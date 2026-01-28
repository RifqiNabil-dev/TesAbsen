@extends('layouts.app')

@section('title', 'Lokasi')

@section('content')
<div class="max-w-6xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <i class="bi bi-geo-alt"></i> Lokasi
        </h2>

        <a
            href="{{ route('admin.locations.create') }}"
            class="inline-flex items-center gap-2 rounded bg-blue-600 px-4 py-2
                   text-sm font-semibold text-white hover:bg-blue-700"
        >
            <i class="bi bi-plus-circle"></i> Tambah Lokasi
        </a>
    </div>

    <!-- TABLE CARD -->
    <div class="bg-white rounded-lg shadow border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 border-b">
                    <tr class="text-left text-gray-700">
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Koordinat</th> <!-- Kolom koordinat -->
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 w-32">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($locations as $location)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $location->name }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ Str::limit($location->description, 50) }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $location->latitude }}, {{ $location->longitude }} <!-- Kolom Koordinat -->
                            </td>

                            <td class="px-4 py-3">
                                @if($location->is_active)
                                    <span class="inline-block rounded bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-block rounded bg-gray-200 px-2 py-1 text-xs font-semibold text-gray-600">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="{{ route('admin.locations.edit', $location) }}"
                                        class="rounded bg-yellow-400 p-2 text-white hover:bg-yellow-500"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.locations.destroy', $location) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="rounded bg-red-600 p-2 text-white hover:bg-red-700"
                                            title="Hapus"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada data lokasi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
