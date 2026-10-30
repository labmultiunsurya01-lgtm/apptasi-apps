<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran APPTASI Disetujui</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background: #f4f4f4; }
        .wrapper { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { background: #0d9488; color: #ffffff; padding: 24px; text-align: center; }
        .header h1 { margin: 0; font-size: 22px; }
        .content { padding: 28px 24px; }
        .info-box { background: #f0fdfa; border-left: 4px solid #0d9488; padding: 16px; margin: 20px 0; border-radius: 4px; }
        .info-box p { margin: 6px 0; }
        .note { background: #fff7ed; border-left: 4px solid #f59e0b; padding: 14px; margin: 20px 0; border-radius: 4px; font-size: 14px; }
        .footer { background: #f8fafc; padding: 18px 24px; text-align: center; font-size: 13px; color: #64748b; border-top: 1px solid #e2e8f0; }
        ul { padding-left: 20px; }
        li { margin-bottom: 6px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>✅ Pendaftaran APPTASI Disetujui</h1>
        </div>

        <div class="content">
            <p>Halo <strong><?php echo e($member->nama_lengkap); ?></strong>,</p>

            <p>Kami dengan senang hati menginformasikan bahwa <strong>pendaftaran Anda sebagai anggota APPTASI telah disetujui</strong>!</p>

            <div class="info-box">
                <p><strong>Nama:</strong> <?php echo e($member->nama_lengkap); ?></p>
                <p><strong>Nomor Anggota:</strong> <?php echo e($member->nomor_anggota); ?></p>
                <p><strong>Bergabung Sejak:</strong> <?php echo e($member->tanggal_bergabung->translatedFormat('d F Y')); ?></p>
                <p><strong>Berlaku Hingga:</strong> <?php echo e($member->getExpirationDate()->translatedFormat('d F Y')); ?></p>
            </div>

            <p><strong>📎 Kartu Anggota Digital</strong><br>
            Kartu anggota digital Anda telah disertakan dalam lampiran email ini (file PDF).</p>

            <div class="note">
                <strong>Catatan Penting:</strong>
                <ul>
                    <li>Kartu ini adalah bukti sah keanggotaan Anda di APPTASI</li>
                    <li>Kartu hanya berlaku selama 3 tahun sejak tanggal bergabung</li>
                    <li>Kartu digital ini untuk referensi pribadi</li>
                    <li>Untuk keperluan formal, silakan hubungi kantor pusat APPTASI</li>
                </ul>
            </div>

            <p><strong>Langkah Selanjutnya:</strong></p>
            <ul>
                <li>Simpan kartu anggota digital Anda dengan baik</li>
                <li>Download & cetak jika diperlukan</li>
                <li>Hubungi admin jika ada pertanyaan</li>
            </ul>

            <p>Terima kasih telah bergabung dengan APPTASI!</p>
        </div>

        <div class="footer">
            © <?php echo e(date('Y')); ?> APPTASI - Asosiasi Profesi Pendidik dan Praktisi Teknisi Akuntansi Indonesia<br>
            Email: admin@apptasi.org
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\apptasi\resources\views/emails/member_approved.blade.php ENDPATH**/ ?>