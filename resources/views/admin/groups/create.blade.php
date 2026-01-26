@extends('layouts.app')

@section('title', 'Tambah Kelompok')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Tambah Kelompok</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.groups.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Kelompok <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Aktif
                    </label>
                </div>
            </div>

            <hr class="my-4">

            <div class="mb-3">
                <label class="form-label">Pilih Mahasiswa untuk Kelompok</label>
                <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                    @forelse($availableMahasiswa as $mahasiswa)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="user_ids[]" value="{{ $mahasiswa->id }}" id="user_{{ $mahasiswa->id }}" {{ in_array($mahasiswa->id, old('user_ids', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="user_{{ $mahasiswa->id }}">
                                <strong>{{ $mahasiswa->name }}</strong>
                                <small class="text-muted">({{ $mahasiswa->email }})</small>
                                @if($mahasiswa->nim)
                                    <br><small class="text-muted">NIM: {{ $mahasiswa->nim }}</small>
                                @endif
                            </label>
                        </div>
                    @empty
                        <p class="text-muted mb-0">Tidak ada mahasiswa yang tersedia (semua sudah terdaftar di kelompok lain)</p>
                    @endforelse
                </div>
                <small class="form-text text-muted">Pilih satu atau lebih mahasiswa untuk ditambahkan ke kelompok ini.</small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.groups.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

