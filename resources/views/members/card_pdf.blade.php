<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 20px; }
        .header { background: #0d9488; color: white; padding: 10px; text-align: center; }
        .content { margin-top: 20px; }
        .row { margin-bottom: 8px; }
        .label { font-weight: bold; width: 120px; display: inline-block; }
        .value { }
        .footer { margin-top: 30px; text-align: right; font-size: 12px; color: #555; }
    </style>
</head>
<body>
    <div class="header">
        <h2>KARTU TANDA ANGGOTA APPTASI</h2>
        <p>{{ $member->nama_lengkap }} &middot; {{ $member->nomor_anggota }}</p>
    </div>
    <div class="content">
        <div class="row"><span class="label">Nama:</span> <span class="value">{{ $member->nama_lengkap }}</span></div>
        <div class="row"><span class="label">Nomor:</span> <span class="value">{{ $member->nomor_anggota }}</span></div>
        <div class="row"><span class="label">Jabatan:</span> <span class="value">{{ $member->jabatan }}</span></div>
        <div class="row"><span class="label">Masa Berlaku:</span> <span class="value">{{ $member->isActive() ? $member->getExpirationDate()->translatedFormat('F Y') : 'EXPIRED' }}</span></div>
    </div>
    <div class="footer">
        Jakarta, {{ $member->tanggal_bergabung ? $member->tanggal_bergabung->translatedFormat('d F Y') : now()->translatedFormat('d F Y') }}
    </div>
</body>
</html>

