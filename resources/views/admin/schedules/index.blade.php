@extends('layouts.app')

@section('title', 'Data Jadwal Kelompok')

@section('content')

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
            <i class="bi bi-calendar-check"></i> Data Jadwal Kelompok
        </h2>

        <div class="flex gap-2">
            <a href="{{ route('admin.schedules.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Buat Jadwal
            </a>
        </div>
    </div>

    <!-- FILTER & SEARCH -->
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mb-6">
        <form action="{{ route('admin.schedules.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">

            <div class="flex-1">
                <div class="relative">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kelompok..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>
            </div>
        </form>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-700 font-semibold border-b">
                <tr>
                    <th class="px-6 py-4">Nama Kelompok</th>
                    <th class="px-6 py-4 text-center">Jumlah Peserta</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($groups as $group)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $group->name }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $group->users_count }} Peserta
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.schedules.index', ['group_id' => $group->id]) }}"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-medium text-white shadow-sm hover:bg-blue-700 transition">
                                <i class="bi bi-calendar-week"></i>
                                Detail Jadwal
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <i class="bi bi-calendar-x text-3xl text-gray-300"></i>
                                <p>Tidak ada data kelompok ditemukan</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $groups->withQueryString()->links() }}
    </div>

@endsection