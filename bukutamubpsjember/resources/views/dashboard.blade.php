<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    {{-- Menu Admin --}}
                    @if(Auth::user()->role == 'admin')
                        <div class="mt-6 border-t border-gray-300 dark:border-gray-600 pt-6">
                            <h3 class="text-lg font-semibold mb-4">Menu Admin</h3>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <a href="{{ route('admin.kp.index') }}" 
                                    class="flex items-center justify-center p-4 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-500 transition duration-200">
                                    📊 Lihat Data Kepuasan Pelanggan
                                </a>
                            </div>
                        </div>

                        {{-- Tabel Data Buku Tamu --}}
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">Laporan Buku Tamu BPS Kabupaten Jember</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm border border-gray-300 dark:border-gray-700">
                                    <thead class="bg-gray-100 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-4 py-2 border">Tanggal & Waktu</th>
                                            <th class="px-4 py-2 border">Nama</th>
                                            <th class="px-4 py-2 border">Email</th>
                                            <th class="px-4 py-2 border">Alamat</th>
                                            <th class="px-4 py-2 border">No. HP</th>
                                            <th class="px-4 py-2 border">Umur</th>
                                            <th class="px-4 py-2 border">Asal Instansi</th>
                                            <th class="px-4 py-2 border">Jenis Kelamin</th>
                                            <th class="px-4 py-2 border">Pendidikan</th>
                                            <th class="px-4 py-2 border">Pekerjaan</th>
                                            <th class="px-4 py-2 border">Keperluan</th>
                                            <th class="px-4 py-2 border">Keperluan Lainnya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bts as $bt)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="px-4 py-2 border">{{ $bt->hari }}/{{ $bt->bulan }}/{{ $bt->tahun }} {{ $bt->waktu }}</td>
                                                <td class="px-4 py-2 border">{{ $bt->nama }}</td>
                                                <td class="px-4 py-2 border">{{ $bt->email }}</td>
                                                <td class="px-4 py-2 border">{{ $bt->alamat }}</td>
                                                <td class="px-4 py-2 border">{{ $bt->no_hp }}</td>
                                                <td class="px-4 py-2 border">{{ $bt->umur }}</td>
                                                <td class="px-4 py-2 border">{{ $bt->asal }}</td>
                                                <td class="px-4 py-2 border">{{ $bt->jk }}</td>
                                                <td class="px-4 py-2 border">{{ $bt->pendidikan }}</td>
                                                <td class="px-4 py-2 border">{{ $bt->pekerjaan }}</td>
                                                <td class="px-4 py-2 border">{{ $bt->keperluan }}</td>
                                                <td class="px-4 py-2 border">{{ $bt->k_lain }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
