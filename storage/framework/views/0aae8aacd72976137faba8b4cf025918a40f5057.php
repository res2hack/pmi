 

<?php $__env->startSection('title'); ?>
Kelola Data Pengirim - Buat Baru
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Pengirim</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Buat Data Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pengirim_index')); ?>"><u>Pengirim</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('pengirim_store')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmStatus" value="baru">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-7">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kode</div>
                    <div class="col-md-9">
                        <input id="nmKode" name="nmKode" class="form-control h-45 
                                border-form bg-form font-weight-500" value="<?php echo e(old('nmKode')); ?>">
                        <small class="text-danger"><?php echo e($errors->first('nmKode')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pengirim / Perusahaan</div>
                    <div class="col-md-9">
                        <textarea id="nmPengirim" name="nmPengirim" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2"><?php echo e(old('nmPengirim')); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmPengirim')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pemilik</div>
                    <div class="col-md-9">
                        <textarea id="nmPemilik" name="nmPemilik" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2"><?php echo e(old('nmPemilik')); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmPemilik')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Telepon</div>
                    <div class="col-md-9">
                        <textarea id="nmTelepon" name="nmTelepon" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2"><?php echo e(old('nmTelepon')); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Fax</div>
                    <div class="col-md-9">
                        <textarea id="nmFax" name="nmFax" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2"><?php echo e(old('nmFax')); ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="mt-2 font-15 font-weight-bold text-dark mb-2">Keputusan</label>
                        <textarea id="nmKeputusan" name="nmKeputusan" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="2"><?php echo e(old('nmKeputusan')); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</label>
                        <textarea id="nmAlamat" name="nmAlamat" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="3"><?php echo e(old('nmAlamat')); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="mt-2 font-15 font-weight-bold text-dark mb-2">Alamat Penampungan</label>
                        <textarea id="nmPenampungan" name="nmPenampungan" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            rows="3"><?php echo e(old('nmPenampungan')); ?></textarea>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/master/pengirim/create.blade.php ENDPATH**/ ?>