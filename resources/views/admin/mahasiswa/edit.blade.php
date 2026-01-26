@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Mahasiswa</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.mahasiswa.update', $mahasiswa) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $mahasiswa->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $mahasiswa->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}">
            </div>

            <div class="mb-3">
                <label for="institution" class="form-label">Institusi</label>
                <input type="text" class="form-control" id="institution" name="institution" value="{{ old('institution', $mahasiswa->institution) }}">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">No. Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $mahasiswa->phone) }}">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="text" class="form-control datepicker" id="start_date" name="start_date" value="{{ old('start_date', $mahasiswa->start_date ? (is_string($mahasiswa->start_date) ? \Carbon\Carbon::parse($mahasiswa->start_date)->format('Y-m-d') : $mahasiswa->start_date->format('Y-m-d')) : '') }}" placeholder="Pilih tanggal mulai">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="text" class="form-control datepicker" id="end_date" name="end_date" value="{{ old('end_date', $mahasiswa->end_date ? (is_string($mahasiswa->end_date) ? \Carbon\Carbon::parse($mahasiswa->end_date)->format('Y-m-d') : $mahasiswa->end_date->format('Y-m-d')) : '') }}" placeholder="Pilih tanggal selesai">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

