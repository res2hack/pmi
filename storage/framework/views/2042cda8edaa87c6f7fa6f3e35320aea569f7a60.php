 

<?php $__env->startSection('title'); ?>
Kelola Role User
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-user-shield font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Role User</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Role User</span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Role User</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-left mr-3">
                        <a href="<?php echo e(route('role_create')); ?>" class="btn btn-primary font-15 py-2" title="Buat Role Baru">
                            <i class="fas fa-plus mr-2"></i>Baru
                        </a>
                    </div>
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th class="font-16 font-weight-bold text-white">#</th>
                                    <th class="font-16 font-weight-bold text-white" style="width:15%;">Nama Role</th>
                                    <th class="font-16 font-weight-bold text-white" style="width:25%;">Deskripsi</th>
                                    <th class="font-16 font-weight-bold text-white">Hak Akses</th>
                                    <th class="font-16 font-weight-bold text-white"></th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td></td>
                                    <td class="bg-light3">
                                        <a class="font-14 font-weight-bold" href="<?php echo e(route('role_edit', $x->id )); ?>"><?php echo e($x->name); ?></a>
                                    </td>
                                    <td class="font-13 font-weight-500 text-dark">
                                        <?php echo e($x->deskripsi); ?>

                                    </td>
                                    <td>
                                        <?php $__currentLoopData = $role_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($x->id === $y->role_id): ?>
                                                <span class="mr-2 d-inline-block bg-primary 
                                                font-weight-500 font-11 rounded py-1 mt-1 px-2 text-white">
                                                    <?php echo e($y->name); ?>

                                                </span>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td class="pt-3">
                                        <a class="mr-1" href="<?php echo e(route('role_edit', $x->id )); ?>"><i class="fas fa-edit"></i></a>
                                        <a href="" onclick="$('#idDelete').val(<?php echo e($x->id); ?>);" title="Hapus Pengguna" data-toggle="modal" 
                                            data-target="#exampleModalCenter"><i class="fas fa-times text-danger font-15"></i></a>
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

<form method="POST" action="<?php echo e(route('role_delete_index')); ?>">
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
    <?php echo $__env->make('global.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/users/role/index.blade.php ENDPATH**/ ?>