<form id="formUbahDaftar" method="POST" action="<?php echo e(route('pelatihan_pendaftaran_update')); ?>">
    <?php echo csrf_field(); ?>
        <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateTitle" aria-hidden="true">
                
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-3 bg-primary text-white">
                        <div class="modal-title font-16 font-weight-bold" id="modalUpdateTitle">
                            <i class="fas fa-user font-14 mr-3"></i>Detail Pendaftar
                        </div>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body font-weight-bold">
                        <div class="form-group row my-0">
                            <div class="col-4 py-2 text-dark border-right">
                                Nama
                            </div>
                            <div class="col-8 py-2">
                                <div id="modalNama"></div>
                            </div>
                        </div>
                        <div class="form-group row my-0">
                            <div class="col-4 py-2 text-dark border-right">
                                NIK
                            </div>
                            <div class="col-8 py-2">
                                <div id="modalNIK"></div>
                            </div>
                        </div>
                        <div class="form-group row my-0">
                            <div class="col-4 py-2 text-dark border-right">
                                J. Kelamin
                            </div>
                            <div class="col-8 py-2">
                                <div id="modalJK"></div>
                            </div>
                        </div>
                        <div class="form-group row my-0">
                            <div class="col-4 py-2 text-dark border-right">
                                Tgl. Lahir
                            </div>
                            <div class="col-8 py-2">
                                <div id="modalTglLahir"></div>
                            </div>
                        </div>
                        <div class="form-group row my-0">
                            <div class="col-4 py-2 text-dark border-right">
                                Alamat
                            </div>
                            <div class="col-8 py-2">
                                <div id="modalAlamat"></div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row my-0">
                            <div class="col-4 py-2 text-dark border-right">
                                No. Pendaftaran
                            </div>
                            <div class="col-8 py-2">
                                <div id="modalNoDaftar"></div>
                            </div>
                        </div>
                        <div class="form-group row my-0">
                            <div class="col-4 pt-3 pb-2 text-dark border-right">
                                Tgl. Pendaftaran
                            </div>
                            <div class="col-8 py-2">
                                <input type="date" id="modalTglDaftar" name="nmTglDaftarUbah" 
                                class="form-control bg-form border-form font-weight-bold">
                                
                                <input id="idUbah" name="idUbah" type="hidden">
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer bg-light2">
                        <a href="" class="btn btn-secondary text-dark" data-dismiss="modal">Batal</a>
                        <a href="" id="btn-ubah-daftar" class="btn btn-primary">
                            <i class="fas fa-check mr-2"></i>Perbarui
                        </a>
                    </div>
                
            </div>
        </div>
    </div>
</form>

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
                    <h6>Anda Ingin <?php if($pelatihan->status_pendaftaran === "buka"): ?> 
                        <span class="text-danger">Menutup</span>  <?php else: ?> <span class="text-success">Membuka</span> <?php endif; ?>
                        Pendaftaran Untuk Pelatihan Ini?</h6>
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
</form>
<?php /**PATH E:\xampp\xampp\htdocs\pmi\resources\views/sistem/pelatihan/pendaftaran/modal-edit.blade.php ENDPATH**/ ?>