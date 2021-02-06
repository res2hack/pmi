<form method="POST" action="<?php echo e(route('pengaduan_restore')); ?>">
    <?php echo csrf_field(); ?>
        <div class="modal fade" id="modalRestore" tabindex="-1" role="dialog" aria-labelledby="modalRestoreTitle" aria-hidden="true">
                
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">
                        <i class="fas fa-exclamation-triangle font-18 text-warning mr-2"></i>Konfirmasi
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body font-weight-bold text-dark">
                    <h5>Anda Yakin Ingin Mengembalikan Data Ini?</h5>
                    <h6 class="text-success font-weight-500">Data Akan Dikembalikan.</h6>
                    <input id="idRestore" name="idRestore" type="hidden">
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-success">Ya Kembalikan</button>
                </div>
            
                </div>
            </div>
    
        </div>
    </form>

    <form method="POST" action="<?php echo e(route('pengaduan_destroy')); ?>">
    <?php echo csrf_field(); ?>
        <div class="modal fade" id="modalDestroy" tabindex="-1" role="dialog" aria-labelledby="modalDestroyTitle" aria-hidden="true">
                
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">
                        <i class="fas fa-exclamation-triangle font-18 text-warning mr-2"></i>Konfirmasi
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body font-weight-bold text-dark">
                    <h5>Anda Yakin Ingin Menghapus Data Ini?</h5>
                    <h6 class="text-danger font-weight-500">Data Akan Dihapus Permanen dan tidak bisa dikembalikan.</h6>
                    <input id="idDestroy" name="idDestroy" type="hidden">
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-danger">Ya Hapus</button>
                </div>
            
                </div>
            </div>
    
        </div>
    </form><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pengaduan/modal-sampah.blade.php ENDPATH**/ ?>