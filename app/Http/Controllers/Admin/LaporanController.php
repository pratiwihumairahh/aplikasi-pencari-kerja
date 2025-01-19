<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PencariKerja;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $totalPencariKerja = PencariKerja::count();
        $pencariKerjaAktif = PencariKerja::where('status', 'aktif')->count();
        $sudahBekerja = PencariKerja::where('status', 'bekerja')->count();

        return view('admin.laporan.index', compact('totalPencariKerja', 'pencariKerjaAktif', 'sudahBekerja'));
    }

    public function export(Request $request)
    {
        // Validate required dates
        if (!$request->filled(['start_date', 'end_date'])) {
            return redirect()->back()->with('error', 'Tanggal Mulai dan Tanggal Akhir harus diisi.');
        }

        try {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();

            // Validate date range
            if ($startDate > $endDate) {
                return redirect()->back()->with('error', 'Tanggal Mulai tidak boleh lebih besar dari Tanggal Akhir.');
            }

            // Get filtered data
            $query = PencariKerja::query();
            $query->whereBetween('created_at', [$startDate, $endDate]);
            $pencariKerjas = $query->get();

            // Check if data exists
            if ($pencariKerjas->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data untuk periode yang dipilih.');
            }

            // Generate filename with date range
            $filename = 'laporan-pencari-kerja';
            $filename .= '-periode-' . $startDate->format('d-m-Y');
            $filename .= '-sd-' . $endDate->format('d-m-Y');
            $filename .= '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0'
            ];

            $columns = [
                'NIK',
                'Nama',
                'Tanggal Lahir',
                'Tempat Lahir',
                'Jenis Kelamin',
                'Alamat',
                'Telepon',
                'Email',
                'Pendidikan Terakhir',
                'Keahlian',
                'Pengalaman Kerja',
                'Status',
                'Tanggal Daftar'
            ];

            $callback = function() use ($pencariKerjas, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, "\xEF\xBB\xBF"); // Add UTF-8 BOM for Excel
                fputcsv($file, $columns);

                foreach ($pencariKerjas as $pencariKerja) {
                    $status = $pencariKerja->status ?? 'aktif';
                    $status = ucfirst($status);

                    fputcsv($file, [
                        $pencariKerja->nik,
                        $pencariKerja->nama,
                        $pencariKerja->tanggal_lahir->format('d/m/Y'),
                        $pencariKerja->tempat_lahir,
                        $pencariKerja->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
                        $pencariKerja->alamat,
                        $pencariKerja->telepon,
                        $pencariKerja->email,
                        $pencariKerja->pendidikan_terakhir,
                        $pencariKerja->keahlian ?? '-',
                        $pencariKerja->pengalaman_kerja ?? '-',
                        $status,
                        $pencariKerja->created_at->format('d/m/Y')
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengekspor data. Pastikan format tanggal sudah benar.');
        }
    }
}
