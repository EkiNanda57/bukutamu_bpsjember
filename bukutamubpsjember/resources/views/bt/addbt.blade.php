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

                {{-- Jenis Kelamin --}}
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required
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
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Sarjana">Sarjana</option>
                        <option value="Magister">Magister</option>
                        <option value="Doktor">Doktor</option>
                    </select>
                </div>

                {{-- Pekerjaan --}}
                <div>
                    <label for="pekerjaan" class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                    <select name="pekerjaan" id="pekerjaan" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="">Pilih Pekerjaan</option>
                        <option value="PNS">PNS</option>
                        <option value="TNI/POLRI">TNI/POLRI</option>
                        <option value="Pegawai Swasta">Pegawai Swasta</option>
                        <option value="Wiraswasta">Wiraswasta</option>
                        <option value="Petani">Petani</option>
                        <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                {{-- Instansi --}}
                <div>
                    <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                    <input type="text" name="instansi" id="instansi" required
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
                    <label for="telp" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="tel" name="telp" id="telp"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                </div>

                {{-- Keperluan --}}
                <div>
                    <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
                    <select name="keperluan" id="keperluan" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="">Pilih Keperluan</option>
                        <option value="Konsultasi">Konsultasi</option>
                        <option value="Pengambilan Data">Pengambilan Data</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                {{-- Keperluan Lainnya --}}
                <div id="keperluanlainnya" class="hidden">
                    <label for="lainnya" class="block text-sm font-medium text-gray-700">Keperluan Lainnya</label>
                    <input type="text" name="lainnya" id="lainnya"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
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
