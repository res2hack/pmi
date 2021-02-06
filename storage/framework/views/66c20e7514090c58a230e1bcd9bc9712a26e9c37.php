 

<?php $__env->startSection('title'); ?>
Kelola Data Pelamar - Ubah
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php echo $__env->make('global.custom-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-id-card font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Lamaran</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold rounded text-white align-top py-1 px-2">Ubah</span>
        </div>
            
        <span class="text-dark font-weight-bold">#<?php echo e($lamaran_first->sip_id); ?> ( <?php echo e($jabatan_first->nama); ?> -  <?php echo e($negara_first); ?>)</span>
        <span class="mx-2">/</span> 
        <span class="font-weight-bold text-form"><?php echo e($lamaran_first->name); ?></span> 
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('lamaran_index')); ?>"><u>Lamaran</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('lamaran_detail', $lamaran_first->id_lamaran)); ?>"><u>#<?php echo e($lamaran_first->id_lamaran); ?> - <?php echo e($lamaran_first->name); ?></u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Ubah Data</span>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form id="formLamaran" method="post" action="<?php echo e(route('lamaran_update')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmTipe" value="edit">
<input type="hidden" name="nmID" value="<?php echo e($lamaran_first->id_lamaran); ?>">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6 pb-0 border-right">
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Lowongan</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Tujuan</span>
                    </div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmLowongan" id="nmLowongan" class="form-control select2 w-100" required>
                                <option value="">- Pilih -</option>
                                <?php $__currentLoopData = $lowongan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $low): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($low->id); ?>" <?php if($lamaran_first->sip_id === $low->id): ?> selected <?php endif; ?>>
                                        (<?php echo e($low->jabatan); ?> - <?php echo e($low->negara); ?>) - <?php echo e($low->agency); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Tanggal</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Melamar</span>
                    </div>
                    <div class="col-md-9">
                        <input type="date" id="nmTglRegistrasi" name="nmTglRegistrasi" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="<?php echo e($lamaran_first->tgl_registrasi); ?><?php echo e(old('nmTglRegistrasi')); ?>">
                    <small class="text-danger"><?php echo e($errors->first('nmTglRegistrasi')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-15 font-weight-bold text-dark">Nama</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Pelamar</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmPelamar" name="nmPelamar" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="<?php echo e($lamaran_first->name); ?><?php echo e(old('nmPelamar')); ?>">
                    <small class="text-danger"><?php echo e($errors->first('nmPelamar')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-14 font-weight-bold text-dark">
                        NIK / KTP
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmNIK" name="nmNIK" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="<?php echo e($lamaran_first->nik); ?><?php echo e(old('nmNIK')); ?>">
                    <small class="text-danger"><?php echo e($errors->first('nmNIK')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">No. BPJS</span>
                        <br>
                        <span class="font-12 text-primary font-weight-500">Ketenagakerjaan</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="nmBPJS" name="nmBPJS" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="<?php echo e($lamaran_first->bpjs); ?><?php echo e(old('nmBPJS')); ?>">
                    <small class="text-danger"><?php echo e($errors->first('nmBPJS')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-1 font-15 font-weight-bold text-dark mb-2">J. Kelamin</div>
                    <div class="col-md-9 mt-1">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdLaki" name="nmJK" class="custom-control-input" 
                                    value="L" <?php if($lamaran_first->jk === "L"): ?> checked <?php endif; ?>>
                            <label class="custom-control-label font-weight-bold" for="rdLaki" style="cursor:pointer;">Laki-Laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdPerempuan" name="nmJK" class="custom-control-input" 
                                value="P" <?php if($lamaran_first->jk === "P"): ?> checked <?php endif; ?>>
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
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="<?php echo e($lamaran_first->tgl_lahir); ?><?php echo e(old('nmTglLahir')); ?>">
                    <small class="text-danger"><?php echo e($errors->first('nmTglLahir')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-weight-bold font-15 text-dark">Kontak / Telp.</div>
                    <div class="col-md-9">
                        <textarea id="nmKontak" name="nmKontak" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-bold"><?php echo e($lamaran_first->kontak); ?></textarea>
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
                                    <option value="<?php echo e($agm->id); ?>" 
                                        <?php if($lamaran_first->agama_id === $agm->id): ?> selected <?php endif; ?>>
                                        <?php echo e($agm->nama); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-weight-bold font-15 text-dark">Email</div>
                    <div class="col-md-9">
                        <input type="email" id="nmEmail" name="nmEmail" 
                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                        value="<?php echo e($lamaran_first->email); ?><?php echo e(old('nmEmail')); ?>">
                        <small class="text-danger"><?php echo e($errors->first('nmEmail')); ?></small>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                    <textarea id="nmAlamat" name="nmAlamat" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-bold"><?php echo e($lamaran_first->alamat); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmAlamat')); ?></small>
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Provinsi</div>
                    <div class="col-md-9">
                        <select name="nmProvinsi" id="nmProvinsi" onchange="getKota();" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $provinsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($prov->id); ?>"
                                    <?php if($lamaran_first->provinsi_id === $prov->id): ?> selected <?php endif; ?>>
                                    <?php echo e($prov->nama); ?>

                                </option>
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
                                    <option value="<?php echo e($pdk->id); ?>" <?php if($lamaran_first->pendidikan_id === $pdk->id): ?> selected <?php endif; ?>>
                                        <?php echo e($pdk->nama); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mt-2">
                            <textarea id="nmJurusan" name="nmJurusan" rows="2" placeholder="Jurusan..."
                            class="form-control h-45 border-form bg-form text-form font-weight-bold"><?php echo e($lamaran_first->jurusan); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-3">
                        <span class="font-14 font-weight-bold text-dark">Foto Resmi</span>
                        <br>
                        <span class="font-12 text-primary font-weight-500">Terbaru</span>
                        <?php if($lamaran_first->foto): ?>
                            <br>
                            <div class="mt-3">
                                
                                <a id="hapusFoto" class="text-primary font-13" style="cursor:pointer;"
                                    onClick="$('#image-preview2').css('background-image','');$('#hapusFoto').hide();
                                    $('#fotoUndo').show();$('#statusFoto').val('<?php echo e($lamaran_first->foto); ?>');">
                                    <i class="fas fa-times text-danger font-13 mr-2"></i><u>Hapus Foto</u>
                                </a>
                                <a id="fotoUndo" style="cursor:pointer;display:none;" 
                                    onclick="$('#hapusFoto').show();$('#fotoUndo').hide();
                                    $('#image-preview2').css('background-image', 'url(<?php echo e(url($lamaran_first->foto)); ?>)');
                                    $('#statusFoto').val('0');" class="font-13 text-primary">
                                    <i class="text-primary font-13 mr-2 fas fa-reply"></i><u>Batal</u>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-9">
                        <?php if($lamaran_first->foto): ?>
                            <div id="image-preview2" class="image-preview" <?php if($lamaran_first->foto): ?> style="background-image: url('<?php echo e(url($lamaran_first->foto)); ?>');background-repeat: no-repeat;background-size: cover;" <?php endif; ?>>
                                <label for="image-upload" id="image-label2">Pilih Foto</label>
                                <input type="file" name="nmFoto" id="image-upload2" class="img-fluid" />
                            </div>
                            
                            <small class="text-danger"><?php echo e($errors->first('nmFoto')); ?></small>
                        <?php else: ?>
                            <div id="image-preview2" class="image-preview" style="background-size:cover;" >
                                <label for="image-upload" id="image-label2">Pilih Foto</label>
                                <input type="file" name="nmFoto" id="image-upload2" class="img-fluid" />
                            </div>
                        <?php endif; ?>
                        <input type="hidden" id="statusFoto" name="statusFoto" value="0">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class="font-14 font-weight-bold text-dark">CV (C. Vitae)</span>
                        <br>
                        <span class="font-12 text-primary font-weight-500">Riwayat Hidup</span>
                    </div>
                    <div class="col-md-9">
                        
                        <?php if($lamaran_first->cv): ?>
                            <div id="idLampiran" class="mb-2">
                                <a href="<?php echo e(url($lamaran_first->cv)); ?>" target="_blank" class="font-weight-bold mr-3 font-15">
                                    <u><?php echo e(str_replace("uploads/file/pmi/cv/", "", $lamaran_first->cv)); ?></u>
                                </a> 
                                <a style="cursor:pointer;" onclick="$('#idCV').show();$('#idLampiran').hide();
                                    $('#statusCV').val('<?php echo e($lamaran_first->cv); ?>');">
                                    <i class="text-primary ml-2 fas fa-edit"></i>
                                </a>
                                <a style="cursor:pointer;" onclick="$('#idCV').show();$('#idLampiran').hide();
                                    $('#statusCV').val('<?php echo e($lamaran_first->cv); ?>');">
                                    <i class="text-danger ml-2 font-16 fas fa-times"></i>
                                </a>
                            </div>
                            <div id="idCV" class="" style="display:none;">
                                <div class="row">
                                    <div class="col-1">
                                        <a style="cursor:pointer;" onclick="$('#idCV').hide();$('#idLampiran').show();
                                            $('#statusCV').val('0');">
                                            <i class="text-primary fas fa-reply"></i>
                                        </a>
                                    </div>
                                    <div class="col-11">
                                        <input type="file" id="nmCV" name="nmCV" 
                                        class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                                        value="<?php echo e(old('nmCV')); ?>">
                                        <small class="text-danger"><?php echo e($errors->first('nmCV')); ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <input type="file" id="nmCV" name="nmCV" 
                            class="form-control h-45 border-form bg-form text-form font-weight-bold" 
                            value="<?php echo e(old('nmCV')); ?>">
                            <small class="text-danger"><?php echo e($errors->first('nmCV')); ?></small>
                        <?php endif; ?>
                        <input type="hidden" id="statusCV" name="statusCV" value="0">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <span class=" font-weight-bold font-15 text-dark">Keterangan</span>
                        <br>
                        <span class="font-13 text-primary font-weight-500">Tambahan</span>
                    </div>
                    <div class="col-md-9">
                        <textarea id="nmKeterangan" name="nmKeterangan" rows="2"
                        class="form-control h-45 border-form bg-form text-form font-weight-bold"><?php echo e($lamaran_first->keterangan_lamaran); ?></textarea>
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
                            <input type="checkbox" class="custom-control-input"  id="cbKompetensi" 
                                    name="nmKompetensi" <?php if($lamaran_first->syarat_kompetensi === "Y"): ?> checked <?php endif; ?>>
                            <label for="cbKompetensi" class="custom-control-label font-14 font-weight-500 align-top text-dark" style="cursor:pointer;">
                                Apakah Anda Memiliki Kompetensi yang sesuai ?
                            </label>
                        </div>
                        <div class="custom-control mt-2 custom-checkbox">
                            <input type="checkbox" class="custom-control-input"  id="cbSehat" 
                                name="nmSehat" <?php if($lamaran_first->syarat_sehat === "Y"): ?> checked <?php endif; ?>>
                            <label for="cbSehat" class="custom-control-label font-14 font-weight-500 align-top text-dark" style="cursor:pointer;">
                                Apakah Anda Sehat Jasmani dan Rohani?
                            </label>
                        </div>
                        <div class="custom-control mt-2 custom-checkbox">
                            <input type="checkbox" class="custom-control-input"  id="cbDokumen" 
                                name="nmDokumen" <?php if($lamaran_first->syarat_dokumen === "Y"): ?> checked <?php endif; ?>>
                            <label for="cbDokumen" class="custom-control-label font-14 font-weight-500 align-top text-dark" style="cursor:pointer;">
                                Apakah Anda Memiliki Dokumen Sesuai Persyaratan ?
                            </label>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button id="btn-simpan" type="submit" class="btn btn-lg btn-dark">
            <span class="font-15"><i class="fas fa-check mr-2"></i>Perbarui</span>
        </button>
    </div>
</div>

</form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<?php echo $__env->make('sistem.lamaran.script-edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<script>
    setTimeout(function()
    { 
        getKota();
        getKecamatan();
    }, 1000);
</script>
<?php echo $__env->make('sistem.lamaran.script-cek', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    $('#btn-simpan').on('click',function(e){
        e.preventDefault();

        let form = $('#formLamaran');
        let nama_lowongan = $('#nmLowongan').val();
        let tipe_pelamar = $('#tipePelamar').val();
        let pelamar_exists = $('#nmPenduduk').val();
        let pelamar_baru = $('#nmPelamar').val();

        let beri_login = document.getElementById("cbBeriLogin");
        let username = $('#nmUsername').val();
        let email_login = $('nmEmailLogin').val();
        let password = $('nmPassword').val();

        if(tipe_pelamar == "exists" && !nama_lowongan){
            swal.fire({
                title: 'Lowongan Tujuan Belum Dipilih',
                text: 'Pilih Lowongan Terlebih Dahulu',
                icon: 'error',
            });
        }
        else if(tipe_pelamar == "exists" && !pelamar_exists){
            swal.fire({
                title: 'Pelamar Belum Dipilih',
                text: 'Cari Pelamar Dari Data Penduduk. Jika Tidak Ada, Buat Data Penduduk Baru',
                icon: 'error',
            });
        }
        else if(tipe_pelamar !== "exists" && !pelamar_baru )
        {
            swal.fire({
                title: 'Nama Pelamar Masih Kosong',
                text: 'Nama Pelamar harus diisi',
                icon: 'error',
            });
        }
        else{
            form.submit();
        }

    });
</script>

<?php echo $__env->make('global.upload-preview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/lamaran/edit.blade.php ENDPATH**/ ?>