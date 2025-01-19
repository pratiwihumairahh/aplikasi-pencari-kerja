<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $profile = auth()->user()->profile;
        return view('user.documents.index', compact('profile'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'document_type' => 'required|in:photo,id_card,certificate,work_experience',
            'document' => 'required|file|max:2048',
        ]);

        $profile = auth()->user()->profile;
        if (!$profile) {
            return redirect()->back()->with('error', 'Please complete your profile first');
        }

        $file = $request->file('document');
        $type = $request->document_type;

        // Validate file type based on document type
        switch ($type) {
            case 'photo':
                $this->validate($request, [
                    'document' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $path = 'profile-photos';
                $field = 'photo_path';
                break;
            case 'id_card':
                $this->validate($request, [
                    'document' => 'mimes:pdf,jpg,jpeg,png|max:2048',
                ]);
                $path = 'id-cards';
                $field = 'id_card_path';
                break;
            case 'certificate':
                $this->validate($request, [
                    'document' => 'mimes:pdf|max:2048',
                ]);
                $path = 'certificates';
                $field = 'certificate_path';
                break;
            case 'work_experience':
                $this->validate($request, [
                    'document' => 'mimes:pdf|max:2048',
                ]);
                $path = 'work-experience';
                $field = 'work_experience_path';
                break;
        }

        // Delete old file if exists
        if ($profile->$field) {
            Storage::delete($profile->$field);
        }

        // Store new file
        $profile->$field = $file->store("public/{$path}");
        $profile->save();

        return redirect()->back()->with('success', 'Document uploaded successfully');
    }

    public function download($type)
    {
        $profile = auth()->user()->profile;
        if (!$profile) {
            return redirect()->back()->with('error', 'Profile not found');
        }

        $field = null;
        switch ($type) {
            case 'photo':
                $field = 'photo_path';
                break;
            case 'id_card':
                $field = 'id_card_path';
                break;
            case 'certificate':
                $field = 'certificate_path';
                break;
            case 'work_experience':
                $field = 'work_experience_path';
                break;
            default:
                return redirect()->back()->with('error', 'Invalid document type');
        }

        if (!$profile->$field || !Storage::exists($profile->$field)) {
            return redirect()->back()->with('error', 'Document not found');
        }

        return Storage::download($profile->$field);
    }
}
