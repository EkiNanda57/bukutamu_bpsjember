@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Data Kepuasan Pelanggan</h2>

    <form action="{{ route('admin.kp.index') }}" method="GET" class="card card-body my-4">
        <div class="row">
            <div class="col-md-5">
                <label for="bulan" class="form-label">Filter Bulan</label>
                <select name="bulan" id="bulan" class="form-select">
                    <option value="">-- Semua Bulan --</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ ($bulan ?? '') == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-5">
                <label for="tahun" class="form-label">Filter Tahun</label>
                <select name="tahun" id="tahun" class="form-select">
                    <option value="">-- Semua Tahun --</option>
                    {{-- Loop dari tahun sekarang sampai 5 tahun ke belakang --}}
                    @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                        <option value="{{ $y }}" {{ ($tahun ?? '') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-3">Filter</button>
                <a href="{{ route('admin.kp.index') }}" class="btn btn-secondary">Reset</a>
                <a href="{{ route('kp.downloadPDF', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" class="btn btn-success ms-2" target="_blank">PDF</a>
            </div>
        </div>
    </form>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Kepuasan</th>
                    <th>Tahun</th>
                    <th>Bulan</th>
                    <th>Hari</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $kp)
                    <tr>
                        <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                        <td>{{ $kp->email }}</td>
                        <td>{{ $kp->kepuasan }}</td>
                        <td>{{ $kp->tahun }}</td>
                        <td>{{ $kp->bulan }}</td>
                        <td>{{ $kp->hari }}</td>
                        <td>{{ $kp->waktu }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $data->links() }}
    </div>
</div>
@endsection
