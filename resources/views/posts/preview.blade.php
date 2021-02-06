@extends('layouts-front.base')


@section('title')
{{ $post->title }} - PREVIEW
@endsection

@section('content')

<!-- Main content -->
<section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center text-lg-left">
                <!-- Heading -->
                <h1 class="text-white my-4 mx-2" style="line-height:1.2;">
                    {{ $post->title }}
                </h1>
                <div class="mx-2 px-1 font-weight-bold">
                    <i class="fas fa-bookmark mr-3 text-success"></i><span class="text-white border-bottom">{{ $post->kategori }}</span>
                    <i class="far fa-calendar-check ml-4 font-17 mr-2 text-success"></i> <span class="text-white">{{ \Carbon\Carbon::parse($post->published_date)->format('d-m-Y') }}</span>  
                </div>
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
       <a href="{{ route('home')}}">Depan</a> <i class="fas fas fa-angle-right mx-2"></i> Berita & Artikel <i class="fas fas fa-angle-right mx-2"></i> {{ $post->kategori }}
    </div>
    <div class="col-12 text-center mt-3 bg-warning py-3">
        <span class="font-20 font-weight-700 text-white">Pratinjau ARTIKEL</span>
        <p class="mb-1 text-dark">Artikel ini masih belum terbit, masih berstatus draft.</p>
        <a href="{{ route('post_edit', $post->id)}}" class=" btn-dark font-11 py-1 px-2 rounded">
            <i class="fas fa-edit mr-2"></i>Edit
        </a>
    </div>
</div>
<section class="slice slice-lg pt-5">
    <div class="container px-5 ">
        <div class="row">
            <div class="col-md-8">
                <div class="share-btn" data-url="{{ url($post->slug) }}" data-title="Google" data-desc="Google">
                    <a class="bg-brand-facebook py-1 px-3 text-white rounded font-13" style="cursor:pointer;" data-id="fb"><i class="mr-2 fab fa-facebook-square"></i> Facebook</a>
                    <a class="bg-brand-twitter py-1 px-3 ml-2 text-white rounded font-13" style="cursor:pointer;" data-id="tw"><i class="mr-2 fab fa-twitter"></i> Twitter</a>
                    <a class="bg-brand-slack py-1 px-3 ml-2 text-white rounded font-13" style="cursor:pointer;" data-id="wa"><i class="mr-2 fab fa-whatsapp"></i> WhatsApp</a>
                    {{-- <a class="border bg-light py-1 px-3 ml-2" style="cursor:pointer;" data-id="mail"><i class="fas fa-at"></i> EMail</a> --}}
                </div>
            
                @if(file_exists($post->img_featured))
                <div class="my-3 text-justify">
                    <img class="img-fluid" src="{{ url($post->img_featured) }}">
                </div>
                @endif
                <div class="my-3 text-justify">
                    {!! $post->content !!}
                </div>
                
                <div class="share-btn mt-4" data-url="{{ url($post->slug) }}" data-title="Google" data-desc="Google">
                    <a class="bg-brand-facebook py-1 px-3 text-white rounded font-13" style="cursor:pointer;" data-id="fb"><i class="mr-2 fab fa-facebook-square"></i> Facebook</a>
                    <a class="bg-brand-twitter py-1 px-3 ml-2 text-white rounded font-13" style="cursor:pointer;" data-id="tw"><i class="mr-2 fab fa-twitter"></i> Twitter</a>
                    <a class="bg-brand-slack py-1 px-3 ml-2 text-white rounded font-13" style="cursor:pointer;" data-id="wa"><i class="mr-2 fab fa-whatsapp"></i> WhatsApp</a>
                    {{-- <a class="border bg-light py-1 px-3 ml-2" style="cursor:pointer;" data-id="mail"><i class="fas fa-at"></i> EMail</a> --}}
                </div>
                <div class="row mt-4">
                    <div class="col-lg-8 col-md-10">
                        <h3 class=" mt-4">Artikel Terkait</h3>
                    </div>
                </div>
                <div class="row ">
                    
                    @foreach($related as $rel)
                    <div class="col-md-6">
                        <a href="{{ route('post_show', [$rel->slug_kategori, $rel->slug ]) }}" class="media mb-3">
                            <img class="mr-3 avatar mt-1" @if(file_exists($rel->img_thumbnail))
                                src="{{ url($rel->img_thumbnail)}}" @else src="{{ asset('theme/frontend/assets/img/no-image.jpg') }}"
                                @endif style="width: 120px; height: 100px;">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1 font-15 text-primary">{{ $rel->title }}</h5>
                                {{-- <span class="font-12 font-weight-700">
                                    <i class="far fa-calendar-check ml-2 font-17 mr-1 text-success"></i> {{ \Carbon\Carbon::parse($related->published_date)->format('d-m-Y') }}
                                </span> --}}
                                
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">

                {{-- Recent Posts --}}
                <div>
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

@section('script')
<script src="{{ asset('theme/frontend/assets/wcoder-share-btn/dist/share-buttons.js') }}"></script>
@endsection