 

<?php $__env->startSection('title'); ?>
Kelola Data Master Jenis Pulang
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .dropleft .dropdown-toggle::before {
    display: none !important;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Master Data Jenis Pulang</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span></div>
            
        <span class="font-weight-500 text-primary">Ubah Data</span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('master_index', 'jenis-pulang')); ?>"><u>Jenis Pulang</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah</span>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <div class="col-md-4">
        <form method="POST" action="<?php echo e(route('master_update')); ?>">
            <?php echo csrf_field(); ?>
            <div class="card shadow border-top5 border-form ">
                <div class="card-body mt-0 pb-1 ">

                    <input type="hidden" name="nmStatus" value="edit">
                    <input type="hidden" name="nmRedirect" value="index">
                    <input type="hidden" name="nmJenisKategori" value="kedatangan_jenis_pulang">
                    <input type="hidden" name="nmID" value="<?php echo e($master->id); ?>">

                    
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Nama Jenis Pulang</div>
                        <textarea name="nmName" class="form-control font-weight-500 
                                    bg-form border-form" rows="3" required><?php echo e($master->name); ?></textarea>
                        <small class="text-danger"><?php echo e($errors->first('nmName')); ?></small>
                    </div>
                    <div class="form-group">
                        <div class="font-weight-bold font-16 mb-2 text-dark">Warna Label</div>
                        <select name="nmTag1" id="nmWarna" class="selectric">
                            <option value="dark" <?php if($master->tag1 === "dark"): ?> selected <?php endif; ?>>Gelap (dark)</option>
                            <option value="success" <?php if($master->tag1 === "success"): ?> selected <?php endif; ?>>Hijau (success)</option>
                            <option value="primary" <?php if($master->tag1 === "primary"): ?> selected <?php endif; ?>>Ungu (primary)</option>
                            <option value="info" <?php if($master->tag1 === "info"): ?> selected <?php endif; ?>>Biru Muda (info)</option>
                            <option value="warning" <?php if($master->tag1 === "warning"): ?> selected <?php endif; ?>>Kuning (warning)</option>
                            <option value="danger" <?php if($master->tag1 === "danger"): ?> selected <?php endif; ?>>Merah (danger)</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer border-top mt-2 py-3 text-center">
                    <button type="submit" class="btn btn-lg btn-dark w-75">
                        <i class="fas fa-check mr-3 font-14"></i><span class="font-16">Perbarui</span></button>
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
                                <th class="font-15">Nama Jenis Pulang</th>
                                <th class="font-15">Warna</th>
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
        <?php echo $__env->make('sistem.master.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('sistem.master.jenis-pulang.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/master/jenis-pulang/edit.blade.php ENDPATH**/ ?>