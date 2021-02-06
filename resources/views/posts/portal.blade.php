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
       <a href="{{ route('home')}}">Depan</a> <i class="fas fas fa-angle-right mx-2"></i>
        Berita & Artikel
    </div>
</div>
<section class="slice slice-lg pt-5">
    <div class="container px-5 ">
        <div class="row">
            <div class="col-md-8 my-2">
                <div class="font-24 mt-0 mb-2 font-weight-700 text-info">Sorotan</div>
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
                    <div class="font-20 mt-2 mb-2 font-weight-bold text-dark">Video</div>
                    <!-- 16:9 aspect ratio -->
                    {{-- <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/-vIeLhhMpb8"></iframe>
                    </div>
                                <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9 mt-2">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/xg0EPpcG_jQ"></iframe>
                    </div> --}}
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 my-2">
                <div class="font-24 mt-0 mb-2 font-weight-700 text-dark">Terbaru</div>
                    <div class="row">
                        <div class="col-md-7">
                            @php $i = 1 @endphp
                            @foreach ($post as $x)
                                @if($i == 1)
                                    <a href="{{ route('post_show', [$x->slug_kategori, $x->slug] )}}">
                                    <img src="{{ $x->img_featured }}" alt="Image" class="rounded-lg img-fluid w-100">
                                        <h4>{{ $x->title }}</h4>  
                                    </a>
                                @endif
                                @php $i++ @endphp
                            @endforeach
                        </div>
                        <div class="col-md-5">
                            @php $i = 1 @endphp
                            @foreach ($post as $x)
                                @if($i > 1 && $i < 5)
                                <a href="{{ route('post_show', [$x->slug_kategori, $x->slug] )}}">
                                    <h5 class="font-18 mb-4">{{ $x->title }} 
                                        <span class="ml-2 bg-light px-1 font-10 border border-dark"
                                                    style="vertical-align:7px;font-weight:700 !important;border-radius:3px;">
                                            {{ \Carbon\Carbon::parse($x->published_date)->format('d-m-Y') }}
                                        </span>
                                    </h5>  
                                </a>
                                @endif
                                @php $i++ @endphp
                            @endforeach
                        </div>
                    </div>
                    <div class="border-top mb-4"></div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-unstyled">
                                @php $i = 1 @endphp
                                @foreach ($post as $x)
                                    @if($i > 5)
                                    <a href="{{ route('post_show', [$x->slug_kategori, $x->slug] )}}">
                                        <li class="media mb-3">
                                            <img class="mr-3 avatar mt-1" src="{{ $x->img_thumbnail }}" style="width: 120px; height: 100px;">
                                            <div class="media-body">
                                                <h5 class="font-16 pb-0 mb-0 text-primary">{{ $x->title }}</h5>  
                                                <span class="font-13 font-weight-600">
                                                    <i class="fas fa-bookmark mr-2 text-success"></i>{{ $x->kategori }}
                                                </span>
                                                <span class="font-12 font-weight-700 ml-3">
                                                    <i class="far fa-calendar-check font-17 mr-1 text-success"></i>
                                                    {{ \Carbon\Carbon::parse($x->published_date)->format('d-m-Y') }}
                                                </span>
                                                <p class="font-14 text-dark" style="line-height:1.4;">
                                                    {{ substr(strip_tags(html_entity_decode($x->content)), 0, 150) }} ...
                                                </p>
                                            </div>
                                        </li>
                                    </a>
                                    @endif
                                    @php $i++ @endphp
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mt-2">
                        <h4 class="mb-3">Pengumuman</h4>
                        @foreach ($pengumuman as $peng)
                        <a href="{{ route('pengumuman_show', $x->slug )}}">
                            <h6>{{ $peng->title }}</h6>
                        </a>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <h4 class="mb-3">Download</h4>
                    </div>
                    <div class="mt-4">
                        <h4 class="mb-3">Galeri</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('script')

@endsection