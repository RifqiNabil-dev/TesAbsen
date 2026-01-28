@extends('layouts.app')

@section('title', 'Data Presensi')

@section('content')
<div 
    x-data="attendanceFilter()" 
    class="space-y-4"
>

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <h2 class="text-2xl font-bold text-gray-800">Data Presensi</h2>
    </div>

    <!-- SEARCH & FILTER -->
    <div class="flex flex-col md:flex-row gap-3">

        <!-- SEARCH -->
        <input
            type="text"
            x-model="search"
            placeholder="Cari nama mahasiswa / lokasi..."
            class="w-full md:w-1/3 rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none"
        >

        <!-- FILTER MAHASISWA -->
        <select
            x-model="user"
            class="w-full md:w-1/4 rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none"
        >
            <option value="">Semua Mahasiswa</option>
            @foreach($mahasiswa as $mhs)
                <option value="{{ $mhs->id }}">{{ $mhs->name }}</option>
            @endforeach
        </select>

        <!-- FILTER STATUS -->
        <select
            x-model="status"
            class="w-full md:w-1/4 rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none"
        >
            <option value="">Semua Status</option>
            <option value="hadir">Hadir</option>
            <option value="terlambat">Terlambat</option>
            <option value="tidak_hadir">Tidak Hadir</option>
        </select>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Mahasiswa</th>
                    <th class="px-4 py-3">Lokasi</th>
                    <th class="px-4 py-3">Check In</th>
                    <th class="px-4 py-3">Check Out</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($attendances as $attendance)
                <tr
                    class="border-t hover:bg-gray-50"
                    x-show="filterRow($el)"
                    data-user="{{ $attendance->user_id }}"
                    data-name="{{ strtolower($attendance->user->name) }}"
                    data-location="{{ strtolower($attendance->location->name ?? '') }}"
                    data-status="{{ $attendance->status }}"
                >
                    <td class="px-4 py-3">
                        {{ $attendance->date?->format('d/m/Y') ?? '-' }}
                    </td>
                    <td class="px-4 py-3 font-medium">
                        {{ $attendance->user->name }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $attendance->location->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $attendance->check_in?->format('H:i') ?? '-' }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $attendance->check_out?->format('H:i') ?? '-' }}
                    </td>
                    <td class="px-4 py-3">
                        @if($attendance->status === 'hadir')
                            <span class="rounded bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">Hadir</span>
                        @elseif($attendance->status === 'terlambat')
                            <span class="rounded bg-yellow-100 px-2 py-1 text-xs font-semibold text-yellow-700">Terlambat</span>
                        @else
                            <span class="rounded bg-red-100 px-2 py-1 text-xs font-semibold text-red-700">Tidak Hadir</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('admin.attendance.show', $attendance) }}"
                           class="inline-block rounded bg-blue-500 px-2 py-1 text-white hover:bg-blue-600">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                        Tidak ada data presensi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div>
        {{ $attendances->links() }}
    </div>
</div>

<!-- ALPINE JS -->
<script>
function attendanceFilter() {
    return {
        search: '',
        user: '',
        status: '',

        filterRow(row) {
            const name = row.dataset.name
            const location = row.dataset.location
            const user = row.dataset.user
            const status = row.dataset.status

            const searchMatch =
                name.includes(this.search.toLowerCase()) ||
                location.includes(this.search.toLowerCase())

            const userMatch =
                this.user === '' || user === this.user

            const statusMatch =
                this.status === '' || status === this.status

            return searchMatch && userMatch && statusMatch
        }
    }
}
</script>
@endsection
