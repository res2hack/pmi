<form id="formBatalDaftar" method="POST" action="<?php echo e(route('pelatihan_pendaftaran_delete')); ?>">
<?php echo csrf_field(); ?>
    <div class="modal fade" id="modalBatalDaftar" tabindex="-1" role="dialog" aria-labelledby="modalBatalDaftarTitle" aria-hidden="true">
            
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
                    <h6> Anda Yakin Ingin Membatalkan Pendaftaran Peserta Ini?</h6>
                    <span class="text-danger font-14 font-weight-500">Pendaftaran Peserta Akan Dibatalkan.</span>
                    <input id="idDelete" name="idDelete" type="hidden">
                </div>
                <div class="modal-footer bg-light3">
                    <a href="" class="btn btn-secondary text-dark" data-dismiss="modal">Tutup</a>
                    <a id="btn-delete-daftar" class="btn btn-dark text-white " style="cursor:pointer;">
                        <i class="fas fa-check mr-2 font-10"></i>Ya Batalkan
                    </a>
                </div>
        
            </div>
        </div>

    </div>
</form><?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/pendaftaran/modal-del.blade.php ENDPATH**/ ?>