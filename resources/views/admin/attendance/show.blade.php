@extends('layouts.app')

@section('title', 'Detail Presensi')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0"> <i class="bi bi-info-square"></i> Detail Presensi</h2>
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
                    <td>{{ $attendance->check_in ? $attendance->check_in->translatedFormat('j F Y H:i') : '-' }}</td>
                </tr>
                <tr>
                    <th>Check Out</th>
                    <td>{{ $attendance->check_out ? $attendance->check_out->translatedFormat('j F Y H:i') : '-' }}</td>
                </tr>
                <tr>
                    <th>Durasi Magang</th>
                    <td>{{ $attendance->work_duration ? $attendance->work_duration . ' jam' : '-' }}</td>
                </tr>
                <tr>
                    <th>Status lokasi</th>
                    <td>
                        @if($attendance->location_status === 'berada dilokasi magang')
                            <span class="text-green-700 text-xs font-medium flex items-center gap-1">
                                <i class="bi bi-geo-alt-fill"></i> Di Lokasi
                            </span>
                        @elseif($attendance->location_status === 'diluar lokasi magang')
                            <span class="text-red-700 text-xs font-medium flex items-center gap-1">
                                <i class="bi bi-geo-alt"></i> Diluar Lokasi
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Latitude</th>
                    <td>{{ $attendance->latitude ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Longitude</th>
                    <td>{{ $attendance->longitude ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <!-- Update Status Form -->
                        <form action="{{ route('admin.attendance.updateStatus', $attendance->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select">
                                <option value="hadir" {{ $attendance->status === 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="terlambat" {{ $attendance->status === 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                                <option value="tidak_hadir" {{ $attendance->status === 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                        </form>
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
