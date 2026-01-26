<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = User::where('role', 'mahasiswa')
            ->latest()
            ->paginate(15);

        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'nim' => ['nullable', 'string', 'max:20'],
            'institution' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'mahasiswa';

        User::create($validated);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(User $mahasiswa)
    {
        $mahasiswa->load(['attendances', 'logbooks', 'schedules', 'assessments']);
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(User $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, User $mahasiswa)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $mahasiswa->id],
            'nim' => ['nullable', 'string', 'max:20'],
            'institution' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->validate([
                'password' => ['required', 'confirmed', Password::defaults()],
            ])['password']);
        }

        $mahasiswa->update($validated);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(User $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}

