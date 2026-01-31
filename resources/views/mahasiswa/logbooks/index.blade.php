@extends('layouts.app')

@section('title', 'Logbook')

@section('content')

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <h2 class="text-xl sm:text-2xl font-semibold flex items-center gap-2">
            <i class="bi bi-journal-text"></i> Logbook
        </h2>

        <a href="{{ route('mahasiswa.logbooks.create') }}" class="inline-flex items-center justify-center gap-2
                  bg-blue-500 hover:bg-blue-600 text-white
                  px-4 py-2 rounded-lg text-sm sm:text-base
                  w-full sm:w-auto">
            <i class="bi bi-plus-circle"></i> Tambah Logbook
        </a>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 sm:p-6">

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Tanggal</th>
                            <th class="p-3 text-left">Aktivitas</th>
                            <th class="p-3 text-left">Waktu</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse($logbooks as $logbook)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">
                                    {{ $logbook->date->format('d-m-Y') }}
                                </td>

                                <td class="p-3">
                                    {{ Str::limit($logbook->activity, 40) }}
                                </td>

                                <td class="p-3 whitespace-nowrap">
                                    {{ $logbook->start_time }} - {{ $logbook->end_time }}
                                </td>

                                <td class="p-3">
                                    @if($logbook->status === 'pending')
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-medium">
                                            Pending
                                        </span>
                                    @elseif($logbook->status === 'approved')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">
                                            Disetujui
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>

                                <td class="p-3">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('mahasiswa.logbooks.show', $logbook) }}" class="bg-cyan-500 hover:bg-cyan-600 text-white
                                                      px-2 py-1 rounded text-xs flex items-center">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        @if($logbook->isPending())
                                            <a href="{{ route('mahasiswa.logbooks.edit', $logbook) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white
                                                              px-2 py-1 rounded text-xs flex items-center">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('mahasiswa.logbooks.destroy', $logbook) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white
                                                                   px-2 py-1 rounded text-xs flex items-center">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-500">
                                    Belum ada data logbook
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $logbooks->links() }}
            </div>

        </div>
    </div>

@endsection