@extends('layouts.admin') 

@section('title')
Kelola Role User
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-dark text-white ">
                                    <th class="h-50 py-3 text-white">Nama File</th>
                                    <th class="h-50 py-3 text-white">Size</th>
                                    <th class="h-50 py-3 text-white">Tanggal</th>
                                    <th class="h-50 py-3 text-white"></th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <td colspan="4" class="pt-2 h-50"></td>
                                </tr>
                                @foreach($file_details as $x)
                                <tr>
                                    <td class=" bg-plum4 h-50 py-2">
                                        <span class="font-weight-bold">{{ str_replace('Laravel/', '_',  $x['name']) }}</span> 
                                        <a class="ml-2" title="Download File"
                                            href="{{ url('/') }}/{{ str_replace('Laravel', 'qZIbTNutNWDujmpKABlwKWkRqdaSaEAm',  $x['name']) }}"> 
                                            <i class="fas fa-download"></i>  
                                        </a>
                                      
                                        {{-- <a class="ml-2" title="Download File"
                                            href="{{ route('backup_download', $x['name'])}}"> 
                                            <i class="fas fa-download"></i>  
                                        </a> --}}
                                    </td>
                                    <td class=" bg-plum4 h-50 py-2">
                                        {{ $x['size'] }} MB
                                    </td>
                                    <td class=" bg-plum4 h-50 py-2">
                                        {{ $x['date'] }}
                                    </td>
                                    <td class=" bg-plum4 h-50 py-2">
                                        {{-- <a class="mr-1" href="{{ route('role_edit', $x->id )}}"><i class="fas fa-edit"></i></a> --}}
                                        <a href="" onclick="$('#idDelete').val('{{  $x['name'] }}');" title="Hapus File" data-toggle="modal" 
                                            data-target="#exampleModalCenter"><i class="fas fa-times text-danger font-15"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <form method="GET" action="{{ route('backup_process')}}">
                        @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <select name="jenisBackup" id="jenisBackup" class="form-control" required>
                                            <option value="">- Pilih -</option>
                                            <option value="db">Database</option>
                                            <option value="files">File</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <button style="cursor:pointer;" class="btn btn-dark font-14">Proses Backup</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('modal')

<form method="POST" action="{{ route('backup_delete')}}">
    @csrf
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle font-15 text-warning mr-2"></i> KONFIRMASI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Anda Yakin Ingin Menghapus File Ini?
                <input id="idDelete" name="idDelete" type="hidden">
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                <button type="submit" class="btn btn-danger">Ya Hapus</button>
            </div>
        
            </div>
        </div>

    </div>
</form>
@endsection