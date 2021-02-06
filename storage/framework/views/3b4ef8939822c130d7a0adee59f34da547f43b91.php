


<?php $__env->startSection('meta'); ?>
    
    
    
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Prodesmigratif - P3TKI JATIM
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .prodes{
        /* cursor:pointer; */
    }
    .prodes:hover{
        /* cursor:pointer; */
        background:#ECFDF5;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <!-- Main content -->
 <section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center">
                <!-- Heading -->
                <h1 class="text-white my-4 mx-2" style="line-height:1.2;">
                    Prodesmigratif
                </h1>
            </div>
        </div>
    </div>
</section>
<section class="slice slice-lg pt-5">
    <div class="container px-5 ">
        <div class="row">
            <div class="col-md-12">
                <?php echo $deskripsi->deskripsi; ?>

            </div>
            <div class="col-md-12 mt-1 mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <form id="formKategori" action="<?php echo e(route('prodesmigratif_kategori_front')); ?>" class="d-inline ">
                            <select name="kategori" id="kategori" class="form-control" onChange="$('#formKategori').submit();">
                                <option value="">- Semua Kategori -</option>
                                <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kat->jenis_id); ?>"
                                         <?php if($cat == $kat->jenis_id): ?> selected <?php endif; ?>><?php echo e($kat->name); ?>

                                        </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </form>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <form action="<?php echo e(route('prodesmigratif_search_front')); ?>" class="d-inline ">
                            
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari Prodesmigratif.."
                                 name="search" aria-label="Cari Artikel" aria-describedby="basic-addon2" value="<?php echo e($search); ?>">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text" id="basic-addon2">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            <?php $__currentLoopData = $prodesmigratif_paginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="col-md-6 d-flex">
                <div class="card shadow prodes">
                    <div class="card-body ">
                        <ul class="list-unstyled">
                            <a href="<?php echo e(route('prodesmigratif_show', $prodes->slug )); ?>" title="<?php echo e($prodes->judul); ?>">
                                <li class="media">
                                    <img class="mr-3 avatar h-100 mt-1" src="<?php if($prodes->img_thumbnail): ?> <?php echo e(url($prodes->img_thumbnail)); ?> <?php else: ?><?php echo e(url($prodes->img_featured)); ?><?php endif; ?>" style="width: 180px;max-height:160px !important;">
                                    <div class="media-body">
                                        <a href="<?php echo e(route('prodesmigratif_show', $prodes->slug )); ?>" title="<?php echo e($prodes->judul); ?>">
                                            <div class="mt-0 font-17 font-weight-800" style="line-height:22px;"><?php echo e($prodes->judul); ?></div>
                                        </a>
                                        <div><a href="<?php echo e(route('prodesmigratif_kategori_front')); ?>?kategori=<?php echo e($prodes->kategori_id); ?>" class="font-12 bg-success text-white px-2 my-1 rounded" style="padding-top:3px;padding-bottom:3px;"><?php echo e($prodes->kategori); ?></a></div>
                                        <div class="font-14 font-weight-700 text-danger"><?php echo e($prodes->pemilik); ?></div>
                                        <div class="font-13 font-weight-700 mt-1"><?php echo e($prodes->kontak); ?></div>
                                        <div class="font-13 font-weight-700"><?php echo e($prodes->alamat); ?></div>
                                    </div>
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            
            </div>
        
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-1">
            <?php echo e($prodesmigratif_paginate->links()); ?>

        </div>
       
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts-front.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/prodesmigratif/front.blade.php ENDPATH**/ ?>