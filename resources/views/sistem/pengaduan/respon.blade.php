@if (session('respon'))
<div class="alert alert-success alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>×</span>
        </button>
    <i class="far fa-check-circle mr-2"></i> {{ session('respon') }}
    </div>
</div>
@endif

@if(count($respon) > 0) 
<div class="card border shadow">
<div class="card-body">
    <div class="row">
        <div class="col-md-7">
            <h4>
                Tanggapan
                @if($pengaduan->status_respon === "open")
                    <span class="bg-success px-2 py-1 text-white align-top ml-2 rounded font-13 font-weight-500">Open</span>
                @else
                    <span class="bg-dark px-2 py-1 text-white align-top ml-2 rounded font-13 font-weight-500">Closed</span>
                @endif
            </h4>
        </div>
        <div class="col-md-5 text-right">
            @if($pengaduan->status_respon === "open")
                <a href="#" class="text-primary"
                    data-toggle="modal" data-target="#modalResponStatus" 
                    onclick="$('#idRespon').val({{ $pengaduan->id }});" title="Tutup Kolom Tanya Jawab">
                    <span class="font-14"><i class="fas fas fa-lock mr-1"></i> Tutup Kolom Diskusi
                    </span>
                </a>
            @else
                <a href="#" class="text-primary"
                    data-toggle="modal" data-target="#modalResponStatus" 
                    onclick="$('#idRespon').val({{ $pengaduan->id }});" title="Buka Kolom Tanya Jawab">
                    <span class="font-14"><i class="fas fas fa-lock-open mr-1"></i> Buka Kolom Diskusi
                    </span>
                </a>
            @endif
        </div>
    </div>
    <div class="border-top mb-3"></div>
    <table id="dt-respon" class="w-100">
        <thead>
            <th></th>
        </thead>
        @foreach($respon as $res)
        <tr>
            <td>
                
                <div class="card shadow mb-3 @if($res->user_id !== Auth::user()->id ) ml-5 @endif">
                    <div class="card-body border rounded">
                        <div class="font-13 font-weight-500
                            @if($res->user_id !== Auth::user()->id ) text-primary @else text-success @endif">
                            {{ $res->username }} - {{ $res->create_date}}

                            @if(!$res->delete_date)
                                <div class="float-right">
                                    <a href="#" class="text-danger"
                                        data-toggle="modal" data-target="#modalResponHapus" 
                                        onclick="$('#nmIdResponHapus').val({{ $res->id_respon }});" title="Hapus Komentar">
                                        <i class="fas fas fa-times font-14"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                        @if(!$res->delete_date)
                            <div class="text-dark font-14 mt-2"> {{ $res->respon }}</div>
                        @else
                        <div class="text-dark text-center font-14 mt-2 font-weight-500"> Tanggapan Dihapus</div>
                        @endif
                    </div>
                </div>
                
            </td>
        </tr>
        @endforeach
    </table>
</div>
</div>

@else
<h5 class="mb-4">Belum Ada Respon</h5>
@endif


@if($pengaduan->status_respon === "open" || Auth::user()->tipe === "staf")

{{-- @include('global.notifikasi') --}}

<form method="post" action="{{ route('pengaduan_respon')}}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="nmIdPengaduan" value="{{ $pengaduan->id }}">
{{-- <div class="card shadow mt-2">
    <div class="card-body rounded"> --}}
        <textarea id="nmRespon" name="nmRespon" rows="4" placeholder="Beri Tanggapan Baru.."
        class="form-control bg-form border-form">{{ old('nmRespon') }}</textarea>

        <button type="submit" class="btn btn-lg btn-dark mt-3">
            <span class="font-16"><i class="fas fa-check mr-2"></i>Beri Tanggapan</span>
        </button>
    {{-- </div>
</div> --}}
</form>
@endif