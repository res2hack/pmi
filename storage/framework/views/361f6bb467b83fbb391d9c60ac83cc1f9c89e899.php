 

<?php $__env->startSection('title'); ?>
Kelola Data Master Kecamatan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('theme/node_modules/select2/dist/css/select2.min.css')); ?>">
<style>
    .dropleft .dropdown-toggle::before {
    display: none !important;
    }

    .select2-container--default .select2-selection--single {
            background-color: #F5F3FF;
            border-color:#C4B5FD;
            font-weight:500;
    }
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Master Data Kecamatan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span></div>
            
        <span class="font-weight-500 text-primary">Ubah Data Kecamatan</span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('kecamatan_index')); ?>"><u>Kecamatan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <div class="col-md-4">
        <form method="POST" action="<?php echo e(route('kecamatan_update', $kecamatan->id )); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="nmStatus" value="baru">
            <div class="card shadow border-top5 border-form ">
                <div class="card-body mt-0 pb-1 ">

                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Nama Kecamatan</div>
                        <textarea  id="nmKecamatan" name="nmKecamatan" class="form-control bg-form 
                            h-45 font-weight-500 border-form" required><?php echo e($kecamatan->nama); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmKecamatan')); ?></small>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-1 text-dark">Kabupaten / Kota</div>
                        <select name="nmKabKota" id="nmKabKota" class="form-control select2">
                            <?php $__currentLoopData = $kabkota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($x->id); ?>" 
                                    <?php if($x->id === $kecamatan->kabkota_id): ?> selected <?php endif; ?>>
                                    <?php echo e($x->nama); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer border-top mt-2 py-3 text-center">
                    <button type="submit" class="btn btn-lg btn-dark w-75">
                        <i class="fas fa-check mr-3 font-14"></i><span class="font-16">Tambah</span></button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="mt-2 table-responsive ">
                    <table id="dt-master" class="table w-100">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th class="font-15">Kecamatan</th>
                                <th class="font-15">Kabupaten / Kota</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('sistem.master.kecamatan.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('theme/node_modules/select2/dist/js/select2.min.js')); ?>"></script>
    <?php echo $__env->make('sistem.master.kecamatan.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/master/kecamatan/edit.blade.php ENDPATH**/ ?>