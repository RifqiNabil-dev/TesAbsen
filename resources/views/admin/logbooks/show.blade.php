@extends('layouts.app')

@section('title', 'Detail Logbook')

@section('content')

<div class="bg-white rounded-lg shadow border border-gray-200">

    <!-- HEADER -->
    <div class="border-b px-6 py-4">
        <h5 class="text-lg font-semibold text-gray-800">
            Detail Logbook
        </h5>
    </div>

    <!-- BODY -->
    <div class="p-6">

        <!-- DETAIL TABLE -->
        <div class="overflow-x-auto mb-6">
            <table class="w-full text-sm text-gray-700">
                <tbody class="divide-y">

                    <tr>
                        <th class="w-52 py-3 font-semibold text-left text-gray-600">
                            Tanggal
                        </th>
                        <td class="py-3">
                            {{ $logbook->date->format('d/m/Y') }}
                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Mahasiswa
                        </th>
                        <td class="py-3">
                            {{ $logbook->user->name }}
                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Aktivitas
                        </th>
                        <td class="py-3">
                            {{ $logbook->activity }}
                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Deskripsi
                        </th>
                        <td class="py-3 whitespace-pre-line">
                            {{ $logbook->description }}
                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Waktu
                        </th>
                        <td class="py-3">
                            {{ $logbook->start_time }} - {{ $logbook->end_time }}
                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Status
                        </th>
                        <td class="py-3">
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
                    </tr>

                    @if($logbook->admin_notes)
                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Catatan Admin
                        </th>
                        <td class="py-3">
                            {{ $logbook->admin_notes }}
                        </td>
                    </tr>
                    @endif

                    @if($logbook->approved_by)
                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Disetujui Oleh
                        </th>
                        <td class="py-3">
                            {{ $logbook->approver->name }}
                            <span class="text-gray-500 text-xs">
                                ({{ $logbook->approved_at->format('d/m/Y H:i') }})
                            </span>
                        </td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>

        <!-- APPROVAL FORM -->
        @if($logbook->isPending())
        <form method="POST" action="{{ route('admin.logbooks.approve', $logbook) }}" class="mb-6">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="admin_notes" class="block text-sm font-semibold text-gray-700 mb-1">
                    Catatan
                </label>
                <textarea
                    id="admin_notes"
                    name="admin_notes"
                    rows="3"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200 focus:border-blue-500"
                >{{ old('admin_notes') }}</textarea>
            </div>

            <div class="flex gap-3">
                <button
                    type="submit"
                    name="status"
                    value="approved"
                    class="inline-flex items-center gap-2 rounded bg-green-600 px-4 py-2
                           text-sm font-semibold text-white hover:bg-green-700"
                >
                    <i class="bi bi-check-circle"></i>
                    Setujui
                </button>

                <button
                    type="submit"
                    name="status"
                    value="rejected"
                    class="inline-flex items-center gap-2 rounded bg-red-600 px-4 py-2
                           text-sm font-semibold text-white hover:bg-red-700"
                >
                    <i class="bi bi-x-circle"></i>
                    Tolak
                </button>
            </div>
        </form>
        @endif

        <!-- BACK BUTTON -->
        <a
            href="{{ route('admin.logbooks.index') }}"
            class="inline-block rounded bg-gray-500 px-4 py-2 text-sm
                   text-white hover:bg-gray-600"
        >
            Kembali
        </a>

    </div>
</div>

@endsection
