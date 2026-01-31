@extends('layouts.app')

@section('title', 'Detail Peserta')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- CARD DETAIL -->
        <div class="bg-white rounded-lg shadow border border-gray-200">

            <!-- Header -->
            <div class="flex items-center justify-between border-b px-6 py-4">
                <h2 class="text-lg font-bold text-gray-800">Detail Peserta</h2>

                <div class="flex gap-2">
                    <a href="{{ route('admin.mahasiswa.edit', $mahasiswa) }}"
                        class="inline-flex items-center gap-1 rounded bg-yellow-500 px-3 py-1.5 text-sm text-white hover:bg-yellow-600">
                        ✏️ Edit
                    </a>

                    <a href="{{ route('admin.reports.show', $mahasiswa) }}"
                        class="inline-flex items-center gap-1 rounded bg-blue-500 px-3 py-1.5 text-sm text-white hover:bg-blue-600">
                        📄 Laporan
                    </a>
                </div>
            </div>

            <!-- Body -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- DATA MAHASISWA -->
                <div>
                    <table class="w-full text-sm">
                        <tbody class="divide-y">
                            <tr>
                                <th class="py-2 text-left font-semibold w-40">Nama</th>
                                <td class="py-2">{{ $mahasiswa->name }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left font-semibold">Email</th>
                                <td class="py-2">{{ $mahasiswa->email }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left font-semibold">NIM</th>
                                <td class="py-2">{{ $mahasiswa->nim ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left font-semibold">Institusi</th>
                                <td class="py-2">{{ $mahasiswa->institution ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left font-semibold">No. Telepon</th>
                                <td class="py-2">{{ $mahasiswa->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 text-left font-semibold">Periode PKL</th>
                                <td class="py-2">
                                    @if($mahasiswa->start_date && $mahasiswa->end_date)
                                        @php
                                            $startDate = is_string($mahasiswa->start_date)
                                                ? \Carbon\Carbon::parse($mahasiswa->start_date)
                                                : $mahasiswa->start_date;

                                            $endDate = is_string($mahasiswa->end_date)
                                                ? \Carbon\Carbon::parse($mahasiswa->end_date)
                                                : $mahasiswa->end_date;
                                        @endphp
                                        {{ $startDate->format('d-m-Y') }} - {{ $endDate->format('d-m-Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- STATISTIK -->
                <div class="bg-gray-50 rounded-lg p-4 border">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">
                        📊 Statistik Peserta
                    </h3>

                    <ul class="space-y-2 text-sm">
                        <li class="flex justify-between">
                            <span>Total Presensi</span>
                            <span class="font-semibold">
                                {{ $mahasiswa->attendances->count() }}
                            </span>
                        </li>

                        <li class="flex justify-between">
                            <span>Total Logbook</span>
                            <span class="font-semibold">
                                {{ $mahasiswa->logbooks->count() }}
                            </span>
                        </li>

                        <li class="flex justify-between">
                            <span>Total Jadwal</span>
                            <span class="font-semibold">
                                {{ $mahasiswa->schedules->count() }}
                            </span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
@endsection