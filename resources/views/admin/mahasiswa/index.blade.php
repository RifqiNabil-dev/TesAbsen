@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people"></i> Data Mahasiswa</h2>
    <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
    </a>
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
                        <th>Institusi</th>
                        <th>Periode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswa as $mhs)
                        <tr>
                            <td>{{ $mhs->name }}</td>
                            <td>{{ $mhs->email }}</td>
                            <td>{{ $mhs->nim ?? '-' }}</td>
                            <td>{{ $mhs->institution ?? '-' }}</td>
                            <td>
                                @if($mhs->start_date && $mhs->end_date)
                                    @php
                                        $startDate = is_string($mhs->start_date) ? \Carbon\Carbon::parse($mhs->start_date) : $mhs->start_date;
                                        $endDate = is_string($mhs->end_date) ? \Carbon\Carbon::parse($mhs->end_date) : $mhs->end_date;
                                    @endphp
                                    {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.mahasiswa.show', $mhs) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.mahasiswa.edit', $mhs) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.mahasiswa.destroy', $mhs) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                            <td colspan="6" class="text-center">Tidak ada data mahasiswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $mahasiswa->links() }}
        </div>
    </div>
</div>
@endsection

