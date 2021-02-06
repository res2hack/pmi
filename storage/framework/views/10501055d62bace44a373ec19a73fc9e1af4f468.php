 

<?php $__env->startSection('title'); ?>
Kelola Program Pelatihan - Pendaftaran
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
        <i class="fas fa-tasks font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Program Pelatihan</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('pelatihan_create')); ?>" class="text-success dropdown-item" title="Buat Program Pelatihan Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('pelatihan_edit', $pelatihan->id)); ?>" class="text-primary dropdown-item" title="Ubah Data Pelatihan"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Pelatihan <i class="far fa-file-alt ml-2"></i></span>
        
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pelatihan_index')); ?>"><u>Pelatihan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Detail</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-2">
            <div class="col-md-12 text-right">
                <a href="<?php echo e(route('pelatihan_edit', $pelatihan->id)); ?>" class="btn btn-primary">
                    <span class="font-14"><i class="fas fa-user-friends mr-2"></i>Pendaftaran</span>
                </a>
                <a href="<?php echo e(route('pelatihan_edit', $pelatihan->id)); ?>" class="btn btn-dark ml-2">
                    <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                </a>
            </div>
        </div>
        <div class="form-group row mt-4 mb-0 mx-0">
            <div class="col-3 py-2  font-15 font-weight-bold bg-soft-dark text-biru-muda text-right">
                Nama Program
            </div>
            <div class="col-9 py-2 font-15 font-weight-bold bg-soft-dark text-kuning-muda">
                <?php echo e($pelatihan->name); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 pt-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Kejuruan</div>
            <div class="py-2 col-9 pt-3">
                <span class="text-dark font-weight-bold font-14"><?php echo e($sub_kejuruan); ?> (<?php echo e($kejuruan); ?>)</span>   
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Durasi</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($pelatihan->jam_pelajaran); ?> Jam
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Kuota</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($pelatihan->kuota_peserta); ?> Peserta
            </div> 
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jadwal</div>
            <div class="py-2 col-9 font-14 font-weight-bold text-primary">
                <?php echo e(\Carbon\Carbon::parse($pelatihan->tgl_mulai)->format('d-m-Y')); ?> s/d <?php echo e(\Carbon\Carbon::parse($pelatihan->tgl_selesai)->format('d-m-Y')); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
                Status Pendaftaran</div>
            <div class="py-2 col-9">
                <span class="<?php if($pelatihan->status_pendaftaran === "tutup"): ?> bg-danger 
                    <?php else: ?> bg-success <?php endif; ?>
                    px-2 py-1 rounded font-13 text-white text-capitalize">
                    <?php echo e($pelatihan->status_pendaftaran); ?>

                </span>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Keterangan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo $pelatihan->keterangan; ?>

            </div>
        </div>
        <div class="row mt-2"></div>
        <div class="form-group row mt-4 mb-0 mx-0">
            <div class="col-6 py-2  font-15 font-weight-bold bg-soft-dark text-kuning-muda">
                Peserta Yang Mendaftar
            </div>
            <div class="col-6 py-2 font-15 font-weight-bold bg-soft-dark text-kuning-muda">
            
            </div>
        </div>
        <div class="mt-2 table-responsive ">
            <div class="float-left mr-2">
                <a href="<?php echo e(route('pelatihan_create')); ?>" class="btn btn-primary font-14 py-2" title="Buat Data Baru">
                    <i class="fas fa-plus mr-2"></i>Baru
                </a>
            </div>
            <table id="dt-pendaftaran" class="table w-100">
                <thead>
                    <tr>
                        <th style="width:5%;">#</th>
                        <th class="font-15">Nama Program</th>
                        <th class="font-15">Create Date</th>
                        <th style="width:5%;"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <?php echo $__env->make('sistem.pelatihan.table-pendaftaran', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/pendaftaran.blade.php ENDPATH**/ ?>