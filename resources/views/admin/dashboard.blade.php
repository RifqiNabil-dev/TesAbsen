@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold flex items-center gap-2">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </h2>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Peserta</p>
                <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $totalMahasiswa }}</h2>
            </div>
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <i class="bi bi-people-fill text-xl"></i>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Lokasi Aktif</p>
                <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $totalLocations }}</h2>
            </div>
            <div class="p-3 bg-green-50 text-green-600 rounded-lg">
                <i class="bi bi-geo-alt-fill text-xl"></i>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Presensi Hari Ini</p>
                <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $todayAttendances }}</h2>
            </div>
            <div class="p-3 bg-sky-50 text-sky-600 rounded-lg">
                <i class="bi bi-calendar-check-fill text-xl"></i>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm border border-gray-100 flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Logbook Pending</p>
                <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $pendingLogbooks }}</h2>
            </div>
            <div class="p-3 bg-yellow-50 text-yellow-600 rounded-lg">
                <i class="bi bi-journal-text text-xl"></i>
            </div>
        </div>
    </div>

    <!-- TABLES -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- PRESENSI -->
        <div class="bg-white rounded-lg shadow">
            <div class="border-b px-4 py-3">
                <h5 class="font-semibold">Presensi Hari Ini</h5>
            </div>

            <div class="overflow-x-auto p-4">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 text-left">Nama</th>
                            <th class="px-3 py-2 text-left">Lokasi</th>
                            <th class="px-3 py-2 text-left">Check In</th>
                            <th class="px-3 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($recentAttendances as $attendance)
                            <tr>
                                <td class="px-3 py-2">{{ $attendance->user->name }}</td>
                                <td class="px-3 py-2">{{ $attendance->location->name ?? '-' }}</td>
                                <td class="px-3 py-2">
                                    {{ $attendance->check_in ? $attendance->check_in->format('H:i') : '-' }}
                                </td>
                                <td class="px-3 py-2">
                                    @if($attendance->status === 'hadir')
                                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Hadir</span>
                                    @elseif($attendance->status === 'terlambat')
                                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Terlambat</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Tidak Hadir</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-4 text-center text-gray-500">
                                    Tidak ada presensi hari ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- LOGBOOK -->
        <div class="bg-white rounded-lg shadow">
            <div class="border-b px-4 py-3">
                <h5 class="font-semibold">Logbook Pending</h5>
            </div>

            <div class="overflow-x-auto p-4">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-3 py-2 text-left">Nama</th>
                            <th class="px-3 py-2 text-left">Tanggal</th>
                            <th class="px-3 py-2 text-left">Aktivitas</th>
                            <th class="px-3 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($recentLogbooks as $logbook)
                            <tr>
                                <td class="px-3 py-2">{{ $logbook->user->name }}</td>
                                <td class="px-3 py-2">{{ $logbook->date->format('d-m-Y') }}</td>
                                <td class="px-3 py-2">{{ Str::limit($logbook->activity, 30) }}</td>
                                <td class="px-3 py-2">
                                    <a href="{{ route('admin.logbooks.show', $logbook) }}"
                                        class="inline-flex items-center justify-center rounded bg-blue-600 text-white px-3 py-1 hover:bg-blue-700">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-4 text-center text-gray-500">
                                    Tidak ada logbook pending
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection