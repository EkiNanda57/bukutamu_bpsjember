<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kp;
use PDF;

class KpController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = Kp::query();

        if ($bulan) {
            $bulan_format = str_pad($bulan, 2, '0', STR_PAD_LEFT);
            $query->where('bulan', $bulan_format);
        } if ($tahun) {
            $query->where('tahun', $tahun);
            }

        $data = $query->orderBy('tahun', 'asc')
                  ->orderBy('bulan', 'asc')
                  ->orderBy('hari', 'asc')
                  ->orderBy('waktu', 'asc')
                  ->paginate(25)->withQueryString();

        if ($request->ajax()) {
            return view('kp._data_table', compact('data'))->render();
        }
        return view('kp.index', compact('data', 'bulan', 'tahun'));
    }

    public function create()
    {
        return view('kp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'kepuasan' => 'required',
        ]);

        Kp::create([
            'tahun'    => date('Y'),
            'bulan'    => date('m'),
            'hari'     => date('d'),
            'waktu'    => date('H:i:s'),
            'email'    => $request->email,
            'kepuasan' => $request->kepuasan,
        ]);

        return redirect()->route('kp.create')->with('success', 'Terima kasih, data Anda telah kami terima!');
    }

    public function downloadPDF(Request $request)
    {
        $bulan = (int) $request->input('bulan');
        $tahun = (int) $request->input('tahun');

        $query = Kp::query();

        if ($bulan) {
            $bulan_format = str_pad($bulan, 2, '0', STR_PAD_LEFT);
            $query->where('bulan', $bulan_format);
        }
        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        $data = $query->orderBy('tahun', 'asc')
                    ->orderBy('bulan', 'asc')
                    ->orderBy('hari', 'asc')
                    ->orderBy('waktu', 'asc')
                    ->get();

        $periodeText = 'Keseluruhan'; // Teks default jika tidak ada filter
        if ($bulan && $tahun) {
            $nama_bulan = \Carbon\Carbon::create()->month($bulan)->isoFormat('MMMM');
            $periodeText = $nama_bulan . ' ' . $tahun;
        } elseif ($tahun) {
            $periodeText = 'Tahun ' . $tahun;
        } elseif ($bulan) {
            $nama_bulan = \Carbon\Carbon::create()->month($bulan)->isoFormat('MMMM');
            $periodeText = 'Bulan ' . $nama_bulan;
        }

        $filename = 'laporan-kepuasan';
        if ($bulan) {
            $nama_bulan = date('F', mktime(0, 0, 0, $bulan, 1));
            $filename .= '-' . $nama_bulan;
        }
        if ($tahun) {
            $filename .= '-' . $tahun;
        }
        $filename .= '.pdf';

        $pdf = PDF::loadView('kp.pdfkp', [
        'data' => $data,
        'periode' => $periodeText ]);

        return $pdf->download($filename);
    }
}
