 

<?php if(Auth::user()->tipe == "staf" && (auth()->user()->hasRole(['superadmin', 'admin']) || auth()->user()->can(['pelatihan']))): ?>

<?php $__env->startSection('title'); ?>
Kelola Program Pelatihan - <?php echo e($pelatihan->name); ?>

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
        <i class="fas fa-diagnoses font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Program Pelatihan</h4> 
            <span class="ml-2 font-11 bg-primary rounded text-white 
            align-top py-1 px-2 font-weight-bold ">Detail
        </span>
        </div>
            
        <span class="font-weight-bold">Detail Pelatihan</span>
        <i class="mx-2 fas fa-caret-right"></i>
        <span class="font-weight-500 text-primary"><?php echo e($pelatihan->name); ?></span> 
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pelatihan_index')); ?>"><u>Pelatihan</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark"><?php echo e($pelatihan->name); ?></span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="form-group row mb-0 mx-0">
            <div class="col-12 py-3 bg-detail">
                <div class="row">
                    <div class="col-md-6">
                        
                        <span class="font-15 text-uppercase font-weight-bold bg-soft-dark p-2 rounded text-kuning-muda">
                            <i class="fas fa-diagnoses font-14 mr-2 text-white"></i>  <?php echo e($pelatihan->name); ?>

                        </span>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?php echo e(route('pelatihan_edit', $pelatihan->id)); ?>" class="font-weight-bold text-white">
                            <u class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</u>
                        </a>
                        <a href="<?php echo e(route('pelatihan_pendaftaran_detail', $pelatihan->id)); ?>" class="ml-3 font-weight-bold text-white">
                            <u class="font-14"><i class="fas fa-user-friends mr-2"></i>Pendaftaran</u>
                        </a>

                        <div class="btn-group dropleft ml-3 " title="Menu Lainnya">
                            <a type="button" class="dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-white"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="<?php echo e(route('pelatihan_penerimaan_detail', $pelatihan->id)); ?>" class="text-dark dropdown-item" 
                                    title="Penerimaan"><i class="fas fa-caret-right font-14 mx-2"></i>Penerimaan 
                                </a>
                                <a href="<?php echo e(route('pelatihan_kelulusan_detail', $pelatihan->id)); ?>" class="text-dark dropdown-item" 
                                    title="Kelulusan"><i class="fas fa-caret-right font-14 mx-2"></i>Kelulusan 
                                </a>
                                <a href="<?php echo e(route('pelatihan_sertifikasi_detail', $pelatihan->id)); ?>" class="text-dark dropdown-item" 
                                    title="Sertifikasi"><i class="fas fa-caret-right font-14 mx-2"></i>Sertifikasi 
                                </a>
                                <a href="<?php echo e(route('pelatihan_create')); ?>" class="text-success dropdown-item" 
                                    title="Buat Program Pelatihan Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 pt-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Kejuruan</div>
            <div class="py-2 col-9 pt-3">
                <span class="text-dark font-weight-bold font-14"><?php echo e($sub_kejuruan); ?> (<?php echo e($kejuruan); ?>)</span>   
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Anggaran</div>
            <div class="py-2 col-9">
                <span class="font-weight-bold font-15 text-success"><?php echo e(number_format(($pelatihan->anggaran),0,",",".")); ?></span>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Sumber Dana</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($sumber_dana); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Metode</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($metode); ?>

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
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tanggal Pelatihan</div>
            <div class="py-2 col-9 font-14 font-weight-bold text-primary">
                <?php echo e(\Carbon\Carbon::parse($pelatihan->tgl_mulai)->format('d-m-Y')); ?> s/d <?php echo e(\Carbon\Carbon::parse($pelatihan->tgl_selesai)->format('d-m-Y')); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
                Status Pelatihan
            </div>
            <div class="py-2 col-9">
                <span class="<?php if($pelatihan->status_pelatihan === "batal"): ?> bg-danger 
                    <?php elseif($pelatihan->status_pelatihan === "draft"): ?> bg-warning
                    <?php elseif($pelatihan->status_pelatihan === "valid"): ?> bg-ungu2 <?php else: ?> bg-success <?php endif; ?>
                    px-2 py-1 rounded font-13 text-white text-capitalize font-weight-500">
                    <?php if($pelatihan->status_pelatihan === "valid"): ?>
                        <i class="fas fa-check mr-1 font-11"></i>
                    <?php elseif($pelatihan->status_pelatihan === "selesai"): ?>
                        <i class="far fa-check-circle mr-1 font-11"></i>
                    <?php endif; ?>
                    <?php echo e($pelatihan->status_pelatihan); ?>

                </span>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
                Status Pendaftaran</div>
            <div class="py-2 col-9">
                <?php if($pelatihan->status_pendaftaran === "tutup"): ?> 
                    <span class="bg-danger px-2 py-1 rounded font-13 text-white text-capitalize font-weight-500">
                        <i class="fas fa-lock mr-1 font-11"></i> <?php echo e($pelatihan->status_pendaftaran); ?>

                    </span>
                <?php else: ?>
                    <span class="bg-success px-2 py-1 rounded font-13 text-white text-capitalize font-weight-500">
                        <i class="fas fa-lock-open mr-1 font-11"></i> <?php echo e($pelatihan->status_pendaftaran); ?>

                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">
                Tipe Pendaftaran *</div>
            <div class="py-2 col-9 font-weight-500 text-capitalize text-dark">
                    <?php echo e($pelatihan->tipe_pendaftaran); ?> 
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold 
                    bg-light3 text-dark text-right border-right">Jumlah Pendaftar</div>
            <div class="py-2 col-9 font-14 font-weight-500">
                <?php if($pelatihan->jml_pendaftar > 0): ?>
                    <span class="text-primary"><?php echo e($pelatihan->jml_pendaftar); ?> Orang</span>
                    <span class="mx-2">/</span>
                    <span class="text-dark"><?php echo e($pelatihan->pendaftar_l); ?> Laki-Laki,
                        <?php echo e($pelatihan->pendaftar_p); ?> Perempuan
                    </span>
                <?php else: ?>
                    -
                <?php endif; ?>
            </div>
        </div>
       
       
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold 
                    bg-light3 text-dark text-right border-right">Diterima (Peserta)</div>
            <div class="py-2 col-9 font-14 font-weight-500">
                <?php if($pelatihan->jml_peserta > 0): ?>
                <span class="text-primary"><?php echo e($pelatihan->jml_peserta); ?> Orang</span>
                <span class="mx-2">/</span>
                <span class="text-dark"><?php echo e($pelatihan->peserta_l); ?> Laki-Laki,
                    <?php echo e($pelatihan->peserta_p); ?> Perempuan</span>
                <?php else: ?>
                    -
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold 
                    bg-light3 text-dark text-right border-right">Kelulusan</div>
            <div class="py-2 col-9 font-14 font-weight-500">
                <?php if($pelatihan->jml_lulusan > 0): ?>
                    <span class="text-primary"><?php echo e($pelatihan->jml_lulusan); ?> Peserta</span>
                    <span class="mx-2">/</span>
                    <span class="text-dark"><?php echo e($pelatihan->lulusan_l); ?> Laki-Laki,
                        <?php echo e($pelatihan->lulusan_p); ?> Perempuan</span>
                <?php else: ?>
                -
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold 
                    bg-light3 text-dark text-right border-right">Sertifikasi</div>
            <div class="py-2 col-9 font-14 font-weight-500">
                <?php if($pelatihan->jml_lulusan_sertifikasi > 0): ?>
                    <span class="text-primary"><?php echo e($pelatihan->jml_lulusan_sertifikasi); ?> Peserta</span>
                    <span class="mx-2">/</span>
                    <span class="text-dark"><?php echo e($pelatihan->lulusan_sertifikasi_l); ?> Laki-Laki,
                        <?php echo e($pelatihan->lulusan_sertifikasi_p); ?> Perempuan</span>
                <?php else: ?>
                -
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold 
                    bg-light3 text-dark text-right border-right">Penempatan</div>
            <div class="py-2 col-9 font-14 font-weight-500">
                <?php if($pelatihan->jml_penempatan > 0): ?>
                    <span class="text-primary font-weight-bold"><?php echo e($pelatihan->jml_penempatan); ?> Peserta</span>
                    <span class="mx-2">/</span>
                    <span class="text-dark"><?php echo e($pelatihan->penempatan_l); ?> Laki-Laki,
                        <?php echo e($pelatihan->penempatan_p); ?> Perempuan
                    </span>
                    <span class="mx-2">/</span>
                    <span class="text-dark"><?php echo e($pelatihan->jml_penempatan_formal); ?> Formal,
                        <?php echo e($pelatihan->jml_penempatan_informal); ?> Informal
                    </span>
                <?php else: ?>
                -
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Keterangan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo $pelatihan->keterangan; ?>

            </div>
        </div>
        <div class="mt-2 font-12 font-weight-500">
            <span class="text-danger">* Pendaftaran Tipe Terbuka:</span> 
            User yang memiliki akses login sistem bisa 
            melakukan pendaftaran mandiri
        </div>
    </div>
    
</div>

<?php $__env->stopSection(); ?>

<?php else: ?>
    <?php echo $__env->make('global.dilarang', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/detail.blade.php ENDPATH**/ ?>