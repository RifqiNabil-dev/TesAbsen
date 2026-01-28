@extends('layouts.app')

@section('title', 'Logbook')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        <i class="bi bi-journal-text"></i>
        Logbook
    </h2>
</div>

<!-- FILTER -->
<div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
    <div class="p-6">
        <form method="GET" action="{{ route('admin.logbooks.index') }}"
              class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">

            <!-- STATUS -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Status
                </label>
                <select
                    name="status"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200 focus:border-blue-500"
                >
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                        Disetujui
                    </option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                        Ditolak
                    </option>
                </select>
            </div>

            <!-- BUTTON -->
            <div class="flex gap-2">
                <button
                    type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-sm font-semibold
                           text-white hover:bg-blue-700"
                >
                    Filter
                </button>

                <a
                    href="{{ route('admin.logbooks.index') }}"
                    class="rounded bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600"
                >
                    Reset
                </a>
            </div>

        </form>
    </div>
</div>

<!-- TABLE -->
<div class="bg-white rounded-lg shadow border border-gray-200">
    <div class="p-6 overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Mahasiswa</th>
                    <th class="px-4 py-3">Aktivitas</th>
                    <th class="px-4 py-3">Waktu</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($logbooks as $logbook)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            {{ $logbook->date->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $logbook->user->name }}
                        </td>
                        <td class="px-4 py-3">
                            {{ Str::limit($logbook->activity, 40) }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $logbook->start_time }} - {{ $logbook->end_time }}
                        </td>
                        <td class="px-4 py-3">
                            @if($logbook->status === 'pending')
                                <span class="inline-block rounded bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                    Pending
                                </span>
                            @elseif($logbook->status === 'approved')
                                <span class="inline-block rounded bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    Disetujui
                                </span>
                            @else
                                <span class="inline-block rounded bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <a
                                href="{{ route('admin.logbooks.show', $logbook) }}"
                                class="inline-flex items-center gap-1 rounded bg-sky-600 px-3 py-1.5
                                       text-xs font-semibold text-white hover:bg-sky-700"
                            >
                                <i class="bi bi-eye"></i>
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            Tidak ada data logbook
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $logbooks->links() }}
        </div>
    </div>
</div>

@endsection
