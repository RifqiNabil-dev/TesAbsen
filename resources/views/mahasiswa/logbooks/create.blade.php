@extends('layouts.app')

@section('title', 'Tambah Logbook')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Tambah Logbook</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('mahasiswa.logbooks.store') }}">
            @csrf

            <div class="mb-3">
                <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" id="date" name="date" value="{{ old('date', today()->format('Y-m-d')) }}" placeholder="Pilih tanggal" required>
            </div>

            <div class="mb-3">
                <label for="activity" class="form-label">Aktivitas <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="activity" name="activity" value="{{ old('activity') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Kegiatan <span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Waktu Mulai <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="end_time" class="form-label">Waktu Selesai <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('mahasiswa.logbooks.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

