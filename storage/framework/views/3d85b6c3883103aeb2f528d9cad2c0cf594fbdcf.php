 

<?php $__env->startSection('title'); ?>
Kelola Data Jadwal Kedatangan - Ubah Data
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/select2/dist/css/select2.min.css')); ?>">
<style>
    .dropleft .dropdown-toggle::before {
    display: none !important;
    }
    .dropdown-toggle::after {
    display: none !important;
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Jadwal Kedatangan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span>
        
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('jadwal_kedatangan_create')); ?>" class="text-success dropdown-item" title="Buat Data Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('jadwal_kedatangan_detail', $jdkedatangan->id)); ?>" class="text-primary dropdown-item" title="Lihat Detail"><i class="far fa-file-alt  mr-2 font-12"></i>Detail
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Ubah Jadwal Kedatangan  
            <i class="fas fa-edit align-top ml-2"></i>
        </span>
        <span class="mx-2">/</span>
        <span class="font-weight-bold text-dark">#<?php echo e($jdkedatangan->no_penerbangan?:"-"); ?></span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('jadwal_kedatangan_index')); ?>"><u>Jadwal Kedatangan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('jadwal_kedatangan_detail', $jdkedatangan->id)); ?>"><u>#<?php echo e($jdkedatangan->no_penerbangan); ?></u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="post" action="<?php echo e(route('jadwal_kedatangan_update')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="nmStatus" value="edit">
<input type="hidden" name="nmID" value="<?php echo e($jdkedatangan->id); ?>">

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="text-right">
            <a href="<?php echo e(route('jadwal_kedatangan_detail', $jdkedatangan->id)); ?>" title="Batal Ubah Data"
                class="btn btn-secondary pv">
                <i class="fas fa-chevron-left font-14"></i>
            </a>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Pesawat</div>
                    <div class="col-md-8">
                        <select name="nmPesawat" id="nmPesawat" class="form-control select2 w-100" required>
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $pesawat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pes->jenis_id); ?>" 
                                    <?php if($pes->jenis_id === $jdkedatangan->pesawat_id): ?> selected <?php endif; ?>>
                                    [<?php echo e($pes->kode); ?>] - <?php echo e($pes->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">No. Penerbangan</div>
                    <div class="col-md-8">
                        <input type="text" class="form-control font-weight-500 border-form bg-form h-45" 
                        name="nmNoPenerbangan" value="<?php echo e($jdkedatangan->no_penerbangan); ?>" required>
                        <small class="text-danger"><?php echo e($errors->first('nmNoPenerbangan')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Jadwal</div>
                    <div class="col-md-8">
                        <input type="datetime-local" class="form-control font-weight-500 border-form bg-form h-45" 
                        name="nmJadwal" value="<?php echo e(\Carbon\Carbon::parse($jdkedatangan->jadwal)->format('Y-m-d\TH:i:s')); ?>" required>
                        <small class="text-danger"><?php echo e($errors->first('nmKode')); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 mt-2 font-15 font-weight-bold text-dark mb-2">Keterangan</div>
                    <div class="col-md-8">
                        <textarea class="form-control font-weight-500 border-form bg-form h-45" 
                        name="nmKeterangan"><?php echo e($jdkedatangan->keterangan); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmKeterangan')); ?></small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-12 font-15 font-weight-bold text-dark mb-2">Bandara Asal</div>
                    <div class="col-md-12">
                        <select name="nmBandaraAsal" id="nmBandaraAsal" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $bandara; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bd_asal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($bd_asal->jenis_id); ?>"
                                    <?php if($bd_asal->jenis_id === $jdkedatangan->bandara_asal): ?> selected <?php endif; ?>>
                                    [<?php echo e($bd_asal->kode); ?>] - <?php echo e($bd_asal->bandara); ?> - <?php echo e($bd_asal->kota); ?> - <?php echo e($bd_asal->negara); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 font-15 font-weight-bold text-dark mb-2">Bandara Tujuan</div>
                    <div class="col-md-12">
                        <select name="nmBandaraTujuan" id="nmBandaraTujuan" class="form-control select2 w-100">
                            <option value="">- Pilih -</option>
                            <?php $__currentLoopData = $bandara; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bd_tujuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($bd_tujuan->jenis_id); ?>"
                                    <?php if($bd_tujuan->jenis_id === $jdkedatangan->bandara_tujuan): ?> selected <?php endif; ?>>
                                    [<?php echo e($bd_tujuan->kode); ?>] - <?php echo e($bd_tujuan->bandara); ?> - <?php echo e($bd_tujuan->kota); ?> - <?php echo e($bd_tujuan->negara); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center border-top">
        <button type="submit" class="btn btn-lg btn-dark">
            <span class="font-16"><i class="fas fa-check mr-2"></i>Perbarui</span>
        </button>
    </div>
</div>

</form>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.full.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/jadwal/kedatangan/edit.blade.php ENDPATH**/ ?>