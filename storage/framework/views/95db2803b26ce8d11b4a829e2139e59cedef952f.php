<form method="POST" action="<?php echo e(route('konsultasi_respon_status')); ?>">
    <?php echo csrf_field(); ?>
        <div class="modal fade" id="modalResponStatus" tabindex="-1" role="dialog" aria-labelledby="modalResponStatusTitle" aria-hidden="true">
                
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle font-15 text-warning mr-2"></i> Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body font-weight-bold text-dark">
                    <?php if($konsultasi->status_respon === "open"): ?>
                    <?php $status_respon = 'Menutup' ?>
                    <?php else: ?>
                    <?php $status_respon = 'Membuka' ?>
                    <?php endif; ?>
                        <h5>Anda Ingin <?php echo e($status_respon); ?> Kolom Tanya Jawab Pada Konsultasi ini?</h5>
                    <input id="idRespon" name="idRespon" type="hidden">
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-danger">Ya Hapus</button>
                </div>
            
            </div>
        </div>
    </div>
</form>

<form method="POST" action="<?php echo e(route('konsultasi_status')); ?>">
    <?php echo csrf_field(); ?>
        <div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="modalStatusTitle" aria-hidden="true">
                
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle font-15 text-warning mr-2"></i> Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body font-weight-bold text-dark">
                    <?php if($konsultasi->status === "open"): ?>
                    <?php $status = 'Menutup' ?>
                    <?php else: ?>
                    <?php $status = 'Membuka' ?>
                    <?php endif; ?>
                    <h5>Anda Ingin <?php echo e($status); ?> Sesi Konsultasi ini?</h5>
                    <input id="idStatusKonsultasi" name="idStatusKonsultasi" type="hidden">
                    <?php if($konsultasi->status === "open"): ?>
                        <span class="font-weight-500 text-success">Sesi Konsultasi Dinyatakan Selesai</span> 
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-danger">Ya Hapus</button>
                </div>
            
            </div>
        </div>
    </div>
</form>

<form method="POST" action="<?php echo e(route('konsultasi_respon_hapus')); ?>">
    <?php echo csrf_field(); ?>
        <div class="modal fade" id="modalResponHapus" tabindex="-1" role="dialog" aria-labelledby="modalResponHapusTitle" aria-hidden="true">
                
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle font-15 text-warning mr-2"></i> Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body font-weight-bold text-dark">
                   
                    <h5>Anda Ingin Menghapus Tanggapan Ini ini?</h5>
                    <input id="nmIdResponHapus" name="nmIdResponHapus" type="text">
                   
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-danger">Ya Hapus</button>
                </div>
            
            </div>
        </div>
    </div>
</form><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/konsultasi/modal-status.blade.php ENDPATH**/ ?>