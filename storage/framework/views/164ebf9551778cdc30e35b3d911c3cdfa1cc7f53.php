 

<?php $__env->startSection('title'); ?>
Kelola Data Kedatangan TKI - Kedatangan Baru
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Kedatangan TKI</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Baru</span></div>
            
        <span class="font-weight-500 text-primary">Kedatangan Baru</span>
        <i class="fas fa-pencil-alt ml-2 align-top"></i>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('kedatangan_index')); ?>"><u>Kedatangan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Baru</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('kedatangan_store')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmStatus" value="baru">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-6 border-right border-form">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Tgl. Datang</div>
                    <div class="col-md-5">
                        <input type="date" id="nmTglDatang" name="nmTglDatang" value="<?php echo e(now()->format('Y-m-d')); ?>"
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmTglDatang')); ?></small>
                    </div>
                    <div class="col-md-4">
                        <input type="time" id="nmJamDatang" name="nmJamDatang" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmJamDatang')); ?></small>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pesawat</div>
                    <div class="col-md-9">
                        <select name="nmPesawat" id="nmPesawat" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $pesawat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pes->jenis_id); ?>">[<?php echo e($pes->kode); ?>] - <?php echo e($pes->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <hr class="border-top2-dashed border-form">
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">No. Paspor</div>
                    <div class="col-md-9">
                        <input type="text" id="nmPaspor" name="nmPaspor" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmPaspor')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">K. Imigrasi</div>
                    <div class="col-md-9">
                        <select name="nmImigrasi" id="nmImigrasi" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $imigrasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($imi->jenis_id); ?>"><?php echo e($imi->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Nama TKI</div>
                    <div class="col-md-9">
                        <input type="text" id="nmTKI" name="nmTKI" 
                            class="form-control h-45 border-form bg-form font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmTKI')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Tgl. Lahir</div>
                    <div class="col-md-5">
                        <input type="date" id="nmTglLahir" name="nmTglLahir" 
                            class="form-control h-45 border-form bg-form font-weight-500">
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
                <hr class="border-top2-dashed border-form">
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
                <div class="form-group row pt-2">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Alamat</div>
                    <div class="col-md-9">
                        <textarea name="nmAlamat" id="nmAlamat" rows="4" 
                        class="form-control border-form bg-form"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="border-bottom pb-2 mb-4">PPTKIS</h4>
                
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Pengirim</div>
                    <div class="col-md-9">
                        <select name="nmPptkis" id="nmPptkis" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $perusahaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prsh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($prsh->id); ?>"><?php echo e($prsh->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Agency</div>
                    <div class="col-md-9">
                        <input type="text" id="nmAgency" name="nmAgency" 
                            class="form-control h-42 border-form bg-form font-weight-500">
                        <small class="text-danger"><?php echo e($errors->first('nmAgency')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Negara P.</div>
                    <div class="col-md-9">
                        <select name="nmNegara" id="nmNegara" class="form-control select2 w-100">
                            <option value="">- Pilih Negara Penempatan -</option>
                            <?php $__currentLoopData = $negara; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $neg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($neg->jenis_id); ?>"><?php echo e($neg->name); ?></option>
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
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Tgl. Brgkt</div>
                    <div class="col-md-5">
                        <input type="date" id="nmTglBerangkat" name="nmTglBerangkat" onchange="masaKerja();"
                            class="form-control h-45 border-form bg-form font-weight-500">
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control bg-form border-form
                                    h-42 text-center" id="nmMasaKerja" name="nmMasaKerja" readonly>
                            <div class="input-group-append h-42 ">
                                <div class="input-group-text bg-form border-form font-13 font-weight-bold px-2">Thn/Bln</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">J. Kepulangan</div>
                    <div class="col-md-5">
                        <select name="nmJenisPulang" id="nmJenisPulang" class="form-control select2 w-100">
                            <?php $__currentLoopData = $jenis_pulang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jpul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($jpul->jenis_id); ?>"><?php echo e($jpul->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control bg-form border-form h-42 text-center" name="nmPulangHari" >
                            <div class="input-group-append h-42 ">
                                <div class="input-group-text bg-form border-form font-13 font-weight-bold">Hari</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Masalah</div>
                    <div class="col-md-9">
                        <select name="nmMasalah[]" id="nmMasalah" class="form-control select2 w-100" multiple="multiple">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $masalah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($mas->jenis_id); ?>"><?php echo e($mas->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="mt-3 mb-1 text-dark font-weight-500">Masalah lainnya</div>
                        <div>
                            <input type="text" name="nmMasalahLain" class="form-control bg-form border-form h-42">
                        </div>
                    </div>
                </div>
                
                <h4 class="border-bottom mt-5 pb-2 mb-4">Proses Kepulangan</h4>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Kepulangan</div>
                    <div class="col-md-9">
                        <div>
                            <select name="nmKepulangan" id="nmKepulangan"  onchange="cekKepulangan();"
                                    class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                <?php $__currentLoopData = $pulang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pul->jenis_id); ?>"><?php echo e($pul->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div id="dijemput" class="mt-3" style="display:none;">
                            <select name="nmDijemput" id="nmDijemput" class="form-control select2 w-100">
                                <?php $__currentLoopData = $dijemput; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jemput): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($jemput->jenis_id); ?>">
                                        <?php echo e($jemput->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        
                        <div id="pulangSendiri" class="mt-3" style="display:none;">
                            <select name="nmPulangSendiri" id="nmPulangSendiri" class="form-control select2 w-100">
                                <option value="">- Pilih -</option>
                                <?php $__currentLoopData = $pulang_sendiri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pulsd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pulsd->jenis_id); ?>" >
                                        <?php echo e($pulsd->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div id="nmNamaPenjemput" class="mt-3" style="display:none;">
                            <input type="text" id="nmDijemputOleh" name="nmDijemputOleh" 
                                class="form-control h-45 border-form bg-form font-weight-500 "
                                placeholder="Nama Penjemput...">
                        </div>
                        <div id="Menggunakan" class="mt-3" style="display:none;">
                            <input type="text" id="nmMenggunakan" name="nmMenggunakan" 
                                class="form-control h-45 border-form bg-form font-weight-500" placeholder="Menggunakan...">
                        </div>
                        <div id="Transit" class="mt-3" style="display:none;">
                            <input type="text" id="nmTransit" name="nmTransit" 
                            class="form-control h-45 border-form bg-form font-weight-500" placeholder="Transit...">
                        </div>
                    </div>
                </div>
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
<script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.full.min.js')); ?>"></script>

<?php echo $__env->make('sistem.kedatangan.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/kedatangan/create.blade.php ENDPATH**/ ?>