

<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>

<!-- HEADER -->
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-semibold flex items-center gap-2">
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </h2>
</div>

<!-- SUMMARY CARDS -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="rounded-lg bg-blue-600 text-white p-4 shadow">
        <h5 class="text-sm font-medium">Total Mahasiswa</h5>
        <h2 class="text-3xl font-bold"><?php echo e($totalMahasiswa); ?></h2>
    </div>

    <div class="rounded-lg bg-green-600 text-white p-4 shadow">
        <h5 class="text-sm font-medium">Lokasi Aktif</h5>
        <h2 class="text-3xl font-bold"><?php echo e($totalLocations); ?></h2>
    </div>

    <div class="rounded-lg bg-sky-500 text-white p-4 shadow">
        <h5 class="text-sm font-medium">Presensi Hari Ini</h5>
        <h2 class="text-3xl font-bold"><?php echo e($todayAttendances); ?></h2>
    </div>

    <div class="rounded-lg bg-yellow-500 text-white p-4 shadow">
        <h5 class="text-sm font-medium">Logbook Pending</h5>
        <h2 class="text-3xl font-bold"><?php echo e($pendingLogbooks); ?></h2>
    </div>
</div>

<!-- TABLES -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- PRESENSI -->
    <div class="bg-white rounded-lg shadow">
        <div class="border-b px-4 py-3">
            <h5 class="font-semibold">Presensi Hari Ini</h5>
        </div>

        <div class="overflow-x-auto p-4">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-3 py-2 text-left">Nama</th>
                        <th class="px-3 py-2 text-left">Lokasi</th>
                        <th class="px-3 py-2 text-left">Check In</th>
                        <th class="px-3 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php $__empty_1 = true; $__currentLoopData = $recentAttendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-3 py-2"><?php echo e($attendance->user->name); ?></td>
                            <td class="px-3 py-2"><?php echo e($attendance->location->name ?? '-'); ?></td>
                            <td class="px-3 py-2">
                                <?php echo e($attendance->check_in ? $attendance->check_in->format('H:i') : '-'); ?>

                            </td>
                            <td class="px-3 py-2">
                                <?php if($attendance->status === 'hadir'): ?>
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Hadir</span>
                                <?php elseif($attendance->status === 'terlambat'): ?>
                                    <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Terlambat</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Tidak Hadir</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-3 py-4 text-center text-gray-500">
                                Tidak ada presensi hari ini
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- LOGBOOK -->
    <div class="bg-white rounded-lg shadow">
        <div class="border-b px-4 py-3">
            <h5 class="font-semibold">Logbook Pending</h5>
        </div>

        <div class="overflow-x-auto p-4">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-3 py-2 text-left">Nama</th>
                        <th class="px-3 py-2 text-left">Tanggal</th>
                        <th class="px-3 py-2 text-left">Aktivitas</th>
                        <th class="px-3 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php $__empty_1 = true; $__currentLoopData = $recentLogbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logbook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-3 py-2"><?php echo e($logbook->user->name); ?></td>
                            <td class="px-3 py-2"><?php echo e($logbook->date->format('d/m/Y')); ?></td>
                            <td class="px-3 py-2"><?php echo e(Str::limit($logbook->activity, 30)); ?></td>
                            <td class="px-3 py-2">
                                <a href="<?php echo e(route('admin.logbooks.show', $logbook)); ?>"
                                   class="inline-flex items-center justify-center rounded bg-blue-600 text-white px-3 py-1 hover:bg-blue-700">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-3 py-4 text-center text-gray-500">
                                Tidak ada logbook pending
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>