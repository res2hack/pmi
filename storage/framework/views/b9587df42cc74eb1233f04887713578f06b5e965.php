


<?php $__env->startSection('meta'); ?>
    
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Pengumuman - <?php echo e($pengumuman->title); ?> 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<!-- Main content -->
<section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center">
                <!-- Heading -->
                <h1 class="text-white my-4 mx-2" style="line-height:1.2;">
                    <?php echo e($pengumuman->title); ?>

                </h1>
            </div>
        </div>
    </div>
</section>
<section class="slice slice-lg pt-5">
    <div class="container px-5 ">
        <div class="row">
            <div class="col-md-10 text-justify mx-auto">
                <div class="mt-3 text-dark">
                    <?php echo $pengumuman->content; ?>

                </div>

                <div class="text-center mt-5">
                    <a href="<?php echo e(route('pengumuman_front')); ?>" class="btn btn-secondary btn-lg">
                        Kembali ke Pengumuman
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts-front.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/pengumuman/show.blade.php ENDPATH**/ ?>