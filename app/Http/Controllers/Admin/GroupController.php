<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::withCount('users')
            ->latest()
            ->paginate(15);

        return view('admin.groups.index', compact('groups'));
    }

    public function create()
    {
        $availableMahasiswa = User::where('role', 'mahasiswa')
            ->whereNull('group_id')
            ->get();

        return view('admin.groups.create', compact('availableMahasiswa'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:groups,name'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'user_ids' => ['nullable', 'array'],
            'user_ids.*' => ['exists:users,id'],
        ]);

        $group = Group::create($validated);

        // Tambahkan mahasiswa ke kelompok jika dipilih
        if ($request->has('user_ids') && !empty($request->user_ids)) {
            User::whereIn('id', $request->user_ids)
                ->where('role', 'mahasiswa')
                ->whereNull('group_id')
                ->update(['group_id' => $group->id]);
        }

        return redirect()->route('admin.groups.index')
            ->with('success', 'Kelompok berhasil ditambahkan.');
    }

    public function show(Group $group)
    {
        $group->load('users');
        $availableMahasiswa = User::where('role', 'mahasiswa')
            ->where(function ($query) use ($group) {
                $query->whereNull('group_id')
                      ->orWhere('group_id', $group->id);
            })
            ->get();

        return view('admin.groups.show', compact('group', 'availableMahasiswa'));
    }

    public function edit(Group $group)
    {
        $group->load('users');
        $availableMahasiswa = User::where('role', 'mahasiswa')
            ->where(function ($query) use ($group) {
                $query->whereNull('group_id')
                      ->orWhere('group_id', $group->id);
            })
            ->get();

        return view('admin.groups.edit', compact('group', 'availableMahasiswa'));
    }

    public function update(Request $request, Group $group)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:groups,name,' . $group->id],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'user_ids' => ['nullable', 'array'],
            'user_ids.*' => ['exists:users,id'],
        ]);

        $group->update($validated);

        // Update anggota kelompok
        if ($request->has('user_ids')) {
            $selectedUserIds = $request->user_ids ?? [];
            
            // Hapus semua anggota yang tidak dipilih
            $group->users()->whereNotIn('id', $selectedUserIds)->update(['group_id' => null]);
            
            // Tambahkan anggota baru yang dipilih (termasuk yang pindah dari kelompok lain)
            User::whereIn('id', $selectedUserIds)
                ->where('role', 'mahasiswa')
                ->update(['group_id' => $group->id]);
        } else {
            // Jika tidak ada yang dipilih, hapus semua anggota
            $group->users()->update(['group_id' => null]);
        }

        return redirect()->route('admin.groups.index')
            ->with('success', 'Kelompok berhasil diperbarui.');
    }

    public function destroy(Group $group)
    {
        // Set group_id menjadi null untuk semua user di kelompok ini
        $group->users()->update(['group_id' => null]);
        
        $group->delete();

        return redirect()->route('admin.groups.index')
            ->with('success', 'Kelompok berhasil dihapus.');
    }

    public function addMember(Request $request, Group $group)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $user = User::findOrFail($validated['user_id']);
        
        // Cek apakah user sudah ada di kelompok lain
        if ($user->group_id && $user->group_id != $group->id) {
            return back()
                ->withErrors(['user_id' => 'Mahasiswa ini sudah berada di kelompok lain.']);
        }

        $user->update(['group_id' => $group->id]);

        return back()
            ->with('success', 'Mahasiswa berhasil ditambahkan ke kelompok.');
    }

    public function removeMember(Group $group, User $user)
    {
        if ($user->group_id != $group->id) {
            return back()
                ->withErrors(['error' => 'Mahasiswa tidak berada di kelompok ini.']);
        }

        $user->update(['group_id' => null]);

        return back()
            ->with('success', 'Mahasiswa berhasil dikeluarkan dari kelompok.');
    }
}

