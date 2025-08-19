<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - BPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- (Semua script dan style dari head kamu) --}}
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-effect { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
        .sidebar-gradient { background: linear-gradient(180deg, #387290 0%, #4e9ec5 100%); }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">
    <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 sidebar-gradient transform -translate-x-full transition-all duration-300 ease-in-out lg:translate-x-0 shadow-2xl">
        <nav class="mt-8 px-4">
            <div class="space-y-2">
                <a href="{{ route('dashboard') }}" class="nav-link flex items-center px-4 py-3 text-gray-50 hover:bg-white/10 rounded-xl transition group">
                    <i class="fas fa-tachometer-alt text-blue-400"></i><span class="ml-3 font-medium">Dashboard</span>
                </a>
                <a href="{{ route('admin.kp.index') }}" class="nav-link flex items-center px-4 py-3 text-gray-50 hover:bg-white/10 rounded-xl transition group">
                    <i class="fas fa-smile text-green-400"></i><span class="ml-3 font-medium">Kepuasan Pengunjung</span>
                </a>
                <a href="{{ route('bt.view') }}" class="nav-link flex items-center px-4 py-3 text-gray-50 hover:bg-white/10 rounded-xl transition group">
                    <i class="fas fa-book text-yellow-400"></i><span class="ml-3 font-medium">Buku Tamu</span>
                </a>
            </div>
        </nav>
    </div>

    <div class="lg:ml-64">
        <header class="glass-effect shadow-lg border-b border-white/20 sticky top-0 z-40">
            <div class="flex items-center justify-between px-6 py-4">
                <button id="sidebar-toggle" class="lg:hidden text-gray-500 hover:text-gray-700 p-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex-1"></div>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-3">
                        <span class="text-sm font-medium text-gray-700">Admin BPS</span>
                        <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-1 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-3"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="p-6">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
