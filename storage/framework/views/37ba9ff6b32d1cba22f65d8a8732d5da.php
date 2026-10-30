<?php $__env->startSection('title', 'Galeri'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Galeri Kegiatan</h1>
            <p class="text-gray-600">Dokumentasi berbagai kegiatan APPTASI</p>
        </div>

        <?php if($galleries->count() > 0): ?>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('gallery.show', $gallery)); ?>" class="bg-white rounded-xl overflow-hidden card-shadow hover:shadow-xl transition group h-full flex flex-col">
                        <?php if($gallery->image): ?>
                            <img src="<?php echo e($gallery->image_url); ?>" alt="<?php echo e($gallery->title); ?>" class="h-48 w-full object-cover">
                        <?php else: ?>
                            <div class="h-48 bg-gradient-to-br from-teal-600 to-teal-800 flex items-center justify-center">
                                <i class="fas <?php echo e($gallery->icon); ?> text-6xl text-white/40 group-hover:scale-110 transition"></i>
                            </div>
                        <?php endif; ?>
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-semibold text-lg text-gray-800 mb-2 group-hover:text-teal-600 transition line-clamp-2"><?php echo e($gallery->title); ?></h3>
                            <p class="text-sm text-gray-500 line-clamp-3 flex-grow"><?php echo e(strip_tags($gallery->description)); ?></p>
                            <div class="mt-3 pt-3 border-t border-gray-200">
                                <span class="text-xs text-teal-600 font-semibold group-hover:underline">Baca Selengkapnya →</span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            
            <div class="flex justify-center">
                <?php echo e($galleries->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center text-gray-500">
                <i class="fas fa-image text-6xl mb-4"></i>
                <p class="text-lg">Belum ada galeri. Silakan cek kembali nanti.</p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apptasi\resources\views/gallery/index.blade.php ENDPATH**/ ?>