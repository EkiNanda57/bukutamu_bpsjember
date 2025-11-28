@extends('layouts.sidebar')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    <!-- Judul -->
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Data Buku Tamu</h2>

    {{-- Filter Data, Search dan Tombol PDF --}}
    {{-- File: viewbt.blade.php --}}

{{-- GANTI BAGIAN FORM LAMA ANDA DENGAN INI --}}
<form method="GET" action="{{ route('bt.view') }}" id="filterForm" class="bg-white p-4 rounded-lg shadow-md mb-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Kolom 1: Pilih Bulan --}}
        <div>
            <label for="bulan" class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
            <select name="bulan" id="bulan"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                onchange="this.form.submit()">
                <option value="">Semua Bulan</option>
                @foreach (range(1, 12) as $b)
                    <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $b, 1)) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Kolom 2: Pilih Tahun --}}
        <div>
            <label for="tahun" class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
            <select name="tahun" id="tahun"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                onchange="this.form.submit()">
                <option value="">Semua Tahun</option>
                @foreach (range(date('Y'), 2000) as $t)
                    <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                        {{ $t }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Kolom 3: Search Nama --}}
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Nama</label>
            <input type="text" name="search" id="search" placeholder="Ketik nama..."
                value="{{ request('search') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                oninput="this.form.submit()">
        </div>

        {{-- Kolom 4: Tombol Aksi --}}
        <div class="self-end"> {{-- self-end agar tombol sejajar dengan bagian bawah input lain --}}
            <a href="{{ route('bt.exportPdf', request()->query()) }}"
               class="w-full flex items-center justify-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow transition">
                <i class="fas fa-file-pdf mr-2"></i>
                Download PDF
            </a>
        </div>

    </div>
</form>

    {{-- Tabel Data --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2">Nomor Antrian</th>
                    <th class="px-4 py-2">Tanggal dan Waktu</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">No. HP</th>
                    <th class="px-4 py-2">Umur</th>
                    <th class="px-4 py-2">Asal Instansi</th>
                    <th class="px-4 py-2">Jenis Kelamin</th>
                    <th class="px-4 py-2">Pendidikan</th>
                    <th class="px-4 py-2">Pekerjaan</th>
                    <th class="px-4 py-2">Keperluan</th>
                    <th class="px-4 py-2">Keperluan Lainnya</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bts as $bt)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $bt->nomor_antrian }}</td>
                        <td class="px-4 py-2">{{ $bt->hari }}/{{ $bt->bulan }}/{{ $bt->tahun }} {{ $bt->waktu }}</td>
                        <td class="px-4 py-2">{{ $bt->nama }}</td>
                        <td class="px-4 py-2">{{ $bt->email }}</td>
                        <td class="px-4 py-2">{{ $bt->alamat }}</td>
                        <td class="px-4 py-2">{{ $bt->no_hp }}</td>
                        <td class="px-4 py-2">{{ $bt->umur }}</td>
                        <td class="px-4 py-2">{{ $bt->asal }}</td>
                        <td class="px-4 py-2">{{ $bt->jk }}</td>
                        <td class="px-4 py-2">{{ $bt->pendidikan }}</td>
                        <td class="px-4 py-2">{{ $bt->pekerjaan }}</td>
                        <td class="px-4 py-2">{{ $bt->keperluan }}</td>
                        <td class="px-4 py-2">{{ $bt->k_lain }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $bts->appends(request()->query())->onEachSide(1)->links() }}
    </div>
</div>
@endsection
