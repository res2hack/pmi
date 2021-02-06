<form method="POST" action="{{ route('pengaduan_respon_status')}}">
    @csrf
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
                    @if($pengaduan->status_respon === "open")
                    @php $status_respon = 'Menutup' @endphp
                    @else
                    @php $status_respon = 'Membuka' @endphp
                    @endif
                        <h5>Anda Ingin {{ $status_respon }} Kolom Tanggapan Pada Pengaduan Ini?</h5>
                    <input id="idRespon" name="idRespon" type="hidden">
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-danger">Ya Proses</button>
                </div>
            
            </div>
        </div>
    </div>
</form>

<form method="POST" action="{{ route('pengaduan_status')}}">
    @csrf
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
                    @if($pengaduan->status === "open")
                    @php $status = 'Menutup' @endphp
                    @else
                    @php $status = 'Membuka' @endphp
                    @endif
                    <h5>Anda Ingin {{ $status }} Sesi Pengaduan ini?</h5>
                    <input id="idStatusPengaduan" name="idStatusPengaduan" type="hidden">
                    @if($pengaduan->status === "open")
                        <span class="font-weight-500 text-success">Sesi Pengaduan Dinyatakan Selesai</span> 
                    @endif
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-danger">Ya Hapus</button>
                </div>
            
            </div>
        </div>
    </div>
</form>

<form method="POST" action="{{ route('pengaduan_respon_hapus')}}">
    @csrf
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
                    <input id="nmIdResponHapus" name="nmIdResponHapus" type="hidden">
                
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                    <button type="submit" class="btn btn-danger">Ya Hapus</button>
                </div>
            
            </div>
        </div>
    </div>
</form>