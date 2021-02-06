

<?php $__env->startSection('meta'); ?>
    
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo e($post->meta_title); ?>" />
    <meta property="og:description" content="<?php echo e($post->meta_description); ?>" />
    <meta property="og:url" content="<?php echo e(route('post_show', [$post->slug_kategori, $post->slug] )); ?>" />
    
    <meta property="og:site_name" content="P3TKI JATIM" />
    <meta property="article:author" content="UPT P3TKI JATIM" />
    <meta property="article:published_time" content="<?php echo e($post->published_date); ?>" />
    <meta property="article:modified_time" content="<?php echo e($post->write_date); ?>" />
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php echo e($post->title); ?> - P3TKI JATIM
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

 <!-- Main content -->
 <section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center text-lg-left">
                <!-- Heading -->
                <h1 class="text-white my-4 mx-2" style="line-height:1.2;">
                    <?php echo e($post->title); ?>

                </h1>
                <div class="mx-2 px-1 font-weight-bold">
                    <i class="fas fa-bookmark mr-3 text-success"></i><span class="text-white border-bottom"><?php echo e($post->kategori); ?></span>
                    <i class="far fa-calendar-check ml-4 font-17 mr-2 text-success"></i> <span class="text-white"><?php echo e(\Carbon\Carbon::parse($post->published_date)->format('d-m-Y')); ?></span>  
                  </div>
            </div>
        </div>
    </div>
    <!-- SVG separator -->
    <div class="shape-container shape-line shape-position-bottom">
        <svg width="2560px" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve" class="">
            <polygon points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</section>

<div class="row mt-3">
    <div class="col-12 text-center">
        <a href="<?php echo e(route('home')); ?>" class="font-weight-500">Depan</a> <i class="fas fas fa-angle-right mx-2"></i> 
        <a href="<?php echo e(route('post_category', $category->slug)); ?>" class="font-weight-500">Berita & Artikel</a> <i class="fas fas fa-angle-right mx-2"></i> <?php echo e($post->kategori); ?>

    </div>
</div>
<section class="slice slice-lg pt-5">
    <div class="container px-5 ">
        <div class="row">
            <div class="col-md-8">
                <div class="share-btn" data-url="<?php echo e(url($post->slug)); ?>" data-title="Google" data-desc="Google">
                    <a class="bg-brand-facebook py-1 px-3 text-white rounded font-13" style="cursor:pointer;" data-id="fb"><i class="mr-2 fab fa-facebook-square"></i> Facebook</a>
                    <a class="bg-brand-twitter py-1 px-3 ml-2 text-white rounded font-13" style="cursor:pointer;" data-id="tw"><i class="mr-2 fab fa-twitter"></i> Twitter</a>
                    <a class="bg-brand-slack py-1 px-3 ml-2 text-white rounded font-13" style="cursor:pointer;" data-id="wa"><i class="mr-2 fab fa-whatsapp"></i> WhatsApp</a>
                    
                    <?php if(auth()->guard()->check()): ?>
                    <div class="float-right">
                        <a href="<?php echo e(route('post_edit', $post->id)); ?>" class=" btn-dark font-11 py-1 px-2 rounded">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            
                <?php if(file_exists($post->img_featured)): ?>
                <div class="my-3 text-justify">
                    <img class="img-fluid  w-100" src="<?php echo e(url($post->img_featured)); ?>">
                </div>
                <?php endif; ?>
                <div class="my-3 text-justify">
                    <?php echo $post->content; ?>

                </div>

                <div class="mt-3 mb-5">
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="bg-dark px-2 py-1 rounded font-11 text-secondary"><?php echo e($tag); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <div class="share-btn mt-4" data-url="<?php echo e(url($post->slug)); ?>" data-title="Google" data-desc="Google">
                    <a class="bg-brand-facebook py-1 px-3 text-white rounded font-13" style="cursor:pointer;" data-id="fb"><i class="mr-2 fab fa-facebook-square"></i> Facebook</a>
                    <a class="bg-brand-twitter py-1 px-3 ml-2 text-white rounded font-13" style="cursor:pointer;" data-id="tw"><i class="mr-2 fab fa-twitter"></i> Twitter</a>
                    <a class="bg-brand-slack py-1 px-3 ml-2 text-white rounded font-13" style="cursor:pointer;" data-id="wa"><i class="mr-2 fab fa-whatsapp"></i> WhatsApp</a>
                    
                </div>
                <div class="row mt-4">
                    <div class="col-lg-8 col-md-10">
                        <h3 class=" mt-4">Artikel Terkait</h3>
                    </div>
                </div>
                <div class="row ">
                    
                    <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6">
                        <a href="<?php echo e(route('post_show', [$rel->slug_kategori, $rel->slug ])); ?>" class="media mb-3">
                            <img class="mr-3 avatar mt-1" <?php if(file_exists($rel->img_thumbnail)): ?>
                                src="<?php echo e(url($rel->img_thumbnail)); ?>" <?php else: ?> src="<?php echo e(asset('theme/frontend/assets/img/no-image.jpg')); ?>"
                                <?php endif; ?> style="width: 120px; height: 100px;">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1 font-15 text-primary"><?php echo e($rel->title); ?></h5>
                                
                                
                            </div>
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-md-4">
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

                
                <div class="mt-4">
                    <h4 class="mb-3">Artikel Terbaru</h4>
                    <?php $__currentLoopData = $recent_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <ul class="list-unstyled">
                        <a href="<?php echo e(route('post_show', [$recent->slug_kategori, $recent->slug ])); ?>" class="media mb-3">
                            <img class="mr-3 avatar mt-1" <?php if(file_exists($recent->img_thumbnail)): ?>
                            src="<?php echo e(url($recent->img_thumbnail)); ?>" <?php else: ?> src="<?php echo e(asset('theme/frontend/assets/img/no-image.jpg')); ?>"
                            <?php endif; ?> style="width: 120px; height: 100px;">
                            
                            <div class="media-body">
                                <h5 class="mt-0 mb-1 font-15"><?php echo e($recent->title); ?></h5>
                                <span class="font-13 font-weight-600">
                                    <i class="fas fa-bookmark mr-2 text-success"></i><?php echo e($recent->kategori); ?>

                                </span>
                                <span class="font-12 font-weight-700">
                                    <i class="far fa-calendar-check ml-2 font-17 mr-1 text-success"></i> <?php echo e(\Carbon\Carbon::parse($recent->published_date)->format('d-m-Y')); ?>

                                </span>
                                
                            </div>
                        </a>
                    </ul>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-2">
                    <h4 class="mb-3">Pengumuman</h4>
                </div>
                <div class="mt-2">
                    <h4 class="mb-3">Download</h4>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('theme/frontend/assets/wcoder-share-btn/dist/share-buttons.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts-front.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/posts/show.blade.php ENDPATH**/ ?>