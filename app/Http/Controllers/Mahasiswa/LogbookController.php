<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function index()
    {
        $logbooks = Logbook::where('user_id', auth()->id())
            ->latest('date')
            ->paginate(15);

        return view('mahasiswa.logbooks.index', compact('logbooks'));
    }

    public function create()
    {
        return view('mahasiswa.logbooks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required', 'date'],
            'activity' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $user = auth()->user();

        // Auto-fill time from schedule
        $schedule = \App\Models\Schedule::where('user_id', $user->id)
            ->whereDate('date', '=', $request->date)
            ->first();

        $startTime = $schedule ? $schedule->start_time : '08:00:00';
        $endTime = $schedule ? $schedule->end_time : '17:00:00';

        Logbook::create([
            ...$validated,
            'user_id' => $user->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => 'pending',
        ]);

        return redirect()->route('mahasiswa.logbooks.index')
            ->with('success', 'Logbook berhasil ditambahkan dan menunggu persetujuan.');
    }

    public function show(Logbook $logbook)
    {
        if ($logbook->user_id !== auth()->id()) {
            abort(403);
        }

        $logbook->load('approver');
        return view('mahasiswa.logbooks.show', compact('logbook'));
    }

    public function edit(Logbook $logbook)
    {
        if ($logbook->user_id !== auth()->id()) {
            abort(403);
        }

        if ($logbook->isApproved()) {
            return redirect()->route('mahasiswa.logbooks.index')
                ->with('error', 'Logbook yang sudah disetujui tidak dapat diedit.');
        }

        return view('mahasiswa.logbooks.edit', compact('logbook'));
    }

    public function update(Request $request, Logbook $logbook)
    {
        if ($logbook->user_id !== auth()->id()) {
            abort(403);
        }

        if ($logbook->isApproved()) {
            return redirect()->route('mahasiswa.logbooks.index')
                ->with('error', 'Logbook yang sudah disetujui tidak dapat diedit.');
        }

        $validated = $request->validate([
            'date' => ['required', 'date'],
            'activity' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        // Auto-update time if date changes (or check schedule for that date)
        $schedule = \App\Models\Schedule::where('user_id', auth()->id())
            ->whereDate('date', '=', $request->date)
            ->first();

        $startTime = $schedule ? $schedule->start_time : '08:00:00';
        $endTime = $schedule ? $schedule->end_time : '17:00:00';

        $logbook->update([
            ...$validated,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        return redirect()->route('mahasiswa.logbooks.index')
            ->with('success', 'Logbook berhasil diperbarui.');
    }

    public function destroy(Logbook $logbook)
    {
        if ($logbook->user_id !== auth()->id()) {
            abort(403);
        }

        if ($logbook->isApproved()) {
            return redirect()->route('mahasiswa.logbooks.index')
                ->with('error', 'Logbook yang sudah disetujui tidak dapat dihapus.');
        }

        $logbook->delete();

        return redirect()->route('mahasiswa.logbooks.index')
            ->with('success', 'Logbook berhasil dihapus.');
    }
}

