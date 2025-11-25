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
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bps-blue': '#1e40af',
                        'bps-light-blue': '#3b82f6',
                        'bps-dark': '#0f172a',
                        'bps-gray': '#1e293b'
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .sidebar-gradient {
            background: linear-gradient(180deg, #387290 0%, #4e9ec5 100%);
        }

        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link.active {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border-left: 3px solid #3b82f6;
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">
    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 sidebar-gradient transform -translate-x-full transition-all duration-300 ease-in-out lg:translate-x-0 shadow-2xl">
        {{-- <div class="flex items-center justify-center h-16 bg-gradient-to-r from-bps-blue to-blue-600 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20"></div>
            <h1 class="text-white text-xl font-bold relative z-10 tracking-wide">
                <i class="fas fa-chart-line mr-2"></i>BPS Admin
            </h1>
        </div> --}}

        <nav class="mt-8 px-4">
            <div class="space-y-2">
                {{-- Tautan Dashboard (asumsi route-nya bernama 'dashboard') --}}
                <a href="{{ route('dashboard') }}" class="nav-link flex items-center px-4 py-3 text-gray-50 hover:bg-white/10 hover:text-white rounded-xl transition-all duration-300 group">
                    <div class="p-2 bg-blue-500/20 rounded-lg mr-3 group-hover:bg-blue-500/30 transition-colors">
                        <i class="fas fa-tachometer-alt text-blue-400"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>

                {{-- Tautan Kepuasan Pelanggan (hapus onclick) --}}
                <a href="{{ route('admin.kp.index') }}" class="nav-link flex items-center px-4 py-3 text-gray-50 hover:bg-white/10 hover:text-white rounded-xl transition-all duration-300 group">
                    <div class="p-2 bg-green-500/20 rounded-lg mr-3 group-hover:bg-green-500/30 transition-colors">
                        <i class="fas fa-smile text-green-400"></i>
                    </div>
                    <span class="font-medium">Kepuasan Pengunjung</span>
                </a>

                {{-- Tautan Buku Tamu (perbaiki href dan hapus onclick) --}}
                <a href="{{ route('bt.view') }}" class="nav-link flex items-center px-4 py-3 text-gray-50 hover:bg-white/10 hover:text-white rounded-xl transition-all duration-300 group">
                    <div class="p-2 bg-yellow-500/20 rounded-lg mr-3 group-hover:bg-yellow-500/30 transition-colors">
                        <i class="fas fa-book text-yellow-400"></i>
                    </div>
                    <span class="font-medium">Buku Tamu</span>
                </a>
            </div>

            <div class="pt-4 mt-4 border-t border-white/10 lg:hidden">
                <button id="sidebar-close" class="nav-link w-full flex items-center justify-center px-4 py-3 text-gray-50 hover:bg-white/10 hover:text-white rounded-xl transition-all duration-300 group">
                    <div class="p-2 bg-white-500/20 rounded-lg mr-3 group-hover:bg-white-500/30 transition-colors">
                        <i class="fas fa-chevron-left text-grey-400"></i>
                    </div>
                </button>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="lg:ml-64 transition-all duration-300 ease-in-out">
        <!-- Top Navigation -->
        <header class="glass-effect shadow-lg border-b border-white/20 sticky top-0 z-40">
            <div class="flex items-center justify-between px-6 py-4">
                <button id="sidebar-toggle" class="lg:hidden text-gray-500 hover:text-gray-700 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Overview</h2>
                    <p class="text-gray-600">Ringkasan aktivitas dan statistik terkini</p>
                    <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mt-2"></div>
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-3 bg-white/50 rounded-full px-4 py-2 hover:bg-gray-200/80 transition-colors duration-200 focus:outline-none">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">A</span>
                        </div>
                        <span id="profile-text" class="text-sm font-medium text-gray-700">Admin BPS</span>
                        <i id="profile-arrow" class="fas fa-chevron-down text-gray-400 text-sm transition-transform duration-300" :class="{'rotate-180': open}"></i>
                    </button>

                    <div x-show="open"
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5"
                        style="display: none;">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt w-5 h-5 mr-3 text-gray-400"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>


        <!-- Dashboard Content -->
        <main class="p-6">

            @if (session('success'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 1000)"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-4"
                    class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-md mb-6" role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-green-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Sukses</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Dashboard Section -->
            <div id="dashboard-section" class="section">

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="glass-effect p-6 rounded-2xl shadow-lg card-hover floating-animation">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Sangat Puas</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $sangatPuasCount }}</p>
                                <div class="flex text-yellow-400 mt-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl">
                                <i class="fas fa-laugh-beam text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="glass-effect p-6 rounded-2xl shadow-lg card-hover floating-animation" style="animation-delay: 0.2s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Puas</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $puasCount }}</p>
                                <div class="flex text-yellow-400 mt-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl">
                                <i class="fas fa-smile text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="glass-effect p-6 rounded-2xl shadow-lg card-hover floating-animation" style="animation-delay: 0.4s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Kurang Puas</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $kurangPuasCount }}</p>
                                <div class="flex text-yellow-400 mt-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl">
                                <i class="fas fa-meh text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="glass-effect p-6 rounded-2xl shadow-lg card-hover floating-animation" style="animation-delay: 0.6s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Tidak Puas</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $tidakPuasCount }}</p>
                                <div class="flex text-yellow-400 mt-2">
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-red-400 to-red-600 rounded-2xl">
                                <i class="fas fa-frown text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="glass-effect p-6 rounded-2xl shadow-lg card-hover">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Jumlah Pengunjung Tahunan</h3>
                        <div class="relative h-64">
                            <canvas id="visitorChart"></canvas>
                        </div>
                    </div>

                    <div class="glass-effect p-6 rounded-2xl shadow-lg card-hover">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Tingkat Kepuasan</h3>
                        <div class="relative h-64">
                            <canvas id="satisfactionChart"></canvas>
                        </div>
                    </div>
                </div>

                <script>
                    Chart.register(ChartDataLabels);

                    // 1. Grafik Pengunjung Tahunan (Bar Chart)
                    const visitorCtx = document.getElementById('visitorChart');
                    if (visitorCtx) {
                        const dataPengunjung = @json($pengunjungTahunan ?? []);
                        const labelsPengunjung = Object.keys(dataPengunjung);
                        const valuesPengunjung = Object.values(dataPengunjung);

                        new Chart(visitorCtx, {
                            type: 'bar',
                            data: {
                                labels: labelsPengunjung,
                                datasets: [{
                                    label: 'Jumlah Pengunjung',
                                    data: valuesPengunjung,
                                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                                    borderColor: 'rgba(59, 130, 246, 1)',
                                    borderWidth: 1,
                                    borderRadius: 5,
                                    maxBarThickness: 60
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            precision: 0 // Menampilkan angka bulat di sumbu Y
                                        }
                                    }
                                }
                            }
                        });
                    }

                    // 2. Grafik Tingkat Kepuasan (Pie Chart)
                    const satisfactionCtx = document.getElementById('satisfactionChart');
                    if (satisfactionCtx) {
                        new Chart(satisfactionCtx, {
                            type: 'pie',
                            data: {
                                labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Tidak Puas'],
                                datasets: [{
                                    label: 'Jumlah',
                                    data: [
                                        {{ $sangatPuasCount ?? 0 }},
                                        {{ $puasCount ?? 0 }},
                                        {{ $kurangPuasCount ?? 0 }},
                                        {{ $tidakPuasCount ?? 0 }}
                                    ],
                                    backgroundColor: [
                                        '#3B82F6', // Biru
                                        '#16A34A', // Hijau
                                        '#EAB308', // Kuning
                                        '#DC2626'  // Merah
                                    ],
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'top', // Memindahkan legenda ke atas
                                    },
                                    datalabels: {
                                        // Fungsi untuk mengubah angka menjadi format persen
                                        formatter: (value, ctx) => {
                                            const datapoints = ctx.chart.data.datasets[0].data;
                                            // Menjumlahkan semua data untuk mendapatkan total
                                            const total = datapoints.reduce((total, datapoint) => total + datapoint, 0);
                                            // Menghitung persentase
                                            const percentage = (value / total * 100).toFixed(1) + "%";
                                            // Hanya tampilkan persen jika lebih dari 0
                                            return value > 0 ? percentage : '';
                                        },
                                        color: '#fff', // Warna teks persentase
                                        font: {
                                            weight: 'bold'
                                        }
                                    }
                                }
                            }
                        });
                    }
                </script>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function () {
                // 1. Ambil semua elemen yang kita butuhkan
                const sidebarToggle = document.getElementById('sidebar-toggle');
                const sidebarClose = document.getElementById('sidebar-close');
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.getElementById('main-content');
                const profileText = document.getElementById('profile-text');   // Elemen baru
                const profileArrow = document.getElementById('profile-arrow'); // Elemen baru

                // 2. Buat fungsi khusus untuk membuka sidebar
                function openSidebar() {
                    sidebar.classList.remove('-translate-x-full');
                    mainContent.classList.add('ml-64');
                    sidebarToggle.classList.add('hidden');
                    // Sembunyikan elemen profil
                    if (profileText && profileArrow) {
                        profileText.classList.add('hidden');
                        profileArrow.classList.add('hidden');
                    }
                }

                // 3. Buat fungsi khusus untuk menutup sidebar
                function closeSidebar() {
                    sidebar.classList.add('-translate-x-full');
                    mainContent.classList.remove('ml-64');
                    sidebarToggle.classList.remove('hidden');
                    // Tampilkan lagi elemen profil
                    if (profileText && profileArrow) {
                        profileText.classList.remove('hidden');
                        profileArrow.classList.remove('hidden');
                    }
                }

                // 4. Atur event listener untuk tombol burger (toggle)
                if (sidebarToggle) {
                    sidebarToggle.addEventListener('click', function () {
                        if (sidebar.classList.contains('-translate-x-full')) {
                            openSidebar();
                        } else {
                            closeSidebar();
                        }
                    });
                }

                // 5. Atur event listener untuk tombol tutup yang baru
                if (sidebarClose) {
                    sidebarClose.addEventListener('click', function () {
                        closeSidebar();
                    });
                }
            });
            </script>

</body>
</html>
