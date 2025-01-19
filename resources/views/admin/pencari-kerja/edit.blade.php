@extends('layouts.admin')

@section('header', 'Edit Data Pencari Kerja')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Form Edit Data</h3>
    </div>
    
    <div class="p-4">
        <form action="{{ route('admin.pencari-kerja.update', $pencariKerja) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('nik') border-red-500 @enderror" 
                            id="nik" name="nik" value="{{ old('nik', $pencariKerja->nik) }}"
                            pattern="[0-9]{16}" maxlength="16" minlength="16"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)"
                            title="NIK harus 16 digit angka"
                            required>
                        @error('nik')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('nama') border-red-500 @enderror" 
                            id="nama" name="nama" value="{{ old('nama', $pencariKerja->nama) }}" required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('tanggal_lahir') border-red-500 @enderror" 
                            id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pencariKerja->tanggal_lahir->format('Y-m-d')) }}" required>
                        @error('tanggal_lahir')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('tempat_lahir') border-red-500 @enderror" 
                            id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $pencariKerja->tempat_lahir) }}" required>
                        @error('tempat_lahir')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('jenis_kelamin') border-red-500 @enderror" 
                            id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin', $pencariKerja->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $pencariKerja->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('alamat') border-red-500 @enderror" 
                            id="alamat" name="alamat" rows="3" required>{{ old('alamat', $pencariKerja->alamat) }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('telepon') border-red-500 @enderror" 
                            id="telepon" name="telepon" value="{{ old('telepon', $pencariKerja->telepon) }}" required>
                        @error('telepon')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('email') border-red-500 @enderror" 
                            id="email" name="email" value="{{ old('email', $pencariKerja->email) }}" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pendidikan_terakhir" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('pendidikan_terakhir') border-red-500 @enderror" 
                            id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $pencariKerja->pendidikan_terakhir) }}" required>
                        @error('pendidikan_terakhir')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="keahlian" class="block text-sm font-medium text-gray-700">Keahlian</label>
                        <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('keahlian') border-red-500 @enderror" 
                            id="keahlian" name="keahlian" rows="3">{{ old('keahlian', $pencariKerja->keahlian) }}</textarea>
                        @error('keahlian')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pengalaman_kerja" class="block text-sm font-medium text-gray-700">Pengalaman Kerja</label>
                        <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('pengalaman_kerja') border-red-500 @enderror" 
                            id="pengalaman_kerja" name="pengalaman_kerja" rows="3">{{ old('pengalaman_kerja', $pencariKerja->pengalaman_kerja) }}</textarea>
                        @error('pengalaman_kerja')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.pencari-kerja.index') }}" class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Kembali
                </a>
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
