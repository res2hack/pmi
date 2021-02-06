@extends('layouts-front.base')


@section('meta')
    
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $page->meta_title }}" />
    <meta property="og:description" content="{{ $page->meta_description }}" />
    <meta property="og:url" content="{{ route('page_show', $page->slug )}}" />
    {{-- <meta property="article:publisher" content="https://www.facebook.com/yoast" /> --}}
    <meta property="og:site_name" content="P3TKI JATIM" />
    <meta property="article:author" content="UPT P3TKI JATIM" />
    <meta property="article:published_time" content="{{ $page->published_date }}" />
    <meta property="article:modified_time" content="{{ $page->write_date }}" />
    {{-- <meta property="og:image" content="{{ asset('theme/frontend/assets/img/svg/misc/welcome.svg')}}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="628" /> --}}
    
@endsection

@section('title')
{{ $page->title }} - P3TKI JATIM
@endsection


@section('content')

 <!-- Main content -->
 <section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center">
                <!-- Heading -->
                <h1 class="text-white my-4 mx-2" style="line-height:1.2;">
                    {{ $page->title }}
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
                    {!! $page->content !!}
                </div>
                
            </div>
        </div>
    </div>
</section>


@endsection