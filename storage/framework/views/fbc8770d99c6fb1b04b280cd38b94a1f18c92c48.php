<form method="POST" action="<?php echo e(route('pelatihan_pendaftaran_ubah_status')); ?>">
    <?php echo csrf_field(); ?>
        <div class="modal fade" id="modalUbahStatus" tabindex="-1" role="dialog" aria-labelledby="modalUbahStatusTitle" aria-hidden="true">
                
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-3 bg-warning text-white">
                        <div class="modal-title font-16 font-weight-bold" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-triangle font-14 mr-3"></i>Konfirmasi
                        </div>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body font-weight-bold text-dark">
                    <h6>Anda Ingin <?php if($pelatihan->status_pendaftaran === "tutup"): ?> 
                            <span class="text-success">Membuka </span><?php else: ?> 
                            <span class="text-danger">Menutup </span><?php endif; ?> Pendaftaran Pelatihan Ini?</h6>
                    <input id="idUbahStatus" name="idUbahStatus" type="hidden">
                </div>
                <div class="modal-footer bg-light3">
                    <a href="" class="btn btn-secondary text-dark" data-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-dark" style="cursor:pointer;">
                        <i class="fas fa-check mr-2 font-10"></i>Ya Proses
                    </button>
                </div>
            
            </div>
        </div>
    </div>
</form><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/penerimaan/modal-status.blade.php ENDPATH**/ ?>