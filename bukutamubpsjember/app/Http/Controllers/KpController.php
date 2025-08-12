<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kp;

class KpController extends Controller
{
    public function index(Request $request)
    {
        // $data = Kp::all();
        // return view('kp.index', compact('data'));

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
                  ->paginate(25);
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
}
