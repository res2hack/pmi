 

<?php $__env->startSection('title'); ?>
Kelola Data Pencaker - Detail
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Pencaker</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('pencaker_create')); ?>" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('pencaker_edit', $pencaker->id)); ?>" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="fas fa-edit mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Pencari Kerja <i class="far fa-file-alt ml-2"></i></span>
        <span class="mx-2">/</span> 
        <span class="text-dark font-weight-bold"><?php echo e($pencaker->name); ?></span> 
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pencaker_index')); ?>"><u>Pencaker</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500"><?php echo e($pencaker->name); ?></span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-2">
            <div class="col-md-12 text-right">
                <a href="<?php echo e(route('pencaker_index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>
                <a href="<?php echo e(route('pencaker_edit', $pencaker->id)); ?>" class="btn btn-dark ml-2">
                    <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                </a>
                
                <a href="<?php echo e(route('pencaker_delete')); ?>" class="btn btn-danger ml-2"
                    data-toggle="modal" data-target="#exampleModalCenter" 
                    onclick="$('#idDelete').val(<?php echo e($pencaker->id); ?>);" title="Hapus Data">
                    <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                </a>
            </div>
        </div>
        <div class="form-group row mt-4 mb-0 ml-0 mr-0">
            <div class="col-6 py-2 font-18 font-weight-bold bg-soft-dark text-biru-muda">
                <i class="fas fa-bell font-15 mr-3 text-kuning-muda"></i>Info Lowongan
                <a href="<?php echo e(route('sip_detail', $pencaker->sip_id)); ?>" target="_blank" 
                    title="Lihat Detail Lowongan" class="font-12 font-weight-bold text-white">
                    <i class="ml-3 mr-2 fas fa-link font-12"></i><u>Lihat Detail</u>
                </a>
            </div>
            <div class="col-6 py-2 font-18 font-weight-bold bg-soft-dark text-white ">
                
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jabatan</div>
            <div class="py-2 col-9 font-14 font-weight-bold text-primary text-uppercase">
                <?php echo e($jabatan->nama); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Negara Tujuan</div>
            <div class="py-2 col-9 font-14 font-weight-bold text-danger text-uppercase">
                <?php echo e($negara?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Agency</div>
            <div class="py-2 col-9 font-14 font-weight-bold text-dark">
                <?php echo e($sip->agency); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Perusahaan</div>
            <div class="py-2 col-9 font-14 font-weight-bold text-dark">
                <?php echo e($perusahaan->nama); ?>

            </div>
        </div>
        <div class="form-group row mt-4 mb-0 ml-0 mr-0">
            <div class="col-6 py-2 font-18 font-weight-bold bg-soft-dark text-biru-muda">
                <i class="fas fa-user-tie font-15 mr-3 text-kuning-muda"></i>Detail Pelamar
            </div>
            <div class="col-6 py-2 font-18 font-weight-bold bg-soft-dark text-white">
                
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tgl. Registrasi</div>
            <div class="py-2 col-9 font-14 font-weight-bold text-dark">
                <?php echo e(\Carbon\Carbon::parse($pencaker->tgl_registrasi)->format('d-m-Y')); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Nama</div>
            <div class="py-2 col-9 font-15 font-weight-bold text-primary text-uppercase">
                <?php echo e($pencaker->name); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">J. Kelamin</div>
            <div class="py-2 col-9 font-weight-bold">
                <?php echo e($pencaker->jk === "L"?"Laki-Laki":"Perempuan"); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Agama</div>
            <div class="py-2 col-9 font-weight-bold">
                <?php echo e($agama?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">NIK</div>
            <div class="py-2 col-9 font-weight-bold">
                <?php echo e($pencaker->nik); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">No. BPJS</div>
            <div class="py-2 col-9 font-weight-bold">
                <?php echo e($pencaker->bpjs); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Alamat</div>
            <div class="py-2 col-9 font-weight-bold">
                <?php if(!$pencaker->alamat && !$pencaker->kabupaten_id 
                    && !$pencaker->kecamatan_id &&  !$pencaker->provinsi_id): ?>
                    -
                <?php else: ?>
                    <?php if($pencaker->alamat): ?>
                        <?php echo e($pencaker->alamat); ?>

                    <?php endif; ?>
                    <?php if($pencaker->kabupaten_id): ?>
                        , <?php echo e($kabupaten->nama); ?>

                    <?php endif; ?>
                    <?php if($pencaker->kecamatan_id ): ?>
                        , <?php echo e($kecamatan->nama); ?>

                    <?php endif; ?>
                    <?php if($pencaker->provinsi_id): ?>
                        , <?php echo e($provinsi->nama); ?>

                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Pendidikan</div>
            <div class="py-2 col-9 font-weight-bold">
                <?php echo e($pendidikan); ?> <?php if($pencaker->jurusan): ?> / Jurusan: <?php echo e($pencaker->jurusan); ?> <?php else: ?> - <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Foto</div>
            <div class="py-2 col-9 font-weight-bold">
                <?php if($pencaker->foto): ?>
                <a href="<?php echo e(url($pencaker->foto)); ?>" target="_blank">
                    <img src="<?php echo e(url($pencaker->foto)); ?>" alt="Foto" style="width:180px;height:200px;">
                </a> 
                <?php else: ?>
                    <span class="text-danger">Tidak disertakan</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Curriculum Vitae</div>
            <div class="py-2 col-9 font-weight-bold">
                <?php if($pencaker->cv): ?>
                    <a href="<?php echo e(url($pencaker->cv)); ?>" target="_blank"><u>CV Pelamar</u></a> 
                <?php else: ?>
                    <span class="text-danger">Tidak disertakan</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Kompetensi</div>
            <div class="py-2 col-9 font-weight-bold">
                <?php if($pencaker->syarat_kompetensi === "Y"): ?>
                    <i class="font-18 far fa-check-circle text-success" title="Memenuhi"></i>
                <?php else: ?>
                    <i class="font-18 far fa-times-circle text-danger" title="Tidak Memenuhi"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Sehat</div>
            <div class="py-2 col-9 font-weight-bold">
                <?php if($pencaker->syarat_sehat === "Y"): ?>
                    <i class="font-18 far fa-check-circle text-success" title="Memenuhi"></i>
                <?php else: ?>
                    <i class="font-18 far fa-times-circle text-danger" title="Tidak Memenuhi"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Dokumen</div>
            <div class="py-2 col-9 font-weight-bold">
                <?php if($pencaker->syarat_dokumen === "Y"): ?>
                    <i class="font-18 far fa-check-circle text-success" title="Memenuhi"></i>
                <?php else: ?>
                    <i class="font-18 far fa-times-circle text-danger" title="Tidak Memenuhi"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Keterangan Tambahan</div>
            <div class="py-2 col-9 font-weight-bold">
                <?php echo e($pencaker->keterangan?:"-"); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<form method="POST" action="<?php echo e(route('pencaker_delete')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('sistem.kedatangan.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pencaker/detail.blade.php ENDPATH**/ ?>