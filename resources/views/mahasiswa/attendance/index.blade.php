@extends('layouts.app')

@section('title', 'Presensi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clock-history"></i> Presensi</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Durasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->date->format('d/m/Y') }}</td>
                            <td>{{ $attendance->location->name ?? '-' }}</td>
                            <td>{{ $attendance->check_in ? $attendance->check_in->format('H:i') : '-' }}</td>
                            <td>{{ $attendance->check_out ? $attendance->check_out->format('H:i') : '-' }}</td>
                            <td>{{ $attendance->work_duration ? $attendance->work_duration . ' jam' : '-' }}</td>
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
                            <td colspan="6" class="text-center">Belum ada data presensi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $attendances->links() }}
        </div>
    </div>
</div>
@endsection

