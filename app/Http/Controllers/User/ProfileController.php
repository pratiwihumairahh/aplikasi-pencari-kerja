<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JobSeekerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function create()
    {
        // Check if user already has a profile
        if (auth()->user()->profile) {
            return redirect()->route('user.profile.edit')
                ->with('error', 'Anda sudah memiliki profil. Silakan edit profil yang ada.');
        }

        return view('user.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'education_level' => 'required|string',
            'major' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1950|max:' . date('Y'),
            'photo' => 'required|image|max:2048',
            'id_card' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'certificate' => 'required|mimes:pdf|max:2048',
        ]);

        $profile = new JobSeekerProfile();
        $profile->user_id = auth()->id();
        $profile->place_of_birth = $request->place_of_birth;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->address = $request->address;
        $profile->education_level = $request->education_level;
        $profile->major = $request->major;
        $profile->institution = $request->institution;
        $profile->graduation_year = $request->graduation_year;

        // Handle file uploads
        if ($request->hasFile('photo')) {
            $profile->photo_path = $request->file('photo')->store('profile-photos');
        }

        if ($request->hasFile('id_card')) {
            $profile->id_card_path = $request->file('id_card')->store('id-cards');
        }

        if ($request->hasFile('certificate')) {
            $profile->certificate_path = $request->file('certificate')->store('certificates');
        }

        $profile->save();

        return redirect()->route('user.dashboard')
            ->with('success', 'Profil berhasil dibuat.');
    }

    public function edit()
    {
        $profile = auth()->user()->profile;
        
        // If user doesn't have a profile, redirect to create
        if (!$profile) {
            return redirect()->route('user.profile.create')
                ->with('error', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        return view('user.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'education_level' => 'required|string',
            'major' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1950|max:' . date('Y'),
            'photo' => 'nullable|image|max:2048',
            'id_card' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            'certificate' => 'nullable|mimes:pdf|max:2048',
        ]);

        $profile = auth()->user()->profile;
        $profile->place_of_birth = $request->place_of_birth;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->address = $request->address;
        $profile->education_level = $request->education_level;
        $profile->major = $request->major;
        $profile->institution = $request->institution;
        $profile->graduation_year = $request->graduation_year;

        // Handle file uploads
        if ($request->hasFile('photo')) {
            if ($profile->photo_path) {
                Storage::delete($profile->photo_path);
            }
            $profile->photo_path = $request->file('photo')->store('profile-photos');
        }

        if ($request->hasFile('id_card')) {
            if ($profile->id_card_path) {
                Storage::delete($profile->id_card_path);
            }
            $profile->id_card_path = $request->file('id_card')->store('id-cards');
        }

        if ($request->hasFile('certificate')) {
            if ($profile->certificate_path) {
                Storage::delete($profile->certificate_path);
            }
            $profile->certificate_path = $request->file('certificate')->store('certificates');
        }

        $profile->save();

        return redirect()->route('user.dashboard')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function downloadCard()
    {
        $user = auth()->user();
        $profile = $user->profile;

        if (!$profile) {
            return redirect()->route('user.profile.create')
                ->with('error', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        // TODO: Generate and download card
        return redirect()->back()->with('error', 'Fitur download kartu belum tersedia.');
    }
}
