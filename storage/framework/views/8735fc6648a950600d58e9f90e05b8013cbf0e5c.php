 

<?php $__env->startSection('title'); ?>
Kelola Data Lamaran - Detail
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
        <i class="far fa-id-card font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Lamaran</h4> 
            <span class="ml-2 font-11 bg-primary font-weight-bold rounded text-white align-top py-1 px-2">Detail</span>
        </div>
            
        <span class="text-dark font-weight-bold">#<?php echo e($lamaran_first->sip_id); ?> ( <?php echo e($jabatan_first->nama); ?> -  <?php echo e($negara_first); ?>)</span>
        <span class="mx-2">/</span> 
        <span class="font-weight-bold text-form"><?php echo e($lamaran_first->name); ?></span> 
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('lamaran_index')); ?>"><u>Lamaran</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-bold text-dark">#<?php echo e($lamaran_first->id_lamaran); ?> - <?php echo e($lamaran_first->name); ?></span>
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
                            <span class="font-14 text-uppercase font-weight-bold "> 
                                Lowongan
                            </span> 
                        </span>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="<?php echo e(route('sip_detail', $sip_first->id)); ?>" 
                            class="p-2 text-white" title="Detail Lowongan"><u>
                                Detail</u><i class="fas fa-caret-right ml-2 font-11"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-3 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Jabatan</div>
            <div class="pt-3 pb-2 col-9 font-14 font-weight-bold text-primary text-uppercase">
                <?php echo e($jabatan_first->nama); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Negara Tujuan</div>
            <div class="pt-1 pb-2 col-9 font-14 font-weight-bold text-danger text-uppercase">
                <?php echo e($negara_first?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Agency</div>
            <div class="pt-1 pb-2 col-9 font-14 font-weight-bold text-dark">
                <?php echo e($sip_first->agency); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Perusahaan</div>
            <div class="pt-1 pb-2 col-9 font-14 font-weight-bold text-dark">
                <?php echo e($perusahaan_first->nama); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="py-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">No. SIP</div>
            <div class="py-2 col-9 font-weight-bold text-dark">
                <?php echo e($sip_first->no_sip); ?>

            </div>
        </div>
        <div class="form-group row m-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold text-dark text-right border-right bg-light3">Ijin Berlaku</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php echo e(\Carbon\Carbon::parse($sip_first->tgl_ijin_awal)->format('d-m-Y')); ?> 
                <span class="mx-1">s/d</span>
                <?php echo e(\Carbon\Carbon::parse($sip_first->tgl_ijin_akhir)->format('d-m-Y')); ?> 

                <span class="ml-2">
                    <?php if(strtotime($sip_first->tgl_ijin_akhir) > strtotime("-1 day", strtotime(now()))): ?>
                        <span style="padding:3px 4px;" 
                            class="bg-success font-weight-500 font-11 font-weight-bold align-top rounded text-white">Active</span>
                    <?php else: ?>
                        <span style="padding:3px 4px;" 
                            class="bg-light font-weight-500 font-11 font-weight-bold align-top rounded text-dark">Expired</span>
                    <?php endif; ?>
                </span>
            </div>
        </div>

        <div class="form-group row mt-4 mb-0 mx-0 ">
            <div class="col-12 py-3 bg-detail  ">
                <div class="row">
                    <div class="col-md-9">
                        <span class="bg-soft-dark p-2 rounded text-kuning-muda">
                            <i class="fas fa-user-tie font-14 mr-2 text-white"></i> 
                            <span class="font-14 text-uppercase font-weight-bold"> 
                                Data Pelamar
                            </span> 
                        </span>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="<?php echo e(route('lamaran_create')); ?>" 
                            class="p-2 text-white" title="Buat Lamaran Baru">
                            <u><i class="fas fa-plus mr-2 font-11"></i>Buat Lamaran Baru</u>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-3 pb-2 col-3 font-14 font-weight-bold 
                bg-light3 text-dark text-right border-right">Tgl. Melamar</div>
            <div class="pt-3 pb-2 col-9 font-14 font-weight-bold text-dark">
                <?php echo e(\Carbon\Carbon::parse($lamaran_first->tgl_registrasi)->format('d-m-Y')); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Nama</div>
            <div class="pt-1 pb-2 col-9 ">
                <a href="<?php echo e(route('partner_detail', $lamaran_first->user_partner_id )); ?>" target="_blank"
                    class="font-14 font-weight-bold text-primary text-uppercase" title="Detail Biodata Pelamar">
                    <u><?php echo e($lamaran_first->name); ?></u>
                </a>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">J. Kelamin</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php echo e($lamaran_first->jk === "L"?"Laki-Laki":"Perempuan"); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Agama</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php echo e($agama_first?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">NIK</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php echo e($lamaran_first->nik); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">No. BPJS</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php echo e($lamaran_first->bpjs); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Pendidikan</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php echo e($pendidikan_first); ?> <?php if($lamaran_first->jurusan): ?> / Jurusan: <?php echo e($lamaran_first->jurusan); ?> <?php else: ?> - <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Foto</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php if($lamaran_first->foto_lamaran): ?>
                <a href="<?php echo e(url($lamaran_first->foto_lamaran)); ?>" target="_blank">
                    <img src="<?php echo e(url($lamaran_first->foto_lamaran)); ?>" alt="Foto" style="width:180px;height:200px;">
                </a> 
                <?php else: ?>
                    <span class="text-danger">Tidak disertakan</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Curriculum Vitae</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php if($lamaran_first->cv_lamaran): ?>
                    <a href="<?php echo e(url($lamaran_first->cv_lamaran)); ?>" target="_blank"><u>CV Pelamar</u></a> 
                <?php else: ?>
                    <span class="text-danger">Tidak disertakan</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Kompetensi</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php if($lamaran_first->syarat_kompetensi === "Y"): ?>
                    <i class="font-18 far fa-check-circle text-success" title="Memenuhi"></i>
                <?php else: ?>
                    <i class="font-18 far fa-times-circle text-danger" title="Tidak Memenuhi"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Sehat</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php if($lamaran_first->syarat_sehat === "Y"): ?>
                    <i class="font-18 far fa-check-circle text-success" title="Memenuhi"></i>
                <?php else: ?>
                    <i class="font-18 far fa-times-circle text-danger" title="Tidak Memenuhi"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Dokumen</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php if($lamaran_first->syarat_dokumen === "Y"): ?>
                    <i class="font-18 far fa-check-circle text-success" title="Memenuhi"></i>
                <?php else: ?>
                    <i class="font-18 far fa-times-circle text-danger" title="Tidak Memenuhi"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Keterangan Tambahan</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php echo e($lamaran_first->keterangan_lamaran?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Alamat</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php if(!$lamaran_first->alamat && !$lamaran_first->kabupaten_id 
                    && !$lamaran_first->kecamatan_id &&  !$lamaran_first->provinsi_id): ?>
                    -
                <?php else: ?>
                    <?php if($lamaran_first->alamat): ?>
                        <?php echo e($lamaran_first->alamat); ?>

                    <?php endif; ?>
                    <?php if($lamaran_first->kabupaten_id): ?>
                        , <?php echo e($kabupaten_first->nama); ?>

                    <?php endif; ?>
                    <?php if($lamaran_first->kecamatan_id ): ?>
                        , <?php echo e($kecamatan_first->nama); ?>

                    <?php endif; ?>
                    <?php if($lamaran_first->provinsi_id): ?>
                        , <?php echo e($provinsi_first->nama); ?>

                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-2 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Kontak (Telp.)</div>
            <div class="pt-1 pb-2 col-9 font-weight-bold text-dark">
                <?php echo e($lamaran_first->kontak?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="pt-1 pb-3 col-3 font-14 font-weight-bold bg-light3 text-dark text-right border-right">Email</div>
            <div class="pt-1 pb-3 col-9 font-weight-bold text-dark">
                <?php echo e($lamaran_first->email?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 mx-0">
            <div class="py-3 col-3 font-14 font-weight-bold bg-light3 
                text-dark text-right border-right"></div>
            <div class="py-3 col-9 font-weight-bold text-dark bg-light3">
                <a href="<?php echo e(route('lamaran_edit', $lamaran_first->id_lamaran)); ?>" class="btn btn-primary"><i class="fas fa-edit mr-2"></i>
                    <span class="font-14">Ubah</span></a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<form method="POST" action="<?php echo e(route('lamaran_delete')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('sistem.lamaran.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/sistem/lamaran/detail.blade.php ENDPATH**/ ?>