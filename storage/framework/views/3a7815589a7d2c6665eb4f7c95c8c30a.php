

<?php $__env->startSection('title', $gallery->title); ?>

<?php $__env->startSection('content'); ?>
<section class="py-12">
    <div class="max-w-4xl mx-auto px-4">
        
        <a href="<?php echo e(route('gallery')); ?>" class="inline-flex items-center text-teal-600 hover:text-teal-800 mb-6">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Galeri
        </a>

        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            
            <?php if($gallery->image): ?>
                <img src="<?php echo e($gallery->image_url); ?>" alt="<?php echo e($gallery->title); ?>" class="w-full h-96 object-cover">
            <?php else: ?>
                <div class="w-full h-96 bg-gradient-to-br from-teal-600 to-teal-800 flex items-center justify-center">
                    <i class="fas <?php echo e($gallery->icon); ?> text-8xl text-white/30"></i>
                </div>
            <?php endif; ?>

            
            <div class="p-8">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-800 mb-2"><?php echo e($gallery->title); ?></h1>
                        <p class="text-gray-500 text-sm">
                            <i class="fas <?php echo e($gallery->icon); ?> mr-2"></i>
                            Dibuat pada <?php echo e($gallery->created_at->translatedFormat('d F Y H:i')); ?>

                        </p>
                    </div>
                </div>

                
                <div class="prose prose-lg max-w-none text-gray-700 mb-8 prose-p:text-base prose-p:leading-relaxed prose-p:my-4 prose-headings:font-bold prose-headings:text-gray-800 prose-ul:my-4 prose-li:my-1 prose-strong:font-semibold prose-strong:text-gray-900">
                    <?php echo $gallery->description; ?>

                </div>

                
                <div class="flex gap-4">
                    <?php
                        $prevGallery = \App\Models\Gallery::where('is_active', true)
                            ->where('created_at', '>', $gallery->created_at)
                            ->orderBy('created_at')
                            ->first();
                        
                        $nextGallery = \App\Models\Gallery::where('is_active', true)
                            ->where('created_at', '<', $gallery->created_at)
                            ->orderBy('created_at', 'desc')
                            ->first();
                    ?>

                    <?php if($prevGallery): ?>
                        <a href="<?php echo e(route('gallery.show', $prevGallery)); ?>" class="flex items-center text-teal-600 hover:text-teal-800 font-semibold">
                            <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo e(route('gallery')); ?>" class="flex-1 text-center bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fas fa-th-large mr-2"></i>Lihat Semua Galeri
                    </a>

                    <?php if($nextGallery): ?>
                        <a href="<?php echo e(route('gallery.show', $nextGallery)); ?>" class="flex items-center text-teal-600 hover:text-teal-800 font-semibold">
                            Berikutnya<i class="fas fa-chevron-right ml-2"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apptasi\resources\views/gallery/show.blade.php ENDPATH**/ ?>