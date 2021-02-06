 

<?php $__env->startSection('title'); ?>
Kelola Data Pengaduan TKI - Pengaduan Baru
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/summernote/dist/summernote-bs4.css')); ?>">
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
#loadingku{
    position: fixed;
    top: 50%;
    left: 50%;
    margin-top: -50px;
    margin-left: -50px;
    width: 300px;
    height: 150px;
    background:#433675;
    z-index: 1;    
}
#spinku{
    right: 8px;
    width: 27px;
    height: 27px;
    background-color: #b9a8f5;
    border-radius: 50%;
    -webkit-animation: pulsate 2s ease-out;
    animation: pulsate 1s ease-out;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    opacity: 1;
}
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-comments font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Pengaduan TKI</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Pengaduan Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pengaduan_index')); ?>"><u>Pengaduan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div id="loadingku" class="rounded text-white text-center p-4" style="display:none;">
    <div class="text-warning font-18 font-weight-bold">Menyimpan Data...</div>
    <div id="spinku" class="mt-3 mx-auto"></div>
    <div class="mt-3 text-white font-14">Harap Menunggu</div>
    
</div>
<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form id="formPengaduan" method="post" action="<?php echo e(route('pengaduan_store')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmStatus" value="baru">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-4 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Tgl. Pengaduan</div>
                    <div class="col-md-12">
                        <input type="date" id="nmTglPengaduan" name="nmTglPengaduan" value="<?php echo e(now()->format('Y-m-d')); ?>"
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmTglPengaduan')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Asal Pengaduan</div>
                    <div class="col-md-12">
                        <select name="nmPengaduanAsal" id="nmPengaduanAsal" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $pengaduan_asal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($asal->jenis_id); ?>"><?php echo e($asal->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h4 class="border-bottom pb-2 mb-4">Data Pengadu</h4>
                <div class="form-group row pt-2">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Pengadu</div>
                    <div class="col-md-8">
                        <input type="text" id="nmNamaPengadu" name="nmNamaPengadu" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmNamaPengadu')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-8">
                        <textarea class="form-control border-form bg-form font-weight-500" name="nmAlamatPengadu" id="nmAlamatPengadu"  rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">No. Telepon</div>
                    <div class="col-md-8">
                        <textarea class="form-control border-form bg-form font-weight-500" 
                            name="nmTeleponPengadu" id="nmTeleponPengadu"  rows="2"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Email</div>
                    <div class="col-md-8">
                        <input type="email" id="nmEmailPengadu" name="nmEmailPengadu" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Hub. dengan TKI</div>
                    <div class="col-md-8">
                        <input type="text" id="nmHubunganTKI" name="nmHubunganTKI" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Saluran Pengaduan</div>
                    <div class="col-md-8">
                        <select name="nmSaluranPengaduan" id="nmSaluranPengaduan" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $saluran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sal->jenis_id); ?>"><?php echo e($sal->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <h4 class="border-bottom mt-4 pb-2 mb-4">Data TKI</h4>
        <div class="row mt-3">
            <div class="col-md-6 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama TKI</div>
                    <div class="col-md-9">
                        <input type="text" id="nmTKI" name="nmTKI" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmTKI')); ?></small>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">No. Paspor</div>
                    <div class="col-md-9">
                        <input type="text" id="nmPaspor" name="nmPaspor" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmPaspor')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-1 font-15 font-weight-bold text-dark mb-2">J. Kelamin</div>
                    <div class="col-md-9 mt-1">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdLaki" name="nmJK" class="custom-control-input" value="L" checked>
                            <label class="custom-control-label font-weight-bold" for="rdLaki" style="cursor:pointer;">Laki-Laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdPerempuan" name="nmJK" class="custom-control-input" value="P">
                            <label class="custom-control-label font-weight-bold" for="rdPerempuan" style="cursor:pointer;">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">TTL</div>
                    <div class="col-md-9">
                        <div>
                            <input type="text" id="nmTempatLahir" name="nmTempatLahir" 
                            class="form-control h-45 border-form bg-form font-weight-500" placeholder="Tempat Lahir..">
                        </div>
                        <div class="mt-3">
                            <input type="date" id="nmTglLahir" name="nmTglLahir" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Status</div>
                    <div class="col-md-9">
                        <select name="nmStatusKawin" id="nmStatusKawin" class="form-control select2 w-100">
                            <option value="B">Belum Kawin</option>
                            <option value="K">Kawin</option>
                            <option value="J">Janda</option>
                            <option value="D">duda</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                        <textarea name="nmAlamat" id="nmAlamat" rows="4" 
                        class="form-control border-form bg-form"></textarea>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Provinsi</div>
                    <div class="col-md-9">
                        <select name="nmProvinsi" id="nmProvinsi" onchange="getKota();" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $provinsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($prov->id); ?>"><?php echo e($prov->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kab. / Kota</div>
                    <div class="col-md-9">
                        <select name="nmKabKota" id="nmKabKota" onchange="getKecamatan();" class="form-control select2 w-100">
                            
                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kecamatan</div>
                    <div class="col-md-9">
                        <select name="nmKecamatan" id="nmKecamatan" onchange="getDesa();" class="form-control select2 w-100">

                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kel. / Desa</div>
                    <div class="col-md-9">
                        <select name="nmDesa" id="nmDesa" class="form-control select2 w-100">

                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pendidikan</div>
                    <div class="col-md-9">
                        <select name="nmPendidikan" id="nmPendidikan" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $pendidikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pdk->jenis_id); ?>"><?php echo e($pdk->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pekerjaan</div>
                    <div class="col-md-4">
                        <select name="nmSektor" id="nmSektor" class="form-control select2 w-100" onchange="getPekerjaan();">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $sektor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sek): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sek->jenis_id); ?>"><?php echo e($sek->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="nmPekerjaan" id="nmPekerjaan" class="form-control select2 w-100">

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Jabatan</div>
                    <div class="col-md-9">
                        <input type="text" id="nmJabatan" name="nmJabatan" 
                            class="form-control h-42 border-form bg-form font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmJabatan')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-15 font-weight-bold text-dark">Negara
                        <div><small>Penempatan</small></div>
                    </div>
                    <div class="col-md-9">
                        <select name="nmNegara" id="nmNegara" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $negara; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $neg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($neg->jenis_id); ?>"><?php echo e($neg->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Tgl. Bekerja</div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglBerangkat" name="nmTglBerangkat"
                            class="form-control h-45 border-form bg-form font-weight-500">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Tgl. Kembali</div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglDatang" name="nmTglDatang"
                            class="form-control h-45 border-form bg-form font-weight-500">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama Majikan</div>
                    <div class="col-md-9">
                        <input type="text" id="nmNamaMajikan" name="nmNamaMajikan" 
                            class="form-control h-42 border-form bg-form font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmMajikan')); ?></small>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3 font-15 font-weight-bold text-dark mb-2">
                        Alamat
                        <div><small>Majikan</small></div>
                    </div>
                    <div class="col-md-9">
                        <textarea name="nmAlamatMajikan" id="nmAlamatMajikan" rows="3" 
                        class="form-control border-form bg-form" placeholder="Alamat Majikan"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-15 font-weight-bold text-dark">Pengirim 
                        <div><small>PPTKIS</small></div>
                    </div>
                    <div class="col-md-9">
                        <select name="nmPptkis" id="nmPptkis" onchange="getPptkis();"
                            class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $perusahaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prsh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($prsh->id); ?>"><?php echo e($prsh->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row pt-2" >
                    <div class="col-md-3 font-15 font-weight-bold text-dark mb-2">
                        Alamat
                        <div><small>PPTKIS</small></div>
                    </div>
                    <div class="col-md-9">
                        <textarea name="nmAlamatPptkis" id="nmAlamatPptkis" rows="3" 
                        class="form-control border-form bg-form" readonly></textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <h4 class="border-bottom mt-4 pb-2 mb-4">Permasalahan TKI</h4>
        <div class="row mt-3">
            <div class="col-md-6 border-right">
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Masalah</div>
                    <div class="col-md-12">
                        <select name="nmMasalah[]" id="nmMasalah" class="form-control select2 w-100" multiple="multiple">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $masalah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($mas->jenis_id); ?>"><?php echo e($mas->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Masalah Lainnya</div>
                    <div class="col-md-12">
                        <textarea id="nmMasalahLainnya" name="nmMasalahLainnya" 
                            class="form-control border-form bg-form" rows="2"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Detail Masalah</div>
                    <div class="col-md-12">
                        <textarea id="nmDetailMasalah" name="nmDetailMasalah" class="summernote"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Lampiran</div>
                   
                      <div class="col-md-12">

                        <?php echo $__env->make('sistem.pengaduan.file-kronologis', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                        
                      </div>
                       
                </div>
                <div class="form-group row">
                    <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Kronologis Masalah</div>
                    <div class="col-md-12">
                        <textarea id="nmKronologis" name="nmKronologis" class="summernote"></textarea>
                    </div>
                </div>
               
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12 mt-2 font-15 font-weight-bold text-dark mb-2">Tuntutan Pengadu</div>
            <div class="col-md-12">
                <textarea id="nmTuntutan" name="nmTuntutan" class="summernote"></textarea>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button id="btn-simpan" type="submit" class="btn btn-lg btn-dark" onclick="loadingku();">
            <span class="font-16"><i class="fas fa-check mr-2"></i>Simpan</span>
        </button>
    </div>
</div>

</form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    var cek_pengaduan = 1;
</script>

<?php echo $__env->make('sistem.pengaduan.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('sistem.pengaduan.script-file', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script src="<?php echo e(asset('theme/assets/dropzone/dist/min/dropzone.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/summernote/dist/summernote-bs4.js')); ?>"></script>
<script src="<?php echo e(asset('theme/assets/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
<script>
    $('#nmDetailMasalah').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 210
});
</script>
<script>
    $('#nmKronologis').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 200
});
</script>

<script>
    $('#nmTuntutan').summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link']],
    ['view', ['codeview', 'help']],
    ['height', ['height']]
    ],
    height: 150
});
</script>

<script>
    function loadingku() {
        $(document).ready(function() {
                $("#loadingku").show();
            })
        }; 
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pengaduan/create.blade.php ENDPATH**/ ?>