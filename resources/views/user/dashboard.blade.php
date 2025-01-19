@extends('layouts.user')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-6">Dashboard Pencari Kerja</h2>
                
                @if(auth()->user()->profile)
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4">Status Kartu Pencari Kerja</h3>
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="mr-4">
                                    @if(auth()->user()->profile->status === 'approved')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Disetujui
                                        </span>
                                    @elseif(auth()->user()->profile->status === 'rejected')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <svg class="mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Menunggu Review
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if(auth()->user()->profile->status === 'approved')
                                <div class="bg-white p-4 rounded-lg border border-gray-200 mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Nomor Kartu:</p>
                                    <p class="text-lg font-semibold">{{ auth()->user()->profile->card_number }}</p>
                                </div>
                                <a href="{{ route('user.card.download') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="fas fa-download mr-2"></i>
                                    Download Kartu
                                </a>
                            @elseif(auth()->user()->profile->status === 'rejected')
                                <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                                    <p class="text-sm font-medium text-red-800 mb-1">Alasan Penolakan:</p>
                                    <p class="text-sm text-red-700">{{ auth()->user()->profile->rejection_reason }}</p>
                                </div>
                            @else
                                <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                                    <p class="text-sm text-yellow-700">
                                        Aplikasi Anda sedang dalam proses review. Kami akan memberitahu Anda segera setelah proses review selesai.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Anda belum mengajukan aplikasi kartu pencari kerja.
                                </p>
                                <p class="mt-3">
                                    <a href="{{ route('user.profile.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-plus mr-2"></i>
                                        Ajukan Sekarang
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-semibold mb-4">
                            <i class="fas fa-user-circle mr-2 text-gray-400"></i>
                            Informasi Pribadi
                        </h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ auth()->user()->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">NIK</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ auth()->user()->nik }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ auth()->user()->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nomor Telepon</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ auth()->user()->phone ?? '-' }}</dd>
                            </div>
                        </dl>
                        <div class="mt-4">
                            <a href="{{ route('user.profile.edit') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                Edit Profil <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-semibold mb-4">
                            <i class="fas fa-link mr-2 text-gray-400"></i>
                            Menu Cepat
                        </h3>
                        <nav class="space-y-3">
                            <a href="{{ route('user.experience.index') }}" class="flex items-center p-3 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-briefcase w-6 text-gray-400"></i>
                                <span class="ml-3">Pengalaman Kerja</span>
                                <span class="ml-auto">
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </span>
                            </a>
                            <a href="{{ route('user.documents.index') }}" class="flex items-center p-3 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-file-alt w-6 text-gray-400"></i>
                                <span class="ml-3">Dokumen</span>
                                <span class="ml-auto">
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </span>
                            </a>
                            <a href="{{ route('user.profile.edit') }}" class="flex items-center p-3 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-user-edit w-6 text-gray-400"></i>
                                <span class="ml-3">Update Profil</span>
                                <span class="ml-auto">
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
