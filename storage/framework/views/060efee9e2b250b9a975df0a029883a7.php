<?php $__env->startSection('title', 'Anggota'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-10">
    <div class="max-w-7xl mx-auto px-4">


        <div class="flex justify-center mb-8">
            <div class="inline-flex bg-gray-200 rounded-lg p-1">
                <button onclick="showTab('daftar')" id="tab-daftar"
                    class="px-6 py-2 rounded-md font-medium <?php echo e(request('page') ? 'text-gray-600 hover:text-teal-800' : 'bg-white shadow text-teal-800'); ?>">
                    Pendaftaran
                </button>
                <button onclick="showTab('list')" id="tab-list"
                    class="px-6 py-2 rounded-md font-medium <?php echo e(request('page') ? 'bg-white shadow text-teal-800' : 'text-gray-600 hover:text-teal-800'); ?>">
                    Daftar Anggota
                </button>
            </div>
        </div>


        <div id="panel-daftar" class="<?php echo e(request('page') ? 'hidden' : ''); ?>">

            
            <div id="step-persyaratan">
                
                <div class="bg-teal-700 text-white px-6 py-3 rounded-t-lg inline-block font-semibold tracking-wide mb-0">
                    PENDAFTARAN ANGGOTA BARU
                </div>
                <div class="border-b-2 border-teal-600 mb-8"></div>

                <div class="grid lg:grid-cols-3 gap-8">

                    
                    <div>
                        <h3 class="font-bold text-gray-800 mb-4 text-lg">Persyaratan:</h3>
                        <ul class="space-y-3 text-sm text-gray-700 list-disc list-inside leading-relaxed">
                            <li>Warga Negara Indonesia (Mempunyai KTP).</li>
                            <li>
                                Pendaftaran anggota APPTASI Baru: <strong>Rp. 150.000,-</strong>
                                <span class="text-gray-500">(keanggotaan berlaku selama 1 tahun)</span>
                            </li>
                            <li>Iuran perpanjangan keanggotaan <strong>Rp. 150.000,-</strong> /tahun</li>
                         
                            <li>
                                Anggota yang mendaftar langsung aktif keanggotaannya,
                                setelah proses Review 
                            </li>
                            
                        </ul>

                        
                    </div>

                    
                    <div class="border border-gray-300 rounded-lg p-6 bg-white shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-4 text-center">Pembayaran Keanggotaan APPTASI:</h3>

                        <div class="text-center mb-4">
                            <div class="text-2xl font-bold text-blue-800 tracking-tight">
                                <span class="text-yellow-500">●</span> Bank Mandiri
                            </div>
                            <div class="text-xl font-mono font-bold text-gray-800 mt-2 tracking-wider">
                                1180007164576
                            </div>
                            <div class="text-sm text-gray-600 mt-1">
                                a/n: <strong>Lembaga Sertifikasi Kompetensi Teknisi Akuntansi Bond'09</strong>
                            </div>
                            <div class="text-xs text-red-600 mt-1">
                                <i class="fas fa-map-marker-alt"></i> Bank Mandiri Cabang Jakarta Pusat
                            </div>
                        </div>

                        <ul class="text-sm text-gray-700 space-y-2 border-t pt-4">
                            <li>
                                <i class="fas fa-circle text-[6px] text-teal-600 align-middle mr-1"></i>
                                Pendaftaran anggota APPTASI Baru: <strong>Rp. 150.000,-</strong>
                                <span class="text-gray-500">(keanggotaan berlaku selama 1 tahun)</span>
                            </li>
                            <li>
                                <i class="fas fa-circle text-[6px] text-teal-600 align-middle mr-1"></i>
                                Iuran perpanjangan keanggotaan <strong>Rp. 150.000,-</strong> /tahun
                            </li>
                        </ul>
                    </div>

                    
                    <div>
                        <h3 class="font-bold text-gray-800 mb-4 text-lg">Dokumen:</h3>
                        <div class="space-y-5">
                            <div class="flex items-start gap-3">
                                <div class="w-12 h-12 rounded bg-blue-50 flex items-center justify-center flex-shrink-0 border">
                                    <i class="fas fa-id-card text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">1. Identitas Diri</div>
                                    <p class="text-sm text-gray-600">
                                        Siapkan scan KTP yang masih berlaku (format JPG, maksimal 1MB)
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="w-12 h-12 rounded bg-red-50 flex items-center justify-center flex-shrink-0 border overflow-hidden">
                                    <i class="fas fa-user text-red-500 text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">2. Pas Foto Pendaftar Terbaru</div>
                                    <p class="text-sm text-gray-600">
                                        Siapkan Pas Foto 2x3 (format JPG, minimal lebar 200px, maksimal 2MB)
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="w-12 h-12 rounded bg-gray-100 flex items-center justify-center flex-shrink-0 border">
                                    <i class="fas fa-receipt text-gray-600 text-xl"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">3. Bukti Pembayaran</div>
                                    <p class="text-sm text-gray-600">
                                        Scan / Foto bukti pembayaran (format JPG, maksimal 1MB)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mt-10 pt-6 border-t flex flex-col sm:flex-row items-center justify-center gap-4">
                    <p class="text-sm text-gray-600 text-center sm:text-right">
                        Jika sudah membaca dan melengkapi persyaratan, silahkan<br class="hidden sm:block">
                        melanjutkan pendaftaran melalui tombol ini:
                    </p>
                    <button onclick="showForm()"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-md shadow transition whitespace-nowrap">
                        Lanjutkan Pendaftaran
                    </button>
                </div>
            </div>

            
            <div id="step-form" class="hidden max-w-3xl mx-auto">
                <div class="bg-white rounded-xl card-shadow p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Formulir Pendaftaran Anggota</h2>
                        <button onclick="showPersyaratan()" class="text-sm text-teal-700 hover:underline">
                            ← Kembali ke Persyaratan
                        </button>
                    </div>

                    <form action="<?php echo e(route('members.register')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="grid md:grid-cols-2 gap-5">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                                <input type="text" name="nama_lengkap" value="<?php echo e(old('nama_lengkap')); ?>" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">NIK (16 digit) *</label>
                                <input type="text" name="nik" value="<?php echo e(old('nik')); ?>" required maxlength="16" pattern="\d{16}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. HP *</label>
                                <input type="text" name="no_hp" value="<?php echo e(old('no_hp')); ?>" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Institusi / Tempat Kerja *</label>
                                <input type="text" name="institusi" value="<?php echo e(old('institusi')); ?>" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan *</label>
                                <input type="text" name="jabatan" value="<?php echo e(old('jabatan')); ?>" required
                                    placeholder="Contoh: Dosen, Praktisi, Teknisi Akuntansi"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap *</label>
                                <textarea name="alamat" rows="3" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none"><?php echo e(old('alamat')); ?></textarea>
                            </div>

                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Scan KTP * <span class="text-gray-400 font-normal">(JPG, max 1MB)</span></label>
                                <input type="file" name="ktp" accept="image/jpeg,image/jpg,image/png" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500 outline-none text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pas Foto 2x3 * <span class="text-gray-400 font-normal">(JPG, max 2MB)</span></label>
                                <input type="file" name="foto" accept="image/jpeg,image/jpg,image/png" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500 outline-none text-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bukti Pembayaran * <span class="text-gray-400 font-normal">(JPG, max 1MB)</span></label>
                                <input type="file" name="bukti_pembayaran" accept="image/jpeg,image/jpg,image/png" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500 outline-none text-sm">
                            </div>
                        </div>

                        <div class="mt-8 text-center">
                            <button type="submit"
                                class="bg-teal-700 hover:bg-teal-800 text-white font-semibold px-10 py-3 rounded-lg transition shadow-md">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Pendaftaran
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 text-center mt-4">
                            * Setelah mendaftar, status Anda akan "Menunggu Persetujuan". Setelah disetujui admin, Anda dapat mencetak kartu anggota.
                        </p>
                    </form>
                </div>
            </div>
        </div>


        <div id="panel-list" class="<?php echo e(request('page') ? '' : 'hidden'); ?>">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Anggota Resmi APPTASI</h2>
                <p class="text-gray-600 text-sm mt-1">Anggota yang sudah disetujui dan memiliki kartu anggota</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white rounded-xl card-shadow overflow-hidden hover:shadow-xl transition">
                        <div class="bg-gradient-to-r from-teal-700 to-teal-500 h-20"></div>
                        <div class="px-6 pb-6 -mt-10">
                            <div class="w-20 h-20 rounded-full bg-white border-4 border-white shadow mx-auto overflow-hidden flex items-center justify-center">
                                <?php if($member->foto): ?>
                                    <img src="<?php echo e(asset('storage/'.$member->foto)); ?>" alt="<?php echo e($member->nama_lengkap); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <i class="fas fa-user text-3xl text-teal-600"></i>
                                <?php endif; ?>
                            </div>
                            <div class="text-center mt-3">
                                <h3 class="font-bold text-lg text-gray-800"><?php echo e($member->nama_lengkap); ?></h3>
                                <p class="text-sm text-teal-700 font-medium"><?php echo e($member->nomor_anggota); ?></p>
                                <p class="text-sm text-gray-500 mt-1"><?php echo e($member->jabatan); ?></p>
                                <p class="text-xs text-gray-400"><?php echo e($member->institusi); ?></p>
                                <p class="text-xs text-gray-400 mt-1">
                                    Bergabung: <?php echo e($member->tanggal_bergabung?->format('d M Y')); ?>

                                </p>
                                <p class="text-xs text-teal-600 font-medium mt-4">
                                    <i class="fas fa-check-circle mr-1"></i> Kartu dikirim via email
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <i class="fas fa-users text-5xl mb-4 opacity-30"></i>
                        <p>Belum ada anggota yang disetujui.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-8">
                <?php echo e($members->links()); ?>

            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function showTab(tab) {
        document.getElementById('panel-daftar').classList.add('hidden');
        document.getElementById('panel-list').classList.add('hidden');
        document.getElementById('tab-daftar').classList.remove('bg-white', 'shadow', 'text-teal-800');
        document.getElementById('tab-list').classList.remove('bg-white', 'shadow', 'text-teal-800');
        document.getElementById('tab-daftar').classList.add('text-gray-600');
        document.getElementById('tab-list').classList.add('text-gray-600');

if (tab === 'daftar') {
            // Jika sedang di halaman pagination, arahkan kembali ke halaman utama tanpa page
            if (new URLSearchParams(window.location.search).has('page')) {
                window.location.href = window.location.pathname;
                return;
            }
            document.getElementById('panel-daftar').classList.remove('hidden');
            document.getElementById('tab-daftar').classList.add('bg-white', 'shadow', 'text-teal-800');
            document.getElementById('tab-daftar').classList.remove('text-gray-600');
            // reset ke step persyaratan
            document.getElementById('step-persyaratan').classList.remove('hidden');
            document.getElementById('step-form').classList.add('hidden');
        } else {
            document.getElementById('panel-list').classList.remove('hidden');
            document.getElementById('tab-list').classList.add('bg-white', 'shadow', 'text-teal-800');
            document.getElementById('tab-list').classList.remove('text-gray-600');
        }
    }

    function showForm() {
        document.getElementById('step-persyaratan').classList.add('hidden');
        document.getElementById('step-form').classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function showPersyaratan() {
        document.getElementById('step-form').classList.add('hidden');
        document.getElementById('step-persyaratan').classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Jika ada error validasi, langsung tampilkan form
    <?php if($errors->any()): ?>
        document.addEventListener('DOMContentLoaded', function() {
            showForm();
        });
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apptasi\resources\views/members/index.blade.php ENDPATH**/ ?>