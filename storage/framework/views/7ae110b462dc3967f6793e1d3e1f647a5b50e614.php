 

<?php $__env->startSection('title'); ?>
Kelola Data Master Peserta Pelatihan - Baru
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/select2/dist/css/select2.min.css')); ?>">
<style>
    .select2-container--default .select2-selection--single {
    background-color: #F5F3FF !important;
    border-color: #C4B5FD !important;
    /* padding-top: 6px !important; */
    font-weight:500 !important;
}
.note-editor.note-frame {
    border: 1px solid #C4B5FD;
}
.modal-backdrop {
        z-index: 0;
}
div.dataTables_wrapper div.dataTables_filter input {
        width:75% !important;
    }
    .selectric{
        background-color: #F5F3FF;
        border-color: #C4B5FD;
        font-weight:500;
    }
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-user-tie font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Peserta Pelatihan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Peserta Pelatihan Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pelatihan_mst_peserta_index')); ?>"><u>Peserta Pelatihan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('pelatihan_mst_peserta_store')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmTipe" value="create">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6 pb-0 border-right">
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Tanggal</span>
                        <br>
                        <span class="font-13 text-success font-weight-500">Registrasi</span>
                    </div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglRegistrasi" name="nmTglRegistrasi" 
                        class="form-control h-45 border-form bg-form font-weight-500" 
                        value="<?php echo e(now()->format('Y-m-d')); ?><?php echo e(old('nmTglRegistrasi')); ?>">
                    <small class="text-danger"><?php echo e($errors->first('nmTglRegistrasi')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Nama</span>
                        <br>
                        <span class="font-13 text-success font-weight-500">Pencari Kerja</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmPencaker" name="nmPencaker" 
                        class="form-control h-45 border-form bg-form font-weight-500" 
                        value="<?php echo e(old('nmPencaker')); ?>">
                    <small class="text-danger"><?php echo e($errors->first('nmPencaker')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-14 font-weight-bold text-dark">
                        NIK / KTP
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmNIK" name="nmNIK" 
                        class="form-control h-45 border-form bg-form font-weight-500" 
                        value="<?php echo e(old('nmNIK')); ?>">
                    <small class="text-danger"><?php echo e($errors->first('nmNIK')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">No. BPJS</span>
                        <br>
                        <span class="font-12 text-success font-weight-500">Ketenagakerjaan</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmBPJS" name="nmBPJS" 
                        class="form-control h-45 border-form bg-form font-weight-500" 
                        value="<?php echo e(old('nmBPJS')); ?>">
                    <small class="text-danger"><?php echo e($errors->first('nmBPJS')); ?></small>
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
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark">
                        Tgl. Lahir
                    </div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglLahir" name="nmTglLahir" 
                        class="form-control h-45 border-form bg-form font-weight-500" 
                        value="<?php echo e(old('nmTglLahir')); ?>">
                    <small class="text-danger"><?php echo e($errors->first('nmTglLahir')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-weight-bold font-15 text-dark">Kontak / Telp.</div>
                    <div class="col-md-9">
                        <textarea id="nmKontak" name="nmKontak" rows="2"
                        class="form-control h-45 border-form bg-form font-weight-500"></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmKontak')); ?></small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Agama</div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmAgama" id="nmAgama" class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                <?php $__currentLoopData = $agama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($agm->id); ?>"><?php echo e($agm->nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-weight-bold font-15 text-dark">Email</div>
                    <div class="col-md-9">
                        <input type="email" id="nmEmail" name="nmEmail" 
                        class="form-control h-45 border-form bg-form font-weight-500" 
                        value="<?php echo e(old('nmEmail')); ?>">
                        <small class="text-danger"><?php echo e($errors->first('nmEmail')); ?></small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                    <textarea id="nmAlamat" name="nmAlamat" rows="2"
                        class="form-control h-45 border-form bg-form font-weight-500"></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmAlamat')); ?></small>
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
                        <select name="nmKecamatan" id="nmKecamatan" class="form-control select2 w-100">

                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pendidikan</div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmPendidikan" id="nmPendidikan" class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                <?php $__currentLoopData = $pendidikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pdk->id); ?>"><?php echo e($pdk->nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mt-2">
                            <textarea id="nmJurusan" name="nmJurusan" rows="2" placeholder="Jurusan..."
                            class="form-control h-45 border-form bg-form font-weight-500"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Lowongan</span>
                        <br>
                        <span class="font-13 text-success font-weight-500">Tujuan</span>
                    </div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmLowongan" id="nmLowongan" class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                <?php $__currentLoopData = $lowongan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $low): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($low->id); ?>">
                                        (<?php echo e($low->jabatan); ?> - <?php echo e($low->negara); ?>) - <?php echo e($low->agency); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">Foto Resmi</span>
                        <br>
                        <span class="font-12 text-success font-weight-500">Terbaru</span>
                    </div>
                    <div class="col-md-9">
                        <div id="image-preview2" class="image-preview">
                            <label for="image-upload" id="image-label2">Pilih Foto</label>
                            <input type="file" name="nmFoto" id="image-upload2" class="img-fluid" />
                        </div>

                        
                    <small class="text-danger"><?php echo e($errors->first('nmFoto')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">CV (C. Vitae)</span>
                        <br>
                        <span class="font-12 text-success font-weight-500">Riwayat Hidup</span>
                    </div>
                    <div class="col-md-9">
                        <input type="file" id="nmCV" name="nmCV" 
                        class="form-control h-45 border-form bg-form font-weight-500" 
                        value="<?php echo e(old('nmCV')); ?>">
                        <small class="text-danger"><?php echo e($errors->first('nmCV')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class=" font-weight-bold font-15 text-dark">Keterangan</span>
                        <br>
                        <span class="font-13">Tambahan</span>
                    </div>
                    <div class="col-md-9">
                        <textarea id="nmKeterangan" name="nmKeterangan" rows="2"
                        class="form-control h-45 border-form bg-form font-weight-500"></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmKeterangan')); ?></small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 font-weight-bold font-15 text-dark ">
                        <div class="border-bottom pb-1">
                            Prasyarat
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"  id="cbKompetensi" name="nmKompetensi">
                            <label for="cbKompetensi" class="custom-control-label font-14 font-weight-500 align-top text-dark" style="cursor:pointer;">
                                Apakah Anda Memiliki Kompetensi yang sesuai ?
                            </label>
                        </div>
                        <div class="custom-control mt-2 custom-checkbox">
                            <input type="checkbox" class="custom-control-input"  id="cbSehat" name="nmSehat">
                            <label for="cbSehat" class="custom-control-label font-14 font-weight-500 align-top text-dark" style="cursor:pointer;">
                                Apakah Anda Sehat Jasmani dan Rohani?
                            </label>
                        </div>
                        <div class="custom-control mt-2 custom-checkbox">
                            <input type="checkbox" class="custom-control-input"  id="cbDokumen" name="nmDokumen">
                            <label for="cbDokumen" class="custom-control-label font-14 font-weight-500 align-top text-dark" style="cursor:pointer;">
                                Apakah Anda Memiliki Dokumen Sesuai Persyaratan ?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="border-top2-dashed mt-4 border-form"></div>
                <div class="form-group row mt-3">
                    <div class="col-md-12">
                        <div class="mt-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" 
                                        onclick="beriLogin();" id="cbBeriLogin" name="nmBeriLogin">
                                <label for="cbBeriLogin" class="custom-control-label font-14 font-weight-500 align-top text-primary" style="cursor:pointer;">
                                    Beri Hak Akses Login Sistem
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div id="detailLogin" style="display:none;">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">
                                    Username <i id="usernameSuccess" class="ml-2 font-18 far fa-check-circle text-success" style="display:none;"></i>
                                </label>
                                <div class="col-md-8">
                                    <input name="nmUsername" type="text" class="form-control bg-form border-form h-42" 
                                        value="<?php echo e(old('nmUsername')); ?>"  onchange="cekUsername();">
                                    <span id="usernameError" class="font-12 text-danger font-weight-bold" 
                                            style="display:none;">* Username ini sudah digunakan</span>
                                    <small class="text-danger font-weight-bold"><?php echo e($errors->first('nmUsername')); ?></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">
                                    Email <i id="emailSuccess" class="ml-2 font-18 far fa-check-circle text-success" style="display:none;"></i>

                                </label>
                                <div class="col-md-8">
                                    <input name="nmEmailLogin" type="email" class="form-control bg-form border-form h-42" 
                                            value="<?php echo e(old('Email')); ?>" onchange="cekEmail();">
                                    <span id="emailError" class="font-12 text-danger font-weight-bold" style="display:none;">* Email ini sudah digunakan</span>
                                    <span id="formatError" class="font-12 text-danger font-weight-bold" style="display:none;">* Format Email Salah</span>
                                    <small class="text-danger font-weight-bold"><?php echo e($errors->first('nmEmailLogin')); ?></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">Password</label>
                                <div class="col-md-8">
                                    <input name="nmPassword" type="text" class="form-control bg-form border-form h-42" value="<?php echo e(old('password')); ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">Status</label>
                                <div class="col-md-8">
                                    <select name="nmStatusAktif" id="nmStatusAktif" class="form-control selectric" style="font-size:16px;" >
                                            <option value="0">Aktif</option>
                                            <option value="1">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button id="btn-simpan" type="submit" class="btn btn-lg btn-dark">
            <span class="font-15"><i class="fas fa-check mr-2"></i>Simpan</span>
        </button>
    </div>
</div>

</form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<?php echo $__env->make('sistem.pencaker.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    function beriLogin() {
    var checkBox = document.getElementById("cbBeriLogin");
    if (checkBox.checked == true){
        $('#detailLogin').show();
        cekUsername();
        cekEmail();
    } else {
        $('#detailLogin').hide();
        $('#btn-simpan').prop('disabled', false);
    }
}
</script>

<script src="<?php echo e(asset('theme/assets/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')); ?>"></script>
<script src="<?php echo e(asset('theme/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js')); ?>"></script>

<?php echo $__env->make('global.upload-preview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/peserta/create.blade.php ENDPATH**/ ?>