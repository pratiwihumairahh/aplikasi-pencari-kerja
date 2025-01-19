<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $profile = $user->profile;
        $experiences = $user->workExperiences;
        
        return view('user.dashboard', compact('user', 'profile', 'experiences'));
    }
}
