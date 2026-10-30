<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #111827; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 3px solid #0d9488; padding-bottom: 10px; }
        .header .org { font-size: 18px; font-weight: bold; color: #0d9488; letter-spacing: 1px; }
        .header .sub { font-size: 12px; font-weight: bold; margin-top: 4px; }
        .header .title { font-size: 14px; font-weight: bold; margin-top: 8px; }
        .header .meta { font-size: 10px; color: #4b5563; margin-top: 4px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #9ca3af; padding: 5px 6px; text-align: left; }
        th { background-color: #0d9488; color: #fff; font-weight: bold; }
        tr:nth-child(even) { background-color: #f3f4f6; }
        .footer { margin-top: 20px; font-size: 10px; color: #6b7280; text-align: right; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 3px; font-size: 9px; font-weight: bold; }
        .badge-approved { background: #d1fae5; color: #065f46; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-rejected { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>

    <div class="header">
        <div class="org">APPTASI</div>
        <div class="sub">ASOSIASI PROFESI PENDIDIK DAN PRAKTISI TEKNISI AKUNTANSI</div>
        <div class="title">{{ $title }}</div>
        <div class="meta">
            Alamat: Jalan Daan Mogot KM 13,5 Nomor 64 Cengkareng, Jakarta Barat 11730
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:5%;">No</th>
                <th style="width:12%;">No. Anggota</th>
                <th style="width:18%;">Nama Lengkap</th>
                <th style="width:14%;">NIK</th>
                <th style="width:8%;">No. HP</th>
                <th style="width:16%;">Institusi</th>
                <th style="width:12%;">Jabatan</th>
                <th style="width:9%;">Tanggal Daftar</th>
                <th style="width:6%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $index => $m)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $m->nomor_anggota ?? '-' }}</td>
                    <td>{{ $m->nama_lengkap }}</td>
                    <td>{{ $m->nik }}</td>
                    <td>{{ $m->no_hp }}</td>
                    <td>{{ $m->institusi }}</td>
                    <td>{{ $m->jabatan }}</td>
                    <td>{{ $m->created_at?->format('d-m-Y') ?? '-' }}</td>
                    <td>
                        @if($m->status === 'approved')
                            @if($m->isActive())
                                <span class="badge badge-approved">Aktif</span>
                            @else
                                <span class="badge badge-rejected">Expire</span>
                            @endif
                        @elseif($m->status === 'pending')
                            <span class="badge badge-pending">Menunggu</span>
                        @else
                            <span class="badge badge-rejected">Ditolak</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center; padding:20px;">Tidak ada data anggota.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>
