<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'APPTASI'); ?> - Asosiasi Profesi Pendidik dan Praktisi Teknisi Akuntansi Indonesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #1e3a5f 0%, #0d9488 100%); }
        .card-shadow { box-shadow: 0 10px 40px -10px rgba(0,0,0,0.15); }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="gradient-bg text-white sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-2">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo APPTASI" class="h-10 w-auto">
                    <div>
                        <span class="font-bold text-lg tracking-wide">APPTASI</span>
                        <p class="text-xs text-teal-100 hidden sm:block">Asosiasi Profesi Pendidik dan Praktisi Teknisi Akuntansi</p>
                    </div>
                </a>
                <div class="hidden md:flex space-x-8">
                    <a href="<?php echo e(route('home')); ?>" class="hover:text-teal-200 transition <?php echo e(request()->routeIs('home') ? 'font-semibold border-b-2 border-white' : ''); ?>">Beranda</a>
                    <a href="<?php echo e(route('about')); ?>" class="hover:text-teal-200 transition <?php echo e(request()->routeIs('about') ? 'font-semibold border-b-2 border-white' : ''); ?>">Tentang Kami</a>
                    <a href="<?php echo e(route('members.index')); ?>" class="hover:text-teal-200 transition <?php echo e(request()->routeIs('members.*') ? 'font-semibold border-b-2 border-white' : ''); ?>">Anggota</a>
                    <a href="<?php echo e(route('gallery')); ?>" class="hover:text-teal-200 transition <?php echo e(request()->routeIs('gallery') ? 'font-semibold border-b-2 border-white' : ''); ?>">Galeri</a>
                </div>
                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" class="md:hidden text-white focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-teal-900 pb-4">
            <a href="<?php echo e(route('home')); ?>" class="block px-4 py-2 hover:bg-teal-800">Beranda</a>
            <a href="<?php echo e(route('about')); ?>" class="block px-4 py-2 hover:bg-teal-800">Tentang Kami</a>
            <a href="<?php echo e(route('members.index')); ?>" class="block px-4 py-2 hover:bg-teal-800">Anggota</a>
            <a href="<?php echo e(route('gallery')); ?>" class="block px-4 py-2 hover:bg-teal-800">Galeri</a>
        </div>
    </nav>

    <!-- Flash Message -->
    <?php if(session('success')): ?>
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?php echo e(session('success')); ?></span>
            </div></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
    <?php endif; ?>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="gradient-bg text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">APPTASI</h3>
                    <p class="text-teal-100 text-sm leading-relaxed">
                        Asosiasi Profesi Pendidik dan Praktisi Teknisi Akuntansi Indonesia. 
                        Mewadahi dan mengembangkan kompetensi profesional di bidang teknisi akuntansi.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2 text-teal-100 text-sm">
                        <li><a href="<?php echo e(route('home')); ?>" class="hover:text-white">Beranda</a></li>
                        <li><a href="<?php echo e(route('about')); ?>" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="<?php echo e(route('members.index')); ?>" class="hover:text-white">Keanggotaan</a></li>
<li><a href="<?php echo e(route('gallery')); ?>" class="hover:text-white">Galeri</a></li>
                        <li><a href="<?php echo e(route('login')); ?>" class="hover:text-white">Login Admin</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-teal-100 text-sm">
                        <li><i class="fas fa-envelope mr-2"></i> info@apptasi.or.id</li>
                        <li><i class="fas fa-phone mr-2"></i> +62 21 1234 5678</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>
            <div class="border-t border-teal-700 mt-8 pt-6 text-center text-sm text-teal-200">
                &copy; <?php echo e(date('Y')); ?> APPTASI. All rights reserved.
            </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\apptasi\resources\views/layouts/app.blade.php ENDPATH**/ ?>