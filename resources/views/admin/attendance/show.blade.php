@extends('layouts.app')

@section('title', 'Detail Presensi')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Detail Presensi</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">Tanggal</th>
                    <td>{{ $attendance->date->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Peserta</th>
                    <td>{{ $attendance->user->name }}</td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td>{{ $attendance->location->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Check In</th>
                    <td>{{ $attendance->check_in ? $attendance->check_in->format('d-m-Y H:i') : '-' }}</td>
                </tr>
                <tr>
                    <th>Check Out</th>
                    <td>{{ $attendance->check_out ? $attendance->check_out->format('d-m-Y H:i') : '-' }}</td>
                </tr>
                <tr>
                    <th>Durasi Kerja</th>
                    <td>{{ $attendance->work_duration ? $attendance->work_duration . ' jam' : '-' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
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
                @if($attendance->notes)
                    <tr>
                        <th>Catatan</th>
                        <td>{{ $attendance->notes }}</td>
                    </tr>
                @endif
            </table>
            <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection