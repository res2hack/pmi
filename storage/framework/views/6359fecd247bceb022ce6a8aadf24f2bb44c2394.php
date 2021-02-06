

<div  class="table-responsive border border-plum1 rounded mb-2">
    <table class="table"  id="table_lampiran" style="width:100%;">
        
        <thead >
            <tr class="border-bottom border-plum1 group-tombol">
                <th class="text-center text-white" >Lampiran (File)</th>
                <th class="text-center text-white" style="width:10%;">
                    <a type="button" name="addFile" class="font-weight-bold align-top mr-2 addFile " 
                        title="Tambah Lampiran">
                        <i class="fas fa-plus text-white font-18"></i>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody style="font-weight:500;">
            <?php if($status === "baru"): ?>
                <tr>
                    <td class="pl-2 pt-3 pb-2"> 
                        <input id="nmFileKrono1" name="nmFileKrono[]" type="file" 
                        class="h-45  form-control border-form bg-form " onchange="cekSize();">
                    </td>

                    <td class="pt-3 pb-2"></td>
                </tr>

            <?php else: ?>
                

                <?php if(count($file_krono) > 0): ?>

                <?php $i=1 ?>
                
                <?php $__currentLoopData = $file_krono; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $krono): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="pl-3 py-2 h-50"> 
                        
                        <input type="hidden" value="1" name="cekEditBaruFile[]">
                        <input type="hidden" id="nmIdEditFile" name="nmIdEditFile[]" class="nmIdEditFile" value="<?php echo e($krono->id); ?>">
                        
                        <div class="border-bottom">
                            
                            <a target="_blank" class="font-weight-bold" href="<?php echo e(url('/uploads/file/pengaduan/kronologis')); ?>/<?php echo e($krono->nmfile); ?>">
                                <?php echo e($krono->nmfile); ?> <i class="fas fa-file ml-2"></i>
                            </a>
                        </div>
                    </td>

                    <td class="pt-3 py-2 h-50">
                        <a name="removeFileEdit" class="text-danger removeFileEdit ml-1" 
                            style="cursor:pointer;"> <i class="fas fa-times font-20"></i></a>
                    </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php else: ?>
                
                    <tr>
                        <td class="pl-2 pt-3 pb-2"> 
                            <input id="nmFileKrono1" name="nmFileKrono[]" type="file" 
                            class="h-45  form-control border-form bg-form " onchange="cekSize();">
                        </td>

                        <td class="pt-3 pb-2"></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>

        </tbody>
        
    </table>
    
    
</div>
<small class="text-danger">Ukuran File Max: 2MB.</small>

<table id="tabel_hapus_krono" class="d-none">

</table><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pengaduan/file-kronologis.blade.php ENDPATH**/ ?>