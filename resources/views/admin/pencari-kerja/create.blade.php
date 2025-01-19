@extends('layouts.admin')

@section('header', 'Tambah Data Pencari Kerja')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Form Tambah Data</h3>
    </div>
    
    <div class="p-4">
        <form action="{{ route('admin.pencari-kerja.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('nik') border-red-500 @enderror" 
                            id="nik" name="nik" value="{{ old('nik') }}" 
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
                            id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('tanggal_lahir') border-red-500 @enderror" 
                            id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                        @error('tanggal_lahir')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('tempat_lahir') border-red-500 @enderror" 
                            id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                        @error('tempat_lahir')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('jenis_kelamin') border-red-500 @enderror" 
                            id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                            id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('telepon') border-red-500 @enderror" 
                            id="telepon" name="telepon" value="{{ old('telepon') }}" required>
                        @error('telepon')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('email') border-red-500 @enderror" 
                            id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pendidikan_terakhir" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                        <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('pendidikan_terakhir') border-red-500 @enderror" 
                            id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                            <option value="">Pilih Pendidikan Terakhir</option>
                            <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA/SMK" {{ old('pendidikan_terakhir') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                            <option value="D1" {{ old('pendidikan_terakhir') == 'D1' ? 'selected' : '' }}>D1</option>
                            <option value="D2" {{ old('pendidikan_terakhir') == 'D2' ? 'selected' : '' }}>D2</option>
                            <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="D4" {{ old('pendidikan_terakhir') == 'D4' ? 'selected' : '' }}>D4</option>
                            <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ old('pendidikan_terakhir') == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                        @error('pendidikan_terakhir')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="keahlian" class="block text-sm font-medium text-gray-700">Keahlian</label>
                        <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('keahlian') border-red-500 @enderror" 
                            id="keahlian" name="keahlian">
                            <option value="">Pilih Keahlian</option>
                            <option value="Teknologi Informasi" {{ old('keahlian') == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                            <option value="Administrasi" {{ old('keahlian') == 'Administrasi' ? 'selected' : '' }}>Administrasi</option>
                            <option value="Keuangan" {{ old('keahlian') == 'Keuangan' ? 'selected' : '' }}>Keuangan</option>
                            <option value="Marketing" {{ old('keahlian') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="Desain" {{ old('keahlian') == 'Desain' ? 'selected' : '' }}>Desain</option>
                            <option value="Teknik" {{ old('keahlian') == 'Teknik' ? 'selected' : '' }}>Teknik</option>
                            <option value="Pendidikan" {{ old('keahlian') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="Kesehatan" {{ old('keahlian') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                            <option value="Lainnya" {{ old('keahlian') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('keahlian')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pengalaman_kerja" class="block text-sm font-medium text-gray-700">Pengalaman Kerja</label>
                        <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('pengalaman_kerja') border-red-500 @enderror" 
                            id="pengalaman_kerja" name="pengalaman_kerja">
                            <option value="">Pilih Pengalaman Kerja</option>
                            <option value="Fresh Graduate" {{ old('pengalaman_kerja') == 'Fresh Graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                            <option value="1-2 Tahun" {{ old('pengalaman_kerja') == '1-2 Tahun' ? 'selected' : '' }}>1-2 Tahun</option>
                            <option value="2-3 Tahun" {{ old('pengalaman_kerja') == '2-3 Tahun' ? 'selected' : '' }}>2-3 Tahun</option>
                            <option value="3-5 Tahun" {{ old('pengalaman_kerja') == '3-5 Tahun' ? 'selected' : '' }}>3-5 Tahun</option>
                            <option value="5-10 Tahun" {{ old('pengalaman_kerja') == '5-10 Tahun' ? 'selected' : '' }}>5-10 Tahun</option>
                            <option value="Lebih dari 10 Tahun" {{ old('pengalaman_kerja') == 'Lebih dari 10 Tahun' ? 'selected' : '' }}>Lebih dari 10 Tahun</option>
                        </select>
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
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
