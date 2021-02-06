 

<?php $__env->startSection('title'); ?>
Kelola Data Disnaker - Ubah
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Disnaker</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('disnaker_create')); ?>" class="text-success dropdown-item" title="Buat Data Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('disnaker_detail', $direktori->id)); ?>" class="text-primary dropdown-item" title="Lihat Detail Data Disnaker"><i class="far fa-file-alt  mr-2 font-12"></i>Detail
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Ubah Data</span>
        <i class="fas fa-edit ml-2 align-top"></i>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('disnaker_index')); ?>"><u>Disnaker</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    

<form method="post" action="<?php echo e(route('disnaker_update', $direktori->id)); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmTipe" value="edit">
<input type="hidden" name="idDirektori" value="<?php echo e($direktori->id); ?>">

<div class="card shadow  border-top5 border-form">
    
    <div class="card-body">
        <div class="text-right">
            <a href="<?php echo e(route('disnaker_detail', $direktori->id)); ?>" title="Batal Ubah Data">
                <i class="fas fa-times font-16 text-abu"></i>
            </a>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Dinas</div>
                    <div class="col-md-9">
                        <textarea id="nmDirektori" name="nmDirektori" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmDirektori')); ?>" rows="2"><?php echo e($direktori->nama); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmDirektori')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                        <textarea id="nmAlamat" name="nmAlamat" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmAlamat')); ?>" rows="3"><?php echo e($direktori->alamat); ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-16 font-weight-bold text-dark mb-2">Kontak</div>
                    <div class="col-md-9">
                        <textarea id="nmKontak" name="nmKontak" 
                            class="form-control h-45 border-form bg-form font-weight-500" 
                            value="<?php echo e(old('nmKontak')); ?>" rows="3"><?php echo e($direktori->kontak); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 my-1 font-weight-bold text-dark">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="cbTampil" name="nmTampil"
                                    class="custom-control-input" value="1" <?php if($direktori->sts_tampil === 1): ?> checked <?php endif; ?>>
                            <label class="custom-control-label" for="cbTampil" style="cursor:pointer;">Tampil</label>
                        </div>
                        <div class="ml-3 custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="cbValid" name="nmValid" 
                                    class="custom-control-input" value="1" <?php if($direktori->sts_valid === 1): ?> checked <?php endif; ?>>
                            <label class="custom-control-label" for="cbValid" style="cursor:pointer;">Valid</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="font-16 font-weight-bold text-dark mb-2">Detail</div>
                <textarea id="summernote" name="nmDetail" class="summernote"><?php echo e($direktori->detail); ?></textarea>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button type="submit" class="btn btn-lg btn-dark">
            <span class="font-16"><i class="fas fa-check mr-3"></i>Perbarui</span>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/direktori/disnaker/edit.blade.php ENDPATH**/ ?>