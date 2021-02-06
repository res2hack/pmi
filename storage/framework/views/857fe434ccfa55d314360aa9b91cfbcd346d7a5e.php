 

<?php $__env->startSection('title'); ?>
Prodesmigratif Baru
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/summernote/dist/summernote-bs4.css')); ?>">
<style>
    .bootstrap-tagsinput {
        background-color: #F5F3FF;
        border-color: #C4B5FD;
        font-weight:500;
        height: 43px;
    }
    .selectric{
        background-color: #F5F3FF;
        border-color: #C4B5FD;
        font-weight:500;
    }
</style>

<style>
    .note-toolbar.card-header {
        background: #F5F3FF;
    }
    .note-editor.note-frame .note-editing-area .note-editable{
        /* background:#fffcf1; */
        background:#ffffff;
    }
    .note-editor.note-frame {
        border-color:#C4B5FD;
    }
    .activities .activity:before {
        background:#a3a2a3;
        width: 1px;
    }
    
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-hand-holding-heart font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Prodesmigratif</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Buat Prodesmigratif Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('prodesmigratif_index')); ?>"><u>Prodesmigratif</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('prodesmigratif_store')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="prodesmigratif_tipe" value="baru">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow border-top5 border-form" >
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-3 font-15 font-weight-bold text-dark mb-2">
                            Nama Usaha
                            <br><span class="font-13 font-weight-500">(Produk)</span>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="nmJudul" name="nmJudul" class="form-control h-45 border-form bg-form text-dark font-weight-500" 
                            value="<?php echo e(old('nmJudul')); ?>"
                            onChange="$('#nmJenisKategori').val($('#nmJudul').val().toLowerCase().replace(/\s/g, '-'));">
                            <small class="text-danger"><?php echo e($errors->first('nmJudul')); ?></small>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Slug</div>
                        <div class="col-md-9">
                        <input type="text" id="nmJenisKategori" name="nmJenisKategori" value="<?php echo e(old('nmJenisKategori')); ?>"
                            class="form-control h-45 border-form bg-form text-dark font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmJenisKategori')); ?></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kategori</div>
                        <div class="col-md-9">
                            <select name="nmKategori" id="nmKategori" class="form-control selectric">
                                <option value="">- Pilih -</option>
                                <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kat->jenis_id); ?>"><?php echo e($kat->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Pemilik</div>
                        <div class="col-md-9">
                            <input type="text" id="nmPemilik" name="nmPemilik" 
                            class="form-control h-45 border-form bg-form text-dark font-weight-500" 
                            value="<?php echo e(old('nmPemilik')); ?>">
                            <small class="text-danger"><?php echo e($errors->first('nmPemilik')); ?></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                        <div class="col-md-9">
                            <textarea name="nmAlamat" class="form-control bg-form border-form font-weight-500" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kontak</div>
                        <div class="col-md-9">
                            <textarea name="nmKontak" class="form-control bg-form border-form font-weight-500" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">
                            Deskripsi
                            <br><span class="font-13 font-weight-500">Usaha (Produk)</span>
                        </div>
                        <div class="col-md-9">
                            <textarea id="summernote" name="nmKeterangan" class="summernote"></textarea>
                        </div>
                    </div>
                    <div class="form-group row w-100" id="featuredImage" style="cursor:pointer !important;">
                        <div class="col-md-4 font-weight-bold font-15 text-dark">Foto Utama</div>
                        <div id="image-preview" class="col-md-8 image-preview w-100" style="cursor:pointer !important;">
                            <label for="image-upload" id="image-label" >Pilih Gambar</label>
                            <input type="file" name="image" id="image-upload" class="img-fluid border-form"  />
                        </div>
                    </div>
                </div>
            </div>
          
        </div>

        <div class="col-md-4">
            <div class="card shadow border-top5 border-form">
                <div class="card-body">
                    <div class="form-group w-100">
                        <div class="font-weight-bold font-16 mb-1 text-dark">Thumbnail</div>
                        <div id="image-preview2" class="image-preview w-100">
                            <label for="image-upload" id="image-label2">Pilih Gambar</label>
                            <input type="file" name="thumbnailImage" id="image-upload2" class="img-fluid" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-1 text-dark">Status</div>
                        <select name="nmStatus" id="nmStatus" class="form-control selectric" style="font-size:16px;" >
                            <option value="draft" selected>Draft</option>
                            <option value="terbit">Terbit</option>
                        </select>
                    </div>
                    
                </div>
                <div class="card-footer py-3 border-top text-center">
                    <button type="submit" class="btn btn-dark w-75 font-18 font-weight-bold py-2 px-5">
                        <i class="fas fa-check mr-2"></i>
                        <span id="btnSubmit">
                            Simpan
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    function cekFeatured() {
    // Get the checkbox
    var checkBox = document.getElementById("cbFeatured");
    if (checkBox.checked == true){
        $('#featuredImage').show();
    } else {
        $('#featuredImage').hide();
    }
    }
</script>

<script src="<?php echo e(asset('theme/node_modules/summernote/dist/summernote-bs4.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/assets/js/page/features-post-create.js')); ?>"></script>
<script>
    $(document).ready(function () {

        $(document).on('change', '#nmStatus', function(){
            var status = $(this).val();
            if(status == 'draft'){
                $teks = 'Simpan';
            }
            else if(status == 'terbit'){
                $teks = 'Terbitkan';
            }
            
            $('#btnSubmit').text($teks); 
            
        });

    });
</script>
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
    ['view', ['fullscreen', 'codeview', 'help']],
    ['height', ['height']]
    ],
    height: 300
});
</script>
<script>
    setTimeout(function () {
        $('#nmStatus').trigger('change');
        $('#metaTitle').trigger('change');
        $('#metaDescription').trigger('change');
    }, 1000);
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/prodesmigratif/create.blade.php ENDPATH**/ ?>