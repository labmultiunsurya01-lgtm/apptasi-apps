<?php $__env->startSection('title', 'Admin - Kelola Anggota'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-wrap items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Panel Admin - Kelola Keanggotaan</h1>
            <div class="flex items-center gap-4">
<span class="text-sm text-gray-600">
                    <i class="fas fa-user-shield mr-1 text-teal-700"></i>
                    <?php echo e(Auth::user()->name); ?>

                </span>
<a href="<?php echo e(route('admin.gallery.index')); ?>"
                    class="bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    <i class="fas fa-images mr-1"></i> Kelola Galeri
                </a>
<button type="button" onclick="openPasswordModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    <i class="fas fa-key mr-1"></i> Ganti Password
                </button>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                    </button>
                </form>
            </div>
        </div>

        
        <div class="bg-white rounded-xl card-shadow p-5 mb-8">
            <h3 class="font-semibold text-gray-800 mb-3">
                <i class="fas fa-download mr-2 text-teal-700"></i> Export Laporan Anggota
            </h3>
            <form method="GET" action="<?php echo e(route('admin.index')); ?>" id="filterForm" class="flex flex-wrap items-end gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                    <select name="bulan" onchange="document.getElementById('filterForm').submit()"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 outline-none">
                        <option value="">Semua Bulan</option>
                        <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($b); ?>" <?php echo e(request('bulan') == $b ? 'selected' : ''); ?>>
                                <?php echo e(\Carbon\Carbon::createFromFormat('n', $b)->translatedFormat('F')); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                    <select name="tahun" onchange="document.getElementById('filterForm').submit()"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 outline-none">
                        <option value="">Semua Tahun</option>
                        <?php
                            // Ambil tahun data aktual dari created_at (pending/rejected)
                            $yearsCreated = \App\Models\Member::query()
                                ->whereNotNull('created_at')
                                ->pluck('created_at')
                                ->map(fn($d) => (int) \Carbon\Carbon::parse($d)->year)
                                ->toArray();

                            // Ambil tahun data aktual dari tanggal_bergabung (anggota disetujui)
                            $yearsJoin = \App\Models\Member::query()
                                ->whereNotNull('tanggal_bergabung')
                                ->pluck('tanggal_bergabung')
                                ->map(fn($d) => (int) \Carbon\Carbon::parse($d)->year)
                                ->toArray();

                            // Gabungkan semua + 6 tahun terakhir (fallback)
                            $allYears = array_values(array_unique(array_merge($yearsCreated, $yearsJoin, range(date('Y'), date('Y') - 5))));
                            rsort($allYears); // urutkan dari tahun terbaru ke terlama
                        ?>
                        <?php $__currentLoopData = $allYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($t); ?>" <?php echo e(request('tahun') == $t ? 'selected' : ''); ?>><?php echo e($t); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" onchange="document.getElementById('filterForm').submit()"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 outline-none">
                        <option value="">Semua Status</option>
                        <option value="approved" <?php echo e(request('status') == 'approved' ? 'selected' : ''); ?>>Disetujui</option>
                        <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Menunggu</option>
                        <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>Ditolak</option>
                        <option value="aktif" <?php echo e(request('status') == 'aktif' ? 'selected' : ''); ?>>Anggota Aktif</option>
                        <option value="expire" <?php echo e(request('status') == 'expire' ? 'selected' : ''); ?>>Anggota Expire</option>
                    </select>
                </div>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    <i class="fas fa-filter mr-1"></i> Terapkan Filter
                </button>
                <a href="<?php echo e(route('admin.index')); ?>"
                    class="bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
                <span class="text-gray-400 text-sm mx-1">|</span>
                <button type="submit" formaction="<?php echo e(route('admin.export.excel')); ?>"
                    class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    <i class="fas fa-file-excel mr-1"></i> Export Excel
                </button>
                <a href="<?php echo e(route('admin.export.pdf', ['bulan' => request('bulan'), 'tahun' => request('tahun'), 'status' => request('status')])); ?>"
                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    <i class="fas fa-file-pdf mr-1"></i> Export PDF
                </a>
            </form>
        </div>

        <!-- Pending -->
        <div class="mb-10">
            <h2 class="text-xl font-semibold mb-4 text-yellow-700">
                <i class="fas fa-clock mr-2"></i> Menunggu Persetujuan (<?php echo e($pending->count()); ?>)
            </h2>
            <?php if($pending->isEmpty()): ?>
                <p class="text-gray-500 bg-white p-4 rounded-lg">Tidak ada pendaftaran baru.</p>
            <?php else: ?>
                <div class="bg-white rounded-xl overflow-hidden card-shadow">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100 text-left">
                            <tr>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Institusi</th>
                                <th class="px-4 py-3">Tanggal Daftar</th>
                                <th class="px-4 py-3 text-center">Dokumen</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $pending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-t hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-medium text-gray-800"><?php echo e($m->nama_lengkap); ?></td>
                                    <td class="px-4 py-3 text-gray-600 text-xs"><?php echo e($m->institusi); ?></td>
                                    <td class="px-4 py-3 text-gray-600 text-xs"><?php echo e($m->created_at->format('d M Y H:i')); ?></td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-col gap-1 items-center">
                                            <a href="<?php echo e(route('admin.document', [$m->id, 'payment'])); ?>" target="_blank" 
                                                class="text-blue-600 hover:underline text-[10px] flex items-center bg-blue-50 px-2 py-0.5 rounded border border-blue-200">
                                                <i class="fas fa-receipt mr-1"></i> Bukti Bayar
                                            </a>
                                            <a href="<?php echo e(route('admin.document', [$m->id, 'ktp'])); ?>" target="_blank" 
                                                class="text-indigo-600 hover:underline text-[10px] flex items-center bg-indigo-50 px-2 py-0.5 rounded border border-indigo-200">
                                                <i class="fas fa-id-card mr-1"></i> Scan KTP
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 space-x-1 whitespace-nowrap">
                                        <form action="<?php echo e(route('admin.approve', $m->id)); ?>" method="POST" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="<?php echo e(route('admin.reject', $m->id)); ?>" method="POST" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                                Tolak
                                            </button>
                                        </form>
                                        <form action="<?php echo e(route('admin.destroy', $m)); ?>" method="POST" class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus pendaftaran <?php echo e($m->nama_lengkap); ?>?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-xs">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- Approved -->
        <div class="mb-10">
            <h2 class="text-xl font-semibold mb-4 text-green-700">
                <i class="fas fa-check-circle mr-2"></i> Anggota Disetujui (<?php echo e($approved->total()); ?>)
            </h2>
            <div class="bg-white rounded-xl overflow-hidden card-shadow">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-3">No. Anggota</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Institusi</th>
                            <th class="px-4 py-3">Bergabung</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Kartu</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $approved; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t">
                                <td class="px-4 py-3 font-mono text-teal-700"><?php echo e($m->nomor_anggota); ?></td>
                                <td class="px-4 py-3 font-medium"><?php echo e($m->nama_lengkap); ?></td>
                                <td class="px-4 py-3"><?php echo e($m->institusi); ?></td>
                                <td class="px-4 py-3"><?php echo e($m->tanggal_bergabung?->format('d M Y')); ?></td>
                                <td class="px-4 py-3">
                                    <?php if($m->isActive()): ?>
                                        <span class="px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-700">Aktif</span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 rounded text-xs font-semibold bg-red-100 text-red-700">Expire</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="<?php echo e(route('members.card', $m)); ?>" target="_blank" class="text-teal-600 hover:underline text-xs">
                                        <i class="fas fa-id-card"></i> Lihat
                                    </a>
                                </td>
                                <td class="px-4 py-3">
                                    <?php if(!$m->isActive()): ?>
                                        <form action="<?php echo e(route('admin.renew', $m)); ?>" method="POST" class="inline"
                                            onsubmit="return confirm('Perpanjang keanggotaan <?php echo e($m->nama_lengkap); ?> selama 3 tahun? Nomor urut 5 digit tetap dipertahankan.');">
                                            <?php echo csrf_field(); ?>
                                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                                                <i class="fas fa-sync-alt"></i> Perpanjang
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    <form action="<?php echo e(route('admin.destroy', $m)); ?>" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus anggota <?php echo e($m->nama_lengkap); ?>?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            
            <?php if($approved->hasPages()): ?>
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-gray-600">
                <div>
                    Menampilkan
                    <span class="font-semibold text-gray-800"><?php echo e($approved->firstItem()); ?></span>
                    sampai
                    <span class="font-semibold text-gray-800"><?php echo e($approved->lastItem()); ?></span>
                    dari
                    <span class="font-semibold text-gray-800"><?php echo e($approved->total()); ?></span>
                    data
                    (Halaman <?php echo e($approved->currentPage()); ?> dari <?php echo e($approved->lastPage()); ?>)
                </div>
                <div>
                    <?php echo e($approved->links()); ?>

                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Rejected -->
        <?php if($rejected->isNotEmpty()): ?>
        <div>
            <h2 class="text-xl font-semibold mb-4 text-red-700">
                <i class="fas fa-times-circle mr-2"></i> Ditolak (<?php echo e($rejected->count()); ?>)
            </h2>
            <div class="bg-white rounded-xl overflow-hidden card-shadow">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $rejected; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t">
                                <td class="px-4 py-3"><?php echo e($m->nama_lengkap); ?></td>
                                <td class="px-4 py-3"><?php echo e($m->email); ?></td>
                                <td class="px-4 py-3"><?php echo e($m->updated_at->format('d M Y')); ?></td>
                                <td class="px-4 py-3">
                                    <form action="<?php echo e(route('admin.destroy', $m)); ?>" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus pendaftaran <?php echo e($m->nama_lengkap); ?>?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>


<div id="passwordModal" class="<?php echo e($errors->has('current_password') || $errors->has('new_password') ? '' : 'hidden'); ?> fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-xl card-shadow w-full max-w-md mx-4 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800">
                <i class="fas fa-key mr-2 text-teal-700"></i> Ganti Password
            </h3>
            <button type="button" onclick="closePasswordModal()"
                class="text-gray-400 hover:text-gray-600 text-xl leading-none">&times;</button>
        </div>

        
        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm flex items-center gap-2">
                <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i> <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        
        <?php if($errors->has('current_password') || $errors->has('new_password')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm flex items-start gap-2">
                <i class="fas fa-exclamation-triangle mt-0.5"></i>
                <div>
                    <strong>Perhatian!</strong> Terdapat kesalahan pada pengisian password:
                    <ul class="list-disc list-inside mt-1">
                        <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <li>Password Lama: <?php echo e($message); ?></li>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <li>Password Baru: <?php echo e($message); ?></li>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('password.change')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                <div class="relative">
                    <input type="password" name="current_password" id="current_password" required
                        class="w-full border border-gray-300 rounded-lg pl-3 pr-10 py-2 focus:ring-2 focus:ring-teal-500 outline-none"
                        placeholder="Masukkan password lama">
                    <button type="button" onclick="togglePassword('current_password', this)"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                <div class="relative">
                    <input type="password" name="new_password" id="new_password" required minlength="8"
                        class="w-full border border-gray-300 rounded-lg pl-3 pr-10 py-2 focus:ring-2 focus:ring-teal-500 outline-none"
                        placeholder="Minimal 8 karakter">
                    <button type="button" onclick="togglePassword('new_password', this)"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required minlength="8"
                        class="w-full border border-gray-300 rounded-lg pl-3 pr-10 py-2 focus:ring-2 focus:ring-teal-500 outline-none"
                        placeholder="Ulangi password baru">
                    <button type="button" onclick="togglePassword('new_password_confirmation', this)"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3">
                <button type="button" onclick="closePasswordModal()"
                    class="bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Batal
                </button>
                <button type="submit"
                    class="bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    <i class="fas fa-save mr-1"></i> Simpan Password
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openPasswordModal() {
        document.getElementById('passwordModal').classList.remove('hidden');
    }
    function closePasswordModal() {
        document.getElementById('passwordModal').classList.add('hidden');
    }
    // Lihat / sembunyikan password
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    // Tutup modal jika klik di luar area modal
    document.getElementById('passwordModal').addEventListener('click', function (e) {
        if (e.target === this) {
            closePasswordModal();
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apptasi\resources\views/admin/index.blade.php ENDPATH**/ ?>