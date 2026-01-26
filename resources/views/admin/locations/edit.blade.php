@extends('layouts.app')

@section('title', 'Edit Lokasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Lokasi</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.locations.update', $location) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $location->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $location->description) }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $location->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

