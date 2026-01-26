<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function index(Request $request)
    {
        $query = Logbook::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $logbooks = $query->latest('date')->paginate(15);

        return view('admin.logbooks.index', compact('logbooks'));
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

