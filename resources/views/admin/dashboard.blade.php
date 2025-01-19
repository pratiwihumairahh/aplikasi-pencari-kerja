@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Pencari Kerja -->
        <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-600 font-medium">Total Pencari Kerja</p>
                    <p class="text-2xl font-bold text-blue-700">{{ $totalPencariKerja }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-users text-2xl text-blue-500"></i>
                </div>
            </div>
            <div class="mt-2">
                <a href="{{ route('admin.pencari-kerja.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <!-- Pencari Kerja Aktif -->
        <div class="bg-green-50 rounded-lg p-4 border border-green-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-600 font-medium">Pencari Kerja Aktif</p>
                    <p class="text-2xl font-bold text-green-700">{{ $pencariKerjaAktif }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-user-check text-2xl text-green-500"></i>
                </div>
            </div>
            <div class="mt-2">
                <a href="{{ route('admin.pencari-kerja.index') }}?status=aktif" class="text-sm text-green-600 hover:text-green-800">
                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <!-- Sudah Bekerja -->
        <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-yellow-600 font-medium">Sudah Bekerja</p>
                    <p class="text-2xl font-bold text-yellow-700">{{ $sudahBekerja }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fas fa-briefcase text-2xl text-yellow-500"></i>
                </div>
            </div>
            <div class="mt-2">
                <a href="{{ route('admin.pencari-kerja.index') }}?status=bekerja" class="text-sm text-yellow-600 hover:text-yellow-800">
                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <!-- Total Riwayat Pekerjaan -->
        <div class="bg-purple-50 rounded-lg p-4 border border-purple-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-purple-600 font-medium">Total Riwayat Pekerjaan</p>
                    <p class="text-2xl font-bold text-purple-700">{{ $totalRiwayatPekerjaan }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <i class="fas fa-history text-2xl text-purple-500"></i>
                </div>
            </div>
            <div class="mt-2">
                <a href="{{ route('admin.riwayat-pekerjaan.index') }}" class="text-sm text-purple-600 hover:text-purple-800">
                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Menu Cepat -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Tambah Pencari Kerja -->
        <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow">
            <a href="{{ route('admin.pencari-kerja.create') }}" class="flex items-center space-x-3">
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-user-plus text-xl text-blue-500"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-800">Tambah Pencari Kerja</h3>
                    <p class="text-sm text-gray-500">Daftarkan pencari kerja baru</p>
                </div>
            </a>
        </div>

        <!-- Laporan -->
        <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow">
            <a href="{{ route('admin.laporan') }}" class="flex items-center space-x-3">
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-chart-bar text-xl text-green-500"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-800">Laporan</h3>
                    <p class="text-sm text-gray-500">Lihat dan export laporan</p>
                </div>
            </a>
        </div>

        <!-- Riwayat Pekerjaan -->
        <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow">
            <a href="{{ route('admin.riwayat-pekerjaan.index') }}" class="flex items-center space-x-3">
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fas fa-briefcase text-xl text-yellow-500"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-800">Riwayat Pekerjaan</h3>
                    <p class="text-sm text-gray-500">Kelola riwayat pekerjaan</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Statistik Tambahan -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Pencari Kerja Terbaru -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-800">Pencari Kerja Terbaru</h3>
            </div>
            <div class="p-4">
                @if($latestPencariKerja->isEmpty())
                    <p class="text-gray-500 text-center py-4">Belum ada data pencari kerja</p>
                @else
                    <div class="space-y-4">
                        @foreach($latestPencariKerja as $pencariKerja)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-gray-100 rounded-full p-2">
                                        <i class="fas fa-user text-gray-500"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $pencariKerja->nama }}</p>
                                        <p class="text-sm text-gray-500">{{ $pencariKerja->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 text-xs rounded-full {{ $pencariKerja->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($pencariKerja->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Statistik Pendidikan -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-800">Statistik Pendidikan</h3>
            </div>
            <div class="p-4">
                @if($pendidikanStats->isEmpty())
                    <p class="text-gray-500 text-center py-4">Belum ada data statistik pendidikan</p>
                @else
                    <div class="space-y-4">
                        @foreach($pendidikanStats as $stat)
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700">{{ $stat->pendidikan_terakhir ?: 'Tidak Diisi' }}</span>
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium text-gray-600">{{ $stat->total }}</span>
                                    <div class="w-24 bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-500 rounded-full h-2" style="width: {{ ($stat->total / $totalPencariKerja) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
