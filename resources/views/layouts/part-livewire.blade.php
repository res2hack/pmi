<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-dropdown')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
               
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        {{-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <x-jet-welcome />
                </div>
            </div>
        </div> --}}
        
    </div>

    @stack('modals')

    <!-- Scripts -->

    <script src="{{ asset('/js/app.js') }}" defer></script>

    {{-- Pengganti @livewireScripts setting dulu di AppServiceProvider n Run vendor:publish --}}
    <script src="{{ asset('/livewire/livewire/dist/livewire.js') }}"></script>

    {{-- Trus Import di Custom --}}
    @include('custom/livewire/script')
    {{-- @livewireScripts --}}
</body>