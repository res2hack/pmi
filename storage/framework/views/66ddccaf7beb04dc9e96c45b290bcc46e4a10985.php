 

<?php $__env->startSection('title'); ?>
Kelola Data Pengaduan TKI - Detail
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
        <i class="far fa-comments font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Data Pengaduan TKI</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('pengaduan_create')); ?>" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('pengaduan_edit', $pengaduan->id)); ?>" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Pengaduan 
            <i class="far fa-file-alt ml-2"></i></span>
            <span class="mx-2">/</span>
            <span class="text-dark font-weight-bold">#<?php echo e($pengaduan->no_pengaduan); ?></span>
            <span class="mx-2">/</span>
            <span class="font-12 font-weight-bold">
                <?php if(!$pengaduan->delete_date): ?>
                    <?php if($pengaduan->status_kasus === "B"): ?>
                        <span class="bg-warning py-1 px-3 text-white rounded">Belum Diproses</span> 
                    <?php elseif($pengaduan->status_kasus === "P"): ?>
                        <span class="bg-primary py-1 px-3 text-white rounded">Sedang Diproses</span> 
                    <?php elseif($pengaduan->status_kasus === "S"): ?>
                        <span class="bg-success py-1 px-3 text-white rounded">Selesai</span> 
                    <?php endif; ?>
                <?php else: ?>
                    <span class="bg-danger py-1 px-3 text-white rounded">Pengaduan Dihapus</span>
                <?php endif; ?>
            </span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pengaduan_index')); ?>"><u>Pengaduan TKI</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">#<?php echo e($pengaduan->no_pengaduan); ?></span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row mb-2 pb-3">
            <div class="col-md-12 text-right">
                <a href="<?php echo e(route('pengaduan_index')); ?>" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>
                <?php if(!$pengaduan->delete_date): ?>
                <a title="Proses Tindak Lanjut Pengaduan" href="<?php echo e(route('pengaduan_penanganan', $pengaduan->id)); ?>" 
                    class="btn btn-primary ml-2">
                    <span class="font-14"><i class="fas fa-rocket mr-2"></i>Tindak Lanjuti</span>
                </a>
                <?php endif; ?>

                <?php if(!$pengaduan->delete_date): ?>
                    <a title="Ubah Data Pengaduan" href="<?php echo e(route('pengaduan_edit', $pengaduan->id)); ?>" 
                        class="btn btn-dark ml-2">
                        <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                    </a>
                <?php endif; ?>
                
                <?php if(!$pengaduan->delete_date): ?>
                    <a href="<?php echo e(route('pengaduan_delete')); ?>" class="btn btn-danger ml-2"
                        data-toggle="modal" data-target="#exampleModalCenter" 
                        onclick="$('#idDelete').val(<?php echo e($pengaduan->id); ?>);" title="Hapus Pengaduan">
                        <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('pengaduan_restore')); ?>" class="btn btn-dark ml-2"
                        data-toggle="modal" data-target="#modalRestore" 
                        onclick="$('#idRestore').val(<?php echo e($pengaduan->id); ?>);" title="Kembalikan Pengaduan">
                        <span class="font-14"><i class="fas fa-reply text-success mr-2"></i>Restore</span>
                    </a>
                    <a href="<?php echo e(route('pengaduan_destroy')); ?>" class="btn btn-danger ml-2"
                        data-toggle="modal" data-target="#modalDestroy" 
                        onclick="$('#idDestroy').val(<?php echo e($pengaduan->id); ?>);" title="Hapus Permanen Pengaduan">
                        <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus Permanen</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <h5 class="text-dark mb-3">
            <i class="far fa-file-alt font-16 mr-2 text-primary"></i>Detail Pengaduan
            <span class="ml-1 text-primary">#<?php echo e($pengaduan->no_pengaduan); ?></span> 
        </h5>
        
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-3 col-3 font-15 font-weight-bold bg-soft-dark text-white text-right">Tgl. Pengaduan</div>
            <div class="py-3 col-9 bg-soft-dark text-white">
                <span class="font-weight-bold bg-info px-2 py-1 rounded">
                    <?php if($pengaduan->tgl_pengaduan): ?>
                    <?php echo e(\Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->format('d-m-Y')); ?>

                    <?php else: ?>
                        -
                    <?php endif; ?>
                </span>
               
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Asal Pengaduan</div>
            <div class="py-3 col-9 font-weight-500 text-dark">
                <div>
                    <?php echo e($pengaduan_asal?:"-"); ?>

                </div>
                
                <div class="mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Nama Pengadu</div>
            <div class="py-3 col-9 bg-light3">
                <span class="font-weight-bold text-uppercase text-dark">
                <?php echo e($pengaduan->nama_peng?:"-"); ?>

                </span>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-3 pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Hub. Dengan TKI</div>
            <div class="pt-3 pb-2 col-9 font-weight-500 text-dark3">
                <?php echo e($pengaduan->hubungan_tki?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Alamat</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($pengaduan->alamat_peng?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Telepon</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($pengaduan->telepon?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Email</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($pengaduan->email?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-2 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Saluran Pengaduan</div>
            <div class="pt-2 pb-3 col-9 font-weight-500 text-dark">
                <div>
                    <?php echo e($info_saluran?:"-"); ?>

                </div>
                
                
                <div class=" mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-3 col-3 font-15 font-weight-bold bg-soft-dark text-white text-right">Nama TKI</div>
            <div class="py-3 col-9 bg-soft-dark text-white">
                <span class="font-weight-bold text-uppercase">
                <?php echo e($pengaduan->nama_tki?:"-"); ?>

                </span>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">No. Paspor</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($pengaduan->no_paspor?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jenis Kelamin</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($pengaduan->jk === "L"?"Laki-Laki":"Perempuan"); ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tmp / Tgl. Lahir</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if(!$pengaduan->tgl_lahir && !$pengaduan->tmp_lahir): ?>
                    -
                <?php else: ?>
                    <?php if($pengaduan->tgl_lahir): ?>
                        <?php echo e(\Carbon\Carbon::parse($pengaduan->tgl_lahir)->format('d-m-Y')); ?>

                    <?php endif; ?>
                    <?php if($pengaduan->tmp_lahir): ?>
                        , <?php echo e($pengaduan->tmp_lahir); ?>

                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Status</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if($pengaduan->status === "B"): ?>
                    Belum Kawin
                <?php elseif($pengaduan->status === "K"): ?>
                    Kawin
                <?php elseif($pengaduan->status === "J"): ?>
                    Janda
                <?php elseif($pengaduan->status === "D"): ?>
                    Duda
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Alamat</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if(!$pengaduan->alamat && !$pengaduan->kabkota 
                    && !$pengaduan->kecamatan && !$pengaduan->desa && !$pengaduan->provinsi): ?>
                    -
                <?php else: ?>
                    <?php if($pengaduan->alamat): ?>
                        <?php echo e($pengaduan->alamat); ?>

                    <?php endif; ?>
                    <?php if($pengaduan->kabkota): ?>
                        , <?php echo e($kabkota); ?>

                    <?php endif; ?>
                    <?php if($pengaduan->kecamatan): ?>
                        , <?php echo e($kecamatan); ?>

                    <?php endif; ?>
                    <?php if($pengaduan->desa): ?>
                        , <?php echo e($desa); ?>

                    <?php endif; ?>
                    <?php if($pengaduan->provinsi): ?>
                        , <?php echo e($provinsi); ?>

                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Pendidikan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($pendidikan?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Pekerjaan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if($pengaduan->pekerjaan): ?>
                    <?php echo e($pekerjaan); ?> - [<?php echo e($sektor); ?>]
                <?php else: ?>
                    -
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Jabatan</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($pengaduan->jabatan?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Negara</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php echo e($negara?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tgl. Bekerja</div>
            <div class="py-2 col-9 font-weight-500 text-dark">
                <?php if($pengaduan->tgl_berangkat): ?>
                    <?php echo e(\Carbon\Carbon::parse($pengaduan->tgl_berangkat)->format('d-m-Y')); ?>

                <?php else: ?>
                    -
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-2 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tgl. Kembali</div>
            <div class="pt-2 pb-3 col-9 font-weight-500 text-dark">
                <div>
                    <?php if($pengaduan->tgl_datang): ?>
                        <?php echo e(\Carbon\Carbon::parse($pengaduan->tgl_datang)->format('d-m-Y')); ?>

                    <?php else: ?>
                        -
                    <?php endif; ?>
                </div>
                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Nama Majikan</div>
            <div class="pb-2 col-9 font-weight-500 text-dark text-dark">
                    <?php echo e($pengaduan->nama_majikan?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-2 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Alamat Majikan</div>
            <div class="pt-2 pb-3 col-9 font-weight-500 text-dark text-dark">
                <div>
                    <?php echo e($pengaduan->alamat_majikan?:"-"); ?>

                </div>
                
                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
    
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pb-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Pengirim / PPTKIS</div>
            <div class="pb-2 col-9 font-weight-500 text-dark text-dark">
                <?php echo e($pptkis?:"-"); ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-2 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Alamat PPTKIS</div>
            <div class="pt-2 pb-3 col-9 font-weight-500 text-dark text-dark">
                <div>
                    <?php echo e($pengaduan->alamat_pptkis?:"-"); ?>

                </div>
                
                <div class="mt-3 mb-0 border-top"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Masalah</div>
            <div class="py-3 col-9 font-weight-500 text-dark">
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
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-3 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Masalah Lainnya</div>
            <div class="pt-3 pb-3 col-9 font-weight-500 text-dark text-dark">
                <?php echo e($pengaduan->masalah_lainnya?:"-"); ?>

                
                
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Detail Masalah</div>
            <div class="py-2 col-9 font-weight-500 text-dark text-dark">
                <?php echo $pengaduan->detail_masalah?:"-"; ?>

                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Kronologis Masalah</div>
            <div class="py-2 col-9 font-weight-500 text-dark text-dark">
                <?php echo $pengaduan->uraian_kronologis?:"-"; ?>

                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Lampiran</div>
            <div class="py-2 col-9 font-weight-500 text-dark text-dark">
                <div>
                    <?php if(count($file_krono) > 0): ?>
                        <ol class="pl-3">
                            <?php $__currentLoopData = $file_krono; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $krono): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a target="_blank" class="font-weight-bold" href="<?php echo e(url('/uploads/file/pengaduan/kronologis')); ?>/<?php echo e($krono->nmfile); ?>">
                                    <?php echo e($krono->nmfile); ?> <i class="fas fa-file ml-2"></i>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </div>

                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tuntutan Pengadu</div>
            <div class="py-2 pb-3 col-9 font-weight-500 text-dark text-dark">
                <?php echo $pengaduan->tuntutan_pengadu?:"-"; ?>

            </div>
        </div>

        <h5 class="text-dark mb-3 mt-5">
            <i class="fas fa-redo font-16 mr-2 text-success"></i>Proses Tindak Lanjut
        </h5>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-3 pb-3 col-3 font-15 font-weight-bold bg-soft-dark text-white text-right">Status Penanganan</div>
            <div class="pt-3 pb-3 col-9 bg-soft-dark text-white font-weight-bold">
                <?php if($pengaduan->status_kasus === "B"): ?>
                    <span class="bg-warning py-1 px-3 text-white rounded">Belum Diproses</span> 
                <?php elseif($pengaduan->status_kasus === "P"): ?>
                    <span class="bg-primary py-1 px-3 text-white rounded">Sedang Diproses</span> 
                <?php elseif($pengaduan->status_kasus === "S"): ?>
                    <span class="bg-success py-1 px-3 text-white rounded">Selesai</span> 
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 pt-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tahap Awal</div>
            <div class="py-2 pt-3 col-9 font-weight-500">
                <?php echo $pengaduan->tahap_awal?:"-"; ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-1 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Lampiran</div>
            <div class="pt-1 pb-3 col-9 font-weight-500 text-dark">
                <div>
                    <?php if(count($file_awal) > 0): ?>
                        <ol class="pl-3">
                            <?php $__currentLoopData = $file_awal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $awal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a target="_blank" class="font-weight-bold" href="<?php echo e(url('/uploads/file/pengaduan/awal')); ?>/<?php echo e($awal->nmfile); ?>">
                                    <?php echo e($awal->nmfile); ?> <i class="fas fa-file ml-2"></i>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </div>
                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 pt-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tahap Proses</div>
            <div class="py-2 pt-3 col-9 font-weight-500">
                <?php echo $pengaduan->tahap_proses?:"-"; ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-1 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Lampiran</div>
            <div class="pt-1 pb-3 col-9 font-weight-500 text-dark">
                <div>
                    <?php if(count($file_proses) > 0): ?>
                        <ol class="pl-3">
                            <?php $__currentLoopData = $file_proses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a target="_blank" class="font-weight-bold" href="<?php echo e(url('/uploads/file/pengaduan/proses')); ?>/<?php echo e($proses->nmfile); ?>">
                                    <?php echo e($proses->nmfile); ?> <i class="fas fa-file ml-2"></i>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </div>
                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Tahap Akhir</div>
            <div class="py-2 col-9 font-weight-500">
                <?php echo $pengaduan->tahap_akhir?:"-"; ?>

            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="pt-1 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Lampiran</div>
            <div class="pt-1 pb-3 col-9 font-weight-500 text-dark">
                <div>
                    <?php if(count($file_akhir) > 0): ?>
                        <ol class="pl-3">
                            <?php $__currentLoopData = $file_akhir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akhir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a target="_blank" class="font-weight-bold" href="<?php echo e(url('/uploads/file/pengaduan/akhir')); ?>/<?php echo e($akhir->nmfile); ?>">
                                    <?php echo e($akhir->nmfile); ?> <i class="fas fa-file ml-2"></i>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </div>
                
                <div class="border-top mt-3 mb-0"></div>
            </div>
        </div>
        <div class="form-group row my-0 ml-0 mr-0">
            <div class="py-2 pb-3 col-3 font-15 font-weight-bold bg-light3 text-dark text-right border-right">Lampiran Foto</div>
            <div class="py-2 pb-3 col-9 font-weight-500 text-dark text-dark">
                <?php if(count($file_foto) > 0): ?>
                    <ol class="pl-3">
                        <?php $__currentLoopData = $file_foto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a target="_blank" class="font-weight-bold" href="<?php echo e(url('/uploads/file/pengaduan/foto')); ?>/<?php echo e($foto->nmfile); ?>">
                                <?php echo e($foto->nmfile); ?> <i class="fas fa-file ml-2"></i>
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                <?php else: ?>
                    -
                <?php endif; ?>
            </div>
        </div>
       

        <div class="row mt-2 pt-3 mb-0">
            <div class="col-md-12 text-right">
                <a href="<?php echo e(route('pengaduan_index')); ?>" class="btn btn-secondary pv">
                    <i class="fas fa-chevron-left font-14"></i>
                </a>

                <?php if(!$pengaduan->delete_date): ?>
                <a title="Proses Tindak Lanjut Pengaduan" href="<?php echo e(route('pengaduan_penanganan', $pengaduan->id)); ?>" 
                    class="btn btn-primary ml-2">
                    <span class="font-14"><i class="fas fa-rocket mr-2"></i>Tindak Lanjuti</span>
                </a>
                <?php endif; ?>

                <?php if(!$pengaduan->delete_date): ?>
                    <a title="Ubah Data Pengaduan" href="<?php echo e(route('pengaduan_edit', $pengaduan->id)); ?>" 
                        class="btn btn-dark ml-2">
                        <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                    </a>
                <?php endif; ?>
                
                <?php if(!$pengaduan->delete_date): ?>
                    <a href="<?php echo e(route('pengaduan_delete')); ?>" class="btn btn-danger ml-2"
                        data-toggle="modal" data-target="#exampleModalCenter" 
                        onclick="$('#idDelete').val(<?php echo e($pengaduan->id); ?>);" title="Hapus Pengaduan">
                        <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus</span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('pengaduan_restore')); ?>" class="btn btn-dark ml-2"
                        id="btnRestore" data-toggle="modal" data-target="#modalRestore" 
                        onclick="$('#idRestore').val(<?php echo e($pengaduan->id); ?>);" title="Kembalikan Pengaduan">
                        <span class="font-14"><i class="fas fa-reply text-success mr-2"></i>Restore</span>
                    </a>
                    <a href="<?php echo e(route('pengaduan_destroy')); ?>" class="btn btn-danger ml-2"
                        id="btnDestroy" data-toggle="modal" data-target="#modalDestroy" 
                        onclick="$('#idDestroy').val(<?php echo e($pengaduan->id); ?>);" title="Hapus Permanen Pengaduan">
                        <span class="font-14"><i class="fas fa-times mr-2"></i>Hapus Permanen</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<h4>Kolom Diskusi</h4>
<div class="card shadow  border-top5 border-form">
    <div class="card-body mb-4">
        <div class="row">
            <div class="col-md-4">
                <p class="text-dark">
                    Selama proses penangangan pengaduan berlangsung, Anda sebagai pelapor
                    bisa menggunakan fitur kolom diskusi untuk berkomunikasi dengan Admin.
                    Anda bisa menanyakan <i class="font-weight-500">progress</i> tindak-lanjut
                    pengaduan, memberikan detail informasi tambahan, dan lain sebagainya asalkan
                    masih relevan dengan topik masalah yang anda adukan.
                </p>
                <p class="font-weight-bold text-dark">
                    * Admin berhak menutup kolom diskusi sewaktu-waktu dan menghapus tanggapan yang tidak relevan.
                </p>
            </div>
            <div class="col-md-8">
                <?php echo $__env->make('sistem.pengaduan.respon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<?php echo $__env->make('sistem.pengaduan.modal-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<form method="POST" action="<?php echo e(route('pengaduan_delete')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('sistem.pengaduan.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>

<form method="POST" action="<?php echo e(route('pengaduan_restore')); ?>">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="nmStatus" value="detail">
    <?php echo $__env->make('sistem.pengaduan.modal-restore', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>



<form method="POST" action="<?php echo e(route('pengaduan_destroy')); ?>">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="nmStatus" value="detail">
    <?php echo $__env->make('sistem.pengaduan.modal-destroy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php echo $__env->make('global.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    var table_respon =  $('#dt-respon').DataTable( {
                paging: 10,
                displayLength: 10,
                ordering: false,
                lengthChange: false,
                });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pengaduan/detail.blade.php ENDPATH**/ ?>