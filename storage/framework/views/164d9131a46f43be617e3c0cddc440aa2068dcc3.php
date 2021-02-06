 

<?php $__env->startSection('title'); ?>
Kelola Role User - Ubah
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subheader'); ?>
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-user-shield font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Role User</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Ubah</span></div>
            
        <span class="font-weight-500 text-primary">Ubah Data</span>
        <i class="fas fa-edit ml-2 align-top text-primary"></i>
        <span class="mx-2">/</span>
        <span class="text-danger font-weight-bold"><?php echo e($role->name); ?></span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<a href="<?php echo e(route('dashboard')); ?>"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<a href="<?php echo e(route('role_index')); ?>"><u>Role user</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Ubah Data</span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('global.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<form method="POST" action="<?php echo e(route('role_update', $role->id )); ?>">
    <?php echo csrf_field(); ?>

    <div class="row">
        <div class="col-4">
            
            <div class="card shadow border-top5 border-form ">
                <div class="border-bottom py-3 px-4 font-17 font-weight-bold text-primary">
                    Ubah Role
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Nama Role</label>
                        <input type="text" name="nmRole" class="form-control font-weight-bold 
                            h-42 bg-form border-form" value="<?php echo e($role->name); ?> <?php echo e(old('nmRole')); ?>" required>
                        <small class="text-danger"><?php echo e($errors->first('nmRole')); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Deskripsi</label>
                        <textarea type="text" name="nmDeskripsi" class="p-3 
                        form-control font-weight-500 bg-form border-form" 
                        rows="5"><?php echo e($role->deskripsi); ?><?php echo e(old('nmDeskripsi')); ?></textarea>
                    </div>
                </div>
                <div class="card-footer border-top py-3">
                    <button type="submit" class="btn btn-lg btn-dark">
                        <i class="fas fa-check mr-3 font-14"></i><span class="font-15">Perbarui</span>
                    </button>
                </div>
            </div>
            
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <table id="dt-roles" class="table">
                        <thead>
                            <tr>
                                <th class="h-50 py-3">#</th>
                                <th class="h-50 py-3">Nama Role</th>
                                <th class="h-50 py-3">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="py-0"></td>
                                <td class="py-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="nmPermission[]" 
                                        value="<?php echo e($x->id); ?>" id="cbPermisi<?php echo e($x->id); ?>" <?php echo e(in_array($x->id, $role_permissions) ? 'checked' : ''); ?>>
                                        <label class="custom-control-label font-14 font-weight-500 align-top text-primary" 
                                        style="cursor:pointer;" for="cbPermisi<?php echo e($x->id); ?>"><?php echo e($x->name); ?></label>
                                    </div>
                                </td>
                                <td class="py-0">
                                    <div class="font-weight-500">
                                        <?php echo e($x->keterangan); ?>

                                    </div>
                                </td>
                                <td class="py-0">
                                    <?php echo e($x->grup); ?>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('users.role.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/users/role/edit.blade.php ENDPATH**/ ?>