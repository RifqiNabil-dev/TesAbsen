

<?php $__env->startSection('title', 'Presensi'); ?>

<?php $__env->startSection('content'); ?>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <h2 class="text-xl sm:text-2xl font-semibold flex items-center gap-2">
            <i class="bi bi-clock-history text-blue-600"></i> Presensi
        </h2>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-lg border shadow">
        <div class="p-4 sm:p-6">

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Tanggal</th>
                            <th class="p-3 text-left">Lokasi Jadwal</th>
                            <th class="p-3 text-left">Lokasi Presensi</th>
                            <th class="p-3 text-left">Check In</th>
                            <th class="p-3 text-left">Check Out</th>
                            <th class="p-3 text-left">Durasi</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Status Lokasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">
                                    <?php echo e($attendance->date->format('d-m-Y')); ?>

                                </td>
                                <td class="p-3">
                                    <?php
                                        $schedule = \App\Models\Schedule::where('user_id', $attendance->user_id)
                                            ->whereDate('date', $attendance->date)
                                            ->with('locations')
                                            ->first();
                                        $scheduledLocations = $schedule ? $schedule->locations->pluck('name')->implode(', ') : '-';
                                    ?>
                                    <?php echo e($scheduledLocations); ?>

                                </td>
                                <td class="p-3">
                                    <?php echo e($attendance->location->name ?? '-'); ?>

                                </td>
                                <td class="p-3">
                                    <?php echo e($attendance->check_in ? $attendance->check_in->format('H:i') : '-'); ?>

                                </td>
                                <td class="p-3">
                                    <?php echo e($attendance->check_out ? $attendance->check_out->format('H:i') : '-'); ?>

                                </td>
                                <td class="p-3">
                                    <?php echo e($attendance->work_duration ? $attendance->work_duration . ' jam' : '-'); ?>

                                </td>

                                <!-- STATUS KEHADIRAN -->
                                <td class="p-3">
                                    <?php if($attendance->status === 'hadir'): ?>
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">
                                            Hadir
                                        </span>
                                    <?php elseif($attendance->status === 'terlambat'): ?>
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-medium">
                                            Hadir Terlambat
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">
                                            Tidak Hadir
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <!-- STATUS LOKASI -->
                                <td class="p-3">
                                    <?php if($attendance->location_status === 'berada dilokasi magang'): ?>
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">
                                            Berada di Lokasi
                                        </span>
                                    <?php elseif($attendance->location_status === 'diluar lokasi magang'): ?>
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">
                                            Diluar Lokasi
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-medium">
                                            -
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="p-6 text-center text-gray-500">
                                    Belum ada data presensi
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <?php echo e($attendances->links()); ?>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/mahasiswa/attendance/index.blade.php ENDPATH**/ ?>