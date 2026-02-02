@extends('layouts.app')

@section('title', 'Kelompok Magang')

@section('content')
    <div class="space-y-4">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="bi bi-people"></i> Kelompok Magang
            </h2>

            <a href="{{ route('admin.groups.create') }}"
                class="inline-flex items-center gap-2 rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                <i class="bi bi-plus-circle"></i> Tambah Kelompok
            </a>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3">Nama Kelompok</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Jumlah Anggota</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($groups as $group)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold text-gray-800">
                                {{ $group->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $group->description ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                <span
                                    class="inline-flex items-center rounded bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-700">
                                    {{ $group->users_count }} anggota
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                @if($group->is_active)
                                    <span class="rounded bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="rounded bg-gray-200 px-2 py-1 text-xs font-semibold text-gray-700">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center space-x-1">
                                <a href="{{ route('admin.groups.show', $group) }}"
                                    class="inline-block rounded bg-blue-500 px-2 py-1 text-white hover:bg-blue-600">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('admin.groups.edit', $group) }}"
                                    class="inline-block rounded bg-yellow-500 px-2 py-1 text-white hover:bg-yellow-600">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.groups.destroy', $group) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        onclick="confirmDeleteGroup(this)"
                                        class="rounded bg-red-500 px-2 py-1 text-white hover:bg-red-600">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada data kelompok
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

<script>
    function confirmDeleteGroup(button) {
        const form = button.closest('form');

        Swal.fire({
            title: 'Hapus Kelompok?',
            text: 'Semua anggota akan dikeluarkan dari kelompok ini.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            confirmButtonColor: '#2563eb'
        });
    @endif
</script>

@endsection