 

<?php $__env->startSection('title'); ?>
Kelola Pengumuman
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-thumbtack font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Pengumuman</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Sampah</span></div>
            
        <span class="font-weight-500">Daftar Pengumuman Yang Telah Dihapus <i class="fas fa-trash text-danger ml-2"></i></span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('pengumuman_index')); ?>"><u>Pengumuman</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Sampah</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">

                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <a href="<?php echo e(route('pengumuman_index')); ?>" class="btn btn-dark font-15 py-2" title="Kembali ke Halaman Indeks">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                            <form action="<?php echo e(route('pengumuman_search_sampah')); ?>" class="d-inline ">
                                <input type="hidden" name="idpengumuman" value="sampah">
                                <span class="ml-2  pl-2 border  rounded bg-light" style="opacity:0.7;padding-top:10px;padding-bottom:11px;">
                                    <input type="text" name="search" class="font-14 font-weight-bold border-0 bg-transparent" value="<?php echo e($search); ?>">
                                    <button class="btn"  type="submit"><i class="fas fa-search"></i></button>
                                </span>
                            </form>
                            <?php if($pengumuman_simple->count() > 0): ?>
                                <span class="align-middle font-weight-bold ml-2 border rounded px-2" style="padding-top:10px;padding-bottom:10px;">
                                    <?php echo e(($pengumuman_simple->currentpage()-1)* $pengumuman_simple->perpage() + 1); ?>-<?php echo e(($pengumuman_simple->currentpage()-1)* $pengumuman_simple->perpage() + $pengumuman_simple->count()); ?> dari <?php echo e($pengumuman_paginate->total()); ?> artikel
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3">
                            <span class="float-right"><?php echo e($pengumuman_simple->links()); ?></span> 
                        </div>
                        
                    </div>

                    <?php if($pengumuman_simple->count() > 0): ?>
                    <div class="table-responsive mt-2">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="font-15">Judul</th>
                                    <th class="font-15">Tanggal Dihapus</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php $__currentLoopData = $pengumuman_paginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="py-2">
                                        <strong class="font-15 text-dark"><?php echo e($x->title); ?></strong> 
                                        <br>
                                        <small class="font-11">/<?php echo e($x->slug); ?></small>
                                        <div class="mt-1">
                                            <small class="ml-2"><a href="<?php echo e(route('pengumuman_edit', $x->id )); ?>" class="font-12"><i class="fas fa-angle-right mr-2"></i>Detail</a></small>
                                            <small class="ml-2">
                                                <a href="" onclick="$('#idRestore').val(<?php echo e($x->id); ?>);" title="Kembalikan Artikel" 
                                                data-toggle="modal" data-target="#modalRestore" class="font-12 text-success"><i class="fas fa-reply mr-2"></i>Restore</a>
                                            </small>
                                            <small class="ml-2">
                                                <a href="" onclick="$('#idDelete').val(<?php echo e($x->id); ?>);" title="Hapus Permanen" 
                                                data-toggle="modal" data-target="#modalHapus" class="font-12 text-danger"><i class="fas fa-times mr-2"></i>Hapus Permanen</a>
                                            </small>
                                        </div>
                                    </td>
                                    <td class="text-capitalize py-2">
                                        <span class="font-12 font-weight-bold text-dark"><?php echo e(\Carbon\Carbon::parse($x->delete_date)->format('d-m-Y')); ?></span>
                                        <br>
                                        <small>
                                            <?php $__currentLoopData = $arr_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($user->id === $x->delete_uid): ?>
                                                <?php echo e($user->name); ?>

                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </small>
                                        
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                            <div class="card-body text-center">
                                <h5>Tidak Ada Pengumuman</h5>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <?php echo e($pengumuman_paginate->links()); ?>

                        </div>
                        <div class="col-md-4 text-right pt-2">
                            <?php if($pengumuman_paginate->count() > 0): ?>
                            <span class="font-weight-bold">
                            Menampilkan <?php echo e(($pengumuman_paginate->currentpage()-1)* $pengumuman_paginate->perpage() + 1); ?>-<?php echo e(($pengumuman_paginate->currentpage()-1)* $pengumuman_paginate->perpage() + $pengumuman_paginate->count()); ?> dari <?php echo e($pengumuman_paginate->total()); ?> artikel
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pengumuman.modal-sampah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/pengumuman/sampah.blade.php ENDPATH**/ ?>