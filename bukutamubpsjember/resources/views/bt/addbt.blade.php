@extends('layouts.app')

@section('content')

<style>
    /* Background gradasi */
    .bg-gradient-bps {
        background: #0494dc82 100%;
        min-height: 100vh;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
</style>

<div class="bg-gradient-bps">
    <div class="container mx-auto px-4">
        <div class="bg-white bg-opacity-90 p-6 rounded-lg my-8 max-w-md mx-auto text-center shadow-lg">
            <img src="{{ asset('logo/logo-BPS.png') }}" alt="BPS Logo" class="h-12 mx-auto mb-2">

            <h5 class="text-lg font-semibold mb-1">BPS Kabupaten Jember</h5>
            <h6 class="text-base mb-3">Form Buku Tamu</h6>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('bt.store') }}" method="POST" class="space-y-3 text-left">
                @csrf

                {{-- Nama --}}
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" id="nama" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" name="email" id="email" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                </div>

                {{-- Alamat --}}
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" name="alamat" id="alamat" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                </div>

                {{-- Nomor Telepon --}}
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" name="no_hp" id="no_hp" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                </div>

                {{-- Umur --}}
                <div>
                    <label for="umur" class="block text-sm font-medium text-gray-700">Umur</label>
                    <input type="text" name="umur" id="umur" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                </div>

                {{-- Asal --}}
                <div>
                    <label for="asal" class="block text-sm font-medium text-gray-700">Asal/Institusi/Instansi</label>
                    <input type="text" name="asal" id="asal" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                </div>

                {{-- Jenis Kelamin --}}
                <div>
                    <label for="jk" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select name="jk" id="jk" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                {{-- Pendidikan --}}
                <div>
                    <label for="pendidikan" class="block text-sm font-medium text-gray-700">Pendidikan</label>
                    <select name="pendidikan" id="pendidikan" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="">Pilih Pendidikan</option>
                        <option value="S3">S3</option>
                        <option value="S2">S2</option>
                        <option value="S1/D4">S1/D4</option>
                        <option value="D3/D2/D1">D3/D2/D1</option>
                        <option value="SMA">SMA</option>
                        <option value="SMP">SMP</option>
                        <option value="SD">SD</option>
                    </select>
                </div>

                {{-- Pekerjaan --}}
                <div>
                    <label for="pekerjaan" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                    <select name="pekerjaan" id="pekerjaan" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="">Pilih Pekerjaan</option>
                        <option value="Belum Bekerja">Belum Bekerja</option>
                        <option value="Guru/Dosen">Guru/Dosen</option>
                        <option value="Karyawan BUMN">Karyawan BUMN</option>
                        <option value="Karyawan Swasta">Karyawan Swasta</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="PNS">PNS</option>
                        <option value="Polri/TNI">Polri/TNI</option>
                        <option value="Wiraswasta">Wiraswasta</option>
                    </select>
                </div>

               {{-- Keperluan --}}
                <div class="mb-4">
                    <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
                    <select id="keperluan" name="keperluan" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="">-- Pilih --</option>
                        <option value="Perpustakaan Tercetak">Perpustakaan Tercetak</option>
                        <option value="Perpustakaan Digital">Perpustakaan Digital</option>
                        <option value="Penjualan Publikasi">Penjualan Publikasi</option>
                        <option value="Konsultasi Statistik">Konsultasi Statistik</option>
                        <option value="Data Mikro">Data Mikro</option>
                        <option value="Rekomendasi Kegiatan Statistik">Rekomendasi Kegiatan Statistik</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                {{-- Keperluan Lainnya --}}
                <div id="keperluanlainnya" class="hidden mb-4">
                    <label for="k_lain" class="block text-sm font-medium text-gray-700">Keperluan Lainnya</label>
                    <input type="text" name="k_lain" id="k_lain"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        placeholder="Lainnya">
                </div>


                {{-- Tombol Submit --}}
                <div class="pt-2">
                    <button type="submit"
                        class="h-12 w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-full text-base hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                        SUBMIT
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script interaksi dropdown keperluan --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const keperluan = document.getElementById('keperluan');
        const keperluanlainnya = document.getElementById('keperluanlainnya');

        keperluan.addEventListener('change', function () {
            if (this.value === 'Lainnya') {
                keperluanlainnya.classList.remove('hidden');
            } else {
                keperluanlainnya.classList.add('hidden');
            }
        });
    });
</script>

@endsection
