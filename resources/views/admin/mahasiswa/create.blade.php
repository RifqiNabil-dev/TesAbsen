@extends('layouts.app')

@section('title', 'Tambah Peserta')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow border border-gray-200">

        <!-- Header -->
        <div class="border-b px-6 py-4">
            <h2 class="text-lg font-bold text-gray-800">Tambah Peserta</h2>
        </div>

        <!-- Body -->
        <div class="p-6">
            <form method="POST" action="{{ route('admin.mahasiswa.store') }}">
                @csrf

                <!-- Nama -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">
                        Nama <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-sm font-semibold mb-1">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" required
                            class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold mb-1">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password_confirmation" required
                            class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                    </div>
                </div>

                <!-- NIM -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">NIM</label>
                    <input type="text" name="nim" value="{{ old('nim') }}"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                </div>

                <!-- Institusi -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Institusi</label>
                    <input type="text" name="institution" value="{{ old('institution') }}"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                </div>

                <!-- No Telepon -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">No. Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                </div>

                <!-- Periode Magang -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold mb-1">
                            Tanggal Mulai
                        </label>
                    <input type="text" id="start_date" name="start_date" value="{{ request('start_date') }}"
                            class="datepicker w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">
                            Tanggal Selesai
                        </label>
                    <input type="text" id="end_date" name="end_date" value="{{ request('end_date') }}"
                            class="datepicker w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Action -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('admin.mahasiswa.index') }}"
                        class="rounded bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600">
                        Batal
                    </a>

                    <button type="submit"
                        class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection