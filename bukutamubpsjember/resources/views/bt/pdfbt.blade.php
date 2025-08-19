<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Buku Tamu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        @page {
            margin: 25px;
        }
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            font-size: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header .logo {
            width: 70px;
            height: auto;
        }
        .header h1 {
            font-size: 18px;
            margin: 5px 0;
            color: #1E40AF; /* Biru BPS */
        }
        .header p {
            font-size: 12px;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #e2e8f0;
            padding: 6px 8px;
            word-wrap: break-word;
        }
        thead tr {
            background-color: #1E40AF; /* Biru BPS */
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 9px;
            letter-spacing: 0.5px;
        }
        th {
            text-align: center;
        }
        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
            font-size: 9px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('logo/logo-BPS.png') }}" alt="Logo BPS" class="logo">
        <h1>Laporan Buku Tamu</h1>
        <p>Badan Pusat Statistik Kabupaten Jember</p>
        <p style="font-weight: 600;">Periode: {{ $periode }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal & Waktu</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th>Umur</th>
                <th>Asal Instansi</th>
                <th>Jenis Kelamin</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <th>Keperluan</th>
                <th>Keperluan Lainnya</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bts as $index => $bt)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $bt->hari }}/{{ $bt->bulan }}/{{ $bt->tahun }} {{ $bt->waktu }}</td>
                    <td>{{ $bt->nama }}</td>
                    <td>{{ $bt->email }}</td>
                    <td>{{ $bt->alamat }}</td>
                    <td>{{ $bt->no_hp }}</td>
                    <td class="text-center">{{ $bt->umur }}</td>
                    <td>{{ $bt->asal }}</td>
                    <td class="text-center">{{ $bt->jk }}</td>
                    <td>{{ $bt->pendidikan }}</td>
                    <td>{{ $bt->pekerjaan }}</td>
                    <td>{{ $bt->keperluan }}</td>
                    <td>{{ $bt->k_lain }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="text-center">Tidak ada data untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, HH:mm') }} WIB
    </div>
</body>
</html>
