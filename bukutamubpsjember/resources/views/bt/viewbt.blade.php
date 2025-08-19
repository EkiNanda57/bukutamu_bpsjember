@extends('layouts.sidebar')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    <!-- Judul -->
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Data Buku Tamu</h2>

    {{-- Filter Data, Search dan Tombol PDF --}}
    <form method="GET" action="{{ route('bt.view') }}" id="filterForm"
        class="mb-6 flex flex-col md:flex-row items-center gap-3">

        {{-- Pilih Bulan --}}
        <select name="bulan" 
            class="w-48 border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300"
            onchange="document.getElementById('filterForm').submit()">
            <option value="">Semua Bulan</option>
            @foreach (range(1, 12) as $b)
                <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $b, 1)) }}
                </option>
            @endforeach
        </select>


        {{-- Pilih Tahun --}}
        <select name="tahun" 
            class="w-48 border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300"
=
        <select name="tahun"
            class="border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300"
            onchange="document.getElementById('filterForm').submit()">
            <option value="">Semua Tahun</option>
            @foreach (range(date('Y'), 2000) as $t)
        </select>

        {{-- Search Nama --}}
        <input type="text" name="search" placeholder="Cari nama..."
            value="{{ request('search') }}"
            class="w-60 border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300 ml-auto"
            oninput="document.getElementById('filterForm').submit()">

        {{-- Tombol Download PDF --}}
        <a href="{{ route('bt.exportPdf', [
        'bulan' => request('bulan'), 
        'tahun' => request('tahun'), 
        'search' => request('search')
    ]) }}" 
   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow transition">
    Download PDF
</a>
    </form>

    {{-- Tabel Data --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-blue-600 text-white">
                <tr>
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
        {{ $bts->appends(request()->query())->links() }}
    </div>
</div>
@endsection
