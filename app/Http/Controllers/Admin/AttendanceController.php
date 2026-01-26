<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with(['user', 'location']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $attendances = $query->latest('date')->paginate(15);
        $mahasiswa = User::where('role', 'mahasiswa')->get();

        return view('admin.attendance.index', compact('attendances', 'mahasiswa'));
    }

    public function show(Attendance $attendance)
    {
        $attendance->load(['user', 'location']);
        return view('admin.attendance.show', compact('attendance'));
    }
}

