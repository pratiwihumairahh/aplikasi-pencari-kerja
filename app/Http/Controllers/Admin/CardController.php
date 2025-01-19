<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobSeekerProfile;
use App\Models\User;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $profiles = JobSeekerProfile::with('user')
            ->latest()
            ->paginate(10);
            
        return view('admin.cards.index', compact('profiles'));
    }

    public function show(JobSeekerProfile $card)
    {
        return view('admin.cards.show', compact('card'));
    }

    public function approve(JobSeekerProfile $card)
    {
        $card->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return redirect()->route('admin.cards.index')
            ->with('success', 'Card application approved successfully');
    }

    public function reject(JobSeekerProfile $card)
    {
        $card->update([
            'status' => 'rejected',
            'rejected_at' => now(),
        ]);

        return redirect()->route('admin.cards.index')
            ->with('success', 'Card application rejected successfully');
    }
}
