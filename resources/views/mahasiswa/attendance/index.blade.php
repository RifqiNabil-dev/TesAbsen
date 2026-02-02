@extends('layouts.app')

@section('title', 'Presensi')

@section('content')

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <h2 class="text-xl sm:text-2xl font-semibold flex items-center gap-2">
            <i class="bi bi-clock-history text-blue-600"></i> Presensi
        </h2>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-lg border shadow">
        <div class="p-4 sm:p-6">

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Tanggal</th>
                            <th class="p-3 text-left">Lokasi Jadwal</th>
                            <th class="p-3 text-left">Lokasi Presensi</th>
                            <th class="p-3 text-left">Check In</th>
                            <th class="p-3 text-left">Check Out</th>
                            <th class="p-3 text-left">Durasi</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Status Lokasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($attendances as $attendance)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">
                                    {{ $attendance->date->format('d-m-Y') }}
                                </td>
                                <td class="p-3">
                                    @php
                                        $schedule = \App\Models\Schedule::where('user_id', $attendance->user_id)
                                            ->whereDate('date', $attendance->date)
                                            ->with('locations')
                                            ->first();
                                        $scheduledLocations = $schedule ? $schedule->locations->pluck('name')->implode(', ') : '-';
                                    @endphp
                                    {{ $scheduledLocations }}
                                </td>
                                <td class="p-3">
                                    {{ $attendance->location->name ?? '-' }}
                                </td>
                                <td class="p-3">
                                    {{ $attendance->check_in ? $attendance->check_in->format('H:i') : '-' }}
                                </td>
                                <td class="p-3">
                                    {{ $attendance->check_out ? $attendance->check_out->format('H:i') : '-' }}
                                </td>
                                <td class="p-3">
                                    {{ $attendance->work_duration ? $attendance->work_duration . ' jam' : '-' }}
                                </td>

                                <!-- STATUS KEHADIRAN -->
                                <td class="p-3">
                                    @if($attendance->status === 'hadir')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">
                                            Hadir
                                        </span>
                                    @elseif($attendance->status === 'terlambat')
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-medium">
                                            Hadir Terlambat
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">
                                            Tidak Hadir
                                        </span>
                                    @endif
                                </td>

                                <!-- STATUS LOKASI -->
                                <td class="p-3">
                                    @if($attendance->location_status === 'berada dilokasi magang')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">
                                            Berada di Lokasi
                                        </span>
                                    @elseif($attendance->location_status === 'diluar lokasi magang')
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">
                                            Diluar Lokasi
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-medium">
                                            -
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-6 text-center text-gray-500">
                                    Belum ada data presensi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $attendances->links() }}
            </div>

        </div>
    </div>

@endsection