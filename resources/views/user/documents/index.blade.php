@extends('layouts.user')

@section('content')
<div class="py-12 pb-20 sm:pb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Dokumen</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Photo Document -->
                    <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Foto (3x4)</h3>
                                <p class="text-sm text-gray-500">Upload foto terbaru Anda</p>
                            </div>
                            @if($profile && $profile->photo_path)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Terunggah
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Wajib
                                </span>
                            @endif
                        </div>

                        @if($profile && $profile->photo_path)
                            <div class="mb-4">
                                <img src="{{ Storage::url(str_replace('public/', '', $profile->photo_path)) }}" 
                                    alt="Foto Profil" 
                                    class="w-32 h-40 object-cover rounded-lg border border-gray-200">
                            </div>
                        @endif

                        <form action="{{ route('user.documents.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="document_type" value="photo">
                            <div class="flex justify-center items-center w-full">
                                <label class="flex flex-col w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-500">
                                            <span class="font-semibold">Klik untuk unggah</span> atau drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500">PNG, JPG (maks. 2MB)</p>
                                    </div>
                                    <input type="file" name="document" accept="image/*" class="hidden" onchange="previewImage(this, 'photo-preview')">
                                </label>
                            </div>
                            <div id="photo-preview" class="mt-4 hidden">
                                <img src="" alt="Preview" class="w-32 h-40 object-cover rounded-lg border border-gray-200">
                            </div>
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-upload mr-2"></i>
                                Unggah Foto
                            </button>
                        </form>
                    </div>

                    <!-- ID Card Document -->
                    <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">KTP</h3>
                                <p class="text-sm text-gray-500">Upload KTP yang masih berlaku</p>
                            </div>
                            @if($profile && $profile->id_card_path)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Terunggah
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Wajib
                                </span>
                            @endif
                        </div>

                        @if($profile && $profile->id_card_path)
                            <div class="mb-4">
                                @if(Str::endsWith(strtolower($profile->id_card_path), ['.pdf']))
                                    <a href="{{ Storage::url(str_replace('public/', '', $profile->id_card_path)) }}" target="_blank" 
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                        <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                        Lihat KTP
                                    </a>
                                @else
                                    <img src="{{ Storage::url(str_replace('public/', '', $profile->id_card_path)) }}" 
                                        alt="KTP" 
                                        class="max-w-full h-auto rounded-lg border border-gray-200">
                                @endif
                            </div>
                        @endif

                        <form action="{{ route('user.documents.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="document_type" value="id_card">
                            <div class="flex justify-center items-center w-full">
                                <label class="flex flex-col w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-500">
                                            <span class="font-semibold">Klik untuk unggah</span> atau drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500">PDF, PNG, JPG (maks. 2MB)</p>
                                    </div>
                                    <input type="file" name="document" accept=".pdf,image/*" class="hidden" onchange="previewDocument(this, 'id-card-preview')">
                                </label>
                            </div>
                            <div id="id-card-preview" class="mt-4 hidden">
                                <!-- Preview will be inserted here by JavaScript -->
                            </div>
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-upload mr-2"></i>
                                Unggah KTP
                            </button>
                        </form>
                    </div>

                    <!-- Certificate Document -->
                    <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Ijazah</h3>
                                <p class="text-sm text-gray-500">Upload ijazah pendidikan terakhir</p>
                            </div>
                            @if($profile && $profile->certificate_path)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Terunggah
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Wajib
                                </span>
                            @endif
                        </div>

                        @if($profile && $profile->certificate_path)
                            <div class="mb-4">
                                <a href="{{ Storage::url(str_replace('public/', '', $profile->certificate_path)) }}" target="_blank" 
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                    Lihat Ijazah
                                </a>
                            </div>
                        @endif

                        <form action="{{ route('user.documents.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="document_type" value="certificate">
                            <div class="flex justify-center items-center w-full">
                                <label class="flex flex-col w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-500">
                                            <span class="font-semibold">Klik untuk unggah</span> atau drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500">PDF (maks. 2MB)</p>
                                    </div>
                                    <input type="file" name="document" accept=".pdf" class="hidden">
                                </label>
                            </div>
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-upload mr-2"></i>
                                Unggah Ijazah
                            </button>
                        </form>
                    </div>

                    <!-- Work Experience Document -->
                    <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Surat Pengalaman Kerja</h3>
                                <p class="text-sm text-gray-500">Upload surat pengalaman kerja (jika ada)</p>
                            </div>
                            @if($profile && $profile->work_experience_path)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Terunggah
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Opsional
                                </span>
                            @endif
                        </div>

                        @if($profile && $profile->work_experience_path)
                            <div class="mb-4">
                                <a href="{{ Storage::url(str_replace('public/', '', $profile->work_experience_path)) }}" target="_blank" 
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                    Lihat Surat
                                </a>
                            </div>
                        @endif

                        <form action="{{ route('user.documents.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="document_type" value="work_experience">
                            <div class="flex justify-center items-center w-full">
                                <label class="flex flex-col w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-500">
                                            <span class="font-semibold">Klik untuk unggah</span> atau drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500">PDF (maks. 2MB)</p>
                                    </div>
                                    <input type="file" name="document" accept=".pdf" class="hidden">
                                </label>
                            </div>
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-upload mr-2"></i>
                                Unggah Surat
                            </button>
                        </form>
                    </div>
                </div>

                @if($errors->any())
                    <div class="mt-6">
                        <div class="rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">
                                        Terdapat {{ $errors->count() }} kesalahan pada form:
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.classList.remove('hidden');
                preview.querySelector('img').src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewDocument(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];
        
        if (file) {
            preview.classList.remove('hidden');
            
            if (file.type === 'application/pdf') {
                preview.innerHTML = `
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-file-pdf text-red-500 text-2xl"></i>
                        <span class="text-sm text-gray-600">${file.name}</span>
                    </div>
                `;
            } else if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="max-w-full h-auto rounded-lg border border-gray-200">
                    `;
                }
                reader.readAsDataURL(file);
            }
        }
    }
</script>
@endpush
@endsection
