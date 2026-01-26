@extends('layouts.app')

@section('title', 'Edit Jadwal')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Jadwal</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.schedules.update', $schedule) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="user_id" class="form-label">Mahasiswa <span class="text-danger">*</span></label>
                <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    <option value="">Pilih Mahasiswa</option>
                    @foreach($mahasiswa as $mhs)
                        <option value="{{ $mhs->id }}" {{ old('user_id', $schedule->user_id) == $mhs->id ? 'selected' : '' }}>
                            {{ $mhs->name }}
                            @if($mhs->group)
                                - {{ $mhs->group->name }}
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location_id" class="form-label">Lokasi <span class="text-danger">*</span></label>
                <select class="form-select @error('location_id') is-invalid @enderror" id="location_id" name="location_id" required>
                    <option value="">Pilih Lokasi</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id', $schedule->location_id) == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" id="date" name="date" value="{{ old('date', $schedule->date ? (is_string($schedule->date) ? \Carbon\Carbon::parse($schedule->date)->format('Y-m-d') : $schedule->date->format('Y-m-d')) : '') }}" placeholder="Pilih tanggal" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Waktu Mulai <span class="text-danger">*</span></label>
                        @php
                            $startTime = $schedule->start_time;
                            if (is_string($startTime)) {
                                $startTime = \Carbon\Carbon::parse($startTime)->format('H:i');
                            } elseif ($startTime instanceof \Carbon\Carbon) {
                                $startTime = $startTime->format('H:i');
                            }
                        @endphp
                        <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time', $startTime) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="end_time" class="form-label">Waktu Selesai <span class="text-danger">*</span></label>
                        @php
                            $endTime = $schedule->end_time;
                            if (is_string($endTime)) {
                                $endTime = \Carbon\Carbon::parse($endTime)->format('H:i');
                            } elseif ($endTime instanceof \Carbon\Carbon) {
                                $endTime = $endTime->format('H:i');
                            }
                        @endphp
                        <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time', $endTime) }}" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Catatan</label>
                <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $schedule->notes) }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

