@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Isi Buku Tamu</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('bt.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Nama</label>
            <input type="text" name="nama" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block font-medium">Alamat</label>
            <textarea name="alamat" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <div>
            <label class="block font-medium">No HP</label>
            <input type="text" name="no_hp" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block font-medium">Umur</label>
            <input type="text" name="umur" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block font-medium">Asal Instansi</label>
            <input type="text" name="asal" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block font-medium">Jenis Kelamin</label>
            <select name="jk" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Pendidikan</label>
                <select name="pendidikan" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih --</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="D3/D2/D1">D3/D2/D1</option>
                    <option value="S1/D4">S1/D4</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
        </div>

        <div>
            <label class="block font-medium">Pekerjaan</label>
                <select name="pekerjaan" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih --</option>
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

        <div class="mb-4">
            <label class="block font-medium">Keperluan</label>
            <select id='keperluan' name="keperluan" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
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

        <div id ="keperluanlainnya" class="hidden mb-4">
            <label class="block font-medium">Keperluan Lainnya</label>
            <input type="text" name="k_lain" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Lainnya">
        </div>

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
        <div>
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Kirim</button>
        </div>
    </form>
</div>
@endsection
