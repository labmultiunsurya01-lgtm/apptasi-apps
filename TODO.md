# TODO - Persiapan Publikasi (Final)

## Backup & Maintenance
- [x] Tambahkan Command Backup Database: `php artisan db:backup`.
- [x] Jadwalkan backup otomatis harian di `app/Console/Kernel.php`.
- [ ] Link Storage: Jalankan `php artisan storage:link` di server produksi.

## Notifikasi Email
- [x] Notifikasi Email Otomatis: User akan menerima email berisi Kartu Anggota PDF ketika Admin menekan tombol "Approve".
- [x] Template Email: `resources/views/emails/member_approved.blade.php`.
- [x] Mailable Class: `app/Mail/MemberApprovedMail.php`.

## Pengujian (UAT)
- [ ] **Test Case 1: Pendaftaran** - User mengisi form, upload 3 file (Foto, KTP, Bukti Bayar). Cek apakah masuk ke database dengan status `pending`.
- [ ] **Test Case 2: Proteksi Dokumen** - Pastikan file KTP & Bukti Bayar TIDAK bisa diakses lewat URL publik secara langsung.
- [ ] **Test Case 3: Admin Approval** - Admin login, review data, lalu Approve. Cek apakah nomor anggota terbuat dan email terkirim (cek Mailtrap/Log).
- [ ] **Test Case 4: Export** - Cek apakah file Excel dan PDF yang diunduh menampilkan data yang benar.

# TODO - Perbaikan Status di PDF & Excel (COMPLETED)
... existing content ...
