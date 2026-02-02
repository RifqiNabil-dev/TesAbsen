<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Division;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::with('division')->latest()->paginate(15);
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        $divisions = Division::all();
        return view('admin.locations.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'radius' => ['required', 'integer'],
            'division_id' => ['required', 'exists:divisions,id'],
        ]);

        Location::create($validated);

        return redirect()->route('admin.locations.index')
            ->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit(Location $location)
    {
        $divisions = Division::all();
        return view('admin.locations.edit', compact('location', 'divisions'));
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'radius' => ['required', 'integer'],
            'division_id' => ['required', 'exists:divisions,id'],
        ]);

        $location->update($validated);

        return redirect()->route('admin.locations.index')
            ->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('admin.locations.index')
            ->with('success', 'Lokasi berhasil dihapus.');
    }
}

