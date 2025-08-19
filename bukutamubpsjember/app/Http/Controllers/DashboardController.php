<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bt;
use App\Models\Kp; // <-- Pastikan ini ada
use Illuminate\Support\Facades\DB; // <-- Pastikan ini ada

class DashboardController extends Controller
{
    // Fungsi index() ini kita biarkan dulu, jangan diubah.
    public function index()
    {
        $semuaPengunjung = \App\Models\Bt::orderBy('tahun', 'desc')
                                    ->orderBy('bulan', 'desc')
                                    ->orderBy('hari', 'desc')
                                    ->orderBy('waktu', 'desc')
                                    ->get();

        // --- OLAH DATA YANG SUDAH DIAMBIL ---
        // 1. Siapkan data untuk tabel (variabel $bts)
        $bts = $semuaPengunjung;

        // 2. Siapkan data untuk grafik pengunjung tahunan
        $pengunjungTahunan = $semuaPengunjung
            ->groupBy('tahun') // Kelompokkan berdasarkan tahun
            ->map(function ($item) {
                return $item->count(); // Hitung jumlah item di setiap grup
            });

        // --- Perhitungan Kepuasan (kode ini tidak diubah) ---
        $counts = \App\Models\Kp::query()
            ->select('kepuasan', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('kepuasan')
            ->pluck('total', 'kepuasan');

        $sangatPuasCount = isset($counts['Sangat Puas']) ? $counts['Sangat Puas'] : 0;
        $puasCount       = isset($counts['Puas']) ? $counts['Puas'] : 0;
        $kurangPuasCount = isset($counts['Kurang Puas']) ? $counts['Kurang Puas'] : 0;
        $tidakPuasCount  = isset($counts['Tidak Puas']) ? $counts['Tidak Puas'] : 0;

        // --- KIRIM SEMUA VARIABEL KE VIEW ---
        return view('dashboard', [
            'bts' => $bts,
            'pengunjungTahunan' => $pengunjungTahunan, // Kirim data grafik
            'sangatPuasCount' => $sangatPuasCount,
            'puasCount' => $puasCount,
            'kurangPuasCount' => $kurangPuasCount,
            'tidakPuasCount' => $tidakPuasCount,
        ]);
    }

    // UBAH FUNGSI DI BAWAH INI
    public function showSurveyPage()
    {
        // --- Bagian 1: Menghitung Kategori Kepuasan (Ini sudah benar) ---
        $counts = \App\Models\Kp::query()
            ->select('kepuasan', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('kepuasan')
            ->pluck('total', 'kepuasan');

        $sangatPuasCount = isset($counts['Sangat Puas']) ? $counts['Sangat Puas'] : 0;
        $puasCount       = isset($counts['Puas']) ? $counts['Puas'] : 0;
        $kurangPuasCount = isset($counts['Kurang Puas']) ? $counts['Kurang Puas'] : 0;
        $tidakPuasCount  = isset($counts['Tidak Puas']) ? $counts['Tidak Puas'] : 0;

        // --- Bagian 2: Menghitung Pengunjung Tahunan (INI PERBAIKANNYA) ---
        $pengunjungTahunan = \App\Models\Bt::query()
            ->select('tahun', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->pluck('total', 'tahun');

        // --- Bagian 3: Mengirim semua data ke view ---
        return view('admin.tampilanadmin', [
            'sangatPuasCount' => $sangatPuasCount,
            'puasCount'       => $puasCount,
            'kurangPuasCount' => $kurangPuasCount,
            'tidakPuasCount'  => $tidakPuasCount,
            'pengunjungTahunan' => $pengunjungTahunan,
        ]);
    }
}
