 

<?php $__env->startSection('title'); ?>
Kelola Data Jabatan - Buat Baru
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
.modal-backdrop {
        z-index: 0;
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
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Buat Data Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('jabatan_index')); ?>"><u>Jabatan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('jabatan_store')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmStatus" value="baru">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Jabatan</div>
                    <div class="col-md-9">
                        <textarea id="nmJabatan" name="nmJabatan" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2"><?php echo e(old('nmJabatan')); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmJabatan')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kode</div>
                    <div class="col-md-9">
                        <input id="nmKode" name="nmKode" class="form-control h-45 
                                border-form bg-form font-weight-500" value="<?php echo e(old('nmKode')); ?>">
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
                            rows="2"><?php echo e(old('nmKeterangan')); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmKeterangan')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-16 my-1 font-weight-bold text-dark">
                        Status
                    </div>
                    <div class="col-md-9 my-1 font-weight-bold text-dark">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdFormal" name="nmStsFormal" class="custom-control-input" value="1" checked>
                            <label class="custom-control-label" style="cursor:pointer;" for="rdFormal">Formal</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdInformal" name="nmStsFormal" class="custom-control-input" value="0">
                            <label class="custom-control-label" style="cursor:pointer;" for="rdInformal">Informal</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button type="submit" class="btn btn-lg btn-dark">
            <span class="font-16"><i class="fas fa-check mr-2"></i>Simpan</span>
        </button>
    </div>
</div>

</form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/master/jabatan/create.blade.php ENDPATH**/ ?>