@extends('layouts.app')

@section('title', 'Edit Jadwal')

@section('content')
<div
    x-data="{ search: '' }"
    class="max-w-4xl mx-auto bg-white rounded-lg shadow border border-gray-200"
>

    <!-- HEADER -->
    <div class="border-b px-6 py-4">
        <h2 class="text-lg font-bold text-gray-800">Edit Jadwal</h2>
    </div>

    <!-- BODY -->
    <div class="p-6">
        <form method="POST" action="{{ route('admin.schedules.update', $schedule) }}">
            @csrf
            @method('PUT')

            <!-- MAHASISWA SEARCH -->
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-1">
                    Mahasiswa <span class="text-red-500">*</span>
                </label>

                <!-- SEARCH BAR -->
                <input
                    type="text"
                    x-model="search"
                    placeholder="Cari nama, email, atau kelompok..."
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200 mb-3"
                >

                <!-- LIST -->
                <div class="border rounded max-h-[300px] overflow-y-auto p-3 space-y-2">
                    @foreach($mahasiswa as $mhs)
                    <label
                        x-show="
                            '{{ strtolower($mhs->name.' '.$mhs->email.' '.($mhs->group->name ?? '')) }}'
                            .includes(search.toLowerCase())
                        "
                        class="flex items-start gap-3 rounded p-3 border
                               hover:bg-gray-50 cursor-pointer"
                    >
                        <input
                            type="radio"
                            name="user_id"
                            value="{{ $mhs->id }}"
                            required
                            class="mt-1 text-blue-600 focus:ring-blue-500"
                            {{ old('user_id', $schedule->user_id) == $mhs->id ? 'checked' : '' }}
                        >

                        <div class="text-sm">
                            <p class="font-semibold text-gray-800">
                                {{ $mhs->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $mhs->email }}
                                @if($mhs->group)
                                    • {{ $mhs->group->name }}
                                @endif
                            </p>
                        </div>
                    </label>
                    @endforeach
                </div>

                @error('user_id')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- LOKASI -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">
                    Lokasi <span class="text-red-500">*</span>
                </label>
                <select
                    name="location_id"
                    required
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200"
                >
                    <option value="">Pilih Lokasi</option>
                    @foreach($locations as $location)
                        <option
                            value="{{ $location->id }}"
                            {{ old('location_id', $schedule->location_id) == $location->id ? 'selected' : '' }}
                        >
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location_id')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- TANGGAL -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">
                    Tanggal <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="date"
                    required
                    value="{{ old('date', $schedule->date ? (is_string($schedule->date) ? \Carbon\Carbon::parse($schedule->date)->format('Y-m-d') : $schedule->date->format('Y-m-d')) : '') }}"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200 datepicker"
                    placeholder="Pilih tanggal"
                >
            </div>

            <!-- WAKTU -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                @php
                    $startTime = $schedule->start_time;
                    if (is_string($startTime)) {
                        $startTime = \Carbon\Carbon::parse($startTime)->format('H:i');
                    } elseif ($startTime instanceof \Carbon\Carbon) {
                        $startTime = $startTime->format('H:i');
                    }

                    $endTime = $schedule->end_time;
                    if (is_string($endTime)) {
                        $endTime = \Carbon\Carbon::parse($endTime)->format('H:i');
                    } elseif ($endTime instanceof \Carbon\Carbon) {
                        $endTime = $endTime->format('H:i');
                    }
                @endphp

                <div>
                    <label class="block text-sm font-semibold mb-1">
                        Waktu Mulai <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="time"
                        name="start_time"
                        required
                        value="{{ old('start_time', $startTime) }}"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                               focus:ring focus:ring-blue-200"
                    >
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">
                        Waktu Selesai <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="time"
                        name="end_time"
                        required
                        value="{{ old('end_time', $endTime) }}"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                               focus:ring focus:ring-blue-200"
                    >
                </div>
            </div>

            <!-- CATATAN -->
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-1">Catatan</label>
                <textarea
                    name="notes"
                    rows="3"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200"
                >{{ old('notes', $schedule->notes) }}</textarea>
            </div>

            <!-- ACTION -->
            <div class="flex justify-between items-center">
                <a
                    href="{{ route('admin.schedules.index') }}"
                    class="rounded bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold
                           text-white hover:bg-blue-700"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
