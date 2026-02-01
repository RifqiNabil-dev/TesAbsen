<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => ['required', 'in:admin,mahasiswa'],
        ]);

        $user->update($validated);

        return redirect()
            ->route('admin.users.edit', $user)
            ->with('alert', 'updated');
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
                return redirect()
                    ->route('admin.users.index')
                    ->with('alert', 'error');
            }

            $user->delete();

            return redirect()
                ->route('admin.users.index')
                ->with('alert', 'success');
    }
}
