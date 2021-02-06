@extends('layouts-front.base')


@section('meta')
    
    {{-- <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $pengumuman->meta_title }}" />
    <meta property="og:description" content="{{ $pengumuman->meta_description }}" />
    <meta property="og:url" content="{{ route('page_show', $pengumuman->slug )}}" />
    <meta property="og:site_name" content="P3TKI JATIM" />
    <meta property="article:author" content="UPT P3TKI JATIM" />
    <meta property="article:published_time" content="{{ $pengumuman->published_date }}" />
    <meta property="article:modified_time" content="{{ $pengumuman->write_date }}" /> --}}
    
@endsection

@section('title')
Pengumuman - {{ $pengumuman->title }} 
@endsection


@section('content')

<!-- Main content -->
<section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center">
                <!-- Heading -->
                <h1 class="text-white my-4 mx-2" style="line-height:1.2;">
                    {{ $pengumuman->title }}
                </h1>
            </div>
        </div>
    </div>
</section>
<section class="slice slice-lg pt-5">
    <div class="container px-5 ">
        <div class="row">
            <div class="col-md-10 text-justify mx-auto">
                <div class="mt-3 text-dark">
                    {!! $pengumuman->content !!}
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('pengumuman_front')}}" class="btn btn-secondary btn-lg">
                        Kembali ke Pengumuman
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>


@endsection