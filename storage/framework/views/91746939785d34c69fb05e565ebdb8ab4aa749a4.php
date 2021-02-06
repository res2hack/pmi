 

<?php $__env->startSection('title'); ?>
Kelola Data KBRI - Buat Baru
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/select2/dist/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/summernote/dist/summernote-bs4.css')); ?>">
<style>
    .select2-container--default .select2-selection--single {
    background-color: #F5F3FF !important;
    border-color: #C4B5FD !important;
    padding-top: 6px !important;
    font-weight:500 !important;
}
.note-editor.note-frame {
    border: 1px solid #C4B5FD;
}
.modal-backdrop {
        z-index: 0;
}


</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data KBRI</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Buat Data Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('kbri_index')); ?>"><u>KBRI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('kbri_store')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmTipe" value="create">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama KBRI</div>
                    <div class="col-md-9">
                        <textarea id="nmDirektori" name="nmDirektori" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmDirektori')); ?>" rows="2"></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmDirektori')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                        <textarea id="nmAlamat" name="nmAlamat" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmAlamat')); ?>" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-16 font-weight-bold text-dark mb-2">Kontak</div>
                    <div class="col-md-9">
                        <textarea id="nmKontak" name="nmKontak" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmKontak')); ?>" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 my-1 font-weight-bold text-dark">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="cbTampil" name="nmTampil"
                                    class="custom-control-input" value="1" checked>
                            <label class="custom-control-label" for="cbTampil" style="cursor:pointer;">Tampil</label>
                        </div>
                        <div class="ml-3 custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="cbValid" name="nmValid" 
                                    class="custom-control-input" value="1" checked>
                            <label class="custom-control-label" for="cbValid" style="cursor:pointer;">Valid</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="font-16 font-weight-bold text-dark mb-2">Detail</div>
                <textarea id="summernote" name="nmDetail" class="summernote"></textarea>
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

<script src="<?php echo e(asset('theme/node_modules/summernote/dist/summernote-bs4.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.full.min.js')); ?>"></script>
<script>
    
    $('#summernote').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link', 'picture']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 200
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/direktori/kbri/create.blade.php ENDPATH**/ ?>