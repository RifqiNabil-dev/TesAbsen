@extends('layouts.app')

@section('title', 'Detail Kelompok')

@section('content')
<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Kelompok: {{ $group->name }}</h5>
        <div>
            <a href="{{ route('admin.groups.edit', $group) }}" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.groups.index') }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Nama Kelompok</th>
                        <td>{{ $group->name }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $group->description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($group->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Jumlah Anggota</th>
                        <td><strong>{{ $group->users->count() }} orang</strong></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-people"></i> Anggota Kelompok 
            <span class="badge bg-primary">{{ $group->users->count() }} anggota</span>
        </h5>
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
            <i class="bi bi-person-plus"></i> Tambah Anggota
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIM</th>
                        <th>Institusi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($group->users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->nim ?? '-' }}</td>
                            <td>{{ $user->institution ?? '-' }}</td>
                            <td>
                                <form action="{{ route('admin.groups.remove-member', [$group, $user]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin mengeluarkan {{ $user->name }} dari kelompok?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-person-dash"></i> Keluarkan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada anggota di kelompok ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Anggota -->
<div class="modal fade" id="addMemberModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Anggota ke Kelompok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.groups.add-member', $group) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Pilih Mahasiswa <span class="text-danger">*</span></label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach($availableMahasiswa as $mahasiswa)
                                @if($mahasiswa->group_id != $group->id)
                                    <option value="{{ $mahasiswa->id }}">
                                        {{ $mahasiswa->name }} ({{ $mahasiswa->email }})
                                        @if($mahasiswa->nim)
                                            - NIM: {{ $mahasiswa->nim }}
                                        @endif
                                        @if($mahasiswa->group_id)
                                            <span class="text-warning">- Sudah di kelompok lain</span>
                                        @endif
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Pilih mahasiswa yang ingin ditambahkan ke kelompok ini. 
                            Mahasiswa yang sudah di kelompok lain akan otomatis dipindahkan.
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

