@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-speedometer2"></i> Dashboard</h2>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Presensi</h5>
                <h2 class="mb-0">{{ $totalAttendance }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Logbook Disetujui</h5>
                <h2 class="mb-0">{{ $totalLogbooks }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Jadwal Hari Ini</h5>
                <h4 class="mb-0">{{ $todaySchedule ? $todaySchedule->location->name : '-' }}</h4>
            </div>
        </div>
    </div>
</div>

@if($todaySchedule)
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Jadwal Hari Ini</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Lokasi:</strong> {{ $todaySchedule->location->name }}</p>
                <p><strong>Waktu:</strong> 
                    @php
                        $startTime = is_string($todaySchedule->start_time) ? \Carbon\Carbon::parse($todaySchedule->start_time)->format('H:i') : ($todaySchedule->start_time instanceof \Carbon\Carbon ? $todaySchedule->start_time->format('H:i') : $todaySchedule->start_time);
                        $endTime = is_string($todaySchedule->end_time) ? \Carbon\Carbon::parse($todaySchedule->end_time)->format('H:i') : ($todaySchedule->end_time instanceof \Carbon\Carbon ? $todaySchedule->end_time->format('H:i') : $todaySchedule->end_time);
                    @endphp
                    {{ $startTime }} - {{ $endTime }}
                </p>
            </div>
            <div class="col-md-6">
                @if($todayAttendance)
                    @if($todayAttendance->check_in && !$todayAttendance->check_out)
                        <form method="POST" action="{{ route('mahasiswa.attendance.checkout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="bi bi-box-arrow-right"></i> Check Out
                            </button>
                        </form>
                    @elseif($todayAttendance->check_in && $todayAttendance->check_out)
                        <p class="text-success"><i class="bi bi-check-circle"></i> Sudah check-in dan check-out hari ini</p>
                    @endif
                @else
                    <form method="POST" action="{{ route('mahasiswa.attendance.checkin') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-box-arrow-in-right"></i> Check In
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Presensi Terakhir</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Check In</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAttendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->date->format('d/m/Y') }}</td>
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
                                    <td colspan="4" class="text-center">Belum ada presensi</td>
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
                <h5 class="mb-0">Logbook Terakhir</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Aktivitas</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentLogbooks as $logbook)
                                <tr>
                                    <td>{{ $logbook->date->format('d/m/Y') }}</td>
                                    <td>{{ Str::limit($logbook->activity, 30) }}</td>
                                    <td>
                                        @if($logbook->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($logbook->status === 'approved')
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada logbook</td>
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

