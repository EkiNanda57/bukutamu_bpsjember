<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPS Kabupaten Jember</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/logobps_jember.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bps-blue': '#1e3c72',
                        'bps-blue-light': '#2a5298',
                        'bps-orange': '#ff6b35',
                        'bps-yellow': '#f7931e',
                    }
                }
            }
        }
    </script>
    <style>
        .bg-gradient-bps {
            background: linear-gradient(
                135deg, 
                #37e31d87 0%,
                #ff74177d 50%,    
                #119bdb81 100%   
            );
        }
        .bg-gradient-button {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
        }
        .bg-gradient-logo {
            background: linear-gradient(135deg, #ff6b35, #f7931e, #4a90e2);
        }
        .qr-pattern {
            background-image: 
                linear-gradient(45deg, #333 25%, transparent 25%),
                linear-gradient(-45deg, #333 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, #333 75%),
                linear-gradient(-45deg, transparent 75%, #333 75%);
            background-size: 12px 12px;
            background-position: 0 0, 0 6px, 6px -6px, -6px 0px;
        }
        .qr-center::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #ff6b35, #f7931e, #4a90e2);
            border-radius: 6px;
        }
    </style>
</head>
<body class="bg-gradient-bps text-white min-h-screen flex justify-center items-center text-center p-5 relative">
    <!-- Background pattern overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-white/5 via-transparent to-white/5 pointer-events-none"></div>
    
    <div class="z-10 relative">
        <!-- Logo -->
        <div class="mb-5">
             <!-- Logo BPS -->
            <div class="mb-6 flex justify-center items-center">
                <img src="{{ asset('logo/logo-BPS.png') }}" alt="BPS Logo" class="max-h-full">
            </div>
        </div>
        
        <!-- Title -->
        <h1 class="text-4xl md:text-5xl font-bold mb-2 leading-tight drop-shadow-lg">
            Badan Pusat Statistik<br>Kabupaten Jember
        </h1>
        
        <!-- Subtitle -->
        <p class="text-lg md:text-xl mb-10 opacity-100 font-light">
            Selamat Datang di Kantor Badan Pusat Statistik Kabupaten Jember
        </p>

        <!-- QR Code Section -->
        <div class="mt-8 flex flex-col items-center">
            <div class="mb-6">
                <img src="{{ asset('assets/barcode_bpsjember.png') }}" alt="BPS Logo" class="w-48 h-48 object-contain mx-auto">
           <p class="text-lg font-medium text-white-100 mb-8">
    btkp.bpsjember.com
</p>

<!-- Buttons -->
<div class="flex justify-center gap-4 flex-wrap">
    <button class="bg-gradient-button text-white px-8 py-4 rounded-full font-semibold text-base cursor-pointer transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 uppercase tracking-widest w-96"
        onclick="window.location.href='{{ route('bt.create') }}'">
        BUKU TAMU
    </button>

    <button class="bg-gradient-button text-white px-8 py-4 rounded-full font-semibold text-base cursor-pointer transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 uppercase tracking-widest w-96"
        onclick="window.location.href='{{ route('kp.create') }}'">
        KEPUASAN PELAYANAN
    </button>
</div>

    </div>
</body>
</html>