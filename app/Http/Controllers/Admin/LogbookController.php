<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function index(Request $request)
    {
        // View Detail Per User (if user_id is present)
        if ($request->filled('user_id')) {
            $query = Logbook::with('user');

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('user_id')) {
                $query->where('user_id', $request->user_id);
            }

            $logbooks = $query->latest('date')->paginate(15);
            $selectedUser = \App\Models\User::find($request->user_id);

            return view('admin.logbooks.detail', compact('logbooks', 'selectedUser'));
        }

        // View Summary List (Group by User)
        $query = \App\Models\User::where('role', 'mahasiswa');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $query->withCount([
            'logbooks as total_logbooks',
            'logbooks as pending_logbooks' => function ($q) {
                $q->where('status', 'pending');
            }
        ])->paginate(15);

        return view('admin.logbooks.index', compact('users'));
    }

    public function show(Logbook $logbook)
    {
        $logbook->load(['user', 'approver']);
        return view('admin.logbooks.show', compact('logbook'));
    }

    public function approve(Request $request, Logbook $logbook)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:approved,rejected'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $logbook->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? null,
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        $statusText = $validated['status'] === 'approved' ? 'disetujui' : 'ditolak';

        return redirect()->route('admin.logbooks.index')
            ->with('success', "Logbook berhasil {$statusText}.");
    }
}

