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

                    {{-- AWAL KODE TAMBAHAN --}}
                    @if(Auth::user()->role == 'admin')
                        <div class="mt-4 border-t pt-4">
                            <h3 class="font-semibold mb-2">Menu Admin</h3>
                            <a href="{{ route('admin.kp.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                                Lihat Data Kepuasan Pelanggan
                            </a>
                        </div>
                    @endif
                    {{-- AKHIR KODE TAMBAHAN --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
