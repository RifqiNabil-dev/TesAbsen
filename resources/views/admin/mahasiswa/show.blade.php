@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Mahasiswa</h5>
        <div>
            <a href="{{ route('admin.mahasiswa.edit', $mahasiswa) }}" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.reports.show', $mahasiswa) }}" class="btn btn-sm btn-info">
                <i class="bi bi-file-text"></i> Laporan
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Nama</th>
                        <td>{{ $mahasiswa->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $mahasiswa->email }}</td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td>{{ $mahasiswa->nim ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Institusi</th>
                        <td>{{ $mahasiswa->institution ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>{{ $mahasiswa->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Periode PKL</th>
                        <td>
                            @if($mahasiswa->start_date && $mahasiswa->end_date)
                                @php
                                    $startDate = is_string($mahasiswa->start_date) ? \Carbon\Carbon::parse($mahasiswa->start_date) : $mahasiswa->start_date;
                                    $endDate = is_string($mahasiswa->end_date) ? \Carbon\Carbon::parse($mahasiswa->end_date) : $mahasiswa->end_date;
                                @endphp
                                {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6>Statistik</h6>
                <ul class="list-unstyled">
                    <li><strong>Total Presensi:</strong> {{ $mahasiswa->attendances->count() }}</li>
                    <li><strong>Total Logbook:</strong> {{ $mahasiswa->logbooks->count() }}</li>
                    <li><strong>Total Jadwal:</strong> {{ $mahasiswa->schedules->count() }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

