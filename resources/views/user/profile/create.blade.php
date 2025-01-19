@extends('layouts.user')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-4">Lengkapi Profil Anda</h2>

                <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('place_of_birth')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('date_of_birth')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="address" id="address" rows="3" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="education_level" class="block text-sm font-medium text-gray-700">Tingkat Pendidikan</label>
                            <select name="education_level" id="education_level" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Pilih Tingkat Pendidikan</option>
                                <option value="SD" {{ old('education_level') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('education_level') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA/SMK" {{ old('education_level') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                <option value="D1" {{ old('education_level') == 'D1' ? 'selected' : '' }}>D1</option>
                                <option value="D2" {{ old('education_level') == 'D2' ? 'selected' : '' }}>D2</option>
                                <option value="D3" {{ old('education_level') == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="D4" {{ old('education_level') == 'D4' ? 'selected' : '' }}>D4</option>
                                <option value="S1" {{ old('education_level') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('education_level') == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ old('education_level') == 'S3' ? 'selected' : '' }}>S3</option>
                            </select>
                            @error('education_level')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="major" class="block text-sm font-medium text-gray-700">Jurusan</label>
                            <input type="text" name="major" id="major" value="{{ old('major') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('major')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="institution" class="block text-sm font-medium text-gray-700">Institusi Pendidikan</label>
                            <input type="text" name="institution" id="institution" value="{{ old('institution') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('institution')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="graduation_year" class="block text-sm font-medium text-gray-700">Tahun Lulus</label>
                            <input type="number" name="graduation_year" id="graduation_year" value="{{ old('graduation_year') }}"
                                min="1950" max="{{ date('Y') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('graduation_year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-6 mt-6">
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Foto (Maks. 2MB)</label>
                            <input type="file" name="photo" id="photo" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-1 text-sm text-gray-500">Format: JPG, JPEG, PNG</p>
                            @error('photo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="id_card" class="block text-sm font-medium text-gray-700">KTP (Maks. 2MB)</label>
                            <input type="file" name="id_card" id="id_card" accept=".pdf,image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-1 text-sm text-gray-500">Format: PDF, JPG, JPEG, PNG</p>
                            @error('id_card')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="certificate" class="block text-sm font-medium text-gray-700">Ijazah (Maks. 2MB)</label>
                            <input type="file" name="certificate" id="certificate" accept=".pdf"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-1 text-sm text-gray-500">Format: PDF</p>
                            @error('certificate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Simpan Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
