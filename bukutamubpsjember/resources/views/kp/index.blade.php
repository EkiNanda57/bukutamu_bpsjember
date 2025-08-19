@extends('layouts.sidebar')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Data Kepuasan Pengunjung</h2>

    <form id="filter-form" action="{{ route('admin.kp.index') }}" method="GET" class="bg-white p-6 rounded-lg shadow-md space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="bulan" class="block text-sm font-medium text-gray-700 mb-1">Filter Bulan</label>
                <select name="bulan" id="bulan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                    <option value="">-- Semua Bulan --</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ ($bulan ?? '') == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="tahun" class="block text-sm font-medium text-gray-700 mb-1">Filter Tahun</label>
                <select name="tahun" id="tahun" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                    <option value="">-- Semua Tahun --</option>
                    @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                        <option value="{{ $y }}" {{ ($tahun ?? '') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="flex items-end">
                <a id="pdf-button" href="{{ route('kp.downloadPDF', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" target="_blank"
                   class="bg-red-600 hover:bg-red-700 text-white px-10 py-2 rounded-lg shadow transition">
                    PDF
                </a>
            </div>
        </div>
    </form>

    <div id="data-wrapper" class="mt-6">
        @include('kp._data_table', ['data' => $data])
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectBulan = document.getElementById('bulan');
    const selectTahun = document.getElementById('tahun');
    const dataWrapper = document.getElementById('data-wrapper');
    const pdfButton = document.getElementById('pdf-button');
    const form = document.getElementById('filter-form');

    function fetchData() {
        const baseUrl = form.getAttribute('action');
        const bulan = selectBulan.value;
        const tahun = selectTahun.value;
        const params = new URLSearchParams({ bulan, tahun });
        const fetchUrl = `${baseUrl}?${params.toString()}`;

        dataWrapper.innerHTML = '<p class="text-center py-10">Memuat data...</p>';

        fetch(fetchUrl, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            dataWrapper.innerHTML = html;
            window.history.pushState({}, '', fetchUrl);
            const pdfBaseUrl = "{{ route('kp.downloadPDF') }}";
            pdfButton.href = `${pdfBaseUrl}?${params.toString()}`;
        })
        .catch(error => {
            console.error('Error:', error);
            dataWrapper.innerHTML = '<p class="text-center py-10 text-red-500">Gagal memuat data.</p>';
        });
    }

    selectBulan.addEventListener('change', fetchData);
    selectTahun.addEventListener('change', fetchData);
});
</script>
@endpush
