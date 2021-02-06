@extends('layouts-front.base')


@section('meta')
    
    {{-- <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $type->title }}" />
    <meta property="og:description" content="{{ $type->description }}" />
    <meta property="og:url" content="{{ route('pengumuman_front')}}" />
    <meta property="og:site_name" content="P3TKI JATIM" />
    <meta property="article:author" content="UPT P3TKI JATIM" /> --}}
    {{-- <meta property="article:published_time" content="{{ $page->published_date }}" />
    <meta property="article:modified_time" content="{{ $page->write_date }}" /> --}}
    {{-- <meta property="og:image" content="{{ asset('theme/frontend/assets/img/svg/misc/welcome.svg')}}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="628" /> --}}
    
@endsection

@section('title')
Prodesmigratif - P3TKI JATIM
@endsection

@section('style')
<style>
    .prodes{
        /* cursor:pointer; */
    }
    .prodes:hover{
        /* cursor:pointer; */
        background:#ECFDF5;
    }
</style>
@endsection

@section('content')
 <!-- Main content -->
 <section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center">
                <!-- Heading -->
                <h1 class="text-white my-4 mx-2" style="line-height:1.2;">
                    Prodesmigratif
                </h1>
            </div>
        </div>
    </div>
</section>
<section class="slice slice-lg pt-5">
    <div class="container px-5 ">
        <div class="row">
            <div class="col-md-12">
                {!! $deskripsi->deskripsi !!}
            </div>
            <div class="col-md-12 mt-1 mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <form id="formKategori" action="{{ route('prodesmigratif_kategori_front')}}" class="d-inline ">
                            <select name="kategori" id="kategori" class="form-control" onChange="$('#formKategori').submit();">
                                <option value="">- Semua Kategori -</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->jenis_id }}"
                                         @if($cat == $kat->jenis_id) selected @endif>{{ $kat->name }}
                                        </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <form action="{{ route('prodesmigratif_search_front')}}" class="d-inline ">
                            {{-- <input type="hidden" name="idProdesmigratif" value="index"> --}}
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari Prodesmigratif.."
                                 name="search" aria-label="Cari Artikel" aria-describedby="basic-addon2" value="{{ $search }}">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text" id="basic-addon2">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            @foreach ($prodesmigratif_paginate as $prodes)

            <div class="col-md-6 d-flex">
                <div class="card shadow prodes">
                    <div class="card-body ">
                        <ul class="list-unstyled">
                            <a href="{{ route('prodesmigratif_show', $prodes->slug )}}" title="{{ $prodes->judul }}">
                                <li class="media">
                                    <img class="mr-3 avatar h-100 mt-1" src="@if($prodes->img_thumbnail) {{ url($prodes->img_thumbnail) }} @else{{ url($prodes->img_featured) }}@endif" style="width: 180px;max-height:160px !important;">
                                    <div class="media-body">
                                        <a href="{{ route('prodesmigratif_show', $prodes->slug )}}" title="{{ $prodes->judul }}">
                                            <div class="mt-0 font-17 font-weight-800" style="line-height:22px;">{{ $prodes->judul }}</div>
                                        </a>
                                        <div><a href="{{ route('prodesmigratif_kategori_front')}}?kategori={{ $prodes->kategori_id }}" class="font-12 bg-success text-white px-2 my-1 rounded" style="padding-top:3px;padding-bottom:3px;">{{ $prodes->kategori }}</a></div>
                                        <div class="font-14 font-weight-700 text-danger">{{ $prodes->pemilik }}</div>
                                        <div class="font-13 font-weight-700 mt-1">{{ $prodes->kontak }}</div>
                                        <div class="font-13 font-weight-700">{{ $prodes->alamat }}</div>
                                    </div>
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            
            </div>
        
            @endforeach
        </div>
        <div class="mt-1">
            {{ $prodesmigratif_paginate->links() }}
        </div>
       
    </div>
</section>


@endsection