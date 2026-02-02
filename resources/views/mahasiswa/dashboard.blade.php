@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <h2 class="text-xl sm:text-2xl font-semibold flex items-center gap-2">
            <i class="bi bi-house-door text-blue-600"></i> Dashboard
        </h2>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div
            class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] hover:-translate-y-1 transition-transform duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xs sm:text-sm font-semibold tracking-wider opacity-90 uppercase">Total Presensi</h5>
                    <i class="bi bi-calendar-check text-2xl opacity-80"></i>
                </div>
                <h2 class="text-3xl font-bold">{{ $totalAttendance }}</h2>
                <p class="text-xs mt-2 opacity-75">Hari hadir</p>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] hover:-translate-y-1 transition-transform duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xs sm:text-sm font-semibold tracking-wider opacity-90 uppercase">Logbook Disetujui</h5>
                    <i class="bi bi-journal-check text-2xl opacity-80"></i>
                </div>
                <h2 class="text-3xl font-bold">{{ $totalLogbooks }}</h2>
                <p class="text-xs mt-2 opacity-75">Aktivitas tervalidasi</p>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-cyan-500 to-cyan-600 text-white rounded-xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] hover:-translate-y-1 transition-transform duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xs sm:text-sm font-semibold tracking-wider opacity-90 uppercase">Jadwal Hari Ini</h5>
                    <i class="bi bi-geo-alt text-2xl opacity-80"></i>
                </div>
                <h4 class="text-lg font-semibold truncate"
                    title="{{ $todaySchedule ? $todaySchedule->locations->pluck('name')->implode(', ') : '-' }}">
                    {{ $todaySchedule ? $todaySchedule->locations->pluck('name')->implode(', ') : 'Libur / Tidak Ada Jadwal' }}
                </h4>
                <p class="text-xs mt-2 opacity-75">Lokasi penempatan</p>
            </div>
        </div>
    </div>

    @if($todaySchedule)
        <!-- Jadwal Hari Ini -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="bg-blue-600 text-white px-4 sm:px-5 py-3 rounded-t-lg">
                <h5 class="font-semibold flex items-center gap-2">
                    <i class="bi bi-calendar-event"></i> Jadwal Hari Ini
                </h5>
            </div>

            <div class="p-4 sm:p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="mb-1"><strong>Lokasi:</strong> {{ $todaySchedule->locations->pluck('name')->implode(', ') }}
                        </p>

                        <p>
                            <strong>Waktu:</strong>
                            @php
                                $startTime = \Carbon\Carbon::parse($todaySchedule->start_time)->format('H:i');
                                $endTime = \Carbon\Carbon::parse($todaySchedule->end_time)->format('H:i');
                            @endphp
                            {{ $startTime }} - {{ $endTime }}
                        </p>
                    </div>

                    <div class="flex items-center">
                        {{-- Logika Absensi --}}
                        @if($todayAttendance && $todayAttendance->check_in)

                            @if(!$todayAttendance->check_out)
                                <form method="POST" action="{{ route('mahasiswa.attendance.checkout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg shadow-sm
                                                                                                                                       text-base sm:text-lg flex items-center gap-2 transition-all">
                                        <i class="bi bi-box-arrow-right"></i> Absen Pulang
                                    </button>
                                </form>
                            @else
                                <div class="flex flex-col gap-3 w-full">
                                    <div
                                        class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2 shadow-sm w-full">
                                        <i class="bi bi-check-circle-fill text-xl"></i>
                                        <span class="font-medium">Selesai absen hari ini</span>
                                    </div>

                                    @if(!$todayLogbook)
                                        <div
                                            class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg shadow-sm w-full">
                                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                                                <div class="flex items-center gap-2">
                                                    <i class="bi bi-journal-text text-xl"></i>
                                                    <div>
                                                        <p class="font-semibold">Jangan lupa isi Logbook!</p>
                                                        <p class="text-sm text-yellow-700">Ceritakan aktivitasmu hari ini.</p>
                                                    </div>
                                                </div>
                                                <a href="{{ route('mahasiswa.logbooks.create') }}"
                                                    class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors whitespace-nowrap">
                                                    Isi Logbook
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div
                                            class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg flex items-center gap-2 shadow-sm w-full">
                                            <i class="bi bi-journal-check text-xl"></i>
                                            <span class="font-medium">Logbook hari ini sudah diisi</span>
                                        </div>
                                    @endif
                                </div>
                            @endif

                        @else
                            {{-- Absen Masuk --}}
                            <button type="button" onclick="openAttendancePreview()"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-sm
                                                                                                       text-base sm:text-lg flex items-center gap-2 transition-all">
                                <i class="bi bi-geo-alt-fill"></i> Absen Masuk
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Tabel -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Presensi -->
        <div class="bg-white rounded-lg border shadow">
            <div class="px-4 sm:px-5 py-3 border-b">
                <h5 class="font-semibold">Presensi Terakhir</h5>
            </div>
            <div class="p-4 sm:p-5 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Tanggal</th>
                            <th class="p-2 text-left">Lokasi</th>
                            <th class="p-2 text-left">Check In</th>
                            <th class="p-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentAttendances as $attendance)
                            <tr class="border-b">
                                <td class="p-2">{{ $attendance->date?->format('d-m-Y') ?? '-' }}</td>
                                <td class="p-2">{{ $attendance->location->name ?? '-' }}</td>
                                <td class="p-2">{{ $attendance->check_in?->format('H:i') ?? '-' }}</td>
                                <td class="p-2">
                                    @if($attendance->status === 'hadir')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Hadir</span>
                                    @elseif($attendance->status === 'terlambat')
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Hadir Terlambat</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Tidak Hadir</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center p-4 text-gray-500">
                                    Belum ada presensi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Logbook -->
        <div class="bg-white rounded-lg border shadow">
            <div class="px-4 sm:px-5 py-3 border-b">
                <h5 class="font-semibold">Logbook Terakhir</h5>
            </div>
            <div class="p-4 sm:p-5 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Tanggal</th>
                            <th class="p-2 text-left">Aktivitas</th>
                            <th class="p-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentLogbooks as $logbook)
                            <tr class="border-b">
                                <td class="p-2">{{ $logbook->date->format('d-m-Y') }}</td>
                                <td class="p-2">{{ Str::limit($logbook->activity, 30) }}</td>
                                <td class="p-2">
                                    @if($logbook->status === 'pending')
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Pending</span>
                                    @elseif($logbook->status === 'approved')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Disetujui</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-4 text-gray-500">
                                    Belum ada logbook
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

        <!-- Page Preview Absensi -->
    <div id="attendanceModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-lg w-full max-w-xl mx-4">
            <div class="px-4 py-3 border-b flex justify-between items-center">
                <h3 class="font-semibold text-lg">Preview Lokasi Absensi</h3>
                <button onclick="closeAttendancePreview()"><i class="bi bi-x-circle" style="color: red;"></i></button>
            </div>

            <div class="p-4 space-y-3">
                <div id="mapPreview" class="w-full h-64 rounded"></div>
                <div id="statusBox" class="hidden">
                    <p class="font-semibold" id="statusTitle"></p>
                    <p class="text-xs mt-1" id="statusDesc"></p>
                </div>
                <p class="text-sm text-gray-600">
                    Pastikan lokasi kamu sudah benar sebelum konfirmasi absensi.
                </p>

                <form method="POST" action="{{ route('mahasiswa.attendance.checkin') }}">
                    @csrf
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeAttendancePreview()" class="px-4 py-2 rounded bg-gray-300">
                            Batal
                        </button>

                        <button type="submit" onclick="closeAttendancePreview()" class="px-4 py-2 rounded bg-blue-600 text-white">
                            Konfirmasi Absen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        let map, marker;

        const locations = @json($todaySchedule ? $todaySchedule->locations : []);

        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371000;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        function showModal() {
            const modal = document.getElementById('attendanceModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeAttendancePreview() {
            const modal = document.getElementById('attendanceModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function setStatusBox({ outside, distanceInt, radius, nearestName }) {
            const box = document.getElementById('statusBox');
            const titleEl = document.getElementById('statusTitle');
            const descEl = document.getElementById('statusDesc');

            if (distanceInt == null) {
                box.classList.add('hidden');
                return;
            }

            box.classList.remove('hidden');

            if (outside) {
                box.className = "rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800";
                titleEl.textContent = "Di luar area lokasi";
                descEl.textContent =
                    `Jarak ke lokasi terdekat: ${distanceInt}m (radius: ${radius}M)${nearestName ? " • " + nearestName : ""}. ` +
                    `Absensi akan tercatat sebagai "Diluar Area Lokasi".`;
            } else {
                box.className = "rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800";
                titleEl.textContent = "Dalam area lokasi";
                descEl.textContent =
                    `Jarak ke lokasi terdekat: ${distanceInt}m (radius: ${radius}m)${nearestName ? " • " + nearestName : ""}.`;
            }
        }

        function openAttendancePreview() {
            if (!navigator.geolocation) {
                setStatusBox({ outside: false, distanceInt: null, radius: null, nearestName: null });
                showModal();
                return;
            }

            navigator.geolocation.getCurrentPosition(position => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                if (locations.length > 0) {
                    let minDistance = Infinity;
                    let nearestRadius = 100;
                    let nearestName = null;

                    locations.forEach(loc => {
                        const dist = calculateDistance(lat, lng, loc.latitude, loc.longitude);
                        if (dist < minDistance) {
                            minDistance = dist;
                            nearestRadius = loc.radius || 100;
                            nearestName = loc.name || null;
                        }
                    });

                    const distanceInt = Math.round(minDistance);
                    const outside = minDistance > nearestRadius;

                    setStatusBox({
                        outside,
                        distanceInt,
                        radius: nearestRadius,
                        nearestName
                    });
                } else {
                    setStatusBox({ outside: false, distanceInt: null, radius: null, nearestName: null });
                }

                showModal();
                setTimeout(() => {
                    if (!map) {
                        map = L.map('mapPreview').setView([lat, lng], 17);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '© OpenStreetMap'
                        }).addTo(map);

                        marker = L.marker([lat, lng]).addTo(map)
                            .bindPopup('Lokasi kamu saat ini')
                            .openPopup();
                    } else {
                        map.setView([lat, lng], 17);
                        marker.setLatLng([lat, lng]);
                    }

                    map.invalidateSize();
                }, 300);

            }, () => {
                setStatusBox({
                    outside: true,
                    distanceInt: null,
                    radius: null,
                    nearestName: null
                });

                showModal();

                const box = document.getElementById('statusBox');
                box.className = "rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800";
                document.getElementById('statusTitle').textContent = "Gagal mengambil lokasi";
                document.getElementById('statusDesc').textContent = "Pastikan GPS aktif dan izin lokasi browser sudah diizinkan, lalu coba lagi.";
                box.classList.remove('hidden');
            });
        }

        @if (session('success') || session('warning') || session('error'))
                document.addEventListener('DOMContentLoaded', () => {
                    let icon = 'info';
                    let title = 'Info';
                    let text = '';

                    @if (session('success'))
                        icon = 'success';
                        title = 'Berhasil';
                        text = @json(session('success'));
                    @elseif (session('warning'))
                        icon = 'warning';
                        title = 'Perhatian';
                        text = @json(session('warning'));
                    @elseif (session('error'))
                        icon = 'error';
                        title = 'Gagal';
                        text = @json(session('error'));
                    @endif

                    Swal.fire({
                        icon,
                        title,
                        text,
                        timer: 2500,
                        showConfirmButton: false,
                        timerProgressBar: true,
                    });
                });
        @endif

    </script>

@endsection