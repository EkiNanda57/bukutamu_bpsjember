@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Kepuasan Pelanggan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('kp.store') }}" method="POST">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        {{-- Kepuasan --}}
        <div class="mb-3">
            <label>Kepuasan</label>
            <select name="kepuasan" class="form-control" required>
                <option value="">-- Pilih Kepuasan --</option>
                <option value="Sangat Puas">Sangat Puas</option>
                <option value="Puas">Puas</option>
                <option value="Cukup Puas">Cukup Puas</option>
                <option value="Tidak Puas">Tidak Puas</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
