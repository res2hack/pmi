@extends('layouts.admin') 

@section('title')
Kelola Pengguna
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="fas fa-user-shield font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Pengguna</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar Pengguna</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">Pengguna</span>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-left mr-3">
                        <a href="{{ route('user_create')}}" class="btn btn-primary font-15 py-2" title="Buat Pengguna Baru">
                            <i class="fas fa-plus mr-2"></i>Baru
                        </a>
                    </div>
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th class="font-16 font-weight-bold text-white" style="width:5%;">#</th>
                                    <th class="font-16 font-weight-bold text-white" style="width:35%;">Pengguna</th>
                                    <th class="font-16 font-weight-bold text-white">Role</th>
                                    <th class="font-16 font-weight-bold text-white" style="width:10%;"></th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($users as $user)
                                <tr>
                                    <td></td>
                                    <td class="bg-light3">
                                        <a class="font-14 font-weight-bold" href="{{ route('user_edit', $user->id )}}">{{ $user->name }}</a>
                                    </td>
                                    <td>
                                        @foreach($roles as $role)
                                            @if($user->id === $role->model_id)
                                                <span class="mr-2 d-inline-block bg-primary 
                                                font-weight-500 font-11 rounded py-1 mt-1 px-2 text-white">
                                                    {{ $role->name }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="pt-3">
                                        <a class="mr-1" href="{{ route('user_edit', $user->id )}}"><i class="fas fa-edit"></i></a>
                                        <a href="" onclick="$('#idDelete').val({{ $user->id }});" title="Hapus Pengguna" data-toggle="modal" 
                                            data-target="#exampleModalCenter"><i class="fas fa-times text-danger font-15"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

<form method="POST" action="{{ route('user_delete')}}">
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
                Anda Yakin Ingin Menghapus Data Ini?
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

@section('script')
    @include('global.datatable')
@endsection