@extends('layouts.app')

@section('title', 'Tambah Kelompok')

@section('content')
<div class="max-w-4xl space-y-4">

    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">
            ➕ Tambah Kelompok
        </h2>
    </div>

    <!-- CARD -->
    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="p-6 space-y-6">

            <form method="POST" action="{{ route('admin.groups.store') }}">
                @csrf

                <!-- NAMA KELOMPOK -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Kelompok <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full rounded border px-3 py-2 text-sm
                               focus:ring focus:ring-blue-200 focus:outline-none
                               @error('name') border-red-500 @else border-gray-300 @enderror"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- DESKRIPSI -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                               focus:ring focus:ring-blue-200 focus:outline-none"
                    >{{ old('description') }}</textarea>
                </div>

                <!-- STATUS AKTIF -->
                <div class="flex items-center gap-2">
                    <input
                        type="checkbox"
                        id="is_active"
                        name="is_active"
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    >
                    <label for="is_active" class="text-sm text-gray-700">
                        Aktif
                    </label>
                </div>

                <hr class="border-gray-200">

                <!-- PILIH MAHASISWA -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Peserta untuk Kelompok
                    </label>

                    <div class="max-h-72 overflow-y-auto rounded border border-gray-300 p-3 space-y-2">
                        @forelse($availableMahasiswa as $mahasiswa)
                            <label
                                for="user_{{ $mahasiswa->id }}"
                                class="flex items-start gap-3 rounded p-2 hover:bg-gray-50 cursor-pointer"
                            >
                                <input
                                    type="checkbox"
                                    name="user_ids[]"
                                    value="{{ $mahasiswa->id }}"
                                    id="user_{{ $mahasiswa->id }}"
                                    {{ in_array($mahasiswa->id, old('user_ids', [])) ? 'checked' : '' }}
                                    class="mt-1 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                >

                                <div class="text-sm">
                                    <p class="font-semibold text-gray-800">
                                        {{ $mahasiswa->name }}
                                    </p>
                                    <p class="text-gray-500">
                                        {{ $mahasiswa->email }}
                                    </p>
                                    @if($mahasiswa->nim)
                                        <p class="text-gray-500">
                                            NIM: {{ $mahasiswa->nim }}
                                        </p>
                                    @endif
                                </div>
                            </label>
                        @empty
                            <p class="text-sm text-gray-500">
                                Tidak ada mahasiswa yang tersedia (semua sudah terdaftar di kelompok lain)
                            </p>
                        @endforelse
                    </div>

                    <p class="mt-2 text-xs text-gray-500">
                        Pilih satu atau lebih mahasiswa untuk ditambahkan ke kelompok ini.
                    </p>
                </div>

                <!-- ACTION BUTTON -->
                <div class="flex justify-between pt-4">
                    <a href="{{ route('admin.groups.index') }}"
                       class="rounded bg-gray-500 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-600">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
