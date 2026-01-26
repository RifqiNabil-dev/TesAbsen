@extends('layouts.app')

@section('title', 'Laporan Mahasiswa')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">Data Mahasiswa</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Nama</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td>{{ $user->nim ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Institusi</th>
                        <td>{{ $user->institution ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6>Statistik</h6>
                <ul class="list-unstyled">
                    <li><strong>Total Presensi Hadir:</strong> {{ $totalAttendance }}</li>
                    <li><strong>Total Presensi Terlambat:</strong> {{ $totalLate }}</li>
                    <li><strong>Total Presensi Tidak Hadir:</strong> {{ $totalAbsent }}</li>
                    <li><strong>Total Logbook Disetujui:</strong> {{ $totalLogbooks }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@if($latestAssessment)
<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">Penilaian Terakhir</h5>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Tanggal Penilaian</th>
                <td>{{ $latestAssessment->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Dinilai Oleh</th>
                <td>{{ $latestAssessment->assessor->name }}</td>
            </tr>
            <tr>
                <th>Nilai Kehadiran</th>
                <td>{{ $latestAssessment->attendance_score }}/20</td>
            </tr>
            <tr>
                <th>Nilai Kedisiplinan</th>
                <td>{{ $latestAssessment->discipline_score }}/20</td>
            </tr>
            <tr>
                <th>Nilai Kinerja</th>
                <td>{{ $latestAssessment->performance_score }}/20</td>
            </tr>
            <tr>
                <th>Nilai Inisiatif</th>
                <td>{{ $latestAssessment->initiative_score }}/20</td>
            </tr>
            <tr>
                <th>Nilai Kerjasama</th>
                <td>{{ $latestAssessment->cooperation_score }}/20</td>
            </tr>
            <tr>
                <th>Total Nilai</th>
                <td><strong>{{ $latestAssessment->total_score }}/100</strong></td>
            </tr>
            <tr>
                <th>Grade</th>
                <td><strong class="h4">{{ $latestAssessment->grade }}</strong></td>
            </tr>
            @if($latestAssessment->strengths)
            <tr>
                <th>Kekuatan</th>
                <td>{{ $latestAssessment->strengths }}</td>
            </tr>
            @endif
            @if($latestAssessment->weaknesses)
            <tr>
                <th>Kelemahan</th>
                <td>{{ $latestAssessment->weaknesses }}</td>
            </tr>
            @endif
            @if($latestAssessment->recommendations)
            <tr>
                <th>Rekomendasi</th>
                <td>{{ $latestAssessment->recommendations }}</td>
            </tr>
            @endif
        </table>
    </div>
</div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Buat Penilaian Baru</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.reports.assessment', $user) }}">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="attendance_score" class="form-label">Nilai Kehadiran (0-20)</label>
                    <input type="number" class="form-control" id="attendance_score" name="attendance_score" 
                           min="0" max="20" value="{{ old('attendance_score', 0) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="discipline_score" class="form-label">Nilai Kedisiplinan (0-20)</label>
                    <input type="number" class="form-control" id="discipline_score" name="discipline_score" 
                           min="0" max="20" value="{{ old('discipline_score', 0) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="performance_score" class="form-label">Nilai Kinerja (0-20)</label>
                    <input type="number" class="form-control" id="performance_score" name="performance_score" 
                           min="0" max="20" value="{{ old('performance_score', 0) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="initiative_score" class="form-label">Nilai Inisiatif (0-20)</label>
                    <input type="number" class="form-control" id="initiative_score" name="initiative_score" 
                           min="0" max="20" value="{{ old('initiative_score', 0) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="cooperation_score" class="form-label">Nilai Kerjasama (0-20)</label>
                <input type="number" class="form-control" id="cooperation_score" name="cooperation_score" 
                       min="0" max="20" value="{{ old('cooperation_score', 0) }}" required>
            </div>

            <div class="mb-3">
                <label for="strengths" class="form-label">Kekuatan</label>
                <textarea class="form-control" id="strengths" name="strengths" rows="3">{{ old('strengths') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="weaknesses" class="form-label">Kelemahan</label>
                <textarea class="form-control" id="weaknesses" name="weaknesses" rows="3">{{ old('weaknesses') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="recommendations" class="form-label">Rekomendasi</label>
                <textarea class="form-control" id="recommendations" name="recommendations" rows="3">{{ old('recommendations') }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
            </div>
        </form>
    </div>
</div>
@endsection

