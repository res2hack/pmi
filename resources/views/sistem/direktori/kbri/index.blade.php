@extends('layouts.admin') 

@section('title')
Kelola Direktori KBRI
@endsection

@section('style')
<style>
    .dropleft .dropdown-toggle::before {
    display: none !important;
}
</style>
@endsection

@section('subheader')
<div class="row">
    <div class="col-1 my-auto">
        <i class="far fa-folder font-24"></i>
    </div>
    <div class="col-11">
        <div class="mb-1 text-dark"><h4 class="d-inline">Kelola Direktori KBRI</h4> 
            <span class="ml-2 font-11 bg-dark rounded text-white align-top py-1 px-2">Indeks</span></div>
            
        <span class="font-weight-500 text-primary">Daftar KBRI</span>
    </div>
</div>
@endsection

@section('breadcrumb')
<a href="{{ route('dashboard')}}"><u>Dashboard</u></a>
<i class="fas fa-angle-right mx-2"></i>
<span class="font-weight-500">KBRI</span>
<input type="hidden" name="jenisDirektori" value="kbri">
@endsection

@section('tombol-baru')
<div class="float-left mr-3">
    <a href="{{ route('kbri_create')}}" class="btn btn-primary font-15 py-2" title="Buat Data KBRI Baru">
        <i class="fas fa-plus mr-2"></i>Baru
    </a>
</div>
@endsection

@section('content')
   @include('sistem.direktori.content')
@endsection

@section('modal')

    <form method="POST" action="{{ route('kbri_delete')}}">
        @csrf
        @include('sistem.direktori.modal-del')
    </form>

@endsection

@section('script')
    @include('sistem.direktori.script')
@endsection