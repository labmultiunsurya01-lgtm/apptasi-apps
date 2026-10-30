<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::active()
            ->orderBy('tanggal_bergabung', 'desc')
            ->paginate(12);

        return view('members.index', compact('members'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            'nik'              => 'required|string|size:16|unique:members,nik',
            'email'            => 'required|email|unique:members,email',
            'no_hp'            => 'required|string|max:20',
            'alamat'           => 'required|string',
            'institusi'        => 'required|string|max:255',
            'jabatan'          => 'required|string|max:100',
            'foto'             => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'ktp'              => 'required|image|mimes:jpg,jpeg,png|max:1024',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:1024',
        ], [
            'nik.size'     => 'NIK harus 16 digit',
            'nik.unique'   => 'NIK sudah terdaftar',
            'email.unique' => 'Email sudah terdaftar',
            'foto.required'             => 'Pas foto wajib diunggah.',
            'foto.image'                => 'Pas foto harus berupa gambar.',
            'foto.mimes'                => 'Pas foto harus berformat JPG/JPEG/PNG.',
            'foto.max'                  => 'Pas foto maksimal 2MB.',
            'ktp.required'              => 'Scan KTP wajib diunggah.',
            'ktp.image'                 => 'Scan KTP harus berupa gambar.',
            'ktp.mimes'                 => 'Scan KTP harus berformat JPG/JPEG/PNG.',
            'ktp.max'                   => 'Scan KTP maksimal 1MB.',
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diunggah.',
            'bukti_pembayaran.image'    => 'Bukti pembayaran harus berupa gambar.',
            'bukti_pembayaran.mimes'    => 'Bukti pembayaran harus berformat JPG/JPEG/PNG.',
            'bukti_pembayaran.max'      => 'Bukti pembayaran maksimal 1MB.',
        ]);

        // Simpan pas foto (bersifat publik, digunakan untuk kartu anggota)
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('members', 'public');
        }

        // Simpan dokumen sensitif (KTP & bukti pembayaran) di disk PRIVAT
        if ($request->hasFile('ktp')) {
            $validated['ktp'] = $request->file('ktp')->store('documents/ktp', 'private');
        }

        if ($request->hasFile('bukti_pembayaran')) {
            $validated['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('documents/payment', 'private');
        }

        $validated['status'] = 'pending';

        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', 'Pendaftaran berhasil! Status Anda masih menunggu persetujuan admin.');
    }

    public function printCard(Member $member)
    {
        if (!$member->isApproved()) {
            abort(403, 'Kartu anggota hanya tersedia untuk anggota yang sudah disetujui.');
        }

        return view('members.card', compact('member'));
    }
}
