<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PencariKerja;
use App\Models\RiwayatPekerjaan;

class RiwayatPekerjaanController extends Controller
{
    public function index()
    {
        $riwayatPekerjaan = RiwayatPekerjaan::with('pencariKerja')->latest()->paginate(10);
        return view('admin.riwayat-pekerjaan.index', compact('riwayatPekerjaan'));
    }

    public function create()
    {
        $pencariKerja = PencariKerja::all();
        return view('admin.riwayat-pekerjaan.create', compact('pencariKerja'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after:tanggal_mulai',
            'deskripsi' => 'nullable|string',
            'pencari_kerja_id' => 'required|exists:pencari_kerjas,id',
        ]);

        RiwayatPekerjaan::create($validated);

        return redirect()->route('admin.riwayat-pekerjaan.index')
            ->with('success', 'Data riwayat pekerjaan berhasil ditambahkan');
    }

    public function show($id)
    {
        $riwayatPekerjaan = RiwayatPekerjaan::with('pencariKerja')->findOrFail($id);
        return view('admin.riwayat-pekerjaan.show', compact('riwayatPekerjaan'));
    }

    public function edit($id)
    {
        $riwayatPekerjaan = RiwayatPekerjaan::findOrFail($id);
        $pencariKerja = PencariKerja::all();
        return view('admin.riwayat-pekerjaan.edit', compact('riwayatPekerjaan', 'pencariKerja'));
    }

    public function update(Request $request, $id)
    {
        $riwayatPekerjaan = RiwayatPekerjaan::findOrFail($id);
        
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after:tanggal_mulai',
            'deskripsi' => 'nullable|string',
            'pencari_kerja_id' => 'required|exists:pencari_kerjas,id',
        ]);

        $riwayatPekerjaan->update($validated);

        return redirect()->route('admin.riwayat-pekerjaan.index')
            ->with('success', 'Data riwayat pekerjaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $riwayatPekerjaan = RiwayatPekerjaan::findOrFail($id);
        $riwayatPekerjaan->delete();

        return redirect()->route('admin.riwayat-pekerjaan.index')
            ->with('success', 'Data riwayat pekerjaan berhasil dihapus');
    }
}
