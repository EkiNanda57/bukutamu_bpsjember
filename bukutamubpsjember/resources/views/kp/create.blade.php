@extends('layouts.app') {{-- Memberitahu Laravel untuk menggunakan bingkai dari layouts.app --}}

@section('content') {{-- Semua kode di dalam section ini akan dimasukkan ke @yield('content') di layout --}}

<style>
    .bg-gradient-blue-green {
        background: #0494dc82 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }
</style>

<div class="bg-gradient-blue-green">
    <div class="relative z-10 flex items-center justify-center w-full">
        <div class="w-full max-w-md">

            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
                <div class="text-center mb-8">
                    <img src="{{ asset('logo/logo-BPS.png') }}" alt="BPS Logo" class="h-12 mx-auto mb-2">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Survey Kepuasan Pelayanan</h1>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Bagaimana Kepuasan Anda Terhadap Pelayanan Kami?
                    </p>
                </div>

                @if(session('success'))
                    <div class="mb-6 p-4 rounded-lg bg-green-50 text-green-800 border border-green-200 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-800 border border-red-200 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('kp.store') }}">
                    @csrf
                    <div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-4 text-center">Tingkat Kepuasan</label>
                             <div class="grid grid-cols-2 gap-4">

                            <label class="cursor-pointer group">
                                <input type="radio" name="kepuasan" value="Sangat Puas" class="sr-only" required>
                                <div class="satisfaction-card border-2 border-green-200 rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg hover:scale-105">
                                    <div class="text-4xl mb-2">😍</div>
                                    <span class="text-sm font-semibold text-green-700">Sangat Puas</span>
                                </div>
                            </label>

                            <label class="cursor-pointer group">
                                <input type="radio" name="kepuasan" value="Puas" class="sr-only">
                                <div class="satisfaction-card border-2 border-blue-200 rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg hover:scale-105">
                                    <div class="text-4xl mb-2">😊</div>
                                    <span class="text-sm font-semibold text-blue-700">Puas</span>
                                </div>
                            </label>

                            <label class="cursor-pointer group">
                                <input type="radio" name="kepuasan" value="Cukup Puas" class="sr-only">
                                <div class="satisfaction-card border-2 border-yellow-200 rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg hover:scale-105">
                                    <div class="text-4xl mb-2">😐</div>
                                    <span class="text-sm font-semibold text-yellow-700">Cukup Puas</span>
                                </div>
                            </label>

                            <label class="cursor-pointer group">
                                <input type="radio" name="kepuasan" value="Tidak Puas" class="sr-only">
                                <div class="satisfaction-card border-2 border-red-200 rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg hover:scale-105">
                                    <div class="text-4xl mb-2">😠</div>
                                    <span class="text-sm font-semibold text-red-700">Tidak Puas</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full mt-8 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition-all duration-300 transform hover:scale-105">
                        Simpan Survey
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts') {{-- Script ini hanya akan di-load di halaman ini saja --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radioInputs = document.querySelectorAll('input[name="kepuasan"]');
        radioInputs.forEach(radio => {
            if(radio.checked) {
                radio.nextElementSibling.classList.add('ring-4', 'ring-blue-400');
            }
            radio.addEventListener('change', function() {
                document.querySelectorAll('.satisfaction-card').forEach(card => {
                    card.classList.remove('ring-4', 'ring-blue-400');
                });
                if (this.checked) {
                    this.nextElementSibling.classList.add('ring-4', 'ring-blue-400');
                }
            });
        });
    });
</script>
@endpush
