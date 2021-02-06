<form method="POST" action="<?php echo e(route('sip_delete')); ?>">
<?php echo csrf_field(); ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header py-3 bg-danger text-white">
                    <div class="modal-title font-16 font-weight-bold" id="exampleModalLongTitle">
                        <i class="fas fa-exclamation-triangle font-14 mr-3"></i>Konfirmasi
                    </div>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body font-weight-bold text-dark">
                <h5> Anda Yakin Ingin Menghapus Data Ini?</h5>
                <h6 class="text-danger font-14 font-weight-500">Data Akan Dihapus Permanen dan tidak bisa dikembalikan.</h6>
                <input id="idDelete" name="idDelete" type="hidden">
            </div>
            <div class="modal-footer bg-light3">
                <a href="" class="btn btn-secondary text-dark" data-dismiss="modal">Batal</a>
                <button type="submit" class="btn btn-dark">
                        <i class="fas fa-check mr-2 font-10"></i>Ya Hapus</button>
            </div>
        
            </div>
        </div>

    </div>
</form><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/sip/modal-del.blade.php ENDPATH**/ ?>