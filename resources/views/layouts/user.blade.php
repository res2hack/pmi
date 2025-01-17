<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
      
    
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            
        </div>

        @stack('modals')

        <!-- Scripts -->

        <script src="{{ asset('/js/app.js') }}" defer></script>

        {{-- Pengganti @livewireScripts setting dulu di AppServiceProvider n Run vendor:publish --}}
        <script src="{{ asset('/livewire/livewire/dist/livewire.js') }}"></script>
    
        @include('custom/livewire/script')

        {{-- Trus Import di Custom --}}
        
        {{-- @livewireScripts --}}
    </body>
</html>
