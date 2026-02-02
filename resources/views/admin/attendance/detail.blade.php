@extends('layouts.app')

@section('title', 'Detail Presensi - ' . $selectedUser->name)

@section('content')
    <div class="space-y-4">

        <!-- BREADCRUMB / HEADER -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('admin.attendance.index') }}" class="hover:text-blue-600">Presensi</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="font-medium text-gray-900">{{ $selectedUser->name }}</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Riwayat Presensi: <span class="text-blue-600">{{ $selectedUser->name }}</span>
            </h2>
            <a href="{{ route('admin.attendance.index') }}"
                class="text-gray-600 hover:text-gray-900 flex items-center gap-2 text-sm font-medium">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <!-- TABLE (Original Logic) -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white shadow-sm">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-700 font-semibold border-b">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Lokasi Jadwal</th>
                        <th class="px-4 py-3">Lokasi Presensi</th>
                        <th class="px-4 py-3">Check In</th>
                        <th class="px-4 py-3">Check Out</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Status Lokasi</th>
                        <th class="px-4 py-3">Latitude</th>
                        <th class="px-4 py-3">Longitude</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($attendances as $attendance)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-900">
                                {{ $attendance->date?->translatedFormat('j F Y') ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                @php
                                    $schedule = \App\Models\Schedule::where('user_id', $attendance->user_id)
                                        ->whereDate('date', $attendance->date)
                                        ->with('locations')
                                        ->first();
                                    $scheduledLocations = $schedule ? $schedule->locations->pluck('name')->implode(', ') : '-';
                                @endphp
                                {{ $scheduledLocations }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $attendance->location->name ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-blue-600 font-medium">
                                {{ $attendance->check_in?->format('H:i') ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-orange-600 font-medium">
                                {{ $attendance->check_out?->format('H:i') ?? '-' }}
                            </td>
                            <td class="px-4 py-3">
                                @if($attendance->status === 'hadir')
                                    <span
                                        class="rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-700">Hadir</span>
                                @elseif($attendance->status === 'terlambat')
                                    <span
                                        class="rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-semibold text-yellow-700">Hadir
                                        Terlambat</span>
                                @else
                                    <span class="rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-semibold text-red-700">Tidak
                                        Hadir</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($attendance->location_status === 'berada dilokasi magang')
                                    <span class="text-green-700 text-xs font-medium flex items-center gap-1">
                                        <i class="bi bi-geo-alt-fill"></i> Di Lokasi
                                    </span>
                                @elseif($attendance->location_status === 'diluar lokasi magang')
                                    <span class="text-red-700 text-xs font-medium flex items-center gap-1">
                                        <i class="bi bi-geo-alt"></i> Diluar Lokasi
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-xs font-mono text-gray-600">
                                {{ $attendance->latitude ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-xs font-mono text-gray-600">
                                {{ $attendance->longitude ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('admin.attendance.show', $attendance) }}"
                                    class="text-gray-400 hover:text-blue-600 transition">
                                    <i class="bi bi-eye text-lg"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                Belum ada riwayat presensi untuk peserta ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $attendances->appends(request()->query())->links() }}
        </div>
    </div>
@endsection