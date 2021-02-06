 

<?php $__env->startSection('title'); ?>
Kelola Data Perusahaan - Detail
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
        <i class="fas fa-house-user font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Perusahaan</h4> 
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
<a href="<?php echo e(route('perusahaan_index')); ?>"><u>Perusahaan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark"><?php echo e($perusahaan->nama); ?></span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card shadow  border-top5 border-form">
    <div class="card-body">
        <div class="form-group row mb-0 mx-0 ">
            <div class="col-12 py-3 bg-detail  ">
                <div class="row">
                    <div class="col-md-9">
                        <span class="font-14 text-uppercase font-weight-bold bg-soft-dark p-2 rounded text-kuning-muda">
                            <i class="fas fa-house-user font-13 mr-2 text-white"></i>  <?php echo e($perusahaan->nama); ?>

                        </span>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="<?php echo e(route('perusahaan_edit', $perusahaan->id)); ?>" 
                            class="bg-dark p-2 text-white border border-dark rounded" title="Ubah Data Perusahaan">
                            <i class="fas fa-edit mr-2 font-11"></i>Ubah
                        </a>
                        <a href="<?php echo e(route('perusahaan_create')); ?>" 
                            class="bg-light p-2 text-dark border border-white rounded ml-2" title="Ubah Data Perusahaan">
                            <i class="fas fa-plus mr-2 font-11"></i>Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pb-2 pt-3 col-3 font-15 font-weight-bold text-dark text-right border-right bg-light3">Alamat</div>
            <div class="pb-2 pt-3 col-9 font-weight-500 text-dark">
                <?php echo e($perusahaan->alamat); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right bg-light3">Kab. / Kota</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($kabupaten); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right bg-light3">Provinsi</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($provinsi); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right bg-light3">Kontak (Telp.)</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($perusahaan->contact_telp); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right bg-light3">Email</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($perusahaan->email?:"-"); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right bg-light3">Contact Person</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($perusahaan->contact_nama?:"-"); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right bg-light3">Login Sistem</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if($perusahaan->user_id): ?>
                    Ya<i class="font-18 far fa-check-circle text-success ml-2" title="Ya"></i>
                    <span class="ml-3 mr-2">Status:</span>
                    <?php if($status_login == "active"): ?>
                        <span class="bg-success px-2 py-1 rounded text-white ">Diterima (Aktif)</span>
                    <?php elseif($status_login == "pending"): ?>
                        <span class="bg-warning px-2 py-1 rounded text-white ">Ditunda</span>
                    <?php else: ?>
                        <span class="bg-danger px-2 py-1 rounded text-white ">Dilarang</span>
                    <?php endif; ?>
                <?php else: ?>
                    Tidak<i class="font-18 far fa-times-circle text-danger ml-2" title="Tidak"></i>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
</div>

<div class="card shadow mt-2">
    <div class="card-body">
        <div class="float-left pt-2">
            <span class="text-dark font-15 font-weight-bold mt-1">50 Daftar Lowongan Terakhir</span>
        </div>
        <table id="datatable" class="table w-100">
            <thead>
                <tr>
                    <th style="width:8%;">#</th>
                    <th>No. SIP</th>
                    <th class="font-15">Agency</th>
                    <th class="font-15">Jabatan</th>
                    <th class="font-15">Negara</th>
                    <th class="font-15">Status</th>
                </tr>
            </thead>
            <tbody class="text-dark">
                <?php $__currentLoopData = $sip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td></td>
                    <td>
                        <a class="font-weight-bold" href="<?php echo e(route('sip_detail', $x->id)); ?>" 
                            target="_blank"><?php echo e($x->no_sip); ?></a> 
                        <br>
                        <span class="font-weight-500">Berlaku: <?php echo e(\Carbon\Carbon::parse($x->tgl_ijin_awal)->format('d-m-Y')); ?>

                            s/d <?php echo e(\Carbon\Carbon::parse($x->tgl_ijin_akhir)->format('d-m-Y')); ?></span> 
                    </td>
                    <td><?php echo e($x->agency); ?></td>
                    <td>
                        <span class="font-weight-500 text-ungu"><?php echo e($x->jabatan); ?></span> 
                        <br><?php echo e($x->sts_formal === "0"?"Formal":"Informal"); ?></td>
                    <td class="font-weight-500"><?php echo e($x->negara); ?></td>
                    <td>
                        <?php if(strtotime($x->tgl_ijin_akhir) > strtotime("-1 day", strtotime(now()))): ?>
                            <span class="bg-success font-weight-500 px-2 py-1 rounded text-white">Active</span>
                        <?php else: ?>
                            <span class="bg-light font-weight-500 px-2 py-1 rounded text-dark">Expired</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php echo $__env->make('global.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/perusahaan/detail.blade.php ENDPATH**/ ?>