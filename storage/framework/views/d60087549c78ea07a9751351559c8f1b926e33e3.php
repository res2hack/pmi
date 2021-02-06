 

<?php $__env->startSection('title'); ?>
Ubah Data Prodesmigratif
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/summernote/dist/summernote-bs4.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')); ?>">
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
        <i class="fas fa-thumbtack font-2"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Prodesmigratif</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span></div>
            
        <span class="font-weight-500 text-primary">Ubah Data</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('prodesmigratif_index')); ?>"><u>Prodesmigratif</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('prodesmigratif_store')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="prodesmigratif_tipe" value="edit">
<input type="hidden" name="idProdesmigratif" value="<?php echo e($prodesmigratif->id); ?>">

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow border-top5 border-form" >
                <div class="card-body">
                    <div class="form-group row mt-3">
                        <div class="col-md-3 font-15 font-weight-bold text-dark mb-2">
                            Nama Usaha
                            <br><span class="font-13 font-weight-500">(Produk)</span>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="nmJudul" name="nmJudul" class="form-control h-45 border-form bg-form text-dark font-weight-500" 
                            value="<?php echo e($prodesmigratif->judul); ?><?php echo e(old('nmJudul')); ?>"
                            onChange="$('#nmJenisKategori').val($('#nmJudul').val().toLowerCase().replace(/\s/g, '-'));">
                            <small class="text-danger"><?php echo e($errors->first('nmJudul')); ?></small>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Slug</div>
                        <div class="col-md-9">
                        <input type="text" id="nmJenisKategori" name="nmJenisKategori" value="<?php echo e($prodesmigratif->slug); ?><?php echo e(old('nmJenisKategori')); ?>"
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
                                    <option value="<?php echo e($kat->jenis_id); ?>" 
                                        <?php if($kat->jenis_id === $prodesmigratif->kategori_id): ?> selected <?php endif; ?>>
                                        <?php echo e($kat->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Pemilik</div>
                        <div class="col-md-9">
                            <input type="text" id="nmPemilik" name="nmPemilik" 
                            class="form-control h-45 border-form bg-form text-dark font-weight-500" 
                            value="<?php echo e($prodesmigratif->pemilik); ?><?php echo e(old('nmPemilik')); ?>">
                            <small class="text-danger"><?php echo e($errors->first('nmPemilik')); ?></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                        <div class="col-md-9">
                            <textarea name="nmAlamat" class="form-control bg-form border-form font-weight-500" 
                            rows="3"><?php echo e($prodesmigratif->alamat); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kontak</div>
                        <div class="col-md-9">
                            <textarea name="nmKontak" class="form-control bg-form border-form font-weight-500" rows="3"><?php echo e($prodesmigratif->kontak); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 mt-2 font-15  text-dark mb-2">
                           <span class="font-weight-bold">Deskripsi</span>  <span class="font-weight-500">Usaha (Produk)</span> 
                        </div>
                        <div class="col-md-12">
                            <textarea id="summernote" name="nmKeterangan" class="summernote"><?php echo e($prodesmigratif->keterangan); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row w-100" id="featuredImage" style="cursor:pointer !important;">
                        <div class="col-md-4 font-weight-bold font-15 text-dark">Foto Utama</div>
                        <div id="image-preview" class="col-md-8 image-preview w-100" <?php if($prodesmigratif->img_featured): ?>  style="background-image: url('<?php echo e(url($prodesmigratif->img_featured)); ?>');" <?php endif; ?>>
                            <label for="image-upload" id="image-label" >Pilih Gambar</label>
                            <input type="file" name="featuredImage" id="image-upload" class="img-fluid border-form"  />
                        </div>
                        <?php if($prodesmigratif->img_featured): ?>
                        <div class="mt-2 col-md-12 text-right">
                            <a id="hapusFeatured" class="text-primary" style="cursor:pointer;"
                                onClick="$('#image-preview').css('background-image','');$('#hapusFeatured').hide();
                                        $('#statusFeatured').val('hapus');">
                                <i class="fas fa-times text-danger font-15 mr-2"></i><u>Hapus foto</u>
                            </a>
                        </div>
                        <input type="hidden" id="statusFeatured" name="statusFeatured" value="0">
                    <?php endif; ?>
                       
                    </div>
                </div>
            </div>
          
        </div>

        <div class="col-md-4">
            
                <?php if($prodesmigratif->status === "terbit"): ?>
                <a class="card shadow font-weight-bold font-18" 
                    href="<?php echo e(route('prodesmigratif_show', $prodesmigratif->slug)); ?>" target="_blank" >
                    <div class="card-body text-center">
                            <i class="font-16 far fa-file-alt mr-2"></i><u>Lihat Halaman</u>
                            <span class="bg-success py-1 px-2 rounded text-white 
                            font-weight-bold font-11 align-top ml-2">Terbit
                        </span>
                    </div>
                </a>
                <?php else: ?>
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <span class="bg-warning py-1 px-2 rounded text-white 
                                font-weight-bold align-top ml-2">Draft
                            </span>
                        </div>
                    </div>
                <?php endif; ?>

            <div class="card shadow border-top5 border-form">
                <div class="card-body">
                    <div class="form-group w-100">
                        <div class="font-weight-bold font-16 mb-1 text-dark">Thumbnail</div>
                        <div id="image-preview2" class="image-preview w-100" <?php if($prodesmigratif->img_thumbnail): ?> style="background-image: url('<?php echo e(url($prodesmigratif->img_thumbnail)); ?>');background-repeat: no-repeat;background-size: cover;" <?php endif; ?>>
                            <label for="image-upload" id="image-label2">Pilih Gambar</label>
                            <input type="file" name="thumbnailImage" id="image-upload2" class="img-fluid" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-1 text-dark">Status</div>
                        <select name="nmStatus" id="nmStatus" class="form-control selectric" style="font-size:16px;" >
                            <option value="draft" <?php if($prodesmigratif->status === "draft"): ?> selected <?php endif; ?>>Draft</option>
                            <option value="terbit" <?php if($prodesmigratif->status === "terbit"): ?> selected <?php endif; ?>>Terbit</option>
                        </select>
                    </div>
                    <div class="form-group w-100 d-none">
                        <div class="font-weight-bold font-16 mb-1 text-dark">Tags</div>
                        <input data-role="tagsinput" type="text" name="tags" class="form-control" >
                        
                    </div>
                    
                </div>
                <div class="card-footer py-3 border-top text-center">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="" onclick="$('#idDelete').val(<?php echo e($prodesmigratif->id); ?>);" title="Hapus Data" 
                                data-toggle="modal" data-target="#modalHapus" class="btn btn-lg btn-danger w-100">
                                <i class="fas fa-times mr-2"></i>Hapus
                            </a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-lg btn-dark font-weight-bold">
                                <i class="fas fa-check mr-2"></i>
                                <span id="btnSubmit">
                                    Perbarui
                                </span>
                            </button>
                        </div>
                    </div>
                   
                   
                </div>
            </div>
        </div>
    </div>
</form>

<?php echo $__env->make('prodesmigratif.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
<script src="<?php echo e(asset('theme/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/assets/js/page/features-post-create.js')); ?>"></script>

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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/prodesmigratif/edit.blade.php ENDPATH**/ ?>