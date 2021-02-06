 

<?php $__env->startSection('title'); ?>
Kelola Data Pelamar - Detail
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
        <i class="fas fa-user-tie font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Pelamar</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('pelamar_create')); ?>" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('pelamar_edit', $pelamar->id)); ?>" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="fas fa-edit mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Pencari Kerja <i class="far fa-file-alt ml-2"></i></span>
        <span class="mx-2">/</span> 
        <span class="text-dark font-weight-bold"><?php echo e($pelamar->name); ?></span> 
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pelamar_index')); ?>"><u>Pelamar</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500"><?php echo e($pelamar->name); ?></span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="form-group row mb-0 mx-0 ">
            <div class="col-12 py-3 bg-detail  ">
                <div class="row">
                    <div class="col-md-9">
                        <span class="bg-soft-dark p-2 rounded text-kuning-muda">
                            <i class="far fa-id-card font-14 mr-2 text-white"></i> 
                            <span class="font-15 text-uppercase font-weight-bold "> 
                                Info Lowongan
                            </span> 
                        </span>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="<?php echo e(route('sip_detail', $sip->id)); ?>" 
                            class="p-2 text-white" title="Ubah Data Lowongan">
                            <i class="fas fa-edit mr-2 font-11"></i>Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>

        
     
        <div class="form-group row my-0 mx-0">
            <div class="pt-3 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jabatan</div>
            <div class="pt-3 pb-2 col-9 font-14 font-weight-bold text-primary text-uppercase">
                <?php echo e($jabatan->nama); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Negara Tujuan</div>
            <div class="pt-1 pb-2 col-9 font-14 font-weight-bold text-danger text-uppercase">
                <?php echo e($negara?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Agency</div>
            <div class="pt-1 pb-2 col-9 font-14 font-weight-bold text-dark">
                <?php echo e($sip->agency); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Perusahaan</div>
            <div class="pt-1 pb-2 col-9 font-14 font-weight-bold text-dark">
                <?php echo e($perusahaan->nama); ?>

            </div>
        </div>
        <div class="form-group row mt-4 mb-0 mx-0 ">
            <div class="col-12 py-3 bg-detail  ">
                <div class="row">
                    <div class="col-md-9">
                        <span class="bg-soft-dark p-2 rounded text-kuning-muda">
                            <i class="fas fa-user-tie font-14 mr-2 text-white"></i> 
                            <span class="font-15 text-uppercase font-weight-bold "> 
                                Data Pelamar
                            </span> 
                        </span>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="<?php echo e(route('partner_detail', $pelamar->user_partner_id )); ?>" 
                            class="p-2 text-white" title="Detail Data Pelamar">
                            <i class="fas fa-edit mr-2 font-11"></i>Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-3 pb-2 col-3 font-15 font-weight-bold 
                bg-light3 text-dark text-right border-right">Tgl. Apply Lamaran</div>
            <div class="pt-3 pb-2 col-9 font-14 font-weight-bold text-dark">
                <?php echo e(\Carbon\Carbon::parse($pelamar->tgl_registrasi)->format('d-m-Y')); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Nama</div>
            <div class="pt-1 pb-2 col-9 font-15 font-weight-bold text-primary text-uppercase">
                <?php echo e($pelamar->name); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">J. Kelamin</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold">
                <?php echo e($pelamar->jk === "L"?"Laki-Laki":"Perempuan"); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Agama</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold">
                <?php echo e($agama?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">NIK</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold">
                <?php echo e($pelamar->nik); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">No. BPJS</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold">
                <?php echo e($pelamar->bpjs); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Alamat</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold">
                <?php if(!$pelamar->alamat && !$pelamar->kabupaten_id 
                    && !$pelamar->kecamatan_id &&  !$pelamar->provinsi_id): ?>
                    -
                <?php else: ?>
                    <?php if($pelamar->alamat): ?>
                        <?php echo e($pelamar->alamat); ?>

                    <?php endif; ?>
                    <?php if($pelamar->kabupaten_id): ?>
                        , <?php echo e($kabupaten->nama); ?>

                    <?php endif; ?>
                    <?php if($pelamar->kecamatan_id ): ?>
                        , <?php echo e($kecamatan->nama); ?>

                    <?php endif; ?>
                    <?php if($pelamar->provinsi_id): ?>
                        , <?php echo e($provinsi->nama); ?>

                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Pendidikan</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold">
                <?php echo e($pendidikan); ?> <?php if($pelamar->jurusan): ?> / Jurusan: <?php echo e($pelamar->jurusan); ?> <?php else: ?> - <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Foto</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold">
                <?php if($pelamar->foto): ?>
                <a href="<?php echo e(url($pelamar->foto)); ?>" target="_blank">
                    <img src="<?php echo e(url($pelamar->foto)); ?>" alt="Foto" style="width:180px;height:200px;">
                </a> 
                <?php else: ?>
                    <span class="text-danger">Tidak disertakan</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Curriculum Vitae</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold">
                <?php if($pelamar->cv): ?>
                    <a href="<?php echo e(url($pelamar->cv)); ?>" target="_blank"><u>CV Pelamar</u></a> 
                <?php else: ?>
                    <span class="text-danger">Tidak disertakan</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Kompetensi</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold">
                <?php if($pelamar->syarat_kompetensi === "Y"): ?>
                    <i class="font-18 far fa-check-circle text-success" title="Memenuhi"></i>
                <?php else: ?>
                    <i class="font-18 far fa-times-circle text-danger" title="Tidak Memenuhi"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Sehat</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold">
                <?php if($pelamar->syarat_sehat === "Y"): ?>
                    <i class="font-18 far fa-check-circle text-success" title="Memenuhi"></i>
                <?php else: ?>
                    <i class="font-18 far fa-times-circle text-danger" title="Tidak Memenuhi"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Dokumen</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold">
                <?php if($pelamar->syarat_dokumen === "Y"): ?>
                    <i class="font-18 far fa-check-circle text-success" title="Memenuhi"></i>
                <?php else: ?>
                    <i class="font-18 far fa-times-circle text-danger" title="Tidak Memenuhi"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Keterangan Tambahan</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold">
                <?php echo e($pelamar->keterangan?:"-"); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<form method="POST" action="<?php echo e(route('pelamar_delete')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('sistem.pelamar.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelamar/detail.blade.php ENDPATH**/ ?>