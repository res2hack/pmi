 

<?php $__env->startSection('title'); ?>
Kelola Data Penduduk - <?php echo e($partner->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    .dropdown-toggle::after {
    display: none !important;
}
.dropleft .dropdown-toggle::before {
    display: none !important;
    }
</style>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-user font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Penduduk</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold
                    rounded text-white align-top py-1 px-2">Detail
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
<span class="font-weight-bold text-dark"><?php echo e($partner->name); ?></span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="form-group row mb-0 mx-0 ">
            <div class="col-12 py-3 bg-detail  ">
                <div class="row">
                    <div class="col-md-6">
                        <span class="font-14 text-uppercase font-weight-bold bg-soft-dark p-2 rounded text-kuning-muda">
                            <i class="fas fa-user font-14 mr-2 text-white"></i>  
                            <?php echo e($partner->name); ?>

                        </span>
                        <span class="ml-3 font-14 text-capitalize font-weight-bold text-white">
                            <?php echo e($partner->jk ==="L"?"Laki-Laki":"Perempuan"); ?>

                            <span class="mx-2">/</span>
                            <?php echo e(\Carbon\Carbon::parse($partner->tgl_lahir)->format('d-m-Y')); ?>

                        </span>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?php echo e(route('partner_edit', $partner->id)); ?>" 
                            class="bg-dark p-2 text-white border border-dark rounded" title="Ubah Data Perusahaan">
                            <i class="fas fa-edit mr-2 font-11"></i>Ubah
                        </a>
                        <a href="<?php echo e(route('partner_create')); ?>" 
                            class="bg-light p-2 text-dark border border-white rounded ml-2" title="Ubah Data Perusahaan">
                            <i class="fas fa-plus mr-2 font-11"></i>Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pb-2 pt-3 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">NIK</div>
            <div class="pb-2 pt-3 col-9 font-weight-500 text-dark">
                <?php echo e($partner->nik); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">No. BPJS</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                <?php echo e($partner->bpjs); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Agama</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                <?php echo e($partner->agama_id); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Pendidikan</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                <?php echo e($partner->pendidikan_id); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Alamat</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                <?php echo e($partner->alamat); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Kab. / Kota</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                <?php echo e($kabupaten); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Provinsi</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                <?php echo e($provinsi); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Kontak (Telp.)</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                <?php echo e($partner->kontak); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Email</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                <?php echo e($partner->email?:"-"); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Keterangan</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark">
                <?php echo e($partner->keterangan?:"-"); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="col-3 py-2 bg-light text-primary font-weight-bold text-right font-16">
                Aksesbilitas
            </div>
            <div class="col-9 py-2 bg-light ">
                
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-3 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Login Sistem</div>
            <div class="pt-3 pb-2 col-9 font-weight-500 text-dark">
                <?php if($partner->user_id): ?>
                    <i class="font-18 far fa-check-circle text-success mr-2" title="Ya"></i>Ya
                    <span class="ml-3 mr-2">Status:</span>
                    <?php if($status_login == "active"): ?>
                        <span class="bg-success px-2 py-1 rounded text-white ">Diterima (Aktif)</span>
                    <?php elseif($status_login == "pending"): ?>
                        <span class="bg-warning px-2 py-1 rounded text-white ">Ditunda</span>
                    <?php else: ?>
                        <span class="bg-danger px-2 py-1 rounded text-white ">Dilarang</span>
                    <?php endif; ?>
                <?php else: ?>
                    <i class="font-18 far fa-times-circle text-danger mr-2" title="Tidak"></i>Tidak
                <?php endif; ?>
            </div>
        </div>
        <?php if($partner->user_id && ($status_login == "active" || $status_login == "pending")): ?>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Konsultasi</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark text-capitalize">
                <i class="font-18 far <?php if($partner->status_konsultasi === "aktif"): ?> fa-check-circle text-success 
                    <?php else: ?> fa-times-circle text-danger <?php endif; ?> mr-2" title="Ya">
                </i><?php echo e($partner->status_konsultasi === "aktif"?"Aktif":"Tidak"); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Pengaduan</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark text-capitalize">
                <i class="font-18 far <?php if($partner->status_pengaduan === "aktif"): ?> fa-check-circle text-success 
                    <?php else: ?> fa-times-circle text-danger <?php endif; ?> mr-2" title="Ya">
                </i><?php echo e($partner->status_pengaduan === "aktif"?"Aktif":"Tidak"); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Lamaran Pkj.</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark text-capitalize">
                <i class="font-18 far <?php if($partner->status_lamaran === "aktif"): ?> fa-check-circle text-success 
                    <?php else: ?> fa-times-circle text-danger <?php endif; ?> mr-2" title="Ya">
                </i><?php echo e($partner->status_lamaran === "aktif"?"Aktif":"Tidak"); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Pencaker</div>
            <div class="pt-1 pb-2 col-9 font-weight-500 text-dark text-capitalize">
                <i class="font-18 far <?php if($partner->status_pencaker === "aktif"): ?> fa-check-circle text-success 
                    <?php else: ?> fa-times-circle text-danger <?php endif; ?> mr-2" title="Ya">
                </i><?php echo e($partner->status_pencaker === "aktif"?"Aktif":"Tidak"); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/penduduk/detail.blade.php ENDPATH**/ ?>