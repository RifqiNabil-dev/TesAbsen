@extends('layouts.app')

@section('title', 'Jadwal PKL')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-calendar-event"></i> Jadwal PKL</h2>
    <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Jadwal
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Mahasiswa</th>
                        <th>Kelompok</th>
                        <th>Lokasi</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $schedule)
                        <tr>
                            <td>
                                @php
                                    $scheduleDate = is_string($schedule->date) ? \Carbon\Carbon::parse($schedule->date) : $schedule->date;
                                    $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                    $dayName = $dayNames[$scheduleDate->dayOfWeek];
                                @endphp
                                {{ $scheduleDate->format('d/m/Y') }}
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $dayName }}</span>
                            </td>
                            <td>{{ $schedule->user->name }}</td>
                            <td>
                                @if($schedule->user->group)
                                    <span class="badge bg-info">{{ $schedule->user->group->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $schedule->location->name }}</td>
                            <td>
                                @php
                                    $startTime = is_string($schedule->start_time) ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i') : ($schedule->start_time instanceof \Carbon\Carbon ? $schedule->start_time->format('H:i') : $schedule->start_time);
                                    $endTime = is_string($schedule->end_time) ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i') : ($schedule->end_time instanceof \Carbon\Carbon ? $schedule->end_time->format('H:i') : $schedule->end_time);
                                @endphp
                                {{ $startTime }} - {{ $endTime }}
                            </td>
                            <td>
                                <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data jadwal</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $schedules->links() }}
        </div>
    </div>
</div>
@endsection

