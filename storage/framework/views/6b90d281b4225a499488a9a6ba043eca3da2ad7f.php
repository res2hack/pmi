 

<?php $__env->startSection('title'); ?>
Kelola Kategori Prodesmigratif
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Kategori Prodesmigratif</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Kategori Yang Telah Dibuat</span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Kategori</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="col-md-4">
        <form method="POST" action="<?php echo e(route('kategori_prodesmigratif_store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="card shadow border-top5 border-form ">
                    <div class="font-weight-bold font-20 text-dark p-3 bg-light2">
                        <i class="fas fa-feather text-success font-16 mx-3"></i>Tambah Kategori
                    </div>  
                <div class="card-body mt-0 pb-1 ">
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Nama Kategori</div>
                        <input type="text"  id="nmKategori" name="nmKategori" class="form-control bg-form h-45 border-form" required>
                        <small class="text-danger"><?php echo e($errors->first('nmKategori')); ?></small>
                    </div>
                </div>
                <div class="card-footer border-top mt-2 py-3 text-center">
                    <button type="submit" class="btn btn-lg btn-dark">
                        <i class="fas fa-check mr-3 font-16"></i><span class="font-18">Tambah</span></button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="<?php echo e(route('kategori_prodesmigratif_search')); ?>" class="d-inline ">
                        <span class="pl-2 border  rounded bg-light" style="opacity:0.7;padding-top:10px;padding-bottom:11px;">
                            <input type="text" name="search" class="font-14 font-weight-bold border-0 bg-transparent" value="<?php echo e($search); ?>">
                            <button class="btn"  type="submit"><i class="fas fa-search"></i></button>
                        </span>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <span class="float-right"><?php echo e($kat_simple->links()); ?></span> 
                    </div>
                    
                </div>

                <?php if($kat_paginate->total() < 11): ?>
                    <div class="table-responsive mt-3">
                <?php else: ?>
                    <div class="table-responsive mt-1">
                <?php endif; ?>
                    <table class="table table-striped">
                        <thead>
                            <th class="font-15">Nama Kategori</th>
                            <th class="font-15"></th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $kat_paginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="py-2 font-15 text-dark font-weight-500">
                                    <?php echo e($x->name); ?>

                                </td>
                                <td class="py-2 font-14">
                                    <a class="mr-1" href="<?php echo e(route('kategori_prodesmigratif_edit', $x->id )); ?>" title="Ubah Kategori"><i class="fas fa-edit"></i></a>
                                    <a href="" onclick="$('#idDelete').val(<?php echo e($x->id); ?>);" title="Hapus Kategori" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-times text-danger font-15"></i></a>
                                </td>
                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo e($kat_paginate->links()); ?>

                    </div>
                    <div class="col-md-6 text-right pt-2">
                        <?php if($kat_paginate->count() > 0): ?>
                        <span class="font-weight-bold">
                        Menampilkan <?php echo e(($kat_paginate->currentpage()-1)* $kat_paginate->perpage() + 1); ?>-<?php echo e(($kat_paginate->currentpage()-1)* $kat_paginate->perpage() + $kat_paginate->count()); ?> dari <?php echo e($kat_paginate->total()); ?> Kategori
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<form method="POST" action="<?php echo e(route('kategori_prodesmigratif_delete')); ?>">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle font-15 text-warning mr-2"></i> KONFIRMASI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="font-weight-bold">Anda Yakin Ingin Menghapus Kategori Ini?</div>  
                <input id="idDelete" name="idDelete" type="hidden">
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                <button type="submit" class="btn btn-danger">Ya Hapus</button>
            </div>
        
            </div>
        </div>

    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <?php echo $__env->make('global.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/prodesmigratif/kategori.blade.php ENDPATH**/ ?>