@extends('layouts.app')

@section('title', 'Jadwal Saya')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="bi bi-calendar-event text-blue-600"></i> Jadwal PKL Saya
            </h2>
        </div>

        <!-- TABLE CARD -->
        <div class="bg-white rounded-lg shadow border border-gray-200">

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-blue-50 text-blue-800 uppercase tracking-wider font-semibold">
                        <tr>
                            <th class="px-6 py-4 rounded-tl-lg">Hari / Tanggal</th>
                            <th class="px-6 py-4">Lokasi</th>
                            <th class="px-6 py-4">Waktu Shift</th>
                            <th class="px-6 py-4 rounded-tr-lg">Catatan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($schedules as $schedule)
                            @php
                                $scheduleDate = is_string($schedule->date) ? \Carbon\Carbon::parse($schedule->date) : $schedule->date;
                                $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                $dayName = $dayNames[$scheduleDate->dayOfWeek];

                                $startTime = is_string($schedule->start_time) ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i') : $schedule->start_time->format('H:i');
                                $endTime = is_string($schedule->end_time) ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i') : $schedule->end_time->format('H:i');
                            @endphp

                            <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex flex-col items-center justify-center w-12 h-12 rounded-lg bg-blue-100 text-blue-600 font-bold shadow-sm">
                                            <span class="text-xs uppercase">{{ \Str::limit($dayName, 3, '') }}</span>
                                            <span class="text-lg leading-none">{{ $scheduleDate->day }}</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $dayName }}</p>
                                            <p class="text-gray-500 text-xs">{{ $scheduleDate->format('d-m-Y') }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($schedule->locations as $loc)
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                                <i class="bi bi-geo-alt-fill text-[10px]"></i> {{ $loc->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-50 text-gray-700 border border-gray-200">
                                        <i class="bi bi-clock"></i>
                                        <span class="font-medium">{{ $startTime }} - {{ $endTime }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-500 italic">
                                    {{ $schedule->notes ?: '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <i class="bi bi-calendar-x text-4xl mb-3 text-gray-300"></i>
                                        <p class="font-medium">Belum ada jadwal yang ditentukan.</p>
                                    </div>
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