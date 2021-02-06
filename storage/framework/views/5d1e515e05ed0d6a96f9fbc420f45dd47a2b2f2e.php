 

<?php $__env->startSection('title'); ?>
Konsultasi
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
        <div class="mb-1 text-dark"><h4 class="d-inline">Konsultasi</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Detail</span>
            <div class="btn-group  align-top ml-2 mr-2" title="Menu">
                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h text-primary"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="<?php echo e(route('konsultasi_create')); ?>" class="text-success dropdown-item" title="Buat SIP Baru"><i class="fas fa-plus mr-2 font-12"></i>Baru 
                    </a>
                    <a href="<?php echo e(route('konsultasi_edit', $konsultasi->id)); ?>" class="text-primary dropdown-item" title="Ubah Data SIP"><i class="far fa-file-alt  mr-2 font-12"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
            
        <span class="font-weight-500 text-primary">Detail Konsultasi <i class="far fa-file-alt ml-2"></i></span>
        
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('konsultasi_index')); ?>"><u>Konsultasi</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Detail</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<div class="row">
    <?php if(session('konsultasi')): ?>
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                <i class="far fa-check-circle mr-2"></i> <?php echo e(session('konsultasi')); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="col-md-12">
        <div class="card shadow  border-top5 border-form">
            <div class="card-body mb-4">
                <?php if(count($respon) < 1): ?> 
                <div class="row mb-2">
                    <div class="col-md-12 text-right">
                        
                        <a href="<?php echo e(route('konsultasi_edit', $konsultasi->id)); ?>" class="btn btn-dark ml-2">
                            <span class="font-14"><i class="fas fa-edit mr-2"></i>Ubah</span>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                <div class="form-group row my-0">
                    <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Status</div>
                    <div class="py-2 col-4">
                        <?php if($konsultasi->status === "open"): ?>
                            <span class="bg-primary text-white font-13 px-2 py-1 rounded font-weight-500">
                                Open
                            </span>
                        <?php else: ?>
                            <span class="bg-dark text-white font-13 px-2 py-1 rounded font-weight-500">
                                Closed
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="col-5 mt-2 text-right">
                        <?php if($konsultasi->status === "open"): ?>
                            <a href="#" class="text-primary"
                                data-toggle="modal" data-target="#modalStatus" 
                                onclick="$('#idStatusKonsultasi').val(<?php echo e($konsultasi->id); ?>);" title="Tutup Sesi Konsultasi">
                                <span class="font-14"><i class="fas fas fa-lock mr-1"></i> Tutup Sesi Konsultasi
                                </span>
                            </a>
                        <?php else: ?>
                            <a href="#" class="text-primary"
                                data-toggle="modal" data-target="#modalStatus" 
                                onclick="$('#idStatusKonsultasi').val(<?php echo e($konsultasi->id); ?>);" title="Buka Sesi Konsultasi">
                                <span class="font-14"><i class="fas fas fa-lock-open mr-1"></i> Buka Sesi Konsultasi
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row my-0">
                    <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Oleh</div>
                    <div class="py-2 col-9 font-weight-500 text-dark">
                      <?php echo e($user->name); ?> (<?php echo e($user->username); ?>) 
                    </div>
                </div>
                <div class="form-group row my-0">
                    <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Jam</div>
                    <div class="py-2 col-9 font-weight-500 text-dark">
                      <?php echo e(\Carbon\Carbon::parse($konsultasi->create_date)->format('d-m-Y / H:i')); ?>

                    </div>
                </div>
                <div class="form-group row my-0">
                    <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Subjek</div>
                    <div class="py-2 col-9 font-weight-bold text-dark">
                        <?php echo e($konsultasi->judul); ?>

                    </div>
                </div>
                <div class="form-group row my-0">
                    <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Kategori</div>
                    <div class="py-2 col-9 font-weight-bold text-primary">
                        <?php echo e($konsultasi->kategori); ?>

                    </div>
                </div>
                <div class="form-group row my-0">
                    <div class="py-2 col-3 font-15 font-weight-bold text-dark text-right border-right2">Pertanyaan</div>
                    <div class="py-2 col-9 text-dark">
                        <?php echo $konsultasi->konten?:"-"; ?>

                    </div>
                </div>
            </div>
        </div>
    
    
        <?php if(session('respon')): ?>
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                <i class="far fa-check-circle mr-2"></i> <?php echo e(session('respon')); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card border-top5 shadow">
            <div class="card-body">

                <?php if(count($respon) > 0): ?> 

                <div class="row">
                    <div class="col-md-7">
                        <h4>
                            Tanggapan
                            <?php if($konsultasi->status_respon === "open"): ?>
                                <span class="bg-success px-2 py-1 text-white align-top ml-2 rounded font-13 font-weight-500">Open</span>
                            <?php else: ?>
                                <span class="bg-dark px-2 py-1 text-white align-top ml-2 rounded font-13 font-weight-500">Closed</span>
                            <?php endif; ?>
                        </h4>
                    </div>
                    <div class="col-md-5 text-right">
                        <?php if($konsultasi->status_respon === "open"): ?>
                            <a href="#" class="text-primary"
                                data-toggle="modal" data-target="#modalResponStatus" 
                                onclick="$('#idRespon').val(<?php echo e($konsultasi->id); ?>);" title="Tutup Kolom Tanggapan">
                                <span class="font-14"><i class="fas fas fa-lock mr-1"></i> Tutup Kolom Tanggapan
                                </span>
                            </a>
                        <?php else: ?>
                            <a href="#" class="text-primary"
                                data-toggle="modal" data-target="#modalResponStatus" 
                                onclick="$('#idRespon').val(<?php echo e($konsultasi->id); ?>);" title="Buka Kolom Tanggapan">
                                <span class="font-14"><i class="fas fas fa-lock-open mr-1"></i> Buka Kolom Tanggapan
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="border-top mb-3"></div>
                <table id="dt-respon" class="w-100">
                    <thead>
                        <th></th>
                    </thead>
                    <?php $__currentLoopData = $respon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="card shadow mb-3 <?php if($res->user_id !== Auth::user()->id ): ?> ml-5 <?php endif; ?>">
                                <div class="card-body border rounded">
                                    <div class="font-13 font-weight-500
                                        <?php if($res->user_id !== Auth::user()->id ): ?> text-primary <?php else: ?> text-success <?php endif; ?>">
                                            <?php echo e($res->username); ?> - <?php echo e($res->create_date); ?>


                                            <?php if(!$res->delete_date): ?>
                                            <div class="float-right">
                                                <a href="#" class="text-danger"
                                                    data-toggle="modal" data-target="#modalResponHapus" 
                                                    onclick="$('#nmIdResponHapus').val(<?php echo e($res->id_respon); ?>);" title="Hapus Komentar">
                                                    <i class="fas fas fa-times font-14"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!$res->delete_date): ?>
                                        <div class="text-dark font-14 mt-2"> <?php echo e($res->respon); ?></div>
                                    <?php else: ?>
                                        <div class="text-dark text-center font-14 mt-2 font-weight-500"> Tanggapan Dihapus</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>

                <?php else: ?>
                    <h5 class="mb-0">Belum Ada Respon</h5>
                <?php endif; ?>


                <div class="row mt-5 mb-3">
                    <div class="col-md-12">
                        <?php if($konsultasi->status_respon === "open" || Auth::user()->tipe === "staf"): ?>

                        
        
                        <form method="post" action="<?php echo e(route('konsultasi_respon')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                            <input type="hidden" name="nmID" value="<?php echo e($konsultasi->id); ?>">
                                    <textarea id="nmRespon" name="nmRespon" rows="4" placeholder="Beri Tanggapan Baru.."
                                    class="form-control bg-form border-form"><?php echo e(old('nmRespon')); ?></textarea>
        
                                    <button type="submit" class="btn btn-lg btn-dark mt-3">
                                        <span class="font-16"><i class="fas fa-check mr-2"></i>Beri Tanggapan</span>
                                    </button>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
   
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<form method="POST" action="<?php echo e(route('konsultasi_delete')); ?>">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('sistem.konsultasi.modal-del', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>

<?php echo $__env->make('sistem.konsultasi.modal-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/konsultasi/detail.blade.php ENDPATH**/ ?>