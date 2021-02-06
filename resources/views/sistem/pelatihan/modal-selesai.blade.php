<form id="formPelatihanSelesai" method="POST" action="{{ route('pelatihan_selesai', $pelatihan->id)}}">
    @csrf
        <div class="modal fade" id="modalSelesai" tabindex="-1" role="dialog" aria-labelledby="modalSelesaiTitle" aria-hidden="true">
                
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-3 bg-success text-white">
                        <div class="modal-title font-16 font-weight-bold" id="exampleModalLongTitle">
                            <i class="fas fa-exclamation-triangle font-14 mr-3"></i>Konfirmasi
                        </div>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body font-weight-bold text-dark">
                    <h6> Anda Ingin Mengubah Status Pelatihan Ini Menjadi <span class="text-success">"Selesai"</span>?</h6>
                    <span class="text-danger font-14 font-weight-500">Status Pelatihan Akan Diperbarui</span>
                </div>
                <div class="modal-footer bg-light3">
                    <a href="" class="btn btn-secondary text-dark" data-dismiss="modal">Tutup</a>
                    <button type="submit" class="btn btn-dark text-white " style="cursor:pointer;">
                        <i class="fas fa-check mr-2 font-10"></i>Ya Proses
                    </button>
                </div>
            
                </div>
            </div>
    
        </div>
    </form>