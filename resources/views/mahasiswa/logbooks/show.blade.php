@extends('layouts.app')

@section('title', 'Detail Logbook')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detail Logbook</h5>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Tanggal</th>
                <td>{{ $logbook->date->format('d/m/Y') }}</td>
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
        <a href="{{ route('mahasiswa.logbooks.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection

