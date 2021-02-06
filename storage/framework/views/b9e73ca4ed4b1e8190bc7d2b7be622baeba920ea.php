 

<?php $__env->startSection('title'); ?>
Kelola Hak Akses - Ubah Data
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder-open font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Hak Akses</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span></div>
            
        <span class="font-weight-500 text-primary">Ubah Hak Akses</span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('permission_index')); ?>"><u>Hak Akses</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah Data</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <div class="col-md-4">
        <form method="POST" action="<?php echo e(route('permission_update', $permission->id)); ?>">
            <?php echo csrf_field(); ?>
            <div class="card shadow border-top5 border-form ">
                <div class="border-bottom py-3 px-4 font-17 font-weight-bold text-primary">
                    Hak Akses Baru
                </div>
                <div class="card-body mt-0 pb-1 ">
                    <div class="form-group">
                        <label class="font-weight-bold font-15">Nama Hak Akses</label>
                        <input type="text" name="nama" value="<?php echo e($permission->name); ?><?php echo e(old('nama')); ?>"
                        class="form-control font-weight-500 border-form bg-form h-42" required>
                        <small class="text-danger"><?php echo e($errors->first('nama')); ?></small>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold font-15">Grup <small class="align-top">(Huruf Kecil)</small></label>
                        <input type="text" name="nmGrup" class="form-control font-weight-500 border-form
                            bg-form h-42" value="<?php echo e($permission->grup); ?><?php echo e(old('nmGrup')); ?>">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold font-15">Keterangan</label>
                        <input type="text" name="nmKeterangan" value="<?php echo e($permission->keterangan); ?><?php echo e(old('nmKeterangan')); ?>"
                            class="form-control font-weight-500 border-form bg-form h-42">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold font-15">Deskripsi</label>
                        <textarea type="text" name="nmDeskripsi" class="form-control font-weight-500 
                        border-form bg-form" rows="5"><?php echo e($permission->deskripsi); ?><?php echo e(old('nmDeskripsi')); ?></textarea>
                    </div>
                </div>
                <div class="card-footer border-top py-3">
                    <button type="submit" class="btn btn-lg btn-dark">
                        <i class="fas fa-check mr-3 font-14"></i><span class="font-15">Tambah</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                    <table id="dt-permissions" class="table">
                        <thead>
                            <th class="h-50 py-3 font-15 font-weight-bold">#</th>
                            <th class="h-50 py-3 font-15 font-weight-bold">Nama Hak Akses</th>
                            <th class="h-50 py-3 font-15 font-weight-bold">Deskripsi</th>
                            <th class="h-50 py-3 font-15 font-weight-bold">Grup</th>
                            <th class="h-50 py-3 font-15 font-weight-bold"></th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $dataPermission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                <td class="font-14">
                                    <div class="font-weight-500 text-primary">
                                        <?php echo e($x->name); ?>

                                    </div>
                                    <small class="font-11 text-dark font-weight-500"><?php echo e($x->keterangan); ?></small>
                                </td>
                                <td class="font-12"><?php echo e($x->deskripsi); ?></td>
                                <td class="font-12"><?php echo e($x->grup); ?></td>
                                <td class="">
                                    <a class="mr-1" href="<?php echo e(route('permission_edit', $x->id )); ?>"><i class="fas fa-edit"></i></a>
                                    <a href="" onclick="$('#idDelete').val(<?php echo e($x->id); ?>);" title="Hapus Data" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-times text-danger font-15"></i></a>
                                </td>
                                
                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
            </div>
            
        </div>
    </div>
    
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<form method="POST" action="<?php echo e(route('permission_delete_index')); ?>">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle font-15 text-warning mr-2"></i> KONFIRMASI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Anda Yakin Ingin Menghapus Data Ini?
                <input id="idDelete" name="idDelete" type="hidden">
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                <button type="submit" class="btn btn-danger">Ya Hapus</button>
            </div>
        
            </div>
        </div>

    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php echo $__env->make('users.permission.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/users/permission/edit.blade.php ENDPATH**/ ?>