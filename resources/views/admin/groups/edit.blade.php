@extends('layouts.app')

@section('title', 'Edit Kelompok')

@section('content')
<div
    x-data="{ search: '' }"
    class="max-w-4xl mx-auto bg-white rounded-lg shadow border border-gray-200"
>

    <!-- HEADER -->
    <div class="border-b px-6 py-4">
        <h2 class="text-lg font-bold text-gray-800">Edit Kelompok</h2>
    </div>

    <!-- BODY -->
    <div class="p-6">
        <form method="POST" action="{{ route('admin.groups.update', $group) }}">
            @csrf
            @method('PUT')

            <!-- NAMA -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">
                    Nama Kelompok <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $group->name) }}"
                    required
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                >
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- DESKRIPSI -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Deskripsi</label>
                <textarea
                    name="description"
                    rows="3"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                >{{ old('description', $group->description) }}</textarea>
            </div>

            <!-- STATUS -->
            <div class="mb-6">
                <label class="inline-flex items-center gap-2">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $group->is_active) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    >
                    <span class="text-sm">Aktif</span>
                </label>
            </div>

            <hr class="my-6">

            <!-- SEARCH BAR -->
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">
                    Cari Peserta
                </label>
                <input
                    type="text"
                    x-model="search"
                    placeholder="Cari nama, email, atau NIM..."
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                >
            </div>

            <!-- LIST MAHASISWA -->
            <div class="border rounded max-h-[320px] overflow-y-auto p-3 space-y-2">
                @forelse($availableMahasiswa as $mahasiswa)
                <label
                    x-show="
                        '{{ strtolower($mahasiswa->name.' '.$mahasiswa->email.' '.$mahasiswa->nim) }}'
                        .includes(search.toLowerCase())
                    "
                    class="flex items-start gap-3 rounded p-3 hover:bg-gray-50 cursor-pointer border"
                >
                    <input
                        type="checkbox"
                        name="user_ids[]"
                        value="{{ $mahasiswa->id }}"
                        class="mt-1 rounded border-gray-300 text-blue-600"
                        {{ (old('user_ids') ? in_array($mahasiswa->id, old('user_ids')) : $mahasiswa->group_id == $group->id) ? 'checked' : '' }}
                    >

                    <div class="text-sm">
                        <p class="font-semibold text-gray-800">
                            {{ $mahasiswa->name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $mahasiswa->email }}
                            @if($mahasiswa->nim)
                                • NIM: {{ $mahasiswa->nim }}
                            @endif
                        </p>

                        <div class="mt-1">
                            @if($mahasiswa->group_id == $group->id)
                                <span class="inline-block rounded bg-green-100 px-2 py-0.5 text-xs text-green-700">
                                    Anggota saat ini
                                </span>
                            @elseif($mahasiswa->group_id)
                                <span class="inline-block rounded bg-yellow-100 px-2 py-0.5 text-xs text-yellow-700">
                                    Kelompok lain
                                </span>
                            @endif
                        </div>
                    </div>
                </label>
                @empty
                    <p class="text-sm text-gray-500 text-center">
                        Tidak ada mahasiswa tersedia
                    </p>
                @endforelse
            </div>

            <!-- ACTION -->
            <div class="flex justify-between items-center mt-6">
                <a href="javascript:void(0);" onclick="window.history.back();"
                    class="rounded bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600">
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
