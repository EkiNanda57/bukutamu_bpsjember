@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Data Buku Tamu</h2>

    {{-- Filter Data --}}
    <form method="GET" action="{{ route('bt.view') }}" id="filterForm" class="mb-4 flex space-x-2">
        <select name="bulan" class="border border-gray-300 rounded px-2 py-1" onchange="document.getElementById('filterForm').submit()">
            <option value="">--Pilih Bulan--</option>
            @foreach (range(1, 12) as $b)
                <option value="{{ $b }}" {{ request('bulan') ==$b ? 'selected' : ''}}>
                    {{ date('F', mktime(0, 0, 0, $b, 1)) }}
                </option>
            @endforeach
        </select>

         <select name="tahun" class="border border-gray-300 rounded px-2 py-1" onchange="document.getElementById('filterForm').submit()">
            <option value="">--Pilih Tahun--</option>
            @foreach (range(date('Y'), 2000) as $t)
                <option value="{{ $t }}" {{ request('tahun') ==$t ? 'selected' : ''}}>
                    {{ $t }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- Tombol Download PDF --}}
    <div class="mb-4">
        <a href="{{ route('bt.exportPdf', request()->all()) }}" class="bg-red-500 text-white px-4 py-2 rounded">
            Download PDF
        </a>
    </div>

    {{-- Tampilan Kolom Data --}}
    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Tanggal dan Waktu</th>
                <th class="border border-gray-300 px-4 py-2">Nama</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Alamat</th>
                <th class="border border-gray-300 px-4 py-2">No. HP</th>
                <th class="border border-gray-300 px-4 py-2">Umur</th>
                <th class="border border-gray-300 px-4 py-2">Asal Instansi</th>
                <th class="border border-gray-300 px-4 py-2">Jenis Kelamin</th>
                <th class="border border-gray-300 px-4 py-2">Pendidikan</th>
                <th class="border border-gray-300 px-4 py-2">Pekerjaan</th>
                <th class="border border-gray-300 px-4 py-2">Keperluan</th>
                <th class="border border-gray-300 px-4 py-2">Keperluan Lainnya</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bts as $bt)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{$bt->hari}}/{{$bt->bulan}}/{{$bt->tahun}} {{$bt->waktu}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$bt->nama}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$bt->email}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$bt->alamat}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$bt->no_hp}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$bt->umur}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$bt->asal}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$bt->jk}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$bt->pendidikan}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$bt->pekerjaan}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$bt->keperluan}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$bt->k_lain}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{$bts->appends(request()->query())->links() }}
    </div>
</div>

@endsection