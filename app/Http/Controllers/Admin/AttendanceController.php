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
        // View Detail Per User (if user_id is present)
        if ($request->filled('user_id')) {
            $query = Attendance::where('user_id', $request->user_id)
                ->with(['user', 'location']);

            if ($request->filled('date')) {
                $query->whereDate('date', $request->date);
            }

            $attendances = $query->latest('date')->paginate(15);
            $selectedUser = User::find($request->user_id);

            return view('admin.attendance.detail', compact('attendances', 'selectedUser'));
        }

        // View Summary List (Group by User) - Default
        // Logic: Get Users with role mahasiswa and count their stats
        // To be simpler, we just pass the users list, and stats can be calculated or just simple list
        $query = User::where('role', 'mahasiswa');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $query->withCount([
            'attendances as total_attendances',
            'attendances as today_attendance' => function ($q) {
                $q->whereDate('date', today());
            }
        ])->paginate(15);

        return view('admin.attendance.index', compact('users'));
    }

    public function show(Attendance $attendance)
    {
        $attendance->load(['user', 'location']);
        return view('admin.attendance.show', compact('attendance'));
    }


}

