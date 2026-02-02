@extends('layouts.app')

@section('title', 'Daftar Division')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <i class="bi bi-list-task"></i> Daftar Divisi
        </h2>
        
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.locations.index') }}"
                    class="inline-flex items-center gap-2 rounded bg-blue-600 px-4 py-2
                        text-sm font-semibold text-white hover:bg-blue-700"
                >
                    <i class="bi bi-box-arrow-left"></i> Kembali
                </a>
            <a
                href="{{ route('admin.divisions.create') }}"
                class="inline-flex items-center gap-2 rounded bg-blue-600 px-4 py-2
                    text-sm font-semibold text-white hover:bg-blue-700"
            >
                <i class="bi bi-plus-circle"></i> Tambah Divisi
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 border-b">
                    <tr class="text-left text-gray-700">
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3 w-32 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach($divisions as $division)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $division->name }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ Str::limit($division->description, 50) }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="{{ route('admin.divisions.edit', $division) }}"
                                        class="rounded bg-yellow-400 p-2 text-white hover:bg-yellow-500"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.divisions.destroy', $division) }}"
                                        method="POST"
                                        class="delete-form"
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Hapus Division?',
                text: 'Data division akan dihapus secara permanen.',
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
        });
    });

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            confirmButtonColor: '#2563eb'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc2626'
        });
    @endif
</script>

@endsection
