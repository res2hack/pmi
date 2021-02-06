 

<?php $__env->startSection('title'); ?>
Kelola Role User
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-dark text-white ">
                                    <th class="h-50 py-3 text-white">Nama File</th>
                                    <th class="h-50 py-3 text-white">Size</th>
                                    <th class="h-50 py-3 text-white">Tanggal</th>
                                    <th class="h-50 py-3 text-white"></th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td colspan="4" class="pt-2 h-50"></td>
                                </tr>
                                <?php $__currentLoopData = $file_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class=" bg-plum4 h-50 py-2">
                                        <span class="font-weight-bold"><?php echo e(str_replace('Laravel/', '_',  $x['name'])); ?></span> 
                                        <a class="ml-2" title="Download File"
                                            href="<?php echo e(url('/')); ?>/<?php echo e(str_replace('Laravel', 'qZIbTNutNWDujmpKABlwKWkRqdaSaEAm',  $x['name'])); ?>"> 
                                            <i class="fas fa-download"></i>  
                                        </a>
                                      
                                        
                                    </td>
                                    <td class=" bg-plum4 h-50 py-2">
                                        <?php echo e($x['size']); ?> MB
                                    </td>
                                    <td class=" bg-plum4 h-50 py-2">
                                        <?php echo e($x['date']); ?>

                                    </td>
                                    <td class=" bg-plum4 h-50 py-2">
                                        
                                        <a href="" onclick="$('#idDelete').val('<?php echo e($x['name']); ?>');" title="Hapus File" data-toggle="modal" 
                                            data-target="#exampleModalCenter"><i class="fas fa-times text-danger font-15"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <form method="GET" action="<?php echo e(route('backup_process')); ?>">
                        <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <select name="jenisBackup" id="jenisBackup" class="form-control" required>
                                            <option value="">- Pilih -</option>
                                            <option value="db">Database</option>
                                            <option value="files">File</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <button style="cursor:pointer;" class="btn btn-dark font-14">Proses Backup</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

<form method="POST" action="<?php echo e(route('backup_delete')); ?>">
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
                Anda Yakin Ingin Menghapus File Ini?
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/backup/list.blade.php ENDPATH**/ ?>