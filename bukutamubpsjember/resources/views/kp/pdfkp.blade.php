<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Kepuasan Pelanggan</title>
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
            font-size: 12px;
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
            font-size: 20px;
            margin: 5px 0;
            color: #1E40AF; /* Biru BPS */
        }
        .header p {
            font-size: 14px;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #e2e8f0;
            padding: 10px 12px;
            text-align: left;
        }
        thead tr {
            background-color: #1E40AF; /* Biru BPS */
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        /* Mengatur perataan teks di header tabel menjadi tengah */
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
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('logo/logo-BPS.png') }}" alt="Logo BPS" class="logo">
        <h1>Laporan Data Kepuasan Pelanggan</h1>
        <p>Badan Pusat Statistik Kabupaten Jember</p>
        <p style="font-weight: 600;">Periode: {{ $periode }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Email</th>
                <th>Kepuasan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $kp)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $kp->email }}</td>
                    <td>{{ $kp->kepuasan }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::create($kp->tahun, $kp->bulan, $kp->hari)->isoFormat('D MMMM YYYY') }}</td>
                    <td class="text-center">{{ $kp->waktu }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, HH:mm') }} WIB
    </div>
</body>
</html>
