@extends('layouts.app')

@section('title', 'Tambah Division')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow border border-gray-200">

    <!-- HEADER -->
    <div class="border-b px-6 py-4">
        <h2 class="text-lg font-semibold text-gray-800">Tambah Divisi</h2>
    </div>

    <!-- BODY -->
    <div class="p-6">
        <form method="POST" action="{{ route('admin.divisions.store') }}" class="space-y-5">
            @csrf

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Division <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 rounded border border-gray-300" required>
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" class="w-full px-4 py-2 rounded border border-gray-300">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ACTION -->
            <div class="flex justify-between">
                <a href="{{ route('admin.divisions.index') }}" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-5 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
            </div>

        </form>
    </div>
</div>
@endsection
