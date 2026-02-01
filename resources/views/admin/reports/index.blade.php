@extends('layouts.app')

@section('title', 'Laporan & Penilaian')

@section('content')

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
            <i class="bi bi-file-text"></i>
            Laporan & Penilaian
        </h2>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-lg shadow border border-gray-200">

        <div class="p-6">

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 font-semibold">
                            <th class="px-4 py-3 border-b">Nama</th>
                            <th class="px-4 py-3 border-b">Email</th>
                            <th class="px-4 py-3 border-b">NIM</th>
                            <th class="px-4 py-3 border-b text-center">Total Presensi</th>
                            <th class="px-4 py-3 border-b text-center">Total Logbook</th>
                            <th class="px-4 py-3 border-b text-center">Penilaian Terakhir</th>
                            <th class="px-4 py-3 border-b text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse($mahasiswa as $mhs)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $mhs->name }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ $mhs->email }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ $mhs->nim ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-center font-semibold">
                                    {{ $mhs->attendances_count }}
                                </td>

                                <td class="px-4 py-3 text-center font-semibold">
                                    {{ $mhs->logbooks_count }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    @if($mhs->assessments->count() > 0)
                                        <span class="font-semibold text-gray-800">
                                            {{ $mhs->assessments->last()->grade }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            ({{ $mhs->assessments->last()->total_score }})
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400 italic">
                                            Belum dinilai
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-center">
                                    @if($mhs->assessments->count() > 0)
                                        <a href="{{ route('admin.reports.edit', $mhs->id) }}"
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-yellow-500 px-3 py-1.5
                                                text-xs font-medium text-white shadow-sm hover:bg-yellow-600 transition">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>
                                    @else
                                        <a href="{{ route('admin.reports.show', $mhs->id) }}"
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 px-3 py-1.5
                                                text-xs font-medium text-white shadow-sm hover:bg-blue-700 transition">
                                            <i class="bi bi-eye"></i>
                                            Nilai
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">
                                    Tidak ada data mahasiswa
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection