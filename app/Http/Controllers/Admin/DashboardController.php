<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Logbook;
use App\Models\Location;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalLocations = Location::where('is_active', true)->count();
        
        $todayAttendances = Attendance::whereDate('date', today())->count();
        $pendingLogbooks = Logbook::where('status', 'pending')->count();
        
        $recentAttendances = Attendance::with(['user', 'location'])
            ->whereDate('date', today())
            ->latest()
            ->take(10)
            ->get();
        
        $recentLogbooks = Logbook::with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'totalLocations',
            'todayAttendances',
            'pendingLogbooks',
            'recentAttendances',
            'recentLogbooks'
        ));
    }
}

