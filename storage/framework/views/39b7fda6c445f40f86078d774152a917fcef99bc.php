 

<?php $__env->startSection('title'); ?>
Konsultasi
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/select2/dist/css/select2.min.css')); ?>">
<style>
.modal-backdrop {
        z-index: 0;
}
.select2-container--default .select2-selection--single, .select2-selection--multiple{
    background-color: #F5F3FF !important;
    border-color: #C4B5FD !important;
    /* padding-top: 6px !important; */
    font-weight:500 !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #aaa;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    margin-right:8px;
    color:#ffffff;
}
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Konsultasi</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Form Konsultasi Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('konsultasi_index')); ?>"><u>Konsultasi</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('konsultasi_store')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmStatus" value="baru">

<div class="row">
    <div class="col-md-8">
        <div class="card shadow  border-top5 border-form">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Subjek</div>
                    <div class="col-md-12">
                        <input type="text" class="form-control font-weight-500 border-form bg-form h-45"
                            name="nmJudul" value="<?php echo e(old('nmJudul')); ?>" required>
                        <small class="text-danger"><?php echo e($errors->first('nmJudul')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Topik</div>
                    <div class="col-md-12">
                        <select name="nmKategori" id="nmKategori" class="form-control select2 w-100" required>
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kat->jenis_id); ?>"><?php echo e($kat->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Pertanyaan</div>
                    <div class="col-md-12">
                        <textarea id="nmPertanyaan" name="nmPertanyaan" rows="10"
                        class="form-control bg-form border-form" required><?php echo e(old('nmPertanyaan')); ?></textarea>
                        
                        <small class="text-danger"><?php echo e($errors->first('nmKeterangan')); ?></small>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center border-top">
                <button type="submit" class="btn btn-lg btn-dark">
                    <span class="font-16"><i class="fas fa-check mr-2"></i>Proses</span>
                </button>
            </div>
        </div>
    </div>
        <div class="col-md-4">
            
            
        </div>
    
</div>

</form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.full.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/konsultasi/create.blade.php ENDPATH**/ ?>