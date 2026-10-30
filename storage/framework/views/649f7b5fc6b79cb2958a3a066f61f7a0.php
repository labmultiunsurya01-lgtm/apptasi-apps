<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Anggota - <?php echo e($member->nama_lengkap); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #e5e7eb;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px;
        }
        .toolbar {
            text-align: center;
            margin-bottom: 30px;
        }
        .toolbar h1 {
            font-size: 22px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 4px;
        }
        .toolbar .sub {
            font-size: 14px;
            color: #4b5563;
            margin-bottom: 16px;
        }
        .btn-print {
            display: inline-block;
            background: #0f766e;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }
        .btn-print:hover { background: #115e59; }
        .btn-back {
            color: #0f766e;
            font-size: 14px;
            margin-left: 12px;
            text-decoration: underline;
        }
        .tip {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 10px;
        }

        .print-area {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            align-items: flex-start;
            justify-content: center;
        }

        /* ====== KARTU ====== */
        .card {
            width: 350px;
            height: 220px;
            border-radius: 10px;
            overflow: hidden;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            page-break-inside: avoid;
            position: relative;
        }

        /* Watermark untuk kartu digital */
        .card::before {
            content: 'KARTU DIGITAL UNTUK REFERENSI PRIBADI';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 11px;
            font-weight: 700;
            color: rgba(220, 38, 38, 0.15);
            letter-spacing: 2px;
            white-space: nowrap;
            pointer-events: none;
            z-index: 1;
            width: 500px;
            text-align: center;
        }

        /* === DEPAN === */
        .depan-header {
            height: 52px;
            background: linear-gradient(135deg, #0d9488, #0e7490, #1e3a5f);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            flex-shrink: 0;
            position: relative;
            z-index: 2;
        }
        .depan-header .judul {
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }
        .depan-header .judul-sub {
            color: #a5f3fc;
            font-size: 7px;
            margin-top: 2px;
        }
        .depan-header .logo-badge {
            background: #fff;
            border-radius: 6px;
            padding: 3px 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .logo-badge .icon {
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #0891b2, #115e59);
            border-radius: 4px;
            color: #fff;
            font-size: 8px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .logo-badge .nama {
            font-size: 9px;
            font-weight: 800;
            color: #155e75;
            line-height: 1;
        }
        .logo-badge .nama-sub {
            font-size: 5px;
            color: #6b7280;
            line-height: 1.2;
            margin-top: 1px;
            max-width: 90px;
        }

        .depan-body {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 8px 16px;
            gap: 14px;
            min-height: 0;
            position: relative;
            z-index: 2;
        }
        .depan-body .foto {
            width: 76px;
            height: 96px;
            flex-shrink: 0;
            border: 2px solid #0d9488;
            border-radius: 6px;
            overflow: hidden;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .depan-body .foto img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .depan-body .foto .ph {
            font-size: 9px;
            color: #9ca3af;
            font-weight: 700;
        }
        .depan-body .data {
            flex: 1;
            min-width: 0;
        }
        .depan-body .data .row {
            margin-bottom: 5px;
        }
        .depan-body .data .label {
            font-size: 7px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .depan-body .data .value {
            color: #111827;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 1px;
        }
        .depan-body .data .value.nomor { font-size: 14px; }
        .depan-body .data .value.nama { font-size: 13px; }
        .depan-body .data .value.jabatan { font-size: 10px; color: #0d9488; font-weight: 600; }

        .depan-footer {
            height: 46px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            flex-shrink: 0;
            position: relative;
            z-index: 2;
        }
        .depan-footer .qr-box {
            width: 38px;
            height: 38px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 2px;
            overflow: hidden;
            flex-shrink: 0;
        }
        .depan-footer .qr-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .depan-footer .ttd {
            text-align: right;
            font-size: 7px;
            color: #6b7280;
            line-height: 1.3;
        }
        .depan-footer .ttd .tgl { color: #374151; }
        .depan-footer .ttd .nama-ttd {
            font-family: Georgia, serif;
            font-style: italic;
            font-size: 11px;
            color: #374151;
            height: 18px;
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
        }
        .depan-footer .ttd .gelar {
            font-size: 7px;
            font-weight: 700;
            color: #111827;
            border-top: 1px solid #d1d5db;
            padding-top: 1px;
            display: inline-block;
        }

        /* === BELAKANG === */
        .belakang-body {
            flex: 1;
            padding: 12px 16px 8px;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }
        .belakang-body h3 {
            text-align: center;
            font-size: 12px;
            font-weight: 800;
            color: #111827;
            letter-spacing: 1px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 6px;
            margin-bottom: 6px;
        }
        .belakang-body ol {
            font-size: 8.5px;
            color: #374151;
            line-height: 1.6;
            padding-left: 16px;
            margin-bottom: 6px;
        }
        .belakang-body .dpp {
            text-align: center;
            border-top: 1px solid #e5e7eb;
            padding-top: 6px;
            margin-top: auto;
        }
        .belakang-body .dpp .t1 {
            font-size: 8px;
            font-weight: 800;
            color: #111827;
            letter-spacing: 1px;
        }
        .belakang-body .dpp .t2 {
            font-size: 7px;
            font-weight: 700;
            color: #0d9488;
            margin-top: 2px;
            line-height: 1.3;
        }
        .belakang-body .dpp .addr {
            font-size: 7px;
            color: #4b5563;
            margin-top: 4px;
            line-height: 1.5;
        }
        .belakang-footer {
            height: 36px;
            background: linear-gradient(90deg, #0d9488, #1e40af);
            color: #fff;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            flex-shrink: 0;
        }

        @media print {
            body { background: #fff !important; padding: 0; }
            .toolbar { display: none !important; }
            .card { box-shadow: none !important; }
            @page { size: A4; margin: 12mm; }
        }
    </style>
</head>
<body>

    <div class="toolbar">
        <h1>Kartu Tanda Anggota APPTASI</h1>
        <p class="sub"><?php echo e($member->nama_lengkap); ?> · <?php echo e($member->nomor_anggota); ?></p>
        <button onclick="window.print()" class="btn-print">
            <i class="fas fa-print" style="margin-right:6px;"></i> Cetak Kartu
        </button>
        <a href="<?php echo e(route('members.index')); ?>" class="btn-back">Kembali</a>
        <p class="tip">Tips: Saat print, pilih layout Landscape atau sesuaikan skala.</p>
    </div>

    <div class="print-area">

        
        <div class="card">
            <div class="depan-header">
                <div>
                    <div class="judul">KARTU TANDA ANGGOTA</div>
                    <div class="judul-sub">DEWAN PENGURUS PUSAT</div>
                </div>
                <div class="logo-badge">
                    <div class="icon">AP</div>
                    <div>
                        <div class="nama">APPTASI</div>
                        <div class="nama-sub">ASOSIASI PROFESI PENDIDIK DAN PRAKTISI TEKNISI AKUNTANSI</div>
                    </div>
                </div>
            </div>
            <div class="depan-body">
                <div class="foto">
                    <?php if($member->foto): ?>
                        <img src="<?php echo e(asset('storage/'.$member->foto)); ?>" alt="Foto">
                    <?php else: ?>
                        <div class="ph">FOTO</div>
                    <?php endif; ?>
                </div>
                <div class="data">
                    <div class="row">
                        <div class="label">Nomor Anggota</div>
<div class="value nomor"><?php echo e($member->nomor_anggota ?? 'XXXXX'); ?></div>
                    </div>
                    <div class="row">
                        <div class="label">Nama Lengkap</div>
                        <div class="value nama"><?php echo e($member->nama_lengkap); ?></div>
                    </div>
                    <div class="row">
                        <div class="label">Jabatan</div>
                        <div class="value jabatan"><?php echo e($member->jabatan); ?></div>
                    </div>
                    <div class="row">
                        <div class="label">Status</div>
                        <div class="value" style="font-size:10px;font-weight:800;color:<?php echo e($member->isActive() ? '#059669' : '#dc2626'); ?>;">
                            <?php echo e($member->isActive() ? 'AKTIF' : 'EXPIRE'); ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="label">Masa Berlaku</div>
                        <?php if($member->isActive()): ?>
                            <div class="value" style="font-size:10px;font-weight:600;">
                                <?php if($member->tanggal_bergabung): ?>
                                    <?php echo e($member->getExpirationDate()->translatedFormat('F Y')); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="value" style="font-size:11px;font-weight:800;color:#dc2626;">EXPIRE</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="depan-footer">
                <div class="qr-box">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=<?php echo e(urlencode(url('/anggota/kartu/'.$member->id))); ?>"
                        alt="QR"
                        onerror="this.style.display='none';this.parentElement.innerHTML='<span style=\'font-size:7px;color:#9ca3af;\'>QR</span>';">
</div>
                <div class="ttd">
                    <div class="tgl" <?php if(!$member->isActive()): ?> style="color:#dc2626;font-weight:700;" <?php endif; ?>>Jakarta, <?php echo e($member->tanggal_bergabung?->translatedFormat('d F Y') ?? now()->translatedFormat('d F Y')); ?></div>
                    <div>Ketua Umum DPP APPTASI</div>
                    <div class="nama-ttd">Arpinus</div>
                    <span class="gelar">Arpinus, SE, MM</span>
                </div>
            </div>
        </div>

        
        <div class="card">
            <div class="belakang-body">
                <h3>PERHATIAN</h3>
                <ol>
                    <li>Kartu KTA ini merupakan tanda anggota APPTASI yang sah</li>
                    <li>Simpanlah Kartu Anggota ini Dengan Baik</li>
                    <li>Kartu KTA ini berlaku sampai habis masa berlaku</li>
                    <li>Apabila kartu ini hilang mohon untuk melapor kepada pengurus DPP APPTASI</li>
                </ol>
                <div class="dpp">
                    <div class="t1">DEWAN PENGURUS PUSAT</div>
                    <div class="t2">ASOSIASI PROFESI PENDIDIK DAN PRAKTISI TEKNISI AKUNTANSI</div>
                    <div class="addr">
                        Alamat : Jalan Dian Margonda, 14 Pasar Atu Cengkareng, Jakarta Barat<br>
                        Telp : 021-5417874 / 5418727<br>
                        Email : apptasi_leb@gmail.com
                    </div>
                </div>
            </div>
            <div class="belakang-footer">
                <i class="fas fa-globe" style="font-size:10px;opacity:.8;"></i>
                www.apptasi.com
            </div>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\apptasi\resources\views/members/card.blade.php ENDPATH**/ ?>