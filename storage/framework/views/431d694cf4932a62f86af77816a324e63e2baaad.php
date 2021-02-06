 

<?php $__env->startSection('title'); ?>
Kelola Data Jabatan - Ubah Data
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .dropleft .dropdown-toggle::before {
    display: none !important;
    }
    .dropdown-toggle::after {
    display: none !important;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Jabatan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span>
        
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('jabatan_create')); ?>" class="text-success dropdown-item" title="Buat Data Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('jabatan_detail', $jabatan->id)); ?>" class="text-primary dropdown-item" title="Lihat Detail"><i class="far fa-file-alt  mr-2 font-12"></i>Detail
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Ubah Data Jabatan  
            <i class="fas fa-edit align-top ml-2"></i>
        </span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('jabatan_index')); ?>"><u>Jabatan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('jabatan_update')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmStatus" value="edit">
<input type="hidden" name="nmID" value="<?php echo e($jabatan->id); ?>">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="text-right">
            <a href="<?php echo e(route('jabatan_detail', $jabatan->id)); ?>" title="Batal Ubah Data">
                <i class="fas fa-times font-16 text-abu"></i>
            </a>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Jabatan</div>
                    <div class="col-md-9">
                        <textarea id="nmJabatan" name="nmJabatan" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2"><?php echo e($jabatan->nama); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmJabatan')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kode</div>
                    <div class="col-md-9">
                        <input id="nmKode" name="nmKode" class="form-control h-45 
                                border-form bg-form font-weight-500" value="<?php echo e($jabatan->kode_pmi_jabatan); ?>">
                        <small class="text-danger"><?php echo e($errors->first('nmKode')); ?></small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Keterangan</div>
                    <div class="col-md-9">
                        <textarea id="nmKeterangan" name="nmKeterangan" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2"><?php echo e($jabatan->keterangan); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmKeterangan')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-16 my-1 font-weight-bold text-dark">
                        Status
                    </div>
                    <div class="col-md-9 my-1 font-weight-bold text-dark">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdFormal" name="nmStsFormal" 
                                class="custom-control-input" value="1" <?php if($jabatan->sts_formal === 1): ?> checked <?php endif; ?>>
                            <label class="custom-control-label" style="cursor:pointer;" for="rdFormal">Formal</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdInformal" name="nmStsFormal" 
                                class="custom-control-input" value="0" <?php if($jabatan->sts_formal === 0): ?> checked <?php endif; ?>>
                            <label class="custom-control-label" style="cursor:pointer;" for="rdInformal">Informal</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button type="submit" class="btn btn-lg btn-dark">
            <span class="font-16"><i class="fas fa-check mr-2"></i>Perbarui</span>
        </button>
    </div>
</div>

</form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/master/jabatan/edit.blade.php ENDPATH**/ ?>