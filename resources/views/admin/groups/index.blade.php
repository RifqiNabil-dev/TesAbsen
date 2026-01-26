@extends('layouts.app')

@section('title', 'Kelompok Magang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people-fill"></i> Kelompok Magang</h2>
    <a href="{{ route('admin.groups.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Kelompok
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Kelompok</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Anggota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($groups as $group)
                        <tr>
                            <td><strong>{{ $group->name }}</strong></td>
                            <td>{{ $group->description ?? '-' }}</td>
                            <td>
                                <span class="badge bg-info">{{ $group->users_count }} anggota</span>
                            </td>
                            <td>
                                @if($group->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.groups.show', $group) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a href="{{ route('admin.groups.edit', $group) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.groups.destroy', $group) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kelompok ini? Semua anggota akan dikeluarkan dari kelompok.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data kelompok</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $groups->links() }}
        </div>
    </div>
</div>
@endsection

