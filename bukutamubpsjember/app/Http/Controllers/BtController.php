<?php

namespace App\Http\Controllers;

use App\Models\Bt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class BtController extends Controller
{
    /**
     * Menampilkan semua data Buku Tamu (hanya untuk admin)
     */
    public function index()
    {
        $bt = Bt::orderBy('id', 'desc')->paginate(20); // Mengambil 20 data per halaman
        return view('bt.viewbt', compact('bt'));
    }

    /**
     * Form untuk isi Buku Tamu (bisa diakses semua orang)
     */
    public function create()
    {
        return view('bt.addbt');
    }

    /**
     * Simpan data Buku Tamu
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'email'       => 'required|email',
            'alamat'      => 'required|string',
            'no_hp'       => 'required|string|max:20',
            'umur'        => 'required|string|max:5',
            'asal'        => 'required|string',
            'jk'          => 'required|string',
            'pendidikan'  => 'required|string',
            'pekerjaan'   => 'required|string',
            'keperluan'   => 'required|string',
            'k_lain'      => 'nullable|string',
        ]);

        $now = Carbon::now();

        // HITUNG NOMOR ANTRIAN HARI INI PER KEPERLUAN
        $jumlahHariIni = Bt::where('hari', $now->day)
            ->where('bulan', $now->format('m'))
            ->where('tahun', $now->year)
            ->count();

        $nomorAntrian = str_pad($jumlahHariIni + 1, 2, '0', STR_PAD_LEFT);

        // SIMPAN DATA
        $data = Bt::create([
            ...$request->all(),
            'tahun' => $now->year,
            'bulan' => $now->format('m'),
            'hari'  => $now->day,
            'waktu' => $now->format('H:i:s'),
            'nomor_antrian' => $nomorAntrian,
        ]);

        return redirect()->back()->with([
            'success' => 'Terima kasih, data Anda sudah tersimpan.',
            'nomor_antrian' => $nomorAntrian,   // dikirim ke view
            'keperluan' => $request->keperluan,
        ]);
    }

    public function viewBt(Request $request)
    {
        $query = Bt::query();

        if ($request->filled('bulan')) {
            $bulan = str_pad($request->bulan, 2, '0', STR_PAD_LEFT);
            $query->where('bulan', $bulan);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Data terbaru dulu
        $bts = $query->orderBy('id', 'asc')->paginate(15);

        return view('bt.viewbt', compact('bts'));
    }



    public function exportPdf(Request $request)
    {
        $query = Bt::query();
        $periode = 'Keseluruhan'; // default

        // Filter bulan
        if ($request->filled('bulan')) {
            $bulan = str_pad($request->bulan, 2, '0', STR_PAD_LEFT);
            $query->where('bulan', $bulan);
            $nama_bulan = \Carbon\Carbon::create()->month((int)$request->bulan)->translatedFormat('F');
            $periode = 'Bulan ' . $nama_bulan;
        }

        // Filter tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
            $periode = $request->filled('bulan') ? $periode . ' ' . $request->tahun : 'Tahun ' . $request->tahun;
        }

        // Filter nama jika ada
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Ambil data sesuai filter atau seluruhnya
        $bts = $query->orderBy('id', 'asc')->get();

        // Nama file otomatis
        $filename = 'Laporan-Buku-Tamu-BPS-Jember';
        if ($request->filled('bulan')) $filename .= '-' . $nama_bulan;
        if ($request->filled('tahun')) $filename .= '-' . $request->tahun;
        $filename .= '.pdf';

        // Generate PDF
        $pdf = Pdf::loadView('bt.pdfbt', [
            'bts' => $bts,
            'periode' => $periode
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }
}
