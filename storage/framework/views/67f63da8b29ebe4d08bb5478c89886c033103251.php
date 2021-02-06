<form method="POST" action="<?php echo e(route('master_delete')); ?>">
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
            <div class="modal-body font-weight-bold text-dark">
                Anda Yakin Ingin Menghapus Data Ini?
                <br>
                <small class="font-12 text-danger font-weight-500">Data Akan Dihapus Permanen dan tidak bisa dikembalikan.</small>
                <input id="idDelete" name="idDelete" type="hidden">
                <input type="hidden" name="nmJenisKategoriDelete" value="<?php echo e($jenisKategori); ?>">
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                <button type="submit" class="btn btn-danger">Ya Hapus</button>
            </div>
        
            </div>
        </div>

    </div>
</form><?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/sistem/master/modal-del.blade.php ENDPATH**/ ?>