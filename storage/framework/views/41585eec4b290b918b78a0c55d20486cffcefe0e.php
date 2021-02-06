 

<?php $__env->startSection('title'); ?>
Kelola Jadwal Keberangkatan TKI - Detail
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Jadwal Keberangkatan TKI</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('jadwal_keberangkatan_create')); ?>" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('jadwal_keberangkatan_edit', $jdkeberangkatan->id)); ?>" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Jadwal Keberangkatan <i class="far fa-file-alt ml-2"></i></span>
        <span class="mx-2">/</span> 
        <span class="text-dark font-weight-bold"><?php echo e($jdkeberangkatan->name); ?></span> 
        <span class="mx-2">/</span> 
        <?php if($jdkeberangkatan->status === 0): ?>
            <span title="Belum Berangkat" class="bg-warning px-2 py-1 text-white font-weight-500 rounded">Belum</span>
            <?php elseif($jdkeberangkatan->status === 1): ?>
            <span title="Sudah Berangkat" class="bg-success px-2 py-1 text-white font-weight-500 rounded">Berangkat</span>
            <?php else: ?>
            <span title="Batal Berangkat" class="bg-danger px-2 py-1 text-white font-weight-500 rounded">Batal</span>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('jadwal_keberangkatan_index')); ?>"><u>Jadwal Keberangkatan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500"><?php echo e($jdkeberangkatan->name); ?></span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-2">
            <div class="col-md-12 text-right">
                <a href="<?php echo e(route('jadwal_keberangkatan_index')); ?>" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>
                <a href="<?php echo e(route('jadwal_keberangkatan_edit', $jdkeberangkatan->id)); ?>" class="btn btn-dark ml-2">
                    <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                </a>
                
                <a href="<?php echo e(route('jadwal_keberangkatan_delete')); ?>" class="btn btn-danger ml-2"
                    data-toggle="modal" data-target="#exampleModalCenter" 
                    onclick="$('#idDelete').val(<?php echo e($jdkeberangkatan->id); ?>);" title="Hapus Data">
                    <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                </a>
            </div>
        </div>
        
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Jadwal Keberangkatan</div>
            <div class="py-2 col-9 font-15 font-weight-bold text-primary">
                <?php echo e(\Carbon\Carbon::parse($jdkeberangkatan->tgl_berangkat)->format('d-m-Y / H:i')); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Pesawat</div>
            <div class="py-2 col-9 font-15  font-weight-bold text-dark">
                <?php echo e($pesawat->name); ?> - [<?php echo e($pesawat->kode); ?>]

                
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">No. Penerbangan</div>
            <div class="py-2 col-9 font-15  font-weight-bold text-dark">
                <?php echo e($jdkeberangkatan->no_penerbangan); ?>


                
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
                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Nama TKI</div>
            <div class="py-2 col-9 font-15 font-weight-bold text-primary">
                <?php echo e($jdkeberangkatan->name); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">J. Kelamin</div>
            <div class="py-2 col-9 font-15 font-weight-500 text-dark">
                <?php echo e($jdkeberangkatan->jk === "L"?"Laki-Laki":"Perempuan"); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Tgl. Lahir</div>
            <div class="py-2 col-9 font-15 font-weight-500 text-dark">
                <?php if($jdkeberangkatan->tgl_lahir): ?>
                <?php echo e(\Carbon\Carbon::parse($jdkeberangkatan->tgl_lahir)->format('d-m-Y')); ?>

            <?php else: ?>
                -
            <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Negara Penempatan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($negara?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Alamat</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if(!$jdkeberangkatan->alamat && !$jdkeberangkatan->kabkota 
                    && !$jdkeberangkatan->kecamatan && !$jdkeberangkatan->desa && !$jdkeberangkatan->provinsi): ?>
                    -
                <?php else: ?>
                    <?php if($jdkeberangkatan->alamat): ?>
                        <?php echo e($jdkeberangkatan->alamat); ?>

                    <?php endif; ?>
                    <?php if($jdkeberangkatan->kabkota): ?>
                        , <?php echo e($kabkota); ?>

                    <?php endif; ?>
                    <?php if($jdkeberangkatan->kecamatan): ?>
                        , <?php echo e($kecamatan); ?>

                    <?php endif; ?>
                    <?php if($jdkeberangkatan->desa): ?>
                        , <?php echo e($desa); ?>

                    <?php endif; ?>
                    <?php if($jdkeberangkatan->provinsi): ?>
                        , <?php echo e($provinsi); ?>

                    <?php endif; ?>
                <?php endif; ?>
               
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Kontak</div>
            <div class="py-2 col-9 font-15 font-weight-500 text-dark">
                <?php echo e($jdkeberangkatan->kontak?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Keterangan</div>
            <div class="py-2 col-9 font-15 font-weight-500 text-dark">
                <?php echo e($jdkeberangkatan->keterangan?:"-"); ?>

                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Paspor</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($jdkeberangkatan->paspor); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Kantor Imigrasi</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($imigrasi); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">PPTKIS</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($pptkis?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Agency</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($jdkeberangkatan->agency?:"-"); ?>

                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Status Keberangkatan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if($jdkeberangkatan->status === 0): ?>
                <span title="Belum Berangkat" class="bg-warning px-2 py-1 text-white font-weight-500 rounded">Belum</span>
                <?php elseif($jdkeberangkatan->status === 1): ?>
                <span title="Sudah Berangkat" class="bg-success px-2 py-1 text-white font-weight-500 rounded">Berangkat</span>
                <?php else: ?>
                <span title="Batal Berangkat" class="bg-danger px-2 py-1 text-white font-weight-500 rounded">Batal</span>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<form method="POST" action="<?php echo e(route('jadwal_keberangkatan_delete')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('sistem.jadwal.keberangkatan.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/jadwal/keberangkatan/detail.blade.php ENDPATH**/ ?>