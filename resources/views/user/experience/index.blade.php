@extends('layouts.user')

@section('content')
<div class="py-12 pb-20 sm:pb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Pengalaman Kerja</h2>
                    <button onclick="toggleModal()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Pengalaman
                    </button>
                </div>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Experience List -->
                <div class="space-y-4">
                    @forelse($experiences as $experience)
                        <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                            <div class="flex justify-between items-start">
                                <div class="flex-grow">
                                    <div class="flex items-center mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $experience->position }}</h3>
                                        @if($experience->is_current_job)
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Pekerjaan Saat Ini
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-gray-600 font-medium">{{ $experience->company_name }}</p>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - 
                                        {{ $experience->is_current_job ? 'Sekarang' : \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                                    </p>
                                    <p class="mt-3 text-gray-600">{{ $experience->job_description }}</p>
                                </div>
                                <div class="ml-4 flex items-start space-x-2">
                                    <button onclick="editExperience({{ $experience->id }})" 
                                        class="text-gray-400 hover:text-indigo-600 transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('user.experience.destroy', $experience->id) }}" method="POST" 
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengalaman kerja ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="mb-4">
                                <i class="fas fa-briefcase text-4xl text-gray-300"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pengalaman kerja</h3>
                            <p class="text-gray-500 mb-4">Tambahkan pengalaman kerja Anda untuk meningkatkan profil</p>
                            <button onclick="toggleModal()" 
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Pengalaman Kerja Pertama
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="experienceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold" id="modalTitle">Tambah Pengalaman Kerja</h3>
            <button onclick="toggleModal()" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="experienceForm" action="{{ route('user.experience.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                    <input type="text" name="company_name" id="company_name" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700">Posisi</label>
                    <input type="text" name="position" id="position" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="month" name="start_date" id="start_date" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div id="end_date_container">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <input type="month" name="end_date" id="end_date"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>

                <div class="relative flex items-start">
                    <div class="flex items-center h-5">
                        <input type="hidden" name="is_current_job" value="0">
                        <input type="checkbox" name="is_current_job" id="is_current_job" value="1"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="is_current_job" class="font-medium text-gray-700">Saya masih bekerja di sini</label>
                    </div>
                </div>

                <div>
                    <label for="job_description" class="block text-sm font-medium text-gray-700">Deskripsi Pekerjaan</label>
                    <textarea name="job_description" id="job_description" rows="4" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Jelaskan tanggung jawab dan pencapaian Anda di posisi ini"></textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="toggleModal()" 
                    class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Batal
                </button>
                <button type="submit" 
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function toggleModal() {
        const modal = document.getElementById('experienceModal');
        modal.classList.toggle('hidden');
    }

    function editExperience(id) {
        // TODO: Implement edit functionality
        toggleModal();
    }

    // Handle is_current_job checkbox
    document.getElementById('is_current_job').addEventListener('change', function() {
        const endDateContainer = document.getElementById('end_date_container');
        const endDateInput = document.getElementById('end_date');
        
        if (this.checked) {
            endDateInput.value = '';
            endDateInput.required = false;
            endDateContainer.style.opacity = '0.5';
            endDateInput.disabled = true;
        } else {
            endDateInput.required = true;
            endDateContainer.style.opacity = '1';
            endDateInput.disabled = false;
        }
    });

    // Form validation
    document.getElementById('experienceForm').addEventListener('submit', function(e) {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        const isCurrentJob = document.getElementById('is_current_job').checked;

        if (!isCurrentJob && !endDate) {
            e.preventDefault();
            alert('Silakan isi tanggal selesai atau centang "Saya masih bekerja di sini"');
            return;
        }

        if (!isCurrentJob && new Date(endDate) <= new Date(startDate)) {
            e.preventDefault();
            alert('Tanggal selesai harus lebih besar dari tanggal mulai');
            return;
        }
    });
</script>
@endpush
@endsection
