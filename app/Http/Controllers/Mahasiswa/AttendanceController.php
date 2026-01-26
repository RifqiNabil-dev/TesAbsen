<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::where('user_id', auth()->id())
            ->with('location')
            ->latest('date')
            ->paginate(15);

        return view('mahasiswa.attendance.index', compact('attendances'));
    }

    public function checkin(Request $request)
    {
        $user = auth()->user();
        $today = today();

        // Check if already checked in today
        $existing = Attendance::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        if ($existing && $existing->check_in) {
            return redirect()->back()
                ->with('error', 'Anda sudah melakukan check-in hari ini.');
        }

        // Get today's schedule
        $schedule = Schedule::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        $checkInTime = now();
        $status = 'hadir';

        // Check if late (after 08:00)
        if ($checkInTime->format('H:i') > '08:00') {
            $status = 'terlambat';
        }

        if ($existing) {
            $existing->update([
                'check_in' => $checkInTime,
                'status' => $status,
                'location_id' => $schedule?->location_id,
            ]);
        } else {
            Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'check_in' => $checkInTime,
                'status' => $status,
                'location_id' => $schedule?->location_id,
            ]);
        }

        return redirect()->back()
            ->with('success', 'Check-in berhasil. Selamat bekerja!');
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();
        $today = today();

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        if (!$attendance || !$attendance->check_in) {
            return redirect()->back()
                ->with('error', 'Anda belum melakukan check-in hari ini.');
        }

        if ($attendance->check_out) {
            return redirect()->back()
                ->with('error', 'Anda sudah melakukan check-out hari ini.');
        }

        $attendance->update([
            'check_out' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Check-out berhasil. Terima kasih atas kerja kerasnya!');
    }
}

