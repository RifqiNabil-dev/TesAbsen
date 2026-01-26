@extends('layouts.app')

@section('title', 'Detail Logbook')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detail Logbook</h5>
    </div>
    <div class="card-body">
        <table class="table table-borderless mb-4">
            <tr>
                <th width="200">Tanggal</th>
                <td>{{ $logbook->date->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Mahasiswa</th>
                <td>{{ $logbook->user->name }}</td>
            </tr>
            <tr>
                <th>Aktivitas</th>
                <td>{{ $logbook->activity }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $logbook->description }}</td>
            </tr>
            <tr>
                <th>Waktu</th>
                <td>{{ $logbook->start_time }} - {{ $logbook->end_time }}</td>
            </tr>
            <tr>
                <th>Status</th>
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
            @if($logbook->admin_notes)
            <tr>
                <th>Catatan Admin</th>
                <td>{{ $logbook->admin_notes }}</td>
            </tr>
            @endif
            @if($logbook->approved_by)
            <tr>
                <th>Disetujui Oleh</th>
                <td>{{ $logbook->approver->name }} pada {{ $logbook->approved_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endif
        </table>

        @if($logbook->isPending())
        <form method="POST" action="{{ route('admin.logbooks.approve', $logbook) }}" class="mb-3">
            @csrf
            @method('PATCH')
            
            <div class="mb-3">
                <label for="admin_notes" class="form-label">Catatan</label>
                <textarea class="form-control" id="admin_notes" name="admin_notes" rows="3">{{ old('admin_notes') }}</textarea>
            </div>

            <div class="btn-group">
                <button type="submit" name="status" value="approved" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Setujui
                </button>
                <button type="submit" name="status" value="rejected" class="btn btn-danger">
                    <i class="bi bi-x-circle"></i> Tolak
                </button>
            </div>
        </form>
        @endif

        <a href="{{ route('admin.logbooks.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection

