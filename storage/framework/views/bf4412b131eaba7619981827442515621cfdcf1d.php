 

<?php $__env->startSection('title'); ?>
Kelola Data Pengirim - Ubah Data
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Pengirim</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span>
        
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('pengirim_create')); ?>" class="text-success dropdown-item" title="Buat Data Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('pengirim_detail', $pengirim->id)); ?>" class="text-primary dropdown-item" title="Lihat Detail"><i class="far fa-file-alt  mr-2 font-12"></i>Detail
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Ubah Data Pengirim  
            <i class="fas fa-edit align-top ml-2"></i>
        </span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pengirim_index')); ?>"><u>Pengirim</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('pengirim_update')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmStatus" value="edit">
<input type="hidden" name="nmID" value="<?php echo e($pengirim->id); ?>">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="text-right">
            <a href="<?php echo e(route('pengirim_detail', $pengirim->id)); ?>" title="Batal Ubah Data">
                <i class="fas fa-times font-16 text-abu"></i>
            </a>
        </div>
        <div class="row mt-3">
            <div class="col-md-7">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kode</div>
                    <div class="col-md-9">
                        <input id="nmKode" name="nmKode" value="<?php echo e($pengirim->kode); ?>"
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmKode')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pengirim / Perusahaan</div>
                    <div class="col-md-9">
                        <textarea id="nmPengirim" name="nmPengirim" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmPengirim')); ?>" rows="2"><?php echo e($pengirim->nama); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmPengirim')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pemilik</div>
                    <div class="col-md-9">
                        <textarea id="nmPemilik" name="nmPemilik" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmPemilik')); ?>" rows="2"><?php echo e($pengirim->pemilik); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmPemilik')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Telepon</div>
                    <div class="col-md-9">
                        <textarea id="nmTelepon" name="nmTelepon" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmTelepon')); ?>" rows="2"><?php echo e($pengirim->telepon); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Fax</div>
                    <div class="col-md-9">
                        <textarea id="nmFax" name="nmFax" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmFax')); ?>" rows="2"><?php echo e($pengirim->fax); ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="mt-2 font-15 font-weight-bold text-dark mb-2">Keputusan</label>
                        <textarea id="nmKeputusan" name="nmKeputusan" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmKeputusan')); ?>" rows="2"><?php echo e($pengirim->keputusan); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</label>
                        <textarea id="nmAlamat" name="nmAlamat" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmAlamat')); ?>" rows="3"><?php echo e($pengirim->alamat); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label class="mt-2 font-15 font-weight-bold text-dark mb-2">Alamat Penampungan</label>
                        <textarea id="nmPenampungan" name="nmPenampungan" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmPenampungan')); ?>" rows="3"><?php echo e($pengirim->alamat_penampungan); ?></textarea>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/master/pengirim/edit.blade.php ENDPATH**/ ?>