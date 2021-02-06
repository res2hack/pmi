 

<?php $__env->startSection('title'); ?>
Kelola Data P3MI - Detail
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .dropdown-toggle::after {
    display: none !important;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data P3MI</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('p3mi_create')); ?>" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('p3mi_edit', $direktori->id)); ?>" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Data P3MI <i class="far fa-file-alt ml-2"></i></span>
        
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('p3mi_index')); ?>"><u>P3MI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Detail</span>
<input type="hidden" name="jenisDirektori" value="p3mi">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-3">
            <div class="col-md-12 text-right">
                <a href="<?php echo e(route('p3mi_index')); ?>" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>
                <a href="<?php echo e(route('p3mi_edit', $direktori->id)); ?>" class="btn btn-dark ml-2">
                    <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                </a>
                
                <a href="<?php echo e(route('p3mi_delete')); ?>" class="btn btn-danger ml-2"
                    data-toggle="modal" data-target="#exampleModalCenter" 
                    onclick="$('#idDelete').val(<?php echo e($direktori->id); ?>);" title="Hapus Data">
                    <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                </a>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Nama P3MI</div>
            <div class="py-2 col-9 font-weight-500 text-primary">
                <?php echo e($direktori->nama); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Kantor</div>
            <div class="py-2 col-9 font-weight-500 text-primary">
                <?php echo e($direktori->kategori === "p3mi-pusat"?'Pusat':'Cabang'); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Alamat</div>
            <div class="py-2 col-9 font-weight-500">
                <?php echo e($direktori->alamat); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Kontak</div>
            <div class="py-2 col-9 font-weight-500">
                <?php echo e($direktori->kontak); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Tampil</div>
            <div class="py-2 col-9 font-weight-500 ">
                <?php if($direktori->sts_tampil == 0): ?>
                    <i class="font-15 far fa-times-circle text-danger"></i>
                <?php else: ?>
                    <i class="font-15 far fa-check-circle text-success"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Valid</div>
            <div class="py-2 col-9 font-weight-500 ">
                <?php if($direktori->sts_valid == 0): ?>
                    <i class="font-15 far fa-times-circle text-danger"></i>
                <?php else: ?>
                    <i class="font-15 far fa-check-circle text-success"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Detail</div>
            <div class="py-2 col-9 font-weight-500">
                <?php echo $direktori->detail; ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<form method="POST" action="<?php echo e(route('p3mi_delete')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('sistem.direktori.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/direktori/p3mi/detail.blade.php ENDPATH**/ ?>