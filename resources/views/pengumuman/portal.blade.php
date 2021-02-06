@extends('layouts-front.base')

@section('meta')
    
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Portal Berita dan Artikel - P3TKI JATIM" />
    <meta property="og:description" content="Portal Berita dan Artikel - P3TKI JATIM" />
    <meta property="og:url" content="{{ route('post_portal')}}" />
    <meta property="og:site_name" content="P3TKI JATIM" />
    <meta property="article:author" content="UPT P3TKI JATIM" />
    
@endsection

@section('title')
Portal Berita dan Artikel - P3TKI JATIM
@endsection

@section('style')
<style>

</style>
@endsection

@section('content')

 <!-- Main content -->
 <section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center text-lg-left">
                <!-- Heading -->
                <h1 class="text-white my-4 mx-2" style="line-height:1.2;">
                    Portal Berita & Artikel
                </h1>
               
            </div>
        </div>
    </div>
   
</section>
{{-- Breadcrumb --}}
<div class="row mt-3">
    <div class="col-12 text-center">
       <a href="{{ route('home')}}">Depan</a> <i class="fas fas fa-angle-right mx-2"></i> Berita & Artikel <i class="fas fas fa-angle-right mx-2"></i> 
    </div>
</div>
<section class="slice slice-lg pt-5">
    <div class="container px-5 ">
        <div class="row">
            <div class="col-md-8 my-2">
                <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('theme/frontend/assets/img/slide1.png') }}" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>judul</h5>
                            <p>tes</p>
                          </div>
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('theme/frontend/assets/img/slide1.png') }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('theme/frontend/assets/img/slide1.png') }}" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-4 my-2">
            
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/-vIeLhhMpb8"></iframe>
                    </div>
                                <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9 mt-2">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/xg0EPpcG_jQ"></iframe>
                    </div>
                
            </div>
        </div>
    </div>
</section>


@endsection

@section('script')

@endsection