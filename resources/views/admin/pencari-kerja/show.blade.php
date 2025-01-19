@extends('layouts.admin')

@section('header', 'Detail Pencari Kerja')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Informasi Pencari Kerja</h3>
    </div>
    
    <div class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-500">NIK</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $pencariKerja->nik }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Nama Lengkap</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $pencariKerja->nama }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Tanggal Lahir</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $pencariKerja->tanggal_lahir->format('d/m/Y') }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Tempat Lahir</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $pencariKerja->tempat_lahir }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Jenis Kelamin</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $pencariKerja->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Alamat</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $pencariKerja->alamat }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Nomor Telepon</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $pencariKerja->telepon }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Email</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $pencariKerja->email }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Pendidikan Terakhir</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $pencariKerja->pendidikan_terakhir }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Keahlian</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $pencariKerja->keahlian ?? '-' }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Pengalaman Kerja</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $pencariKerja->pengalaman_kerja ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end space-x-3">
            <a href="{{ route('admin.pencari-kerja.edit', $pencariKerja) }}" class="inline-flex justify-center rounded-md border border-transparent bg-yellow-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                Edit
            </a>
            <form action="{{ route('admin.pencari-kerja.destroy', $pencariKerja) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    Hapus
                </button>
            </form>
            <a href="{{ route('admin.pencari-kerja.index') }}" class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
