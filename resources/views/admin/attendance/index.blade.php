@extends('layouts.app')

@section('title', 'Presensi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clock-history"></i> Presensi</h2>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.attendance.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="user_id" class="form-label">Mahasiswa</label>
                <select class="form-select" id="user_id" name="user_id">
                    <option value="">Semua</option>
                    @foreach($mahasiswa as $mhs)
                        <option value="{{ $mhs->id }}" {{ request('user_id') == $mhs->id ? 'selected' : '' }}>
                            {{ $mhs->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="date" class="form-label">Tanggal</label>
                <input type="text" class="form-control datepicker" id="date" name="date" value="{{ request('date') }}" placeholder="Pilih tanggal">
            </div>
            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Mahasiswa</th>
                        <th>Lokasi</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->date->format('d/m/Y') }}</td>
                            <td>{{ $attendance->user->name }}</td>
                            <td>{{ $attendance->location->name ?? '-' }}</td>
                            <td>{{ $attendance->check_in ? $attendance->check_in->format('H:i') : '-' }}</td>
                            <td>{{ $attendance->check_out ? $attendance->check_out->format('H:i') : '-' }}</td>
                            <td>
                                @if($attendance->status === 'hadir')
                                    <span class="badge bg-success">Hadir</span>
                                @elseif($attendance->status === 'terlambat')
                                    <span class="badge bg-warning">Terlambat</span>
                                @else
                                    <span class="badge bg-danger">Tidak Hadir</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.attendance.show', $attendance) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data presensi</td>
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

