@extends('layouts.app')

@section('title', 'Detail Kelompok')

@section('content')
    <div x-data="{ openModal: false }" class="space-y-6">

        <!-- ================= HEADER DETAIL ================= -->
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-800">
                    Detail Kelompok: {{ $group->name }}
                </h2>

                <div class="flex gap-2">
                    <a href="{{ route('admin.groups.edit', $group) }}"
                        class="rounded bg-yellow-500 px-3 py-2 text-sm font-semibold text-white hover:bg-yellow-600">
                        ✏️ Edit
                    </a>

                    <a href="{{ route('admin.groups.index') }}"
                        class="rounded bg-gray-500 px-3 py-2 text-sm font-semibold text-white hover:bg-gray-600">
                        ⬅ Kembali
                    </a>
                </div>
            </div>

            <div class="p-6">
                <table class="w-full text-sm">
                    <tr class="border-b">
                        <th class="w-40 py-2 text-left text-gray-600">Nama Kelompok</th>
                        <td class="py-2 font-medium">{{ $group->name }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-2 text-left text-gray-600">Deskripsi</th>
                        <td class="py-2">{{ $group->description ?? '-' }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-2 text-left text-gray-600">Status</th>
                        <td class="py-2">
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
                    </tr>
                    <tr>
                        <th class="py-2 text-left text-gray-600">Jumlah Anggota</th>
                        <td class="py-2 font-semibold">
                            {{ $group->users->count() }} orang
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- ================= ANGGOTA KELOMPOK ================= -->
        <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-800">
                    👥 Anggota Kelompok
                    <span class="ml-2 rounded bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-700">
                        {{ $group->users->count() }} anggota
                    </span>
                </h3>

                <button @click="openModal = true"
                    class="rounded bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                    ➕ Tambah Anggota
                </button>
            </div>

            <div class="p-6 overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">NIM</th>
                            <th class="px-4 py-3">Institusi</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($group->users as $user)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">{{ $user->nim ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $user->institution ?? '-' }}</td>
                                <td class="px-4 py-3 text-center">
                                    <form action="{{ route('admin.groups.remove-member', [$group, $user]) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin mengeluarkan {{ $user->name }} dari kelompok?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded bg-red-500 px-2 py-1 text-xs font-semibold text-white hover:bg-red-600">
                                            ➖ Keluarkan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                    Belum ada anggota di kelompok ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ================= MODAL TAMBAH ANGGOTA (SEARCH) ================= -->
        <div x-show="openModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div x-data="memberSearch()" @click.outside="openModal = false"
                class="w-full max-w-lg rounded-lg bg-white shadow-lg">

                <!-- HEADER -->
                <div class="flex items-center justify-between border-b px-5 py-3">
                    <h3 class="font-semibold text-gray-800">Tambah Anggota ke Kelompok</h3>
                    <button @click="openModal = false" class="text-gray-500 hover:text-gray-700">✖</button>
                </div>

                <!-- FORM -->
                <form method="POST" action="{{ route('admin.groups.add-member', $group) }}">
                    @csrf

                    <div class="p-5 space-y-4">

                        <!-- SEARCH INPUT -->
                        <input type="text" x-model="search" placeholder="Cari nama / email mahasiswa..." class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                               focus:ring focus:ring-blue-200 focus:outline-none">

                        <!-- LIST MAHASISWA -->
                        <div class="max-h-64 overflow-y-auto rounded border border-gray-200">
                            @foreach($availableMahasiswa as $mahasiswa)
                                <div x-show="match('{{ strtolower($mahasiswa->name) }} {{ strtolower($mahasiswa->email) }}')"
                                    @click="select({{ $mahasiswa->id }}, '{{ $mahasiswa->name }}')"
                                    class="cursor-pointer px-4 py-2 hover:bg-blue-50 flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-gray-800">
                                            {{ $mahasiswa->name }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $mahasiswa->email }}
                                            @if($mahasiswa->nim)
                                                • NIM: {{ $mahasiswa->nim }}
                                            @endif
                                        </p>
                                    </div>
                                    <span class="text-xs text-blue-600 font-semibold">Pilih</span>
                                </div>
                            @endforeach
                        </div>

                        <!-- SELECTED -->
                        <template x-if="selectedName">
                            <div class="rounded bg-blue-50 px-3 py-2 text-sm text-blue-700">
                                Terpilih: <strong x-text="selectedName"></strong>
                            </div>
                        </template>

                        <input type="hidden" name="user_id" :value="selectedId" required>

                        <p class="text-xs text-gray-500">
                            Peserta yang sudah di kelompok lain akan otomatis dipindahkan.
                        </p>
                    </div>

                    <!-- FOOTER -->
                    <div class="flex justify-end gap-2 border-t px-5 py-3">
                        <button type="button" @click="openModal = false"
                            class="rounded bg-gray-500 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-600">
                            Batal
                        </button>
                        <button type="submit" :disabled="!selectedId" class="rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white
                               hover:bg-blue-700 disabled:opacity-50">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <script>
        function memberSearch() {
            return {
                search: '',
                selectedId: null,
                selectedName: '',

                match(text) {
                    return text.includes(this.search.toLowerCase())
                },

                select(id, name) {
                    this.selectedId = id
                    this.selectedName = name
                }
            }
        }
    </script>

@endsection