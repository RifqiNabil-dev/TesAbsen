<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Assessment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $mahasiswa = User::where('role', 'mahasiswa')
            ->withCount(['attendances', 'logbooks'])
            ->latest()
            ->get();

        return view('admin.reports.index', compact('mahasiswa'));
    }

    public function show(User $user)
    {
        $user->load(['attendances', 'logbooks', 'schedules.locations', 'assessments.assessor']);
        
        $totalAttendance = $user->attendances()->where('status', 'hadir')->count();
        $totalLate = $user->attendances()->where('status', 'terlambat')->count();
        $totalAbsent = $user->attendances()->where('status', 'tidak_hadir')->count();
        $totalLogbooks = $user->logbooks()->where('status', 'approved')->count();
        
        $latestAssessment = $user->assessments()->latest()->first();

        return view('admin.reports.show', compact(
            'user',
            'totalAttendance',
            'totalLate',
            'totalAbsent',
            'totalLogbooks',
            'latestAssessment'
        ));
    }

    public function storeAssessment(Request $request, User $user)
    {
        $validated = $request->validate([
            'attendance_score' => ['required', 'integer', 'min:0', 'max:20'],
            'discipline_score' => ['required', 'integer', 'min:0', 'max:20'],
            'performance_score' => ['required', 'integer', 'min:0', 'max:20'],
            'initiative_score' => ['required', 'integer', 'min:0', 'max:20'],
            'cooperation_score' => ['required', 'integer', 'min:0', 'max:20'],
            'strengths' => ['nullable', 'string'],
            'weaknesses' => ['nullable', 'string'],
            'recommendations' => ['nullable', 'string'],
        ]);

        Assessment::create([
            ...$validated,
            'user_id' => $user->id,
            'assessed_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.reports.show', $user)
            ->with('alert', 'assessment_saved');

    }
    public function edit(User $user)
    {
        $latestAssessment = $user->assessments()->latest()->first();

        if (!$latestAssessment) {
            return redirect()
                ->route('admin.reports.show', $user)
                ->with('error', 'Penilaian belum tersedia.');
        }

        // Ambil statistik
        $totalAttendance = $user->attendances()->where('status', 'hadir')->count();
        $totalLate       = $user->attendances()->where('status', 'terlambat')->count();
        $totalAbsent     = $user->attendances()->where('status', 'tidak_hadir')->count();
        $totalLogbooks   = $user->logbooks()->where('status', 'approved')->count();

        return view('admin.reports.edit', compact(
            'user',
            'latestAssessment',
            'totalAttendance',
            'totalLate',
            'totalAbsent',
            'totalLogbooks'
        ));
    }

    public function update(Request $request, User $user)
    {
        $assessment = $user->assessments()->latest()->first();

        if (!$assessment) {
            return redirect()
                ->route('admin.reports.show', $user)
                ->with('error', 'Penilaian tidak ditemukan.');
        }

        $validated = $request->validate([
            'attendance_score' => ['required', 'integer', 'min:0', 'max:20'],
            'discipline_score' => ['required', 'integer', 'min:0', 'max:20'],
            'performance_score' => ['required', 'integer', 'min:0', 'max:20'],
            'initiative_score' => ['required', 'integer', 'min:0', 'max:20'],
            'cooperation_score' => ['required', 'integer', 'min:0', 'max:20'],
            'strengths' => ['nullable', 'string'],
            'weaknesses' => ['nullable', 'string'],
            'recommendations' => ['nullable', 'string'],
        ]);

        $assessment->update($validated);

        return redirect()
            ->route('admin.reports.edit', $user)
            ->with('alert', 'assessment_updated');
    }
}

