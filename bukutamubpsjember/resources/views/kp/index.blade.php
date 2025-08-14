@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    <!-- Judul -->
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Data Kepuasan Pelanggan</h2>

    <!-- Form Filter -->
    <form action="{{ route('admin.kp.index') }}" method="GET" class="bg-white p-6 rounded-lg shadow-md space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            
            <!-- Filter Bulan -->
            <div>
                <label for="bulan" class="block text-sm font-medium text-gray-700 mb-1">Filter Bulan</label>
                <select name="bulan" id="bulan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                    <option value="">-- Semua Bulan --</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ ($bulan ?? '') == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endfor
                </select>
            </div>

            <!-- Filter Tahun -->
            <div>
                <label for="tahun" class="block text-sm font-medium text-gray-700 mb-1">Filter Tahun</label>
                <select name="tahun" id="tahun" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                    <option value="">-- Semua Tahun --</option>
                    @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                        <option value="{{ $y }}" {{ ($tahun ?? '') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>

            <!-- Tombol -->
            <div class="flex items-end gap-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Filter
                </button>
                <a href="{{ route('admin.kp.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
                    Reset
                </a>
                <a href="{{ route('kp.downloadPDF', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" target="_blank"
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                    PDF
                </a>
            </div>
        </div>
    </form>

    <!-- Tabel -->
    <div class="overflow-x-auto mt-6 bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Kepuasan</th>
                    <th class="px-4 py-2">Tahun</th>
                    <th class="px-4 py-2">Bulan</th>
                    <th class="px-4 py-2">Hari</th>
                    <th class="px-4 py-2">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $kp)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $kp->email }}</td>
                        <td class="px-4 py-2">{{ $kp->kepuasan }}</td>
                        <td class="px-4 py-2">{{ $kp->tahun }}</td>
                        <td class="px-4 py-2">{{ $kp->bulan }}</td>
                        <td class="px-4 py-2">{{ $kp->hari }}</td>
                        <td class="px-4 py-2">{{ $kp->waktu }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center text-gray-500">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $data->links() }}
    </div>
</div>
@endsection
