<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('user_id', Auth::id())
            ->with(['locations'])
            ->orderBy('date', 'desc')
            ->paginate(15);

        return view('mahasiswa.schedules.index', compact('schedules'));
    }
}
