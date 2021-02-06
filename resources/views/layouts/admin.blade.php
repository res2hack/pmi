<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>

<link rel="stylesheet" href="{{ asset('theme/assets/dropzone/dist/min/dropzone.min.css') }}">
<!-- General CSS Files -->
<link rel="stylesheet" href="{{ asset('theme/node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme/assets/font-awesome/font-awesome-5.15/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme/node_modules/selectric/public/selectric.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('theme/node_modules/select2/dist/css/select2.min.css') }}"> --}}

<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('theme/assets/css/components.css') }}">
<link rel="stylesheet" href="{{ asset('theme/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('theme/assets/css/styleku.css') }}">


@yield('style')

</head>

<body>
    
    <div id="app">
        <div class="main-wrapper">
            @include('layouts.part-admin.1-navbar')
            @include('layouts.part-admin.2-sidebar')
            @include('layouts.part-admin.3-body')
            @include('layouts.part-admin.4-footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    
    <script src="{{ asset('theme/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/node_modules/popper.js/dist/popper-work.min.js') }}"></script>
    <script src="{{ asset('theme/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/node_modules/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('theme/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('theme/node_modules/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/stisla.js') }}"></script>
    {{-- <script src="{{ asset('theme/node_modules/select2/dist/js/select2.min.js') }}"></script> --}}

    <!-- Template JS File -->
    <script src="{{ asset('theme/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('theme/assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    @yield('script')

    </body>
</html>
