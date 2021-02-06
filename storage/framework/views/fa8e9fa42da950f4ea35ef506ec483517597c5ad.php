


<?php $__env->startSection('meta'); ?>
    
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Kategori Artikel : <?php echo e($category->name); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

 <!-- Main content -->
 <section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center">
                <!-- Heading -->
                <h2 class="text-white my-4 mx-2 text-capitalize" style="line-height:1.2;">
                  Daftar Artikel Untuk Kategori:  <?php echo e($category->name); ?>

                </h2>
            </div>
        </div>
    </div>
</section>
<section class="slice slice-lg pt-5">
    <div class="container px-5 ">
        <div class="row mt-0">
            <div class="col-md-10 mx-auto text-justify">
                <form action="<?php echo e(route('post_cari')); ?>" class="d-inline ">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Artikel" name="search"
                        aria-label="Cari Artikel" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text" id="basic-addon2">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-10 text-justify mx-auto">
                <?php $__currentLoopData = $post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('post_show', [$x->slug_kategori, $x->slug] )); ?>">
                        <li class="media mb-3">
                            <img class="mr-3 avatar mt-1" <?php if(file_exists($x->img_thumbnail)): ?>
                            src="<?php echo e(url($x->img_thumbnail)); ?>" <?php else: ?> src="<?php echo e(asset('theme/frontend/assets/img/no-image.jpg')); ?>"
                            <?php endif; ?> style="width: 120px; height: 100px;">
                            <div class="media-body">
                                <h5 class="font-16 pb-0 mb-0 text-primary"><?php echo e($x->title); ?></h5>  
                                <span class="font-13 font-weight-600">
                                    <i class="fas fa-bookmark mr-2 text-success"></i><?php echo e($x->kategori); ?>

                                </span>
                                <span class="font-12 font-weight-700 ml-3">
                                    <i class="far fa-calendar-check font-17 mr-1 text-success"></i>
                                    <?php echo e(\Carbon\Carbon::parse($x->published_date)->format('d-m-Y')); ?>

                                </span>
                                <p class="font-14 text-dark" style="line-height:1.4;">
                                    <?php echo e(substr(strip_tags(html_entity_decode($x->content)), 0, 150)); ?> ...
                                </p>
                            </div>
                        </li>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <?php echo e($post->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts-front.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/posts/bykategori.blade.php ENDPATH**/ ?>