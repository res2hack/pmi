@extends('layouts-front.base')


@section('meta')
    
    {{-- <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $prodesmigratif->meta_title }}" />
    <meta property="og:description" content="{{ $prodesmigratif->meta_description }}" />
    <meta property="og:url" content="{{ route('page_show', $prodesmigratif->slug )}}" />
    <meta property="og:site_name" content="P3TKI JATIM" />
    <meta property="article:author" content="UPT P3TKI JATIM" />
    <meta property="article:published_time" content="{{ $prodesmigratif->published_date }}" />
    <meta property="article:modified_time" content="{{ $prodesmigratif->write_date }}" /> --}}
    
@endsection

@section('title')
Prodesmigratif - {{ $prodesmigratif->judul }} 
@endsection


@section('content')

<!-- Main content -->
<section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center">
                <!-- Heading -->
                <h2 class="text-info">Prodesmigratif</h2>
                <h3 class="text-white my-4 mx-2 font-weight-900" style="line-height:1.2;">
                    {{ $prodesmigratif->judul }}
                </h3>
            </div>
        </div>
    </div>
</section>
<section class="slice slice-lg pt-5">
    <div class="container px-5 ">
        <div class="row">
            <div class="col-md-10 text-justify mx-auto">
                <div class="row">
                    <div class="col-md-4 img-fluid">
                        <img class="mr-3 avatar w-100 h-100" src="{{ url($prodesmigratif->img_featured) }}" >
                    </div>
                    <div class="col-md-8">
                        <table>
                            <tr class="align-top">
                                <td style="width:25%;" class="font-weight-800">Nama Usaha</td>
                                <td style="width:5%;" class="font-weight-800">:</td>
                                <td class="font-weight-600 text-primary">{{ $prodesmigratif->judul }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-800">Kategori</td>
                                <td class="font-weight-800">:</td>
                                <td class="font-weight-700 text-success">{{ $prodesmigratif->kategori }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-800">Pemilik</td>
                                <td class="font-weight-800">:</td>
                                <td  class="font-weight-700">{{ $prodesmigratif->pemilik }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-800">Kontak</td>
                                <td class="font-weight-800">:</td>
                                <td>{{ $prodesmigratif->kontak }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-800">Alamat</td>
                                <td class="font-weight-800">:</td>
                                <td>{{ $prodesmigratif->alamat }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="border-bottom">Deskripsi</h5>
                        {!! $prodesmigratif->keterangan !!}
                    </div>
                </div>
                

                <div class="text-center mt-5">
                    <a href="{{ route('prodesmigratif_front')}}" class="btn btn-secondary btn-lg">
                        Kembali ke Prodesmigratif
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>


@endsection