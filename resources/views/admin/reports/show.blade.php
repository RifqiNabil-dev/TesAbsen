@extends('layouts.app')

@section('title', 'Laporan Peserta')

@section('content')

    <!-- ================= DATA MAHASISWA ================= -->
    <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">

        <div class="border-b px-6 py-4">
            <h5 class="text-lg font-semibold text-gray-800">Data Peserta</h5>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- BIODATA -->
            <div>
                <table class="w-full text-sm">
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600 w-40">Nama</th>
                        <td class="text-gray-800">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">NIM</th>
                        <td>{{ $user->nim ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Institusi</th>
                        <td>{{ $user->institution ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <!-- STATISTIK -->
            <div>
                <h6 class="font-semibold text-gray-700 mb-2">Statistik</h6>
                <ul class="text-sm space-y-1">
                    <li><strong>Total Presensi Hadir:</strong> {{ $totalAttendance }}</li>
                    <li><strong>Total Presensi Terlambat:</strong> {{ $totalLate }}</li>
                    <li><strong>Total Presensi Tidak Hadir:</strong> {{ $totalAbsent }}</li>
                    <li><strong>Total Logbook Disetujui:</strong> {{ $totalLogbooks }}</li>
                </ul>
            </div>

        </div>
    </div>

    <!-- ================= PENILAIAN TERAKHIR ================= -->
    @if($latestAssessment)
        <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">

            <div class="border-b px-6 py-4">
                <h5 class="text-lg font-semibold text-gray-800">Penilaian Terakhir</h5>
            </div>

            <div class="p-6">
                <table class="w-full text-sm">
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600 w-56">Tanggal Penilaian</th>
                        <td>{{ $latestAssessment->created_at->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Dinilai Oleh</th>
                        <td>{{ $latestAssessment->assessor->name }}</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Nilai Kehadiran</th>
                        <td>{{ $latestAssessment->attendance_score }}/20</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Nilai Kedisiplinan</th>
                        <td>{{ $latestAssessment->discipline_score }}/20</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Nilai Kinerja</th>
                        <td>{{ $latestAssessment->performance_score }}/20</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Nilai Inisiatif</th>
                        <td>{{ $latestAssessment->initiative_score }}/20</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Nilai Kerjasama</th>
                        <td>{{ $latestAssessment->cooperation_score }}/20</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Total Nilai</th>
                        <td class="font-semibold">{{ $latestAssessment->total_score }}/100</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Grade</th>
                        <td class="text-2xl font-bold text-blue-600">
                            {{ $latestAssessment->grade }}
                        </td>
                    </tr>

                    @if($latestAssessment->strengths)
                        <tr>
                            <th class="py-1 pr-4 text-left text-gray-600">Kekuatan</th>
                            <td>{{ $latestAssessment->strengths }}</td>
                        </tr>
                    @endif

                    @if($latestAssessment->weaknesses)
                        <tr>
                            <th class="py-1 pr-4 text-left text-gray-600">Kelemahan</th>
                            <td>{{ $latestAssessment->weaknesses }}</td>
                        </tr>
                    @endif

                    @if($latestAssessment->recommendations)
                        <tr>
                            <th class="py-1 pr-4 text-left text-gray-600">Rekomendasi</th>
                            <td>{{ $latestAssessment->recommendations }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    @endif

    <!-- ================= FORM PENILAIAN BARU ================= -->
    <div class="bg-white rounded-lg shadow border border-gray-200">

        <div class="border-b px-6 py-4">
            <h5 class="text-lg font-semibold text-gray-800">Buat Penilaian Baru</h5>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('admin.reports.assessment', $user) }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1">Nilai Kehadiran (0–20)</label>
                        <input type="number" name="attendance_score" min="0" max="20"
                            value="{{ old('attendance_score', 0) }}"
                            class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">Nilai Kedisiplinan (0–20)</label>
                        <input type="number" name="discipline_score" min="0" max="20"
                            value="{{ old('discipline_score', 0) }}"
                            class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                            required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1">Nilai Kinerja (0–20)</label>
                        <input type="number" name="performance_score" min="0" max="20"
                            value="{{ old('performance_score', 0) }}"
                            class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">Nilai Inisiatif (0–20)</label>
                        <input type="number" name="initiative_score" min="0" max="20"
                            value="{{ old('initiative_score', 0) }}"
                            class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                            required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Nilai Kerjasama (0–20)</label>
                    <input type="number" name="cooperation_score" min="0" max="20" value="{{ old('cooperation_score', 0) }}"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Kekuatan</label>
                    <textarea name="strengths" rows="3"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">{{ old('strengths') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Kelemahan</label>
                    <textarea name="weaknesses" rows="3"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">{{ old('weaknesses') }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-1">Rekomendasi</label>
                    <textarea name="recommendations" rows="3"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">{{ old('recommendations') }}</textarea>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('admin.reports.index') }}"
                        class="rounded bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600">
                        Kembali
                    </a>

                    <button type="submit"
                        class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                        Simpan Penilaian
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection