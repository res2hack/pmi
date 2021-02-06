<form method="POST" action="{{ route('pelatihan_pendaftaran_ubah_status')}}">
    @csrf
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
                    <h6>Anda Ingin Membuka/Menutup Pendaftaran Pelatihan Ini?</h6>
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