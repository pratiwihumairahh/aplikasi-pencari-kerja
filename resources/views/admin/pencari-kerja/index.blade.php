@extends('layouts.admin')

@section('header', 'Daftar Pencari Kerja')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800">Data Pencari Kerja</h3>
        <a href="{{ route('admin.pencari-kerja.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Tambah Pencari Kerja</span>
        </a>
    </div>

    <!-- Filter Section -->
    <div class="p-4 border-b border-gray-200 bg-gray-50">
        <form action="{{ route('admin.pencari-kerja.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                    <select name="pendidikan_terakhir" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua</option>
                        <option value="SD" {{ request('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ request('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA/SMK" {{ request('pendidikan_terakhir') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                        <option value="D3" {{ request('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="S1" {{ request('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ request('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>S2</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="bekerja" {{ request('status') == 'bekerja' ? 'selected' : '' }}>Sudah Bekerja</option>
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                        <i class="fas fa-filter"></i>
                        <span>Filter</span>
                    </button>
                    <a href="{{ route('admin.pencari-kerja.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                        <i class="fas fa-undo"></i>
                        <span>Reset</span>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Informasi Pribadi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendidikan & Keahlian</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($pencariKerjas as $pencariKerja)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $pencariKerja->nik }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 font-medium">{{ $pencariKerja->nama }}</div>
                            <div class="text-sm text-gray-500">
                                {{ $pencariKerja->tempat_lahir }}, {{ $pencariKerja->tanggal_lahir->format('d/m/Y') }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $pencariKerja->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $pencariKerja->telepon }}</div>
                            <div class="text-sm text-gray-500">{{ $pencariKerja->email }}</div>
                            <div class="text-sm text-gray-500 max-w-xs truncate">{{ $pencariKerja->alamat }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $pencariKerja->pendidikan_terakhir ?: '-' }}</div>
                            <div class="text-sm text-gray-500">{{ $pencariKerja->keahlian ?: '-' }}</div>
                            <div class="text-sm text-gray-500">{{ $pencariKerja->pengalaman_kerja ?: '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $pencariKerja->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($pencariKerja->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.pencari-kerja.edit', $pencariKerja->id) }}" 
                                    class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.pencari-kerja.destroy', $pencariKerja->id) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data pencari kerja
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $pencariKerjas->links() }}
    </div>
</div>
@endsection
