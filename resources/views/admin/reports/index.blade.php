@extends('layouts.app')

@section('title', 'Laporan & Penilaian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-file-text"></i> Laporan & Penilaian</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIM</th>
                        <th>Total Presensi</th>
                        <th>Total Logbook</th>
                        <th>Penilaian Terakhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswa as $mhs)
                        <tr>
                            <td>{{ $mhs->name }}</td>
                            <td>{{ $mhs->email }}</td>
                            <td>{{ $mhs->nim ?? '-' }}</td>
                            <td>{{ $mhs->attendances_count }}</td>
                            <td>{{ $mhs->logbooks_count }}</td>
                            <td>
                                @if($mhs->assessments->count() > 0)
                                    {{ $mhs->assessments->last()->grade }} ({{ $mhs->assessments->last()->total_score }})
                                @else
                                    <span class="text-muted">Belum dinilai</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.reports.show', $mhs) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data mahasiswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

