


<?php $__env->startSection('meta'); ?>
    
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo e($page->meta_title); ?>" />
    <meta property="og:description" content="<?php echo e($page->meta_description); ?>" />
    <meta property="og:url" content="<?php echo e(route('page_show', $page->slug )); ?>" />
    
    <meta property="og:site_name" content="P3TKI JATIM" />
    <meta property="article:author" content="UPT P3TKI JATIM" />
    <meta property="article:published_time" content="<?php echo e($page->published_date); ?>" />
    <meta property="article:modified_time" content="<?php echo e($page->write_date); ?>" />
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php echo e($page->title); ?> - P3TKI JATIM
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

 <!-- Main content -->
 <section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center">
                <!-- Heading -->
                <h1 class="text-white my-4 mx-2" style="line-height:1.2;">
                    <?php echo e($page->title); ?>

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
                    <?php echo $page->content; ?>

                </div>
                
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts-front.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/pages/show.blade.php ENDPATH**/ ?>