 

<?php $__env->startSection('title'); ?>
Kelola Data Lowongan (SIP) - Ubah Data - <?php echo e($sip->jabatan); ?>

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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Lowongan (SIP)</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold rounded text-white align-top py-1 px-2">
                Ubah
            </span>
        </div>
        <div class="font-weight-bold">
            <?php echo e($sip->agency); ?>

        </div>
    </div>
    
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('sip_index')); ?>"><u>Lowongan (SIP)</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('sip_detail', $sip->id)); ?>"><u><?php echo e($sip->jabatan); ?></u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">Ubah Data</span>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('sip_update', $sip->id)); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmTipe" value="edit">
<input type="hidden" name="idSip" value="<?php echo e($sip->id); ?>">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-7">
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">No. SIP</div>
                    <div class="col-md-9">
                        <input type="text" id="nmNoSip" name="nmNoSip" 
                        class="form-control h-45 border-form bg-form font-weight-bold text-form" 
                        value="<?php echo e($sip->no_sip); ?>">
                    <small class="text-danger"><?php echo e($errors->first('nmNoSip')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Perusahaan</div>
                    <div class="col-md-9">
                        <select name="nmPerusahaan" id="nmPerusahaan" class="form-control select2 bg-dark" >
                            <?php $__currentLoopData = $perusahaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $per): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($per->id); ?>" <?php if($per->id === $sip->perusahaan_id): ?> selected <?php endif; ?>><?php echo e($per->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">P. Agency</div>
                    <div class="col-md-9">
                    <input type="text" id="nmAgency" name="nmAgency" 
                        class="form-control h-45 border-form bg-form font-weight-bold text-form" 
                        value="<?php echo e($sip->agency); ?>">
                        <small class="text-danger"><?php echo e($errors->first('nmAgency')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Jabatan</div>
                    <div class="col-md-9">
                        <select name="nmJabatan" id="nmJabatan" class="form-control select2">
                            <?php $__currentLoopData = $jabatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($jab->id); ?>" <?php if($jab->id === $sip->jabatan_id): ?> selected <?php endif; ?>><?php echo e($jab->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 font-15 my-1 font-weight-bold text-dark">
                        Status
                    </div>
                    <div class="col-md-9 my-1 font-weight-bold text-dark">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdFormal" name="nmStatusFormal" class="custom-control-input" value="0" <?php if($sip->sts_formal === 0): ?> checked <?php endif; ?>>
                                <label class="custom-control-label" for="rdFormal">Formal</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdInformal" name="nmStatusFormal" class="custom-control-input" value="1" <?php if($sip->sts_formal === 1): ?> checked <?php endif; ?>>
                                <label class="custom-control-label" for="rdInformal">Informal</label>
                            </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 mt-2 font-15 font-weight-bold text-dark mb-2">Negara Tujuan</div>
                    <div class="col-md-9">
                        <select name="nmNegara" id="nmNegara" class="form-control select2">
                            <?php $__currentLoopData = $negara; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $neg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($neg->id); ?>" <?php if($neg->id === $sip->negara_id): ?> selected <?php endif; ?>><?php echo e($neg->negara); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-weight-bold font-15 text-dark">Jumlah L/P</div>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="number" class="form-control bg-form border-form text-form font-weight-bold
                                    h-42 text-center" id="nmJumlahL" name="nmJumlahL" value="<?php echo e($sip->jumlah_l); ?>">
                            <div class="input-group-append h-42 ">
                                <div class="input-group-text bg-form-tua border-form font-13 font-weight-bold px-2">Laki-Laki</div>
                            </div>
                        </div>

                        <div class="input-group mt-3">
                            <input type="number" class="form-control bg-form border-form text-form font-weight-bold
                                    h-42 text-center" id="nmJumlahP" name="nmJumlahP" value="<?php echo e($sip->jumlah_p); ?>">
                            <div class="input-group-append h-42 ">
                                <div class="input-group-text bg-form-tua border-form font-13 font-weight-bold px-2">Perempuan</div>
                            </div>
                        </div>

                        <div class="input-group mt-3">
                            <input type="number" class="form-control bg-form border-form text-form font-weight-bold
                                    h-42 text-center" id="nmJumlahLP" name="nmJumlahLP" value="<?php echo e($sip->jumlah_lp); ?>">
                            <div class="input-group-append h-42 ">
                                <div class="input-group-text bg-form-tua border-form 
                                    font-13 font-weight-bold px-2">L / P</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-weight-bold font-15 text-dark">Ijin Berlaku</div>
                    <div class="col-md-8">
                        <input type="date" id="nmIjinAwal" name="nmIjinAwal" 
                        class="form-control h-45 border-form bg-form font-weight-bold text-form" value="<?php echo e($sip->tgl_ijin_awal); ?>">
                    </div>
                </div>
                <div class="form-group row ">
                    <div class="col-md-4 mt-2 font-weight-bold font-15 text-dark">Ijin Berakhir</div>
                    <div class="col-md-8">
                        <input type="date" id="nmIjinAkhir" name="nmIjinAkhir" 
                        class="form-control h-45 border-form bg-form font-weight-bold text-form" value="<?php echo e($sip->tgl_ijin_akhir); ?>">
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="form-group row mb-0">
                    <div class="col-md-2 pr-0 mt-2 font-15 
                            font-weight-bold text-dark mb-2" style="margin-right:-6px;">
                        Keterangan<br><span class="font-14 font-weight-normal">(Deskripsi)</span></div>
                    <div class="col-md-10 pl-0">
                        <textarea id="summernote" name="nmKeterangan" class="summernote"><?php echo e($sip->keterangan); ?></textarea>
                    </div>
                </div>
                <div class="border-top border-form"></div>
            </div>
            <div class="col-md-7">
                <div class="form-group row mt-4">
                    <div class="col-md-4 font-15 font-weight-bold text-dark mt-3">Status Lamaran Peserta</div>
                    <div class="col-md-8">
                        <div class="border border-form rounded p-3 shadow">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdStatusTutup" name="nmStatusLamaran" 
                                    class="custom-control-input" value="tutup" <?php if($sip->status_lamaran === "tutup"): ?> checked <?php endif; ?>>
                                <label class="custom-control-label font-weight-bold" for="rdStatusTutup" 
                                    style="cursor:pointer;">Tutup</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="rdStatusBuka" name="nmStatusLamaran" 
                                    class="custom-control-input" value="buka" <?php if($sip->status_lamaran === "buka"): ?> checked <?php endif; ?>>
                                <label class="custom-control-label font-weight-bold" for="rdStatusBuka" 
                                    style="cursor:pointer;">Buka</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button type="submit" class="btn btn-lg btn-dark">
            <span class="font-15"><i class="fas fa-check mr-2"></i>Perbarui</span>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/sip/edit.blade.php ENDPATH**/ ?>