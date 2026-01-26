@extends('layouts.app')

@section('title', 'Logbook')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-journal-text"></i> Logbook</h2>
    <a href="{{ route('mahasiswa.logbooks.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Logbook
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Aktivitas</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logbooks as $logbook)
                        <tr>
                            <td>{{ $logbook->date->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($logbook->activity, 40) }}</td>
                            <td>{{ $logbook->start_time }} - {{ $logbook->end_time }}</td>
                            <td>
                                @if($logbook->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($logbook->status === 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('mahasiswa.logbooks.show', $logbook) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($logbook->isPending())
                                    <a href="{{ route('mahasiswa.logbooks.edit', $logbook) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('mahasiswa.logbooks.destroy', $logbook) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data logbook</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $logbooks->links() }}
        </div>
    </div>
</div>
@endsection

