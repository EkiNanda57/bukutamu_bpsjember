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
        if (!Auth::check()) {
            return redirect('/'); // jika belum login, kembalikan ke halaman utama
        }

        $bt = Bt::orderBy('id', 'desc')->get();
        return view('bt.index', compact('bt'));
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

        $data = $request->all();

        $now = Carbon::now();
        $data['tahun'] = $now->year;
        $data['bulan'] = $now->format('m');
        $data['hari'] = $now->day;
        $data['waktu'] = $now->format('h:i:s');

        Bt::create($data);

        return redirect()->route('bt.view')->with('success', 'Terima kasih, data Anda sudah tersimpan.');
    }

    public function viewBt(Request $request)
    {
        $query = Bt::query();

        if ($request->filled('bulan')){
            $bulan = str_pad($request->bulan, 2, '0', STR_PAD_LEFT);
            $query->where('bulan', $bulan);
        }

        if ($request->filled('tahun')){
            $query->where('tahun', $request->tahun);
        }

        $bts = $query->orderBy('id', 'asc')->paginate(20);
        return view('bt.viewbt', compact('bts'));
    }

    public function exportPdf(Request $request)
{
    $bts = Bt::query();

    // Filter sesuai request (bulan, tahun)
    if ($request->filled('bulan')) {
        $bulan = str_pad($request->bulan, 2, '0', STR_PAD_LEFT);
        $bts->where('bulan', $bulan);
    }
    if ($request->filled('tahun')) {
        $bts->where('tahun', $request->tahun);
    }

    $bts = $bts->get();

    $pdf = Pdf::loadView('bt.pdfbt', compact('bts'))->setPaper('a4', 'landscape');
    return $pdf->download('Laporan-buku-tamu-BPS-Jember.pdf');
}

    /**
     * Edit data Buku Tamu (admin saja)
     */
    // public function edit($id)
    // {
    //     if (!Auth::check()) {
    //         return redirect('/');
    //     }

    //     $bt = Bt::findOrFail($id);
    //     return view('bt.edit', compact('bt'));
    // }

    // /**
    //  * Update data Buku Tamu (admin saja)
    //  */
    // public function update(Request $request, $id)
    // {
    //     if (!Auth::check()) {
    //         return redirect('/');
    //     }

    //     $validated = $request->validate([
    //         'tahun'       => 'required|integer',
    //         'bulan'       => 'required|string',
    //         'hari'        => 'required|string',
    //         'waktu'       => 'required|string',
    //         'nama'        => 'required|string|max:255',
    //         'email'       => 'required|email',
    //         'alamat'      => 'required|string',
    //         'no_hp'       => 'required|string|max:20',
    //         'umur'        => 'required|string|max:5',
    //         'asal'        => 'required|string',
    //         'jk'          => 'required|string',
    //         'pendidikan'  => 'required|string',
    //         'pekerjaan'   => 'required|string',
    //         'keperluan'   => 'required|string',
    //         'k_lain'      => 'nullable|string',
    //     ]);

    //     $bt = Bt::findOrFail($id);
    //     $bt->update($validated);

    //     return redirect()->route('bt.index')->with('success', 'Data Buku Tamu berhasil diperbarui.');
    // }

    // /**
    //  * Hapus data Buku Tamu (admin saja)
    //  */
    // public function destroy($id)
    // {
    //     if (!Auth::check()) {
    //         return redirect('/');
    //     }

    //     $bt = Bt::findOrFail($id);
    //     $bt->delete();

    //     return redirect()->route('bt.index')->with('success', 'Data Buku Tamu berhasil dihapus.');
    // }
}
