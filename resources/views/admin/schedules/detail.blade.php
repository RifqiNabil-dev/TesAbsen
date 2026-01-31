@extends('layouts.app')

@section('title', 'Detail Jadwal Kelompok - ' . $group->name)

@section('content')
    <div class="space-y-6">

        <!-- HEADER / BREADCRUMB -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                    <a href="{{ route('admin.schedules.index') }}" class="hover:text-blue-600 transition">Data Kelompok</a>
                    <i class="bi bi-chevron-right text-xs"></i>
                    <span class="font-medium text-gray-900">{{ $group->name }}</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Jadwal Kelompok</h2>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.schedules.index') }}"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition flex items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                {{-- Print Button --}}
                <a href="{{ route('admin.schedules.print', request()->all()) }}" target="_blank"
                    class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200 transition flex items-center gap-2">
                    <i class="bi bi-printer"></i> Cetak Jadwal
                </a>

                <a href="{{ route('admin.schedules.create') }}"
                    class="px-4 py-2 bg-blue-600 rounded-lg text-sm font-medium text-white hover:bg-blue-700 transition flex items-center gap-2 shadow-sm">
                    <i class="bi bi-plus-lg"></i> Tambah Jadwal
                </a>

                <!-- BULK DELETE FORM -->
                <form action="{{ route('admin.schedules.bulk-destroy') }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus jadwal yang dipilih?');" class="hidden"
                    id="bulkDeleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 rounded-lg text-sm font-medium text-white hover:bg-red-700 transition flex items-center gap-2 shadow-sm">
                        <i class="bi bi-trash"></i> Hapus Terpilih
                    </button>
                    <div id="bulkDeleteInputs"></div>
                </form>
            </div>
        </div>

        <!-- FILTER CARD -->
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <form action="{{ route('admin.schedules.index') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <input type="hidden" name="group_id" value="{{ $group->id }}">

                <!-- Filter User -->
                <div>
                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Peserta</label>
                    <select name="user_id"
                        class="w-full text-sm rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Peserta</option>
                        @foreach($usersInGroup as $u)
                            <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Date Start -->
                <div>
                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="w-full text-sm rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Filter Date End -->
                <div>
                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="w-full text-sm rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition flex-1">
                        Filter
                    </button>
                    <a href="{{ route('admin.schedules.index', ['group_id' => $group->id]) }}"
                        class="bg-gray-100 text-gray-600 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-200 transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">

            <!-- TOOLBAR: CHECK ALL -->
            <div class="p-3 bg-gray-50 border-b border-gray-200 flex items-center gap-3">
                <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                    <input type="checkbox" id="checkAllHeader"
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="font-medium">Pilih Semua</span>
                </label>
                <div id="selectionStatus" class="text-sm text-gray-500 italic hidden">
                    <span id="selectCount">0</span> jadwal dipilih
                </div>
            </div>

            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-700 font-semibold border-b">
                    <tr>
                        <th class="w-10 px-4 py-3 text-center">
                            #
                        </th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Peserta</th>
                        <th class="px-4 py-3">Jam</th>
                        <th class="px-4 py-3">Lokasi</th>
                        <th class="px-4 py-3">Catatan</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($schedules as $schedule)
                        <tr class="hover:bg-gray-50 transition group">
                            <td class="px-4 py-3 text-center">
                                <input type="checkbox" name="ids[]" value="{{ $schedule->id }}"
                                    class="schedule-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900">
                                {{ $schedule->date->format('d-m-Y') }}
                                <span
                                    class="text-xs text-gray-500 block font-normal">{{ $schedule->date->translatedFormat('l') }}</span>
                            </td>
                            <td class="px-4 py-3 text-gray-900">
                                {{ $schedule->user->name ?? '-' }}
                                <span class="text-xs text-gray-500 block">{{ $schedule->user->nim ?? '' }}</span>
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($schedule->locations as $loc)
                                        <span
                                            class="px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                            {{ $loc->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-500 truncate max-w-xs" title="{{ $schedule->notes }}">
                                {{ $schedule->notes ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-center relative">
                                <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST"
                                    onsubmit="return confirm('Hapus jadwal tanggal {{ $schedule->date->format('d-m-Y') }}?');"
                                    class="inline-flex items-center gap-1">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.schedules.edit', $schedule) }}"
                                        class="p-1.5 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded transition"
                                        title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button type="submit"
                                        class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded transition"
                                        title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="bi bi-calendar4-week text-3xl text-gray-300"></i>
                                    <p>Belum ada jadwal untuk kelompok ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $schedules->appends(request()->query())->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const checkAll = document.getElementById('checkAllHeader');
                const checkboxes = document.querySelectorAll('.schedule-checkbox');
                const bulkDeleteForm = document.getElementById('bulkDeleteForm');
                const bulkDeleteInputs = document.getElementById('bulkDeleteInputs');
                const selectionStatus = document.getElementById('selectionStatus');
                const selectCount = document.getElementById('selectCount');

                function updateUI() {
                    const checked = Array.from(checkboxes).filter(c => c.checked);

                    if (checked.length > 0) {
                        bulkDeleteForm.classList.remove('hidden');
                        bulkDeleteForm.classList.add('flex');
                        selectionStatus.classList.remove('hidden');
                        selectCount.textContent = checked.length;

                        // Re-render hidden inputs
                        bulkDeleteInputs.innerHTML = '';
                        checked.forEach(c => {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'ids[]';
                            input.value = c.value;
                            bulkDeleteInputs.appendChild(input);
                        });
                    } else {
                        bulkDeleteForm.classList.add('hidden');
                        bulkDeleteForm.classList.remove('flex');
                        selectionStatus.classList.add('hidden');
                    }
                }

                checkAll.addEventListener('change', function () {
                    checkboxes.forEach(c => c.checked = checkAll.checked);
                    updateUI();
                });

                checkboxes.forEach(c => {
                    c.addEventListener('change', function () {
                        const allChecked = Array.from(checkboxes).length > 0 && Array.from(checkboxes).every(c => c.checked);
                        checkAll.checked = allChecked;
                        updateUI();
                    });
                });
            });
        </script>
    @endpush

@endsection