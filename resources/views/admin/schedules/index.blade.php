@extends('layouts.app')

@section('title', 'Jadwal PKL')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            📅 Jadwal PKL
        </h2>

        <a href="{{ route('admin.schedules.create') }}"
           class="inline-flex items-center gap-2 rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal
        </a>
    </div>

    <!-- TABLE CARD -->
    <div class="bg-white rounded-lg shadow border border-gray-200">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Hari</th>
                        <th class="px-4 py-3">Mahasiswa</th>
                        <th class="px-4 py-3">Kelompok</th>
                        <th class="px-4 py-3">Lokasi</th>
                        <th class="px-4 py-3">Waktu</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($schedules as $schedule)
                        @php
                            $scheduleDate = is_string($schedule->date)
                                ? \Carbon\Carbon::parse($schedule->date)
                                : $schedule->date;

                            $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                            $dayName = $dayNames[$scheduleDate->dayOfWeek];

                            $startTime = is_string($schedule->start_time)
                                ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i')
                                : ($schedule->start_time instanceof \Carbon\Carbon
                                    ? $schedule->start_time->format('H:i')
                                    : $schedule->start_time);

                            $endTime = is_string($schedule->end_time)
                                ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i')
                                : ($schedule->end_time instanceof \Carbon\Carbon
                                    ? $schedule->end_time->format('H:i')
                                    : $schedule->end_time);
                        @endphp

                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                {{ $scheduleDate->format('d/m/Y') }}
                            </td>

                            <td class="px-4 py-3">
                                <span class="inline-block rounded bg-gray-200 px-2 py-1 text-xs font-semibold text-gray-700">
                                    {{ $dayName }}
                                </span>
                            </td>

                            <td class="px-4 py-3 font-medium">
                                {{ $schedule->user->name }}
                            </td>

                            <td class="px-4 py-3">
                                @if($schedule->user->group)
                                    <span class="inline-block rounded bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-700">
                                        {{ $schedule->user->group->name }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                {{ $schedule->location->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $startTime }} - {{ $endTime }}
                            </td>

                            <td class="px-4 py-3 text-center space-x-1">
                                <a href="{{ route('admin.schedules.edit', $schedule) }}"
                                   class="inline-flex items-center justify-center rounded bg-yellow-500 px-2 py-1 text-white hover:bg-yellow-600">
                                                                <i class="bi bi-pencil"></i>

                                </a>

                                <form action="{{ route('admin.schedules.destroy', $schedule) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center justify-center rounded bg-red-500 px-2 py-1 text-white hover:bg-red-600">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada data jadwal
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="px-4 py-3 border-t">
            {{ $schedules->links() }}
        </div>
    </div>

</div>
@endsection
