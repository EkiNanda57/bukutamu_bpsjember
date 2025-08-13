@extends('layouts.app')

@section('content')
{{-- Bagian ini mengambil body dan style background dari layout utama (app.blade.php) --}}
{{-- Anda bisa menambahkan background spesifik untuk halaman ini di layouts/app.blade.php jika perlu --}}

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

            <div>
                <label for="nama" class="block text-xs mb-1">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="email" class="block text-xs mb-1">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan email" value="{{ old('email') }}" required>
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="alamat" class="block text-xs mb-1">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan alamat" value="{{ old('alamat') }}" required>
                @error('alamat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="no_hp" class="block text-xs mb-1">No. HP</label>
                <input type="text" name="no_hp" id="no_hp" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nomor HP" value="{{ old('no_hp') }}" required>
                @error('no_hp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Kolom Umur dan Asal Instansi ditambahkan karena wajib di backend --}}
            <div>
                <label for="umur" class="block text-xs mb-1">Umur</label>
                <input type="text" name="umur" id="umur" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan umur" value="{{ old('umur') }}" required>
                @error('umur') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="asal" class="block text-xs mb-1">Asal Instansi</label>
                <input type="text" name="asal" id="asal" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan asal instansi" value="{{ old('asal') }}" required>
                @error('asal') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="jk" class="block text-xs mb-1">Jenis Kelamin</label>
                <select name="jk" id="jk" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" @if(old('jk') == 'Laki-laki') selected @endif>Laki-laki</option>
                    <option value="Perempuan" @if(old('jk') == 'Perempuan') selected @endif>Perempuan</option>
                </select>
                @error('jk') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="pendidikan" class="block text-xs mb-1">Pendidikan</label>
                <select name="pendidikan" id="pendidikan" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Pendidikan --</option>
                    <option value="SD" @if(old('pendidikan') == 'SD') selected @endif>SD</option>
                    <option value="SMP" @if(old('pendidikan') == 'SMP') selected @endif>SMP</option>
                    <option value="SMA" @if(old('pendidikan') == 'SMA') selected @endif>SMA</option>
                    <option value="D3/D2/D1" @if(old('pendidikan') == 'D3/D2/D1') selected @endif>D3/D2/D1</option>
                    <option value="S1/D4" @if(old('pendidikan') == 'S1/D4') selected @endif>S1/D4</option>
                    <option value="S2" @if(old('pendidikan') == 'S2') selected @endif>S2</option>
                    <option value="S3" @if(old('pendidikan') == 'S3') selected @endif>S3</option>
                </select>
                @error('pendidikan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="pekerjaan" class="block text-xs mb-1">Pekerjaan</label>
                <select name="pekerjaan" id="pekerjaan" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Pekerjaan --</option>
                    <option value="Belum Bekerja" @if(old('pekerjaan') == 'Belum Bekerja') selected @endif>Belum Bekerja</option>
                    <option value="Guru/Dosen" @if(old('pekerjaan') == 'Guru/Dosen') selected @endif>Guru/Dosen</option>
                    <option value="Karyawan BUMN" @if(old('pekerjaan') == 'Karyawan BUMN') selected @endif>Karyawan BUMN</option>
                    <option value="Karyawan Swasta" @if(old('pekerjaan') == 'Karyawan Swasta') selected @endif>Karyawan Swasta</option>
                    <option value="Mahasiswa" @if(old('pekerjaan') == 'Mahasiswa') selected @endif>Mahasiswa</option>
                    <option value="PNS" @if(old('pekerjaan') == 'PNS') selected @endif>PNS</option>
                    <option value="Polri/TNI" @if(old('pekerjaan') == 'Polri/TNI') selected @endif>Polri/TNI</option>
                    <option value="Wiraswasta" @if(old('pekerjaan') == 'Wiraswasta') selected @endif>Wiraswasta</option>
                </select>
                @error('pekerjaan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="keperluan" class="block text-xs mb-1">Keperluan</label>
                <select name="keperluan" id="keperluan" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih --</option>
                    <option value="Perpustakaan Tercetak" @if(old('keperluan') == 'Perpustakaan Tercetak') selected @endif>Perpustakaan Tercetak</option>
                    <option value="Perpustakaan Digital" @if(old('keperluan') == 'Perpustakaan Digital') selected @endif>Perpustakaan Digital</option>
                    <option value="Penjualan Publikasi" @if(old('keperluan') == 'Penjualan Publikasi') selected @endif>Penjualan Publikasi</option>
                    <option value="Konsultasi Statistik" @if(old('keperluan') == 'Konsultasi Statistik') selected @endif>Konsultasi Statistik</option>
                    <option value="Data Mikro" @if(old('keperluan') == 'Data Mikro') selected @endif>Data Mikro</option>
                    <option value="Rekomendasi Kegiatan Statistik" @if(old('keperluan') == 'Rekomendasi Kegiatan Statistik') selected @endif>Rekomendasi Kegiatan Statistik</option>
                    <option value="Lainnya" @if(old('keperluan') == 'Lainnya') selected @endif>Lainnya</option>
                </select>
                @error('keperluan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div id="keperluanlainnya" class="{{ old('keperluan') == 'Lainnya' ? '' : 'hidden' }}">
                <label for="k_lain" class="block text-xs mb-1">Keperluan Lainnya</label>
                <input type="text" name="k_lain" id="k_lain" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Sebutkan keperluan Anda" value="{{ old('k_lain') }}">
                @error('k_lain') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="h-12 w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-full text-base hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                    SUBMIT
                </button>
            </div>

            <div class="flex justify-center gap-3 pt-2 h-12">
                {{-- Menggunakan tag <a> untuk navigasi lebih tepat secara semantik --}}
                <a href="#" class="bg-orange-500 text-white font-bold py-2 px-4 rounded-full text-sm flex-1 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-200 whitespace-nowrap text-center">
                    HALAMAN UTAMA
                </a>
                <a href="#" class="bg-orange-500 text-white font-bold py-2 px-4 rounded-full text-sm flex-1 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-200 whitespace-nowrap text-center">
                    KEPUASAN PELANGGAN
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Script untuk menampilkan/menyembunyikan input 'Keperluan Lainnya' --}}
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