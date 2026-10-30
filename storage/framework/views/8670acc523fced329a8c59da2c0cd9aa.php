<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - APPTASI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #1e3a5f 0%, #0d9488 100%); }
        .card-shadow { box-shadow: 0 20px 60px -15px rgba(0,0,0,0.3); }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="flex justify-center mb-8">
            <div class="text-center">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo APPTASI" class="h-20 w-auto mx-auto mb-3">
                <h1 class="text-white text-2xl font-bold tracking-wide">APPTASI</h1>
                <p class="text-teal-200 text-sm">Panel Administrator</p>
            </div>
        </div>

        <!-- Card Login -->
        <div class="bg-white rounded-2xl card-shadow overflow-hidden">
            <div class="bg-teal-700 px-6 py-4">
                <h2 class="text-white font-semibold flex items-center gap-2">
                    <i class="fas fa-lock"></i> Masuk ke Panel Admin
                </h2>
            </div>

            <div class="p-8">
                <?php if(session('success')): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                        <ul class="list-disc list-inside">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('login.submit')); ?>" class="space-y-5">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" required autofocus
                                class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none text-sm"
                                placeholder="EMAIL">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-key"></i>
                            </span>
                            <input type="password" name="password" id="password" required
                                class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none text-sm"
                                placeholder="Masukkan password">
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-teal-600">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center text-gray-600">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                            <span class="ml-2">Ingat saya</span>
                        </label>
                        <a href="<?php echo e(route('home')); ?>" class="text-teal-600 hover:underline">Kembali ke Beranda</a>
                    </div>

                    <button type="submit"
                        class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                    </button>
                </form>
            </div>
        </div>

        <p class="text-center text-teal-200 text-xs mt-6">
            &copy; <?php echo e(date('Y')); ?> APPTASI. Hanya untuk pengguna berwenang.
        </p>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
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
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\apptasi\resources\views/admin/login.blade.php ENDPATH**/ ?>