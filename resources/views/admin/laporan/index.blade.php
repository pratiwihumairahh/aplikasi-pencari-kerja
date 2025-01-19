@extends('layouts.admin')

@section('header', 'Laporan')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800">Laporan Data Pencari Kerja</h3>
    </div>
    
    <div class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Card Laporan Total Pencari Kerja -->
            <div class="bg-blue-50 p-4 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-blue-600">Total Pencari Kerja</p>
                        <p class="text-2xl font-bold text-blue-700">{{ $totalPencariKerja }}</p>
                    </div>
                    <div class="text-blue-500">
                        <i class="fas fa-users text-3xl"></i>
                    </div>
                </div>
            </div>

            <!-- Card Laporan Pencari Kerja Aktif -->
            <div class="bg-green-50 p-4 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-green-600">Pencari Kerja Aktif</p>
                        <p class="text-2xl font-bold text-green-700">{{ $pencariKerjaAktif }}</p>
                    </div>
                    <div class="text-green-500">
                        <i class="fas fa-user-check text-3xl"></i>
                    </div>
                </div>
            </div>

            <!-- Card Laporan Pencari Kerja Sudah Bekerja -->
            <div class="bg-yellow-50 p-4 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-yellow-600">Sudah Bekerja</p>
                        <p class="text-2xl font-bold text-yellow-700">{{ $sudahBekerja }}</p>
                    </div>
                    <div class="text-yellow-500">
                        <i class="fas fa-briefcase text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter dan Export -->
        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <h4 class="text-lg font-medium text-gray-700 mb-4">Filter dan Export Data</h4>
            
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.laporan.export') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Akhir <span class="text-red-500">*</span></label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div class="flex items-end space-x-2">
                        <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-2">
                            <i class="fas fa-file-export"></i>
                            <span>Export Data</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection