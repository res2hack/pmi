


<?php $__env->startSection('meta'); ?>
    
    
    
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Pengumuman - P3TKI JATIM
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

 <!-- Main content -->
 <section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center">
                <!-- Heading -->
                <h1 class="text-white my-4 mx-2" style="line-height:1.2;">
                    Pengumuman
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
                    <?php $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($x->id == $last->id): ?>
                            <h4 class="my-4 font-weight-700" >
                                <i class="fas fa-bell mr-2 text-primary"></i>
                                <?php echo e($x->title); ?> 
                                <span class="ml-3 font-12 bg-primary text-white px-2 py-1 align-middle">
                                    <i class="far fa-calendar-check mr-2"></i>  <?php echo e(\Carbon\Carbon::parse($x->published_date)->format('d-m-Y')); ?>

                                </span>
                            </h4>
                            <div class="mb-5">
                                <?php echo $x->content; ?>

                            </div>
                            
                        <?php else: ?>
                        
                            <h5 class="pt-1  pb-3 border-bottom" >
                                <i class="far fa-bell mr-2 text-primary"></i>
                                <a href="<?php echo e(route('pengumuman_show', $x->slug)); ?>" class="text-primary">
                                    <u><?php echo e($x->title); ?></u>
                                </a>  
                                <span class="ml-3 font-12 bg-light px-2 py-1">
                                  <i class="far fa-calendar-check mr-2"></i>  <?php echo e(\Carbon\Carbon::parse($x->published_date)->format('d-m-Y')); ?>

                                </span>
                            </h5>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-4 pt-3">
                    <?php echo e($pengumuman->links()); ?>

                </div>
                
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts-front.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/pengumuman/front.blade.php ENDPATH**/ ?>