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
Pengumuman - P3TKI JATIM
@endsection


@section('content')

 <!-- Main content -->
 <section class="slice py-3 bg-blue1">
    <div class="container py-3 px-4">
        <div class="row row-grid align-items-center">
            <div class="col-lg-12 text-center">
                <!-- Heading -->
                <h1 class="text-white my-4 mx-2" style="line-height:1.2;">
                    Pengumuman
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
                    @foreach ($pengumuman as $x)
                        @if($x->id == $last->id)
                            <h4 class="my-4 font-weight-700" >
                                <i class="fas fa-bell mr-2 text-primary"></i>
                                {{ $x->title }} 
                                <span class="ml-3 font-12 bg-primary text-white px-2 py-1 align-middle">
                                    <i class="far fa-calendar-check mr-2"></i>  {{ \Carbon\Carbon::parse($x->published_date)->format('d-m-Y') }}
                                </span>
                            </h4>
                            <div class="mb-5">
                                {!! $x->content !!}
                            </div>
                            
                        @else
                        
                            <h5 class="pt-1  pb-3 border-bottom" >
                                <i class="far fa-bell mr-2 text-primary"></i>
                                <a href="{{ route('pengumuman_show', $x->slug)}}" class="text-primary">
                                    <u>{{ $x->title }}</u>
                                </a>  
                                <span class="ml-3 font-12 bg-light px-2 py-1">
                                  <i class="far fa-calendar-check mr-2"></i>  {{ \Carbon\Carbon::parse($x->published_date)->format('d-m-Y') }}
                                </span>
                            </h5>
                        @endif
                    @endforeach
                </div>
                <div class="mt-4 pt-3">
                    {{ $pengumuman->links() }}
                </div>
                
            </div>
        </div>
    </div>
</section>


@endsection