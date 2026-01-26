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
        $user->load(['attendances', 'logbooks', 'schedules.location', 'assessments.assessor']);
        
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

        return redirect()->route('admin.reports.show', $user)
            ->with('success', 'Penilaian berhasil disimpan.');
    }
}

