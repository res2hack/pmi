<form method="POST" action="<?php echo e(route('pengaduan_delete')); ?>">
<?php echo csrf_field(); ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fa-exclamation-triangle font-18 text-warning mr-3"></i> 
                    Konfirmasi
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body font-weight-bold text-dark">
                <h5>Anda Yakin Ingin Menghapus Data Ini?</h5>
                <h6 class="text-primary font-weight-500">Data Akan Dihapus dan dimasukkan ke dalam keranjang sampah.</h6>
                <input id="idDelete" name="idDelete" type="hidden">
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                <button type="submit" class="btn btn-danger">Ya Hapus</button>
            </div>
        
            </div>
        </div>

    </div>
</form><?php /**PATH C:\Wamp.NET\sites\disnaker2021\pmi\resources\views/sistem/pengaduan/modal-del.blade.php ENDPATH**/ ?>