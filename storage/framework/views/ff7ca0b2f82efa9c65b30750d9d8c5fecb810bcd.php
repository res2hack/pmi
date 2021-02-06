 

<?php $__env->startSection('title'); ?>
Kelola Data Jadwal Kedatangan - Detail
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .dropdown-toggle::after {
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Jadwal Kedatangan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('jadwal_kedatangan_create')); ?>" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('jadwal_kedatangan_edit', $jdkedatangan->id)); ?>" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Kedatangan <i class="far fa-file-alt ml-2"></i></span>
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
<span class="font-weight-500">Detail</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-2">
            <div class="col-md-12 text-right">
                <a href="<?php echo e(route('jadwal_kedatangan_index')); ?>" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>
                <a href="<?php echo e(route('jadwal_kedatangan_edit', $jdkedatangan->id)); ?>" class="btn btn-dark ml-2">
                    <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                </a>
                
                <a href="<?php echo e(route('jadwal_kedatangan_delete')); ?>" class="btn btn-danger ml-2"
                    data-toggle="modal" data-target="#exampleModalCenter" 
                    onclick="$('#idDelete').val(<?php echo e($jdkedatangan->id); ?>);" title="Hapus Data">
                    <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                </a>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">No. Penerbangan</div>
            <div class="py-2 col-9 font-weight-bold text-dark">
                <?php echo e($jdkedatangan->no_penerbangan); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Pesawat</div>
            <div class="py-2 col-9 font-weight-bold text-primary">
               [<?php echo e($detail_pesawat->kode); ?>] - <?php echo e($detail_pesawat->name); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Jadwal Kedatangan</div>
            <div class="py-2 col-9 font-weight-500 text-success">
                <?php echo e(\Carbon\Carbon::parse($jdkedatangan->jadwal)->format('d-m-Y')); ?>

                <span class="mx-2">/</span>
                <?php echo e(\Carbon\Carbon::parse($jdkedatangan->jadwal)->format('H:i:s')); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Bandara Asal</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if($bandara_asal): ?>
                [<?php echo e($bandara_asal->kode); ?>] - <?php echo e($bandara_asal->name); ?> 
                <span class="mx-2">/</span> <?php echo e($bandara_asal->tag1); ?> - <?php echo e($negara_asal); ?>

                <?php else: ?>
                -
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Bandara Tujuan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if($bandara_asal): ?>
                    [<?php echo e($bandara_tujuan->kode); ?>] - <?php echo e($bandara_tujuan->name); ?>

                    <span class="mx-2">/</span> <?php echo e($bandara_tujuan->tag1); ?> - <?php echo e($negara_tujuan); ?>

                <?php else: ?>
                -
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Keterangan</div>
            <div class="py-2 col-9 font-weight-bold text-dark">
                <?php echo e($jdkedatangan->keterangan?:"-"); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<form method="POST" action="<?php echo e(route('jadwal_kedatangan_delete')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('sistem.jadwal.petugas.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/jadwal/kedatangan/detail.blade.php ENDPATH**/ ?>