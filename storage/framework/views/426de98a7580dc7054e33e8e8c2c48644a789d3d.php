 

<?php $__env->startSection('title'); ?>
Kelola Data Kedatangan TKI - Detail
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Kedatangan TKI</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('kedatangan_create')); ?>" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('kedatangan_edit', $kedatangan->id)); ?>" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail kedatangan <i class="far fa-file-alt ml-2"></i></span>
        <span class="mx-2">/</span> 
        <span class="text-dark font-weight-bold"><?php echo e($kedatangan->nama_tki); ?></span> 
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('kedatangan_index')); ?>"><u>Kedatangan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Detail</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-2">
            <div class="col-md-12 text-right">
                <a href="<?php echo e(route('kedatangan_index')); ?>" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>
                <a href="<?php echo e(route('kedatangan_edit', $kedatangan->id)); ?>" class="btn btn-dark ml-2">
                    <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                </a>
                
                <a href="<?php echo e(route('kedatangan_delete')); ?>" class="btn btn-danger ml-2"
                    data-toggle="modal" data-target="#exampleModalCenter" 
                    onclick="$('#idDelete').val(<?php echo e($kedatangan->id); ?>);" title="Hapus Data">
                    <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                </a>
            </div>
        </div>
        
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Tgl. Kedatangan</div>
            <div class="py-2 col-9 font-15 font-weight-bold text-primary">
                <?php echo e(\Carbon\Carbon::parse($kedatangan->tgl_datang)->format('d-m-Y')); ?>

                <?php if($kedatangan->jam_datang): ?>
                    / Jam <?php echo e($kedatangan->jam_datang); ?>

                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Pesawat</div>
            <div class="py-2 col-9 font-15  font-weight-bold text-dark">
                <?php echo e($pesawat->name); ?> - [<?php echo e($pesawat->kode); ?>]

                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Nama TKI</div>
            <div class="py-2 col-9 font-15 font-weight-bold text-primary">
                <?php echo e($kedatangan->nama_tki); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">J. Kelamin</div>
            <div class="py-2 col-9 font-15 font-weight-500 text-dark">
                <?php echo e($kedatangan->jk === "L"?"Laki-Laki":"Perempuan"); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Tgl. Lahir</div>
            <div class="py-2 col-9 font-15 font-weight-500 text-dark">
                <?php if($kedatangan->tgl_lahir): ?>
                <?php echo e(\Carbon\Carbon::parse($kedatangan->tgl_lahir)->format('d-m-Y')); ?>

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
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Pekerjaan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if($kedatangan->pekerjaan): ?>
                    <?php echo e($pekerjaan); ?> - [<?php echo e($sektor); ?>]
                <?php else: ?>
                    -
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Mulai Bekerja</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e(\Carbon\Carbon::parse($kedatangan->tgl_berangkat)->format('d-m-Y')); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Masa Kerja</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if($kedatangan->masa_kerja): ?>
                    <?php echo e($kedatangan->masa_kerja); ?> <span class="ml-2">(tahun/bulan)</span> 
                <?php else: ?>
                -
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Alamat</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if(!$kedatangan->alamat && !$kedatangan->kabkota 
                    && !$kedatangan->kecamatan && !$kedatangan->desa && !$kedatangan->provinsi): ?>
                    -
                <?php else: ?>
                    <?php if($kedatangan->alamat): ?>
                        <?php echo e($kedatangan->alamat); ?>

                    <?php endif; ?>
                    <?php if($kedatangan->kabkota): ?>
                        , <?php echo e($kabkota); ?>

                    <?php endif; ?>
                    <?php if($kedatangan->kecamatan): ?>
                        , <?php echo e($kecamatan); ?>

                    <?php endif; ?>
                    <?php if($kedatangan->desa): ?>
                        , <?php echo e($desa); ?>

                    <?php endif; ?>
                    <?php if($kedatangan->provinsi): ?>
                        , <?php echo e($provinsi); ?>

                    <?php endif; ?>
                <?php endif; ?>

                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Paspor</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($kedatangan->no_paspor); ?>

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
                <?php echo e($kedatangan->agency?:"-"); ?>

                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
    
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Jenis Pulang</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($jenis_pulang?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Lama Waktu</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if($kedatangan->hari): ?>
                    <?php echo e($kedatangan->hari); ?> hari
                <?php else: ?>
                -
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Proses Kepulangan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if($pulang): ?>
                    <?php echo e($pulang); ?>

                    <?php if($kedatangan->kepulangan === 3): ?>
                      <span class="mx-2">/</span>  <?php echo e($kedatangan->transit_kantor?:""); ?>

                    <?php endif; ?>
                <?php else: ?>
                -
                <?php endif; ?>
            </div>
        </div>

        <?php if($kedatangan->dijemput !== 0): ?>
            <div class="form-group row my-0">
                <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Dijemput oleh</div>
                <div class="py-2 col-9 font-weight-500 text-dark">
                    <?php echo e($dijemput); ?>  
                    <?php if($kedatangan->dijemput_oleh): ?>
                       <span class="mx-2">/</span> Nama: <?php echo e($kedatangan->dijemput_oleh); ?>

                    <?php endif; ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if($kedatangan->kepulangan === 2): ?>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Menggunakan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if($pulang_sendiri): ?>
                   <?php echo e($pulang_sendiri); ?> <span class="mx-2">/</span> <?php echo e($kedatangan->menggunakan); ?>

                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>


        <div class="form-group row my-0">
            <div class="pt-4 pb-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Masalah</div>
            <div class="pt-2 pb-2 col-9 font-weight-500 text-dark">
                
                <div class="border-top pt-3 mt-0"></div>
                <div>
                    <?php if(count($masalah) > 0): ?>
                        <?php if(count($masalah) < 2): ?>
                            <?php $__currentLoopData = $masalah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="font-weight-500">
                                    <?php echo e($mas); ?> 
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <ol class="pl-3 mb-0">
                                <?php $__currentLoopData = $masalah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <span class="font-weight-500">
                                        <?php echo e($mas); ?> 
                                    </span>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>
                        <?php endif; ?>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if($kedatangan->masalah_lainnya): ?>
        <div class="form-group row my-0">
            <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Masalah Lain</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
               <?php echo e($kedatangan->masalah_lainnya); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<form method="POST" action="<?php echo e(route('kedatangan_delete')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('sistem.kedatangan.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/kedatangan/detail.blade.php ENDPATH**/ ?>