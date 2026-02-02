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

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2); // meter
    }


    public function checkin(Request $request)
    {
        $request->validate([
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
        ]);

        $user = auth()->user();
        $today = today();

        // Cegah absen dobel
        $existing = Attendance::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        if ($existing && $existing->check_in) {
            return back()->with('error', 'Anda sudah melakukan absen hari ini.');
        }

        // Ambil jadwal hari ini
        $schedule = Schedule::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->with('locations')
            ->first();

        if (!$schedule || $schedule->locations->isEmpty()) {
            return back()->with('error', 'Lokasi magang belum ditentukan untuk jadwal hari ini.');
        }

        // Cari lokasi terdekat / yang validd
        $nearestLocation = null;
        $minDistance = INF;
        $validLocation = null;

        foreach ($schedule->locations as $loc) {
            $dist = $this->calculateDistance(
                $request->latitude,
                $request->longitude,
                $loc->latitude ?? 0, // Fallback if lat is null
                $loc->longitude ?? 0
            );

            // Jika masuk radius, prioritas pilih ini
            if ($dist <= ($loc->radius ?? 100)) {
                $validLocation = $loc;
                $minDistance = $dist;
                break; 
            }

            if ($dist < $minDistance) {
                $minDistance = $dist;
                $nearestLocation = $loc;
            }
        }

        $targetLocation = $validLocation ?? $nearestLocation;
        $distance = $minDistance;

        if (!$targetLocation) {
            return back()->with('error', 'Data lokasi tidak valid.');
        }

        // Tentukan status lokasi
        $radius = $targetLocation->radius ?? 100;
        $locationStatus = $distance <= $radius
            ? 'berada dilokasi magang'
            : 'diluar lokasi magang';

        // Check Late Status (Tolerance 15 minutes)
        $checkInTime = now();
        $scheduleStartTime = Carbon::parse($schedule->start_time); // From schedule
        $lateThreshold = $scheduleStartTime->copy()->addMinutes(15);

        $status = $checkInTime->gt($lateThreshold) ? 'terlambat' : 'hadir';

        Attendance::updateOrCreate(
            [
                'user_id' => $user->id,
                'date' => $today,
            ],
            [
                'check_in' => $checkInTime,
                'status' => $status,
                'location_id' => $targetLocation->id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'distance' => $distance,
                'location_status' => $locationStatus,
            ]
        );

        $message = "Absen berhasil di {$targetLocation->name}. Anda $locationStatus (jarak $distance meter).";

        return back()->with(
            $locationStatus === 'berada dilokasi magang' ? 'success' : 'warning',
            $message
        );
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
                ->with('error', 'Anda belum melakukan absen hari ini.');
        }

        if ($attendance->check_out) {
            return redirect()->back()
                ->with('error', 'Anda sudah melakukan absen hari ini.');
        }

        $attendance->update([
            'check_out' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Absen pulang berhasil. Terima kasih atas kerja kerasnya!');
    }
}

