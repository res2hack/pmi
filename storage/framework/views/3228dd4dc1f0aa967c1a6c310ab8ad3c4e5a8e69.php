 

<?php $__env->startSection('title'); ?>
Edit Halaman
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
        <i class="fas fa-bookmark font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Halaman</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Edit</span></div>
            
        <span class="font-weight-500 text-primary">Edit Halaman</span>
        <i class="fas fa-edit ml-2 align-top"></i>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('page_index')); ?>"><u>Halaman</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Edit</span>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('page_update', $page->id)); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="idHalaman" value="<?php echo e($page->id); ?>">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow border-top5 border-form" >
                <div class="card-body">
                    <div class="form-group">
                        <div class="font-weight-bold font-18 text-dark mb-2">Judul</div>
                        <input type="text" id="nmJudul" name="nmJudul" class="form-control h-45 border-form bg-form text-dark font-weight-500" 
                            value="<?php echo e($page->title); ?> <?php if($errors->has('nmJudul')): ?><?php echo e(old('nmJudul')); ?><?php endif; ?>"
                            onChange="$('#nmJenisKategori').val($('#nmJudul').val().toLowerCase().replace(/\s/g, '-'));">
                            <small class="text-danger"><?php echo e($errors->first('nmJudul')); ?></small>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-18 text-dark mb-2">Slug</div>
                        <input type="text" id="nmJenisKategori" name="nmJenisKategori" value="<?php echo e($page->slug); ?>"
                            class="form-control h-45 border-form bg-form text-dark font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmJenisKategori')); ?></small>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-18 text-dark mb-2">Konten</div>
                        <textarea id="summernote" name="nmKonten" class="summernote"><?php echo e($page->content); ?></textarea>
                    </div>
                    <div class="form-group w-100" id="featuredImage" style="cursor:pointer !important;">
                        <div class="font-weight-bold font-18 text-dark">Gambar Utama <br> <small>Resolusi sebaiknya besar dan lebar. Contoh: 600x350 px atau lebih</small></div>
                        <div id="image-preview" class="image-preview w-100" <?php if($page->img_featured): ?>  style="background-image: url('<?php echo e(url($page->img_featured)); ?>');" <?php endif; ?>>
                            <label for="image-upload" id="image-label" >Pilih Gambar</label>
                            <input type="file" name="featuredImage" id="image-upload" class="img-fluid border-form"  />
                        </div>
                        <?php if($page->img_featured): ?>
                            <div class="mt-2">
                                <a id="hapusFeatured" class="text-primary" style="cursor:pointer;"
                                    onClick="$('#image-preview').css('background-image','');$('#hapusFeatured').hide();
                                            $('#statusFeatured').val('hapus');">
                                    <i class="fas fa-times text-danger font-15 mr-2"></i><u>Hapus Gambar</u>
                                </a>
                            </div>
                            <input type="hidden" id="statusFeatured" name="statusFeatured" value="0">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="card shadow border-top5 border-form">
                <div class="card-body">
                    <div class="form-group">
                        <div class="font-weight-bold mb-3 font-16">SEO Meta Title</div>
                        <input type="text" id="metaTitle" name="metaTitle" class="form-control h-45 border-form bg-form font-weight-500"  
                            value="<?php echo e($page->meta_title); ?>"   onChange="$('#jmlTitle').html($('#metaTitle').val().length);">
                        <small class="font-12"> Jumlah Karakter: <span id="jmlTitle" class="font-weight-bold text-primary">0</span>. Rekomendasi: 50-60 Karakter.</small>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold mb-3 font-16">SEO Meta Description</div>
                        <textarea id="metaDescription" name="metaDescription" class="form-control h-45 border-form bg-form font-weight-500" rows="5" 
                            onChange="$('#jmlDesc').html($('#metaDescription').val().length);"><?php echo e($page->meta_description); ?></textarea>
                        <small class="font-12"> Jumlah Karakter: <span id="jmlDesc" class="font-weight-bold text-primary">0</span>. Rekomendasi: 150-160 Karakter.</small>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <?php if($page->delete_date): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="" onclick="$('#idRestore').val(<?php echo e($page->id); ?>);" title="Kembalikan Halaman" 
                                    data-toggle="modal" data-target="#modalRestore" class="font-12 btn btn-lg btn-dark w-100">
                                    <i class="fas fa-times mr-2"></i>Restore
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="" onclick="$('#idDelete').val(<?php echo e($page->id); ?>);" title="Hapus Permanen Halaman" 
                                    data-toggle="modal" data-target="#modalHapus" class="font-12 btn btn-lg btn-danger w-100">
                                    <i class="fas fa-times mr-2"></i>Hapus
                                </a>
                                
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <?php if($page->status === "terbit"): ?>
                <a class="card shadow font-weight-bold font-18" 
                    href="<?php echo e(route('page_show', $page->slug )); ?>" target="_blank" >
                    <div class="card-body text-center">
                            <i class="font-16 far fa-file-alt mr-2"></i><u>Lihat Halaman</u>
                            <span class="bg-success py-1 px-2 rounded text-white 
                            font-weight-bold font-11 align-top ml-2">Terbit
                        </span>
                    </div>
                </a>
                <?php else: ?>
                <a class="card shadow font-weight-bold font-18" 
                    href="<?php echo e(route('page_preview', $page->id)); ?>" target="_blank" >
                    <div class="card-body text-center">
                        <i class="font-16 far fa-file-alt mr-2"></i>
                        <u>Pratinjau Halaman</u>
                        <span class="bg-warning py-1 px-2 rounded text-white 
                            font-weight-bold font-11 align-top ml-2">Draft
                        </span>
                    </div>
                </a>
                <?php endif; ?>
            <?php endif; ?>

            <div class="card shadow border-top5 border-form">
                <div class="card-body">
                    <div class="form-group w-100">
                        <div class="font-weight-bold font-16 mb-1 text-dark">Thumbnail</div>
                        <div id="image-preview2" class="image-preview w-100" <?php if($page->img_thumbnail): ?> style="background-image: url('<?php echo e(url($page->img_thumbnail)); ?>');background-repeat: no-repeat;background-size: cover;" <?php endif; ?>>
                            <label for="image-upload" id="image-label2">Pilih Gambar</label>
                            <input type="file" name="thumbnailImage" id="image-upload2" class="img-fluid" />
                        </div>
                        <?php if($page->img_thumbnail): ?>
                            <div class="mt-2">
                                <a id="hapusThumbnail" class="text-primary" style="cursor:pointer;"
                                    onClick="$('#image-preview2').css('background-image','');$('#hapusThumbnail').hide();
                                            $('#statusThumbnail').val('hapus');">
                                    <i class="fas fa-times text-danger font-15 mr-2"></i><u>Hapus Thumbnail</u>
                                </a>
                            </div>
                            <input type="hidden" id="statusThumbnail" name="statusThumbnail" value="0">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-1 text-dark">Status</div>
                        <select name="nmStatus" id="nmStatus" class="form-control selectric" style="font-size:16px;" >
                            <option value="draft" <?php if($page->status === "draft"): ?> selected <?php endif; ?>>Draft</option>
                            <option value="terbit" <?php if($page->status === "terbit"): ?> selected <?php endif; ?>>Terbit</option>
                        </select>
                        <input type="hidden" name="nmTerbitDate" value="<?php echo e($page->published_date); ?>">
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

            <div class="card shadow border-top5 border-form">
                <div class="card-body text-dark">
                    <table>
                        <tr>
                            <td>Tanggal Dibuat</td>
                            <td class="px-2"><i class="fas fa-angle-right"></i></td>
                            <td><?php echo e($page->create_date); ?></td>
                        </tr>
                        <tr>
                            <td>Terakhir Diubah</td>
                            <td class="px-2"><i class="fas fa-angle-right"></i></td>
                            <td><?php echo e($page->write_date); ?></td>
                        </tr>
                        <?php if($page->status === "terbit"): ?>
                        <tr>
                            <td>Tanggal Terbit</td>
                            <td class="px-2"><i class="fas fa-angle-right"></i></td>
                            <td><?php echo e($page->published_date); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>


<?php $__env->stopSection(); ?>

<?php if($page->delete_date): ?>
    <?php echo $__env->make('posts.modal-sampah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/pages/edit.blade.php ENDPATH**/ ?>