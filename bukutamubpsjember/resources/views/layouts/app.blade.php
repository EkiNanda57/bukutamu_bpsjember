<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BPS Kabupaten Jember</title>

    <link rel="icon" type="image/png" href="{{ asset('logo/logobps_jember.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100 font-sans antialiased">
    <div id="app" class="flex flex-col min-h-screen">

        {{-- NAVBAR --}}
        <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    {{-- Logo dan Nama --}}
                    <a href="{{ route('lp') }}" class="flex items-center space-x-4">
                        <div class="flex-shrink-0 h-12 flex items-center">
                            <img src="{{ asset('logo/logo-BPS.png') }}" alt="BPS Logo" class="h-full w-auto">
                        </div>
                        <div class="flex flex-col">
                            <div class="text-base font-semibold text-gray-800 leading-tight">
                                Badan Pusat Statistik
                            </div>
                            <div class="text-sm text-gray-500 leading-tight">
                                Kabupaten Jember
                            </div>
                        </div>
                    </a>

                    {{-- Menu Desktop (Tampil di layar medium ke atas) --}}
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('bt.create') }}" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors">
                            Form Buku Tamu
                        </a>
                        <a href="{{ route('kp.create') }}" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors">
                            Kepuasan Pelanggan
                        </a>
                    </div>
                    
                    {{-- Tombol Hamburger (Hanya tampil di mobile) --}}
                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                            <span class="sr-only">Open main menu</span>
                            {{-- Icon hamburger --}}
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                    </div>

                </div>
            </div>

            {{-- Menu Mobile (Tampil saat tombol hamburger diklik) --}}
            <div id="mobile-menu" class="md:hidden hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="{{ route('bt.create') }}" class="text-gray-600 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Form Buku Tamu</a>
                    <a href="{{ route('kp.create') }}" class="text-gray-600 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Kepuasan Pelanggan</a>
                </div>
            </div>
        </nav>

        <main class="flex-grow">
            @yield('content')
        </main>

        <footer class="text-center py-6 bg-white border-t mt-auto">
            <p class="text-sm text-gray-500">
                © {{ date('Y') }} BPS Kabupaten Jember. All rights reserved.
            </p>
        </footer>
    </div>

    {{-- Script untuk Toggle Menu Mobile --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>