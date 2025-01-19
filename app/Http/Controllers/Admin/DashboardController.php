<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PencariKerja;
use App\Models\RiwayatPekerjaan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Utama
        $totalPencariKerja = PencariKerja::count();
        $pencariKerjaAktif = PencariKerja::where('status', 'aktif')->count();
        $sudahBekerja = PencariKerja::where('status', 'bekerja')->count();
        $totalRiwayatPekerjaan = RiwayatPekerjaan::count();

        // Pencari Kerja Terbaru (5 terakhir)
        $latestPencariKerja = PencariKerja::latest()
            ->take(5)
            ->get();

        // Statistik Pendidikan
        $pendidikanStats = PencariKerja::select('pendidikan_terakhir', DB::raw('count(*) as total'))
            ->groupBy('pendidikan_terakhir')
            ->orderBy('total', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'totalPencariKerja',
            'pencariKerjaAktif',
            'sudahBekerja',
            'totalRiwayatPekerjaan',
            'latestPencariKerja',
            'pendidikanStats'
        ));
    }
}
