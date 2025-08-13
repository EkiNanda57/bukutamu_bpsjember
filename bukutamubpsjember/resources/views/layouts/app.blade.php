<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-t">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BPS Jember') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100 font-sans antialiased">
    <div id="app" class="flex flex-col min-h-screen">

        <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
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

                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('bt.create') }}" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors">
                            Form Buku Tamu
                        </a>
                        <a href="{{ route('kp.create') }}" class="text-gray-600 hover:text-blue-600 font-medium text-sm transition-colors">
                            Kepuasan Pelanggan
                        </a>
                    </div>
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

    @stack('scripts')
</body>
</html>
