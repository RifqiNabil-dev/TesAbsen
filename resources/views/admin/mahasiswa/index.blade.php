@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div 
    x-data="mahasiswaFilter()" 
    class="space-y-4"
>

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <h2 class="text-2xl font-bold text-gray-800">Data Mahasiswa</h2>

        <a href="{{ route('admin.mahasiswa.create') }}"
           class="inline-flex items-center gap-2 rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
            <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
        </a>
    </div>

    <!-- SEARCH & FILTER -->
    <div class="flex flex-col md:flex-row gap-3">
        <!-- Search -->
        <input
            type="text"
            x-model="search"
            placeholder="Cari nama / email..."
            class="w-full md:w-1/3 rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none"
        >

        <!-- Filter Institusi -->
        <select
            x-model="institution"
            class="w-full md:w-1/4 rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none"
        >
            <option value="">Semua Institusi</option>
            @foreach($mahasiswa->pluck('institution')->unique() as $inst)
                @if($inst)
                    <option value="{{ strtolower($inst) }}">{{ $inst }}</option>
                @endif
            @endforeach
        </select>

        <!-- Filter Periode -->
        <select
            x-model="periode"
            class="w-full md:w-1/4 rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none"
        >
            <option value="">Semua Periode</option>
            <option value="aktif">Sedang Magang</option>
            <option value="selesai">Sudah Selesai</option>
            <option value="belum">Belum Mulai</option>
        </select>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">NIM</th>
                    <th class="px-4 py-3">Institusi</th>
                    <th class="px-4 py-3">Periode</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($mahasiswa as $mhs)
                @php
                    $start = $mhs->start_date ? \Carbon\Carbon::parse($mhs->start_date) : null;
                    $end = $mhs->end_date ? \Carbon\Carbon::parse($mhs->end_date) : null;
                @endphp

                <tr
                    class="border-t hover:bg-gray-50"
                    x-show="filterRow($el)"
                    data-name="{{ strtolower($mhs->name) }}"
                    data-email="{{ strtolower($mhs->email) }}"
                    data-institution="{{ strtolower($mhs->institution ?? '') }}"
                    data-start="{{ $mhs->start_date }}"
                    data-end="{{ $mhs->end_date }}"
                >
                    <td class="px-4 py-3 font-medium">{{ $mhs->name }}</td>
                    <td class="px-4 py-3">{{ $mhs->email }}</td>
                    <td class="px-4 py-3">{{ $mhs->nim ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $mhs->institution ?? '-' }}</td>
                    <td class="px-4 py-3">
                        @if($start && $end)
                            {{ $start->format('d/m/Y') }} - {{ $end->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center space-x-1">
                        <a href="{{ route('admin.mahasiswa.show', $mhs) }}"
                           class="inline-block rounded bg-blue-500 px-2 py-1 text-white hover:bg-blue-600">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.mahasiswa.edit', $mhs) }}"
                           class="inline-block rounded bg-yellow-500 px-2 py-1 text-white hover:bg-yellow-600">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.mahasiswa.destroy', $mhs) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="rounded bg-red-500 px-2 py-1 text-white hover:bg-red-600">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                        Tidak ada data mahasiswa
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div>
        {{ $mahasiswa->links() }}
    </div>
</div>

<!-- ALPINE JS -->
<script>
function mahasiswaFilter() {
    return {
        search: '',
        institution: '',
        periode: '',

        filterRow(row) {
            const name = row.dataset.name
            const email = row.dataset.email
            const institution = row.dataset.institution

            const start = row.dataset.start
            const end = row.dataset.end
            const today = new Date().toISOString().split('T')[0]

            const searchMatch =
                name.includes(this.search.toLowerCase()) ||
                email.includes(this.search.toLowerCase())

            const institutionMatch =
                this.institution === '' ||
                institution === this.institution

            let periodeMatch = true

            if (this.periode === 'aktif') {
                periodeMatch = start && end && start <= today && end >= today
            }

            if (this.periode === 'selesai') {
                periodeMatch = end && end < today
            }

            if (this.periode === 'belum') {
                periodeMatch = start && start > today
            }

            return searchMatch && institutionMatch && periodeMatch
        }
    }
}
</script>
@endsection
