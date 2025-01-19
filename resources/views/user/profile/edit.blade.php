@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Edit Profile</h2>
                <a href="{{ route('user.dashboard') }}" class="text-blue-500 hover:text-blue-700">
                    &larr; Back to Dashboard
                </a>
            </div>

            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Personal Information -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="place_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Place of Birth</label>
                            <input type="text" name="place_of_birth" id="place_of_birth" 
                                value="{{ old('place_of_birth', $profile->place_of_birth ?? '') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" 
                                value="{{ old('date_of_birth', $profile->date_of_birth?->format('Y-m-d') ?? '') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                        </div>

                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <textarea name="address" id="address" rows="3" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">{{ old('address', $profile->address ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Education Information -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Education Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="education_level" class="block text-sm font-medium text-gray-700 mb-1">Education Level</label>
                            <select name="education_level" id="education_level" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                                <option value="">Select Education Level</option>
                                <option value="SD" {{ (old('education_level', $profile->education_level ?? '') == 'SD') ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ (old('education_level', $profile->education_level ?? '') == 'SMP') ? 'selected' : '' }}>SMP</option>
                                <option value="SMA/SMK" {{ (old('education_level', $profile->education_level ?? '') == 'SMA/SMK') ? 'selected' : '' }}>SMA/SMK</option>
                                <option value="D3" {{ (old('education_level', $profile->education_level ?? '') == 'D3') ? 'selected' : '' }}>D3</option>
                                <option value="S1" {{ (old('education_level', $profile->education_level ?? '') == 'S1') ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ (old('education_level', $profile->education_level ?? '') == 'S2') ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ (old('education_level', $profile->education_level ?? '') == 'S3') ? 'selected' : '' }}>S3</option>
                            </select>
                        </div>

                        <div>
                            <label for="major" class="block text-sm font-medium text-gray-700 mb-1">Major/Program Study</label>
                            <input type="text" name="major" id="major" 
                                value="{{ old('major', $profile->major ?? '') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label for="institution" class="block text-sm font-medium text-gray-700 mb-1">Institution</label>
                            <input type="text" name="institution" id="institution" 
                                value="{{ old('institution', $profile->institution ?? '') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label for="graduation_year" class="block text-sm font-medium text-gray-700 mb-1">Graduation Year</label>
                            <input type="number" name="graduation_year" id="graduation_year" 
                                value="{{ old('graduation_year', $profile->graduation_year ?? '') }}"
                                min="1950" max="{{ date('Y') }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                        </div>
                    </div>
                </div>

                <!-- Required Documents -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Required Documents</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Photo (3x4)</label>
                            <input type="file" name="photo" id="photo" accept="image/*"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @if($profile->photo_path ?? false)
                                <p class="mt-1 text-sm text-gray-500">Current: {{ basename($profile->photo_path) }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="id_card" class="block text-sm font-medium text-gray-700 mb-1">ID Card (KTP)</label>
                            <input type="file" name="id_card" id="id_card" accept="image/*,.pdf"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @if($profile->id_card_path ?? false)
                                <p class="mt-1 text-sm text-gray-500">Current: {{ basename($profile->id_card_path) }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="certificate" class="block text-sm font-medium text-gray-700 mb-1">Last Education Certificate</label>
                            <input type="file" name="certificate" id="certificate" accept=".pdf"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @if($profile->certificate_path ?? false)
                                <p class="mt-1 text-sm text-gray-500">Current: {{ basename($profile->certificate_path) }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
