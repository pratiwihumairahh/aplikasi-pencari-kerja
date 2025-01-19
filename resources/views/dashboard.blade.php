@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
        
        @if(auth()->user()->profile)
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-3">Kartu Pencari Kerja Status</h3>
                <div class="bg-gray-100 p-4 rounded">
                    <p class="mb-2">Status: 
                        <span class="font-medium 
                            @if(auth()->user()->profile->status === 'approved')
                                text-green-600
                            @elseif(auth()->user()->profile->status === 'rejected')
                                text-red-600
                            @else
                                text-yellow-600
                            @endif
                        ">
                            {{ ucfirst(auth()->user()->profile->status) }}
                        </span>
                    </p>
                    @if(auth()->user()->profile->status === 'approved')
                        <p class="mb-2">Card Number: {{ auth()->user()->profile->card_number }}</p>
                        <a href="#" class="text-blue-500 hover:text-blue-700">Download Card</a>
                    @elseif(auth()->user()->profile->status === 'rejected')
                        <p class="text-red-600">Reason: {{ auth()->user()->profile->rejection_reason }}</p>
                    @else
                        <p>Your application is being reviewed</p>
                    @endif
                </div>
            </div>
        @else
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6">
                <p>You haven't submitted your job seeker card application yet.</p>
                <a href="#" class="text-blue-500 hover:text-blue-700 mt-2 inline-block">Apply Now</a>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-100 p-4 rounded">
                <h3 class="text-lg font-semibold mb-3">Personal Information</h3>
                <p class="mb-2">Name: {{ auth()->user()->name }}</p>
                <p class="mb-2">NIK: {{ auth()->user()->nik }}</p>
                <p class="mb-2">Email: {{ auth()->user()->email }}</p>
                <p>Phone: {{ auth()->user()->phone }}</p>
            </div>

            <div class="bg-gray-100 p-4 rounded">
                <h3 class="text-lg font-semibold mb-3">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-blue-500 hover:text-blue-700">Update Profile</a></li>
                    <li><a href="#" class="text-blue-500 hover:text-blue-700">View Work Experience</a></li>
                    <li><a href="#" class="text-blue-500 hover:text-blue-700">Upload Documents</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
