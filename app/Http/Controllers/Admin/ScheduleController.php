<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['user.group', 'location'])
            ->latest('date')
            ->paginate(15);

        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->with('group')->get();
        $locations = Location::where('is_active', true)->get();

        return view('admin.schedules.create', compact('mahasiswa', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'notes' => ['nullable', 'string'],
        ]);

        $user = User::findOrFail($validated['user_id']);
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        
        $createdSchedules = [];
        $skippedDates = [];
        $conflictDates = [];

        // Generate jadwal untuk setiap hari kerja dalam range
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dayOfWeek = $currentDate->dayOfWeek; // 0 = Minggu, 1 = Senin, ..., 6 = Sabtu
            
            // Skip Sabtu (6) dan Minggu (0)
            if ($dayOfWeek == 0 || $dayOfWeek == 6) {
                $currentDate->addDay();
                continue;
            }

            // Tentukan waktu berdasarkan hari
            if ($dayOfWeek == 5) { // Jumat
                $startTime = '07:30';
                $endTime = '15:00';
            } else { // Senin-Kamis (1-4)
                $startTime = '08:00';
                $endTime = '16:00';
            }

            // Validasi: Cek apakah sudah ada kelompok lain di lokasi yang sama pada tanggal yang sama
            if ($user->group_id) {
                $conflictingSchedule = Schedule::where('location_id', $validated['location_id'])
                    ->where('date', $currentDate->format('Y-m-d'))
                    ->whereHas('user', function ($query) use ($user) {
                        $query->where('group_id', '!=', $user->group_id)
                              ->whereNotNull('group_id');
                    })
                    ->first();

                if ($conflictingSchedule) {
                    $conflictDates[] = $currentDate->format('d/m/Y');
                    $currentDate->addDay();
                    continue;
                }
            }

            // Cek apakah jadwal sudah ada untuk user ini di tanggal yang sama
            $existingSchedule = Schedule::where('user_id', $validated['user_id'])
                ->where('date', $currentDate->format('Y-m-d'))
                ->first();

            if ($existingSchedule) {
                $skippedDates[] = $currentDate->format('d/m/Y');
                $currentDate->addDay();
                continue;
            }

            // Buat jadwal
            $schedule = Schedule::create([
                'user_id' => $validated['user_id'],
                'location_id' => $validated['location_id'],
                'date' => $currentDate->format('Y-m-d'),
                'start_time' => $startTime,
                'end_time' => $endTime,
                'notes' => $validated['notes'] ?? null,
            ]);

            $createdSchedules[] = $schedule;
            $currentDate->addDay();
        }

        // Buat pesan sukses dengan informasi detail
        $message = "Jadwal berhasil dibuat untuk " . count($createdSchedules) . " hari kerja.";
        
        if (!empty($skippedDates)) {
            $message .= " " . count($skippedDates) . " tanggal dilewati (sudah ada jadwal): " . implode(', ', $skippedDates) . ".";
        }
        
        if (!empty($conflictDates)) {
            $message .= " " . count($conflictDates) . " tanggal konflik dengan kelompok lain: " . implode(', ', $conflictDates) . ".";
        }

        if (empty($createdSchedules)) {
            return back()
                ->withInput()
                ->withErrors([
                    'start_date' => 'Tidak ada jadwal yang bisa dibuat. Semua tanggal sudah terisi atau konflik dengan kelompok lain.'
                ]);
        }

        return redirect()->route('admin.schedules.index')
            ->with('success', $message);
    }

    public function edit(Schedule $schedule)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->with('group')->get();
        $locations = Location::where('is_active', true)->get();

        return view('admin.schedules.edit', compact('schedule', 'mahasiswa', 'locations'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'notes' => ['nullable', 'string'],
        ]);

        // Validasi: Cek apakah sudah ada kelompok lain di lokasi yang sama pada tanggal yang sama
        $user = User::findOrFail($validated['user_id']);
        
        if ($user->group_id) {
            $conflictingSchedule = Schedule::where('location_id', $validated['location_id'])
                ->where('date', $validated['date'])
                ->where('id', '!=', $schedule->id) // Exclude current schedule
                ->whereHas('user', function ($query) use ($user) {
                    $query->where('group_id', '!=', $user->group_id)
                          ->whereNotNull('group_id');
                })
                ->first();

            if ($conflictingSchedule) {
                $conflictingGroup = $conflictingSchedule->user->group;
                return back()
                    ->withInput()
                    ->withErrors([
                        'location_id' => "Lokasi ini sudah ditempati oleh {$conflictingGroup->name} pada tanggal yang sama. Silakan pilih lokasi atau tanggal lain."
                    ]);
            }
        }

        $schedule->update($validated);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}

