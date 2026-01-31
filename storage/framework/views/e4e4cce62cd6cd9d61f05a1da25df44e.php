

<?php $__env->startSection('title', 'Detail Presensi - ' . $selectedUser->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-4">

        <!-- BREADCRUMB / HEADER -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="<?php echo e(route('admin.attendance.index')); ?>" class="hover:text-blue-600">Presensi</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="font-medium text-gray-900"><?php echo e($selectedUser->name); ?></span>
        </div>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Riwayat Presensi: <span class="text-blue-600"><?php echo e($selectedUser->name); ?></span>
            </h2>
            <a href="<?php echo e(route('admin.attendance.index')); ?>"
                class="text-gray-600 hover:text-gray-900 flex items-center gap-2 text-sm font-medium">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <!-- TABLE (Original Logic) -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white shadow-sm">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-700 font-semibold border-b">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Lokasi</th>
                        <th class="px-4 py-3">Check In</th>
                        <th class="px-4 py-3">Check Out</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Status Lokasi</th>
                        <th class="px-4 py-3">Latitude</th>
                        <th class="px-4 py-3">Longitude</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-900">
                                <?php echo e($attendance->date?->format('d-m-Y') ?? '-'); ?>

                            </td>
                            <td class="px-4 py-3">
                                <?php echo e($attendance->location->name ?? '-'); ?>

                            </td>
                            <td class="px-4 py-3 text-blue-600 font-medium">
                                <?php echo e($attendance->check_in?->format('H:i') ?? '-'); ?>

                            </td>
                            <td class="px-4 py-3 text-orange-600 font-medium">
                                <?php echo e($attendance->check_out?->format('H:i') ?? '-'); ?>

                            </td>
                            <td class="px-4 py-3">
                                <?php if($attendance->status === 'hadir'): ?>
                                    <span
                                        class="rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-700">Hadir</span>
                                <?php elseif($attendance->status === 'terlambat'): ?>
                                    <span
                                        class="rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-semibold text-yellow-700">Hadir
                                        Terlambat</span>
                                <?php else: ?>
                                    <span class="rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-semibold text-red-700">Tidak
                                        Hadir</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <?php if($attendance->location_status === 'berada dilokasi magang'): ?>
                                    <span class="text-green-700 text-xs font-medium flex items-center gap-1">
                                        <i class="bi bi-geo-alt-fill"></i> Di Lokasi
                                    </span>
                                <?php elseif($attendance->location_status === 'diluar lokasi magang'): ?>
                                    <span class="text-red-700 text-xs font-medium flex items-center gap-1">
                                        <i class="bi bi-geo-alt"></i> Diluar Lokasi
                                    </span>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-xs font-mono text-gray-600">
                                <?php echo e($attendance->latitude ?? '-'); ?>

                            </td>
                            <td class="px-4 py-3 text-xs font-mono text-gray-600">
                                <?php echo e($attendance->longitude ?? '-'); ?>

                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="<?php echo e(route('admin.attendance.show', $attendance)); ?>"
                                    class="text-gray-400 hover:text-blue-600 transition">
                                    <i class="bi bi-eye text-lg"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                Belum ada riwayat presensi untuk peserta ini.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($attendances->appends(request()->query())->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\PKL\TesAbsen\resources\views/admin/attendance/detail.blade.php ENDPATH**/ ?>