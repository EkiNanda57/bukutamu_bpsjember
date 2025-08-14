<h2 style="text-align:center; font-size:16px; margin-bottom:10px;">
    Laporan Buku Tamu BPS Kabupaten Jember
</h2>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 10px;
        table-layout: fixed;
    }
    th, td {
        border: 1px solid #000;
        padding: 4px 6px;
        word-wrap: break-word;
        max-width: 90px;
    }
    thead {
        background-color: #f2f2f2;
    }
    h2 {
        font-family: Arial, sans-serif;
    }
</style>

<table>
    <thead>
        <tr>
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
        @foreach($bts as $bt)
            <tr>
                <td>{{ $bt->hari }}/{{ $bt->bulan }}/{{ $bt->tahun }} {{ $bt->waktu }}</td>
                <td>{{ $bt->nama }}</td>
                <td>{{ $bt->email }}</td>
                <td>{{ $bt->alamat }}</td>
                <td>{{ $bt->no_hp }}</td>
                <td>{{ $bt->umur }}</td>
                <td>{{ $bt->asal }}</td>
                <td>{{ $bt->jk }}</td>
                <td>{{ $bt->pendidikan }}</td>
                <td>{{ $bt->pekerjaan }}</td>
                <td>{{ $bt->keperluan }}</td>
                <td>{{ $bt->k_lain }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
