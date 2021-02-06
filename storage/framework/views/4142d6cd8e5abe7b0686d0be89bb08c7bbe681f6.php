 

<?php $__env->startSection('title'); ?>
Kelola Data Penduduk - Data Baru
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <?php echo $__env->make('global.custom-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-user-friends font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Penduduk</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold
                rounded text-white align-top py-1 px-2">Baru
            </span>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('partner_index')); ?>"><u>Penduduk</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Data Baru</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('partner_store')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmTipe" value="create">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-7 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">Nama</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Lengkap</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="nmPartner" class="form-control bg-form font-weight-500 border-form text-form h-42">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 pt-2 font-14 font-weight-bold text-dark">
                        NIK
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="nmNIK" onchange="cekNik();"
                            class="form-control bg-form font-weight-500 border-form text-form h-42">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 pt-2 font-14 font-weight-bold text-dark">
                        No. BPJS
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="nmBPJS"  onchange="cekBpjs();"
                            class="form-control bg-form font-weight-500 border-form text-form h-42">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-1 font-14 font-weight-bold text-dark mb-2">J. Kelamin</div>
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
                    <div class="col-md-3 ">
                        <span class="font-14 font-weight-bold text-dark">Tempat, </span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Tgl. Lahir</span>
                    </div>
                    <div class="col-md-9">
                        <div>
                            <input type="text" name="nmTempatLahir" class="form-control bg-form font-weight-500 border-form text-form h-42">
                        </div>
                        <div class="mt-2">
                            <input type="date" name="nmTglLahir" class="form-control bg-form font-weight-500 border-form text-form h-42">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 ">
                        <span class="font-14 font-weight-bold text-dark">Pendidikan</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Terakhir</span>
                    </div>
                    <div class="col-md-9">
                        <select name="nmPendidikan" id="nmPendidikan" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $pendidikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pdk->id); ?>"><?php echo e($pdk->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 pt-2 font-14 font-weight-bold text-dark">
                        Agama
                    </div>
                    <div class="col-md-9">
                        <select name="nmAgama" id="nmAgama" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $agama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($agm->id); ?>"><?php echo e($agm->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 pt-3 font-14 font-weight-bold text-dark">
                        Kontak
                    </div>
                    <div class="col-md-9">
                        <textarea type="text" name="nmKontak" class="form-control bg-form font-weight-500 border-form text-form h-42"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 pt-3 font-14 font-weight-bold text-dark">
                        Email
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="nmEmail" class="form-control bg-form font-weight-500 border-form text-form h-42">
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="font-14 mb-2 font-weight-bold text-dark">
                            Alamat
                        </div>
                        <div>
                            <textarea type="text" name="nmAlamat" class="form-control bg-form font-weight-500 border-form text-form h-42"></textarea>
                        </div>
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="font-14 mb-2 font-weight-bold text-dark">
                            Provinsi
                        </div>
                        <div class="">
                            <select name="nmProvinsi" id="nmProvinsi" class="form-control select2"  onchange="getKota();">
                                <option value="">- Pilih -</option>
                                <?php $__currentLoopData = $provinsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($prov->id); ?>"><?php echo e($prov->nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="font-14 mb-2 font-weight-bold text-dark">
                            Kabupaten
                        </div>
                        <div class="">
                            <select name="nmKabupaten" id="nmKabupaten" class="form-control select2" onchange="getKecamatan();">
                                <option value="">- Pilih -</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="font-14 mb-2 font-weight-bold text-dark">
                            Kecamatan
                        </div>
                        <div class="">
                            <select name="nmKecamatan" id="nmKecamatan" class="form-control select2">
                                <option value="">- Pilih -</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="font-14 mb-2 font-weight-bold text-dark">
                            Keterangan
                        </div>
                        <div class="">
                            <textarea id="nmKeterangan" name="nmKeterangan" 
                                class="form-control bg-form font-weight-500 border-form text-form" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
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
        </div>
        
        <div id="detailLogin" style="display:none;">
            <div class="border-top2-dashed mt-3 border-form"></div>
            <div class="row mt-4 mb-3">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-md-6">
                            <h5 class="mb-3 text-ungu">
                                <i class="fas fa-user-shield mr-2 align-middle"></i>Detail Login
                            </h5>
                            <div class="border border-form shadow p-4 rounded">
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">
                                    Username <i id="usernameSuccess" class="ml-2 font-18 far fa-check-circle text-success" style="display:none;"></i>
                                </label>
                                <div class="col-md-8">
                                    <input name="nmUsername" type="text" class="form-control bg-form font-weight-500 border-form h-42" 
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
                                    <input name="nmEmailLogin" type="email" class="form-control bg-form font-weight-500 border-form h-42" 
                                            value="<?php echo e(old('Email')); ?>" onchange="cekEmail();">
                                    <span id="emailError" class="font-12 text-danger font-weight-bold" style="display:none;">* Email ini sudah digunakan</span>
                                    <span id="formatError" class="font-12 text-danger font-weight-bold" style="display:none;">* Format Email Salah</span>
                                    <small class="text-danger font-weight-bold"><?php echo e($errors->first('nmEmailLogin')); ?></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">Password</label>
                                <div class="col-md-8">
                                    <input name="nmPassword" type="text" class="form-control bg-form font-weight-500 border-form h-42" value="<?php echo e(old('password')); ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 mt-2 font-weight-bold font-15">Status</label>
                                <div class="col-md-8">
                                    <select name="nmStatusAktif" id="nmStatusAktif" class="form-control selectric" style="font-size:16px;" >
                                        <option value="pending" selected>Ditunda</option>
                                        <option value="active">Diterima (Aktif)</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="mt-4">
                                <h5 class="text-primary">Aksesibilitas</h5>
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 mt-3 font-weight-bold font-15">Konsultasi</label>
                                    <div class="col-md-8 mt-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdKonsultasiAktif" name="nmStatusKonsultasi" class="custom-control-input" 
                                                value="aktif" checked>
                                            <label class="custom-control-label font-weight-bold text-primary" for="rdKonsultasiAktif" style="cursor:pointer;">Aktif</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdKonsultasiTidak" name="nmStatusKonsultasi" class="custom-control-input" 
                                                value="tidak">
                                            <label class="custom-control-label font-weight-bold" for="rdKonsultasiTidak" style="cursor:pointer;">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 mt-3 font-weight-bold font-15">Pengaduan</label>
                                    <div class="col-md-8 mt-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdPengaduanAktif" name="nmStatusPengaduan" class="custom-control-input" 
                                                value="aktif" checked>
                                            <label class="custom-control-label font-weight-bold text-primary" for="rdPengaduanAktif" style="cursor:pointer;">Aktif</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdPengaduanTidak" name="nmStatusPengaduan" class="custom-control-input" 
                                                value="tidak">
                                            <label class="custom-control-label font-weight-bold" for="rdPengaduanTidak" style="cursor:pointer;">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 mt-3 font-weight-bold font-15">Lamaran</label>
                                    <div class="col-md-8 mt-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdLamaranAktif" name="nmStatusLamaran" class="custom-control-input" 
                                                value="aktif" checked>
                                            <label class="custom-control-label font-weight-bold text-primary" for="rdLamaranAktif" style="cursor:pointer;">Aktif</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdLamaranTidak" name="nmStatusLamaran" class="custom-control-input" 
                                                value="tidak">
                                            <label class="custom-control-label font-weight-bold" for="rdLamaranTidak" style="cursor:pointer;">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-md-4 mt-3 font-weight-bold font-15">Pencaker</label>
                                    <div class="col-md-8 mt-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdPencakerAktif" name="nmStatusPencaker" class="custom-control-input" 
                                                value="aktif"checked>
                                            <label class="custom-control-label font-weight-bold text-primary" for="rdPencakerAktif" style="cursor:pointer;">Aktif</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="rdPencakerTidak" name="nmStatusPencaker" class="custom-control-input" 
                                                value="tidak">
                                            <label class="custom-control-label font-weight-bold" for="rdPencakerTidak" style="cursor:pointer;">Tidak</label>
                                        </div>
                                    </div>
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
<?php echo $__env->make('sistem.penduduk.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/penduduk/create.blade.php ENDPATH**/ ?>