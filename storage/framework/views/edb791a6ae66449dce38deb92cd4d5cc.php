

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
    <h2 class="text-xl sm:text-2xl font-semibold flex items-center gap-2">
        <i class="bi bi-speedometer2"></i> Dashboard
    </h2>
</div>

<!-- Statistik -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <div class="bg-blue-500 text-white rounded-lg shadow">
        <div class="p-4 sm:p-5">
            <h5 class="text-xs sm:text-sm font-semibold tracking-wide">Total Presensi</h5>
            <h2 class="text-2xl sm:text-3xl font-bold"><?php echo e($totalAttendance); ?></h2>
        </div>
    </div>

    <div class="bg-green-500 text-white rounded-lg shadow">
        <div class="p-4 sm:p-5">
            <h5 class="text-xs sm:text-sm font-semibold tracking-wide">Logbook Disetujui</h5>
            <h2 class="text-2xl sm:text-3xl font-bold"><?php echo e($totalLogbooks); ?></h2>
        </div>
    </div>

    <div class="bg-cyan-500 text-white rounded-lg shadow">
        <div class="p-4 sm:p-5">
            <h5 class="text-xs sm:text-sm font-semibold tracking-wide">Jadwal Hari Ini</h5>
            <h4 class="text-lg sm:text-xl font-semibold">
                <?php echo e($todaySchedule ? $todaySchedule->location->name : '-'); ?>

            </h4>
        </div>
    </div>
</div>

<?php if($todaySchedule): ?>
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
                <p class="mb-1"><strong>Lokasi:</strong> <?php echo e($todaySchedule->location->name); ?></p>
                <p>
                    <strong>Waktu:</strong>
                    <?php
                        $startTime = \Carbon\Carbon::parse($todaySchedule->start_time)->format('H:i');
                        $endTime   = \Carbon\Carbon::parse($todaySchedule->end_time)->format('H:i');
                    ?>
                    <?php echo e($startTime); ?> - <?php echo e($endTime); ?>

                </p>
            </div>

            <div class="flex items-center">
                
                <?php if($todayAttendance && $todayAttendance->check_in): ?>

                    <?php if(!$todayAttendance->check_out): ?>
                        <form method="POST" action="<?php echo e(route('mahasiswa.attendance.checkout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg
                                       text-base sm:text-lg flex items-center gap-2">
                                <i class="bi bi-box-arrow-right"></i> Absen Pulang
                            </button>
                        </form>
                    <?php else: ?>
                        <p class="text-green-600 font-semibold flex items-center gap-2">
                            <i class="bi bi-check-circle"></i>
                            Sudah absen masuk dan pulang hari ini
                        </p>
                    <?php endif; ?>

                <?php else: ?>
                    
                    <button
                        type="button"
                        onclick="openAttendancePreview()"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg
                               text-base sm:text-lg flex items-center gap-2"
                    >
                        <i class="bi bi-box-arrow-in-right"></i> Absen Masuk
                    </button>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

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
                    <?php $__empty_1 = true; $__currentLoopData = $recentAttendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b">
                            <td class="p-2"><?php echo e($attendance->date?->format('d/m/Y') ?? '-'); ?></td>
                            <td class="p-2"><?php echo e($attendance->location->name ?? '-'); ?></td>
                            <td class="p-2"><?php echo e($attendance->check_in?->format('H:i') ?? '-'); ?></td>
                            <td class="p-2">
                                <?php if($attendance->status === 'hadir'): ?>
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Hadir</span>
                                <?php elseif($attendance->status === 'terlambat'): ?>
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Terlambat</span>
                                <?php else: ?>
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Tidak Hadir</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center p-4 text-gray-500">
                                Belum ada presensi
                            </td>
                        </tr>
                    <?php endif; ?>
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
                    <?php $__empty_1 = true; $__currentLoopData = $recentLogbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logbook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b">
                            <td class="p-2"><?php echo e($logbook->date->format('d/m/Y')); ?></td>
                            <td class="p-2"><?php echo e(Str::limit($logbook->activity, 30)); ?></td>
                            <td class="p-2">
                                <?php if($logbook->status === 'pending'): ?>
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Pending</span>
                                <?php elseif($logbook->status === 'approved'): ?>
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Disetujui</span>
                                <?php else: ?>
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Ditolak</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center p-4 text-gray-500">
                                Belum ada logbook
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>


<script>
let map, marker;

function openAttendancePreview() {
    document.getElementById('attendanceModal').classList.remove('hidden');
    document.getElementById('attendanceModal').classList.add('flex');

    if (!navigator.geolocation) {
        alert('Browser tidak mendukung GPS');
        return;
    }

    navigator.geolocation.getCurrentPosition(position => {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

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
        }, 300);
    }, () => {
        alert('Gagal mengambil lokasi');
    });
}

function closeAttendancePreview() {
    document.getElementById('attendanceModal').classList.add('hidden');
}
</script>


<!-- MODAL PREVIEW ABSENSI -->
<div id="attendanceModal"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-lg w-full max-w-xl mx-4">
        <div class="px-4 py-3 border-b flex justify-between items-center">
            <h3 class="font-semibold text-lg">Preview Lokasi Absensi</h3>
            <button onclick="closeAttendancePreview()" class="text-gray-500">&times;</button>
        </div>

        <div class="p-4 space-y-3">
            <div id="mapPreview" class="w-full h-64 rounded"></div>

            <p class="text-sm text-gray-600">
                Pastikan lokasi kamu sudah benar sebelum konfirmasi absensi.
            </p>

            <form method="POST" action="<?php echo e(route('mahasiswa.attendance.checkin')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

                <div class="flex justify-end gap-2">
                    <button type="button"
                        onclick="closeAttendancePreview()"
                        class="px-4 py-2 rounded bg-gray-300">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 rounded bg-blue-600 text-white">
                        Konfirmasi Absen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/mahasiswa/dashboard.blade.php ENDPATH**/ ?>