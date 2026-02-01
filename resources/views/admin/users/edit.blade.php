@extends('layouts.app')

@section('title', 'Manage User')

@section('content')

<div class="bg-white rounded-lg border shadow">

    <!-- Header -->
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <h2 class="text-lg font-bold text-gray-800">
            Manage User
        </h2>
    </div>

    <!-- Table -->
    <form id="roleForm" method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-center">Nama</th>
                        <th class="p-3 text-center">Email</th>
                        <th class="p-3 text-center">Role</th>
                        <th class="p-3 text-center">Tanggal Dibuat</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50 text-center">
                        <td class="p-3">
                            {{ $user->name }}
                        </td>
                        <td class="p-3 text-center">
                            {{ $user->email }}
                        </td>
                        <td class="p-3 text-center">
                            <select name="role"
                                class="rounded border border-gray-300 px-3 py-2 text-sm
                                       focus:ring focus:ring-blue-200 focus:border-blue-500">
                                <option value="mahasiswa" {{ $user->role === 'mahasiswa' ? 'selected' : '' }}>
                                    Mahasiswa
                                </option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>
                            </select>
                        </td>
                        <td class="p-3 text-gray-600 text-center">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>
                        <td class="p-3 gap-2 text-center">
                            <button type="submit"
                                class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700
                                       text-white text-xs font-semibold px-4 py-2 rounded">
                                <i class="bi bi-save"></i>
                                Simpan
                            </button>

                            <a href="{{ route('admin.users.index') }}"
                            class="inline-flex items-center gap-1 bg-gray-500 hover:bg-gray-600
                                    text-white text-xs font-semibold px-4 py-2 rounded">
                                <i class="bi bi-x-circle"></i>
                                Batal
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
</div>


<script>
    document.getElementById('roleForm').addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Simpan Perubahan?',
            text: 'Role user akan diperbarui.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    });

    @if(session('alert') === 'updated')
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Role user berhasil diperbarui.',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });

        setTimeout(() => {
            window.location.href = "{{ route('admin.users.index') }}";
        }, 3000);
    @endif

</script>


@endsection
