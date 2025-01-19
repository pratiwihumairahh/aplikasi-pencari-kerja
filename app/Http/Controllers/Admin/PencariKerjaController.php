<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PencariKerja;
use Illuminate\Http\Request;

class PencariKerjaController extends Controller
{
    public function index(Request $request)
    {
        $query = PencariKerja::query();

        // Apply filters
        if ($request->filled('pendidikan')) {
            $query->where('pendidikan_terakhir', $request->pendidikan);
        }

        if ($request->filled('keahlian')) {
            $query->where('keahlian', $request->keahlian);
        }

        if ($request->filled('pengalaman')) {
            $query->where('pengalaman_kerja', $request->pengalaman);
        }

        $pencariKerjas = $query->latest()->paginate(10);
        return view('admin.pencari-kerja.index', compact('pencariKerjas'));
    }

    public function create()
    {
        return view('admin.pencari-kerja.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => [
                'required',
                'string',
                'size:16',
                'regex:/^[0-9]{16}$/',
                'unique:pencari_kerjas'
            ],
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email|unique:pencari_kerjas',
            'pendidikan_terakhir' => 'required|string',
            'keahlian' => 'nullable|string',
            'pengalaman_kerja' => 'nullable|string',
        ]);

        PencariKerja::create($validated);

        return redirect()->route('admin.pencari-kerja.index')
            ->with('success', 'Data pencari kerja berhasil ditambahkan');
    }

    public function show(PencariKerja $pencariKerja)
    {
        return view('admin.pencari-kerja.show', compact('pencariKerja'));
    }

    public function edit(PencariKerja $pencariKerja)
    {
        return view('admin.pencari-kerja.edit', compact('pencariKerja'));
    }

    public function update(Request $request, PencariKerja $pencariKerja)
    {
        $validated = $request->validate([
            'nik' => [
                'required',
                'string',
                'size:16',
                'regex:/^[0-9]{16}$/',
                'unique:pencari_kerjas,nik,' . $pencariKerja->id
            ],
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email|unique:pencari_kerjas,email,' . $pencariKerja->id,
            'pendidikan_terakhir' => 'required|string',
            'keahlian' => 'nullable|string',
            'pengalaman_kerja' => 'nullable|string',
        ]);

        $pencariKerja->update($validated);

        return redirect()->route('admin.pencari-kerja.index')
            ->with('success', 'Data pencari kerja berhasil diperbarui');
    }

    public function destroy(PencariKerja $pencariKerja)
    {
        $pencariKerja->delete();

        return redirect()->route('admin.pencari-kerja.index')
            ->with('success', 'Data pencari kerja berhasil dihapus');
    }

    public function export(Request $request)
    {
        $query = PencariKerja::query();

        // Apply the same filters as in index
        if ($request->filled('pendidikan')) {
            $query->where('pendidikan_terakhir', $request->pendidikan);
        }

        if ($request->filled('keahlian')) {
            $query->where('keahlian', $request->keahlian);
        }

        if ($request->filled('pengalaman')) {
            $query->where('pengalaman_kerja', $request->pengalaman);
        }

        $pencariKerjas = $query->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="data-pencari-kerja-'.date('Y-m-d').'.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $columns = ['NIK', 'Nama', 'Tanggal Lahir', 'Tempat Lahir', 'Jenis Kelamin', 'Alamat', 'Telepon', 'Email', 'Pendidikan Terakhir', 'Keahlian', 'Pengalaman Kerja'];

        $callback = function() use ($pencariKerjas, $columns) {
            $file = fopen('php://output', 'w');
            // Add UTF-8 BOM for proper Excel encoding
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, $columns);

            foreach ($pencariKerjas as $pencariKerja) {
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
                    $pencariKerja->pengalaman_kerja ?? '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
