

<div  class="table-responsive mb-2">
    <div class="ml-2 mb-3">
        <h6 class="border-bottom mb-0 pb-2">Unggah Berkas Tahap Akhir
            <small class="font-11 text-danger ml-2">*Ukuran File Max: 2MB.</small>
        </h6>
    </div>
    
    <table class="table"  id="table_akhir" style="width:100%;">
       
        <tbody>
            <?php if(count($file_akhir) > 0): ?>

                <?php $i=1 ?>
                
                <?php $__currentLoopData = $file_akhir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akhir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td class="pl-2 "> 
                        <input type="hidden" value="1" name="cekEditBaruAkhir[]">
                        <input type="hidden" id="nmIdEditAkhir" name="nmIdEditAkhir[]" class="nmIdEditAkhir" value="<?php echo e($akhir->id); ?>">
                        
                        <div class="border-bottom">
                            <a target="_blank" class="font-weight-bold" href="<?php echo e(url('/uploads/file/pengaduan/akhir')); ?>/<?php echo e($akhir->nmfile); ?>">
                                <?php echo e($akhir->nmfile); ?> <i class="fas fa-file ml-2"></i>
                            </a>
                        </div>
                    </td>
                    <td class="py-2 text-center"><a name="removeFileAkhirEdit" 
                        class="text-danger removeFileAkhirEdit ml-0" style="cursor:pointer;">
                        <i class="fas fa-times font-20"></i></a>
                    </td>
                </tr>
                
                <?php $i++ ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>

            <tr>
                <td class="pl-2 "> 
                    <input id="nmFileTahapAkhir1" name="nmFileTahapAkhir[]" type="file" 
                    class="h-45  form-control border-form bg-form " onchange="cekSize();">
                </td>

                <td class="">
                    <a type="button" name="addFileAkhir" class="font-weight-bold align-top mr-2 addFileAkhir " 
                    title="Tambah Lampiran">
                    <i class="fas fa-plus text-success font-18"></i>
                </a>
                </td>
            </tr>

        </tbody>
        
    </table>
    
</div>


<table id="tabel_hapus_akhir" class="d-none">

</table><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pengaduan/file-tahap-akhir.blade.php ENDPATH**/ ?>