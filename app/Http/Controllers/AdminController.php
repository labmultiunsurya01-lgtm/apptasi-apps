<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Mail\MemberApprovedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
public function index(Request $request)
    {
        $month  = $request->input('bulan');
        $year   = $request->input('tahun');
        $status = $request->input('status');

        // --- Menunggu (pending) ---  (filter pakai created_at)
        if (in_array($status, ['', 'pending', null])) {
            $pending = $this->applyDateFilter(Member::where('status', 'pending'), $month, $year, 'created_at')->latest()->get();
        } else {
            $pending = collect();
        }

        // --- Disetujui (approved), bisa difilter berdasarkan status keanggotaan --
        //     'approved' => semua anggota disetujui
        //     'aktif'    => approved & belum lewat 3 tahun
        //     'expire'   => approved & sudah lewat 3 tahun
        //     Filter bulan/tahun memakai tanggal_bergabung (kolom yang bermakna utk approved)
        if (in_array($status, ['', 'approved', 'aktif', 'expire', null])) {
            $approved = $this->applyDateFilter(Member::query()->where('status', 'approved'), $month, $year, 'tanggal_bergabung');
            if ($status === 'aktif') {
                $approved->active();
            } elseif ($status === 'expire') {
                $approved->expired();
            }
            $approved = $approved->latest('tanggal_bergabung')->paginate(10);
        } else {
            $approved = Member::query()->where('id', 0)->paginate(10);
        }

        // --- Ditolak (rejected) ---  (filter pakai updated_at)
        if (in_array($status, ['', 'rejected', null])) {
            $rejected = $this->applyDateFilter(Member::where('status', 'rejected'), $month, $year, 'updated_at')->latest()->get();
        } else {
            $rejected = collect();
        }

        return view('admin.index', compact('pending', 'approved', 'rejected'));
    }

    /**
     * Terapkan filter tanggal (bulan/tahun) pada query.
     * @param string $column kolom tanggal yang dipakai (default: created_at)
     */
    private function applyDateFilter($query, $month, $year, $column = 'created_at')
    {
        if ($month && $year) {
            $query->whereYear($column, $year)
                ->whereMonth($column, $month);
        } elseif ($year) {
            $query->whereYear($column, $year);
        }

        return $query;
    }

    public function approve(Member $member)
    {
        $member->update([
            'status'            => 'approved',
            'nomor_anggota'     => $member->generateMemberNumber(),
            'tanggal_bergabung' => now(),
        ]);

        // Kirim email dengan kartu PDF attachment
        if (empty($member->email)) {
            return back()->with('error', 'Anggota tidak memiliki email, tidak dapat mengirim kartu.');
        }
        $mailer = config('mail.default') ?? 'smtp';
        Mail::mailer($mailer)->to($member->email)->send(new MemberApprovedMail($member));

        return back()->with('success', 'Anggota berhasil disetujui. Nomor: ' . $member->nomor_anggota . '. Kartu telah dikirim ke email mereka.');
    }

    public function reject(Member $member)
    {
        $member->update(['status' => 'rejected']);

        return back()->with('success', 'Pendaftaran ditolak.');
    }

    public function renew(Member $member)
    {
        if (!$member->isApproved()) {
            abort(403, 'Hanya anggota yang sudah disetujui yang dapat diperpanjang.');
        }

        if ($member->isActive()) {
            return back()->with('error', 'Keanggotaan anggota masih aktif.');
        }

        $oldMemberNumber = $member->nomor_anggota;
        $member->renewMembership();

        return back()->with(
            'success',
            'Keanggotaan berhasil diperpanjang sampai ' . $member->getExpirationDate()->translatedFormat('d F Y')
                . '. Nomor anggota: ' . $oldMemberNumber . ' menjadi ' . $member->nomor_anggota . '.'
        );
    }

    public function destroy(Member $member)
    {
        // Hapus foto jika ada
        if ($member->foto) {
            Storage::disk('public')->delete($member->foto);
        }

        $member->delete();

        return back()->with('success', 'Anggota berhasil dihapus.');
    }

    /**
     * Ambil daftar anggota berdasarkan filter bulan, tahun, dan status.
     */
    private function getFilteredMembers(Request $request)
    {
        $query = Member::query();

$month  = $request->input('bulan');
        $year   = $request->input('tahun');
        $status = $request->input('status');

        // Tentukan kolom tanggal filter berdasarkan status yang dipilih
        // - approved/aktif/expire => tanggal_bergabung (bermakna utk anggota disetujui)
        // - pending               => created_at
        // - rejected              => updated_at
        // - tanpa status          => tanggal_bergabung (utk approved) / created_at (utk lainnya)
        //   diselesaikan ringkas: gunakan created_at sebagai default, approved pakai tanggal_bergabung
        $dateColumn = 'created_at';

        // Filter status terlebih dahulu agar kolom tanggal sesuai
        if ($status === 'aktif' || $status === 'expire') {
            $query->where('status', 'approved');
            $dateColumn = 'tanggal_bergabung';
        } elseif ($status === 'approved') {
            $query->where('status', 'approved');
            $dateColumn = 'tanggal_bergabung';
        } elseif ($status === 'pending') {
            $query->where('status', 'pending');
            $dateColumn = 'created_at';
        } elseif ($status === 'rejected') {
            $query->where('status', 'rejected');
            $dateColumn = 'updated_at';
        }

        if ($month && $year) {
            $query->whereYear($dateColumn, $year)
                ->whereMonth($dateColumn, $month);
        } elseif ($year) {
            $query->whereYear($dateColumn, $year);
        }

        // Filter khusus status keanggotaan (harus setelah filter status)
        if ($status === 'aktif') {
            $query->active();
        } elseif ($status === 'expire') {
            $query->expired();
        }

        return $query->orderBy($dateColumn, 'desc')->get();
    }

    public function exportExcel(Request $request)
    {
        $members = $this->getFilteredMembers($request);

        $html = $this->renderExcel($members);

        $filename = 'laporan_anggota_' . date('Ymd_His') . '.xls';

        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function exportPdf(Request $request)
    {
        $members = $this->getFilteredMembers($request);

        $title = 'Laporan Data Anggota APPTASI';

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.export_pdf', compact('members', 'title'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan_anggota_' . date('Ymd_His') . '.pdf');
    }

    /**
     * Tampilkan/preview dokumen anggota (ktp atau bukti_pembayaran).
     */
    public function viewDocument(Member $member, $type)
    {
        $field = $type === 'ktp' ? 'ktp' : 'bukti_pembayaran';

        if (!$member->$field || !Storage::disk('private')->exists($member->$field)) {
            abort(404, 'Dokumen tidak ditemukan.');
        }

        return Storage::disk('private')->response($member->$field);
    }

    /**
     * Tentukan status tampilan untuk suatu anggota.
     * Anggota yang disetujui: Aktif (masa < 3 tahun) / Expire (masa >= 3 tahun).
     * Selain itu: Menunggu / Ditolak.
     */
    private function getDisplayStatus(Member $member): string
    {
        if ($member->status === 'approved') {
            return $member->isActive() ? 'Aktif' : 'Expire';
        }

        return $member->status === 'pending' ? 'Menunggu' : 'Ditolak';
    }

    /**
     * Render tabel HTML untuk export Excel (format .xls yang dibuka Excel).
     */
    private function renderExcel($members)
    {
        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel">';
        $html .= '<head><meta charset="UTF-8">';
        $html .= '<style>
            table { border-collapse: collapse; }
            th, td { border: 1px solid #000; padding: 6px 10px; font-size: 12px; }
            th { background-color: #0d9488; color: #fff; font-weight: bold; }
            .title { font-size: 16px; font-weight: bold; text-align: center; margin-bottom: 10px; }
        </style></head><body>';
        $html .= '<div class="title">LAPORAN DATA ANGGOTA APPTASI</div>';

        $html .= '<table>';
        $html .= '<thead><tr>';
        $html .= '<th>No</th>';
        $html .= '<th>No. Anggota</th>';
        $html .= '<th>Nama Lengkap</th>';
        $html .= '<th>NIK</th>';
        $html .= '<th>Email</th>';
        $html .= '<th>No. HP</th>';
        $html .= '<th>Institusi</th>';
        $html .= '<th>Jabatan</th>';
        $html .= '<th>Tanggal Daftar</th>';
        $html .= '<th>Status</th>';
        $html .= '</tr></thead>';
        $html .= '<tbody>';

        foreach ($members as $index => $m) {
            $html .= '<tr>';
            $html .= '<td>' . ($index + 1) . '</td>';
            $html .= '<td>' . ($m->nomor_anggota ?? '-') . '</td>';
            $html .= '<td>' . e($m->nama_lengkap) . '</td>';
            $html .= '<td>' . e($m->nik) . '</td>';
            $html .= '<td>' . e($m->email) . '</td>';
            $html .= '<td>' . e($m->no_hp) . '</td>';
            $html .= '<td>' . e($m->institusi) . '</td>';
            $html .= '<td>' . e($m->jabatan) . '</td>';
            $html .= '<td>' . ($m->created_at?->format('d-m-Y') ?? '-') . '</td>';
            $html .= '<td>' . $this->getDisplayStatus($m) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
        $html .= '</body></html>';

        return $html;
    }
}
