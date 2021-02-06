@extends('layouts-front.base')


@section('title')
{{ $page->title }} - PREVIEW
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
<div class="row mt-3">
    <div class="col-12 text-center mt-3 bg-warning py-3">
        <span class="font-20 font-weight-700 text-white">Pratinjau Halaman</span>
        <p class="mb-1 text-dark">Halaman ini masih belum terbit, masih berstatus draft.</p>
        <a href="{{ route('page_edit', $page->id)}}" class=" btn-dark font-11 py-1 px-2 rounded">
            <i class="fas fa-edit mr-2"></i>Edit
        </a>
    </div>
</div>
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

@section('script')
<script src="{{ asset('theme/frontend/assets/wcoder-share-btn/dist/share-buttons.js') }}"></script>
@endsection