@extends('layouts.app')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Tambah Jadwal</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.schedules.store') }}">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">Mahasiswa <span class="text-danger">*</span></label>
                <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    <option value="">Pilih Mahasiswa</option>
                    @foreach($mahasiswa as $mhs)
                        <option value="{{ $mhs->id }}" {{ old('user_id') == $mhs->id ? 'selected' : '' }}>
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
                <select class="form-select" id="location_id" name="location_id" required>
                    <option value="">Pilih Lokasi</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Periode Jadwal <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-md-6">
                        <label for="start_date" class="form-label small">Tanggal Mulai</label>
                        <input type="text" class="form-control datepicker @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" placeholder="Pilih tanggal mulai" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="end_date" class="form-label small">Tanggal Selesai</label>
                        <input type="text" class="form-control datepicker @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}" placeholder="Pilih tanggal selesai" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <small class="form-text text-muted">
                    <i class="bi bi-info-circle"></i> Sistem akan otomatis membuat jadwal untuk hari kerja (Senin-Jumat) dengan waktu:
                    <br>• Senin s.d Kamis: 08:00 - 16:00 WIB
                    <br>• Jumat: 07:30 - 15:00 WIB
                </small>
            </div>

            <div class="alert alert-info">
                <i class="bi bi-calendar-check"></i> <strong>Info:</strong> Jadwal akan dibuat otomatis untuk setiap hari kerja dalam periode yang dipilih. Sabtu dan Minggu akan dilewati.
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Catatan</label>
                <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        
        if (startDateInput && endDateInput && !startDateInput.hasAttribute('data-fp-initialized')) {
            const startPicker = flatpickr(startDateInput, {
                dateFormat: 'Y-m-d',
                locale: 'id',
                allowInput: true,
                altInput: true,
                altFormat: 'd/m/Y',
                altInputClass: 'form-control',
                disableMobile: true,
                monthSelectorType: 'static',
                yearSelectorType: 'static',
                static: true,
                onChange: function(selectedDates) {
                    if (selectedDates.length > 0) {
                        endPicker.set('minDate', selectedDates[0]);
                    }
                }
            });
            
            const endPicker = flatpickr(endDateInput, {
                dateFormat: 'Y-m-d',
                locale: 'id',
                allowInput: true,
                altInput: true,
                altFormat: 'd/m/Y',
                altInputClass: 'form-control',
                disableMobile: true,
                monthSelectorType: 'static',
                yearSelectorType: 'static',
                static: true,
                minDate: startDateInput.value || 'today'
            });
            
            startDateInput.setAttribute('data-fp-initialized', 'true');
            endDateInput.setAttribute('data-fp-initialized', 'true');
        }
    });
</script>
@endpush
@endsection


