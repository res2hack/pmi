 

<?php $__env->startSection('title'); ?>
Kelola Berita & Artikel
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-align-left font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Berita & Artikel</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Sampah</span></div>
            
        <span class="font-weight-500">Daftar Artikel Yang Telah Dihapus <i class="fas fa-trash text-danger ml-2"></i></span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('post_index')); ?>"><u>Artikel</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Sampah</span>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">

                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <a href="<?php echo e(route('post_create')); ?>" class="btn btn-dark font-15 py-2" title="Kembali ke Halaman Indeks">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                            <form action="<?php echo e(route('post_search_sampah')); ?>" class="d-inline ">
                            <input type="hidden" name="idpost" value="sampah">
                            <span class="ml-2  pl-2 border  rounded bg-light" style="opacity:0.7;padding-top:10px;padding-bottom:11px;">
                                <input type="text" name="search" class="font-14 font-weight-bold border-0 bg-transparent" value="<?php echo e($search); ?>">
                                <button class="btn"  type="submit"><i class="fas fa-search"></i></button>
                            </span>
                            </form>
                            <?php if($post_simple->count() > 0): ?>
                                <span class="align-middle font-weight-bold ml-2 border rounded px-2" style="padding-top:10px;padding-bottom:10px;">
                                    <?php echo e(($post_simple->currentpage()-1)* $post_simple->perpage() + 1); ?>-<?php echo e(($post_simple->currentpage()-1)* $post_simple->perpage() + $post_simple->count()); ?> dari <?php echo e($post_paginate->total()); ?> artikel
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3">
                            <span class="float-right"><?php echo e($post_simple->links()); ?></span> 
                        </div>
                        
                    </div>
                    <?php if($post_simple->count() > 0): ?>
                    <div class="table-responsive mt-2">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="font-15" >Judul</th>
                                    <th class="font-15" style="width:15%;">Status</th>
                                    <th class="font-15" style="width:13%;">SEO Meta</th>
                                    <th class="font-15" style="width:16%;">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php $__currentLoopData = $post_paginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="py-2">
                                        <strong class="font-15 text-dark"><?php echo e($x->title); ?></strong> 
                                        <br>
                                        <small class="font-11">/<?php echo e($x->slug); ?></small>
                                        <div class="mt-1">
                                            <small class="ml-2"><a href="<?php echo e(route('post_edit', $x->id )); ?>" class="font-12"><i class="fas fa-angle-right mr-2"></i>Detail</a></small>
                                            <small class="ml-2">
                                                <a href="" onclick="$('#idRestore').val(<?php echo e($x->id); ?>);" title="Kembalikan Artikel" 
                                                data-toggle="modal" data-target="#modalRestore" class="font-12 text-success"><i class="fas fa-reply mr-2"></i>Restore</a>
                                            </small>
                                            <small class="ml-2">
                                                <a href="" onclick="$('#idDelete').val(<?php echo e($x->id); ?>);" title="Hapus Permanen" 
                                                data-toggle="modal" data-target="#modalHapus" class="font-12 text-danger"><i class="fas fa-times mr-2"></i>Hapus Permanen</a>
                                            </small>
                                        </div>
                                    </td>
                                    <td class="py-2">
                                        <?php if($x->status === "draft"): ?>
                                            <i class="fas fa-circle mr-1 font-10 text-warning"></i>
                                            <span class="text-capitalize font-weight-bold text-warning">
                                                <?php echo e($x->status); ?>

                                            </span>
                                        <?php elseif($x->status === "terbit"): ?>
                                            <i class="fas fa-circle mr-2 font-9 text-primary"></i>
                                            <span class="text-capitalize font-weight-bold font-12 text-primary">
                                                <?php echo e($x->status); ?>

                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-2">
                                        <div class="font-12">Title : <?php if($x->meta_title): ?> <i class="ml-1 fas fa-check text-success"></i> <?php else: ?> <i class="ml-1 fas fa-minus"></i> <?php endif; ?></div>
                                        <div class="font-12">Desc: <?php if($x->meta_description): ?> <i class="ml-1 fas fa-check text-success"></i> <?php else: ?> <i class="ml-1 fas fa-minus"></i> <?php endif; ?></div>
                                    </td>
                                    <td class="text-capitalize py-2">
                                        <span class="font-12 font-weight-bold text-dark"><?php echo e(\Carbon\Carbon::parse($x->published_date)->format('d-m-Y')); ?></span>
                                        <br>
                                        <small> oleh <?php echo e(Auth::user()->name); ?></small>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <div class="card-body text-center">
                            <h5>Tidak ada artikel</h5>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-8">
                            <?php echo e($post_paginate->links()); ?>

                        </div>
                        <div class="col-md-4 text-right pt-2">
                            <?php if($post_paginate->count() > 0): ?>
                            <span class="font-weight-bold">
                            Menampilkan <?php echo e(($post_paginate->currentpage()-1)* $post_paginate->perpage() + 1); ?>-<?php echo e(($post_paginate->currentpage()-1)* $post_paginate->perpage() + $post_paginate->count()); ?> dari <?php echo e($post_paginate->total()); ?> artikel
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('posts.modal-sampah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/posts/sampah.blade.php ENDPATH**/ ?>