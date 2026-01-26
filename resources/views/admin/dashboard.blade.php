@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-speedometer2"></i> Dashboard</h2>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Mahasiswa</h5>
                <h2 class="mb-0">{{ $totalMahasiswa }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Lokasi Aktif</h5>
                <h2 class="mb-0">{{ $totalLocations }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Presensi Hari Ini</h5>
                <h2 class="mb-0">{{ $todayAttendances }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Logbook Pending</h5>
                <h2 class="mb-0">{{ $pendingLogbooks }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Presensi Hari Ini</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Check In</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAttendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->user->name }}</td>
                                    <td>{{ $attendance->location->name ?? '-' }}</td>
                                    <td>{{ $attendance->check_in ? $attendance->check_in->format('H:i') : '-' }}</td>
                                    <td>
                                        @if($attendance->status === 'hadir')
                                            <span class="badge bg-success">Hadir</span>
                                        @elseif($attendance->status === 'terlambat')
                                            <span class="badge bg-warning">Terlambat</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Hadir</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada presensi hari ini</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Logbook Pending</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Aktivitas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentLogbooks as $logbook)
                                <tr>
                                    <td>{{ $logbook->user->name }}</td>
                                    <td>{{ $logbook->date->format('d/m/Y') }}</td>
                                    <td>{{ Str::limit($logbook->activity, 30) }}</td>
                                    <td>
                                        <a href="{{ route('admin.logbooks.show', $logbook) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada logbook pending</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

