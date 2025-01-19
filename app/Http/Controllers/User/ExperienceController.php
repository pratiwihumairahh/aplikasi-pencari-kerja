<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = auth()->user()->workExperiences()->orderBy('start_date', 'desc')->get();
        return view('user.experience.index', compact('experiences'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'company_name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'is_current_job' => 'required|in:0,1',
                'job_description' => 'required|string',
            ]);

            Log::info('Validated data:', $validated);

            // Parse dates to ensure correct format
            $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
            $endDate = $request->is_current_job == "1" ? null : 
                      ($request->end_date ? Carbon::parse($request->end_date)->format('Y-m-d') : null);

            $experience = new WorkExperience();
            $experience->user_id = auth()->id();
            $experience->company_name = $request->company_name;
            $experience->position = $request->position;
            $experience->start_date = $startDate;
            $experience->end_date = $endDate;
            $experience->is_current_job = $request->is_current_job == "1";
            $experience->job_description = $request->job_description;

            Log::info('Saving experience:', [
                'user_id' => $experience->user_id,
                'data' => $experience->toArray()
            ]);

            $experience->save();

            return redirect()
                ->route('user.experience.index')
                ->with('success', 'Pengalaman kerja berhasil ditambahkan');

        } catch (\Exception $e) {
            Log::error('Error saving experience:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, WorkExperience $experience)
    {
        $this->authorize('update', $experience);

        try {
            $validated = $request->validate([
                'company_name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'is_current_job' => 'required|in:0,1',
                'job_description' => 'required|string',
            ]);

            // Parse dates to ensure correct format
            $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
            $endDate = $request->is_current_job == "1" ? null : 
                      ($request->end_date ? Carbon::parse($request->end_date)->format('Y-m-d') : null);

            $experience->company_name = $request->company_name;
            $experience->position = $request->position;
            $experience->start_date = $startDate;
            $experience->end_date = $endDate;
            $experience->is_current_job = $request->is_current_job == "1";
            $experience->job_description = $request->job_description;
            $experience->save();

            return redirect()
                ->route('user.experience.index')
                ->with('success', 'Pengalaman kerja berhasil diperbarui');

        } catch (\Exception $e) {
            Log::error('Error updating experience:', [
                'id' => $experience->id,
                'message' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui pengalaman kerja');
        }
    }

    public function destroy(WorkExperience $experience)
    {
        try {
            $this->authorize('delete', $experience);
            $experience->delete();

            return redirect()
                ->route('user.experience.index')
                ->with('success', 'Pengalaman kerja berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting experience:', [
                'id' => $experience->id,
                'message' => $e->getMessage()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus pengalaman kerja');
        }
    }
}
