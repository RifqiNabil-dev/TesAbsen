<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Location;
use App\Models\Group;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {

        if ($request->filled('group_id') && is_numeric($request->group_id)) {
            $group = Group::findOrFail($request->group_id);

            $query = Schedule::whereHas('user', function ($q) use ($group) {
                $q->where('group_id', $group->id);
            })->with(['user', 'locations'])->latest('date');

            if ($request->filled('user_id')) {
                $query->where('user_id', $request->user_id);
            }

            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('date', [$request->start_date, $request->end_date]);
            }

            $schedules = $query->paginate(20);
            $usersInGroup = $group->users;

            return view('admin.schedules.detail', compact('schedules', 'group', 'usersInGroup'));
        }

        $query = Group::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $groups = $query->withCount('users')->paginate(15);

        return view('admin.schedules.index', compact('groups'));
    }

    public function print(Request $request)
    {
        $validated = $request->validate([
            'group_id' => ['required', 'exists:groups,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $group = Group::findOrFail($validated['group_id']);
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);

        $schedules = Schedule::with(['user', 'locations.division'])
            ->whereHas('user', function ($q) use ($group) {
                $q->where('group_id', $group->id);
            })
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->orderBy('user_id')
            ->orderBy('date')
            ->get();

        $data = [];
        $groupedByUser = $schedules->groupBy('user_id');

        foreach ($groupedByUser as $userId => $userSchedules) {
            $user = $userSchedules->first()->user;
            $userRows = [];

            $currentRange = null;

            foreach ($userSchedules as $schedule) {

                $locationNames = $schedule->locations->pluck('name')->implode(', ');

                if (!$currentRange) {
                    $currentRange = [
                        'start' => $schedule->date,
                        'end' => $schedule->date,
                        'location' => $locationNames
                    ];
                    continue;
                }

                if ($currentRange['location'] === $locationNames) {
                    $currentRange['end'] = $schedule->date;
                } else {
                    $userRows[] = $currentRange;
                    $currentRange = [
                        'start' => $schedule->date,
                        'end' => $schedule->date,
                        'location' => $locationNames
                    ];
                }
            }
            if ($currentRange) {
                $userRows[] = $currentRange;
            }

            $data[] = [
                'user' => $user,
                'rows' => $userRows
            ];
        }

        // Get unique division names from all locations involved
        $divisionNames = $schedules->flatMap(function ($schedule) {
            return $schedule->locations->pluck('division.name');
        })->unique()->filter()->implode(', ');

        // If multiple divisions, maybe show them all or handle accordingly. 
        // For now, joining them with commas.
        // If no division found (empty), you might want a default text.
        $divisionName = $divisionNames ?: 'BIDANG LAYANAN DAN PENGEMBANGAN PERPUSTAKAAN';

        return view('admin.schedules.print', compact('data', 'group', 'startDate', 'endDate', 'divisionName'));
    }


    public function create()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->with('group')->get();

        $locations = Location::where('is_active', true)->with('division')->get();

        return view('admin.schedules.create', compact('mahasiswa', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'location_ids' => ['required', 'array', 'min:1', 'max:3'], // 1 to 3 locations
            'location_ids.*' => ['exists:locations,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'notes' => ['nullable', 'string'],
        ]);

        $user = User::findOrFail($validated['user_id']);
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);

        $createdSchedules = [];
        $skippedDates = [];

        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dayOfWeek = $currentDate->dayOfWeek;

            if ($dayOfWeek == 0 || $dayOfWeek == 6) {
                $currentDate->addDay();
                continue;
            }

            if ($dayOfWeek == 5) {
                $startTime = '07:30';
                $endTime = '14:30';
            } else {
                $startTime = '08:00';
                $endTime = '15:30';
            }

            $conflicts = $this->checkConflicts($currentDate->format('Y-m-d'), $startTime, $endTime, $validated['location_ids']);
            if ($conflicts->isNotEmpty()) {

                $conflict = $conflicts->first();

                $conflictingLocationIds = $conflict->locations->pluck('id')->intersect($validated['location_ids']);
                $locationName = Location::whereIn('id', $conflictingLocationIds)->pluck('name')->implode(', ');

                $skippedDates[] = $currentDate->format('d/m/Y') . " (Lokasi $locationName digunakan oleh " . ($conflict->user->name ?? 'Mahasiswa') . ")";
                $currentDate->addDay();
                continue;
            }


            $existingSchedule = Schedule::where('user_id', $validated['user_id'])
                ->where('date', $currentDate->format('Y-m-d'))
                ->first();

            if ($existingSchedule) {
                $skippedDates[] = $currentDate->format('d/m/Y');
                $currentDate->addDay();
                continue;
            }

            $schedule = Schedule::create([
                'user_id' => $validated['user_id'],
                'date' => $currentDate->format('Y-m-d'),
                'start_time' => $startTime,
                'end_time' => $endTime,
                'notes' => $validated['notes'] ?? null,
            ]);

            $schedule->locations()->attach($validated['location_ids']);

            $createdSchedules[] = $schedule;
            $currentDate->addDay();
        }

        $message = "Jadwal berhasil dibuat untuk " . count($createdSchedules) . " hari kerja.";

        if (!empty($skippedDates)) {
            $message .= " " . count($skippedDates) . " tanggal dilewati: " . implode(', ', $skippedDates) . ".";
        }

        if (empty($createdSchedules)) {
            return back()
                ->withInput()
                ->withErrors([
                    'start_date' => 'Tidak ada jadwal yang bisa dibuat karena semua tanggal sudah terisi atau konflik.'
                ]);
        }

        return redirect()->route('admin.schedules.index')
            ->with('success', $message);
    }

    public function edit(Schedule $schedule)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->with('group')->get();
        $locations = Location::where('is_active', true)->with('division')->get();
        $schedule->load('locations'); // Load pivot data

        return view('admin.schedules.edit', compact('schedule', 'mahasiswa', 'locations'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'location_ids' => ['required', 'array', 'min:1', 'max:3'],
            'location_ids.*' => ['exists:locations,id'],
            'date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'notes' => ['nullable', 'string'],
        ]);

        // Validation Conflict for Update
        $conflicts = $this->checkConflicts(
            $validated['date'],
            $validated['start_time'],
            $validated['end_time'],
            $validated['location_ids'],
            $schedule->id
        );

        if ($conflicts->isNotEmpty()) {
            $conflict = $conflicts->first();
            $conflictingLocationIds = $conflict->locations->pluck('id')->intersect($validated['location_ids']);
            $locationName = Location::whereIn('id', $conflictingLocationIds)->pluck('name')->implode(', ');

            return back()
                ->withInput()
                ->withErrors([
                    'location_ids' => "Lokasi $locationName sudah digunakan oleh " . ($conflict->user->name ?? 'lain') . " pada tanggal dan waktu tersebut."
                ]);
        }

        $schedule->update([

            'user_id' => $validated['user_id'],
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'notes' => $validated['notes'] ?? null,
        ]);

        $schedule->locations()->sync($validated['location_ids']);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->back()
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['exists:schedules,id'],
        ]);

        Schedule::whereIn('id', $validated['ids'])->delete();

        return redirect()->back()
            ->with('success', count($validated['ids']) . ' Jadwal berhasil dihapus.');
    }


    private function checkConflicts($date, $startTime, $endTime, $locationIds, $excludeId = null)
    {
        return Schedule::where('date', $date)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime);
            })
            ->whereHas('locations', function ($q) use ($locationIds) {
                $q->whereIn('locations.id', $locationIds);
            })
            ->when($excludeId, function ($q) use ($excludeId) {
                $q->where('id', '!=', $excludeId);
            })
            ->with(['locations', 'user'])
            ->get();
    }
}
