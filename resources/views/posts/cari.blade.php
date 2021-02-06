@extends('layouts-front.base')

@section('meta')
    
   
@endsection

@section('title')
Pencarian Artikel - {{ $search }}
@endsection

@section('content')

 <!-- Main content -->
 <section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center text-lg-left">
                <!-- Heading -->
                <h1 class="text-white my-4 mx-2" style="line-height:1.2;">
                   Pencarian Artikel - Kata Kunci: {{ $search }}
                </h1>
            </div>
        </div>
    </div>
    <!-- SVG separator -->
    <div class="shape-container shape-line shape-position-bottom">
        <svg width="2560px" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve" class="">
            <polygon points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</section>
{{-- Breadcrumb --}}
<div class="row mt-3">
    <div class="col-12 text-center">
        <a href="{{ route('home')}}" class="font-weight-500">Depan</a> <i class="fas fas fa-angle-right mx-2"></i> 
        <span class="text-info">Pencarian Dengan Kata Kunci: 
            <span class="font-weight-bold text-dark">'{{ $search }}'</span> 
        </span>
    </div>
    <div class="col-12 text-center font-weight-bold">
        @if($post->total() > 0)
            <span class=" text-success">{{ $post->total() }} Artikel Ditemukan.</span>  
        @else
            <span class=" text-danger"> Maaf, tidak tersedia artikel dengan kata kunci yang anda cari</span>
        @endif
    </div>
</div>
<section class="slice slice-lg pt-5">
    <div class="container px-5 ">
        <div class="row">
            <div class="col-md-8">
                @foreach ($post as $x)
                    {{-- <a href="{{ route('post_show', [$x->slug_kategori, $x->slug] )}}"> --}}
                        <a href="{{ route('post_show', [$x->slug_kategori, $x->slug ]) }}" class="media mb-3">
                            <img class="mr-3 avatar mt-1" @if(file_exists($x->img_thumbnail))
                            src="{{ url($x->img_thumbnail)}}" @else src="{{ asset('theme/frontend/assets/img/no-image.jpg') }}"
                            @endif style="width: 120px; height: 100px;">
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
                        </a>
                    {{-- </a> --}}
                @endforeach

                <div class="row mt-5">
                    <div class="col-md-12">
                        {{ $post->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <form action="{{ route('post_cari')}}" class="d-inline ">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Artikel" name="search"
                        aria-label="Cari Artikel" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text" id="basic-addon2">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Recent Posts --}}
                <div class="mt-4">
                    <h4 class="mb-3">Artikel Terbaru</h4>
                    @foreach($recent_posts as $recent)
                    <ul class="list-unstyled">
                        <a href="{{ route('post_show', [$recent->slug_kategori, $recent->slug ]) }}" class="media mb-3">
                            <img class="mr-3 avatar mt-1" @if(file_exists($recent->img_thumbnail))
                            src="{{ url($recent->img_thumbnail)}}" @else src="{{ asset('theme/frontend/assets/img/no-image.jpg') }}"
                            @endif style="width: 120px; height: 100px;">
                            {{-- <img class="mr-3 avatar mt-1" src="{{ url($recent->img_thumbnail)}}" style="width: 120px; height: 100px;"> --}}
                            <div class="media-body">
                                <h5 class="mt-0 mb-1 font-15">{{ $recent->title }}</h5>
                                <span class="font-13 font-weight-600">
                                    <i class="fas fa-bookmark mr-2 text-success"></i>{{ $recent->kategori }}
                                </span>
                                <span class="font-12 font-weight-700">
                                    <i class="far fa-calendar-check ml-2 font-17 mr-1 text-success"></i> {{ \Carbon\Carbon::parse($recent->published_date)->format('d-m-Y') }}
                                </span>
                                
                            </div>
                        </a>
                    </ul>
                    @endforeach
                </div>

                <div class="mt-2">
                    <h4 class="mb-3">Pengumuman</h4>
                </div>
                <div class="mt-2">
                    <h4 class="mb-3">Download</h4>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
