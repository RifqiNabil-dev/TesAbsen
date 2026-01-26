<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Logbook;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $todayAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', today())
            ->first();
        
        $todaySchedule = Schedule::where('user_id', $user->id)
            ->whereDate('date', today())
            ->with('location')
            ->first();
        
        $recentAttendances = Attendance::where('user_id', $user->id)
            ->with('location')
            ->latest('date')
            ->take(7)
            ->get();
        
        $recentLogbooks = Logbook::where('user_id', $user->id)
            ->latest('date')
            ->take(5)
            ->get();
        
        $totalAttendance = Attendance::where('user_id', $user->id)
            ->where('status', 'hadir')
            ->count();
        
        $totalLogbooks = Logbook::where('user_id', $user->id)
            ->where('status', 'approved')
            ->count();

        return view('mahasiswa.dashboard', compact(
            'todayAttendance',
            'todaySchedule',
            'recentAttendances',
            'recentLogbooks',
            'totalAttendance',
            'totalLogbooks'
        ));
    }
}

