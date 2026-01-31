

<?php $__env->startSection('title', 'Laporan & Penilaian'); ?>

<?php $__env->startSection('content'); ?>

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
            <i class="bi bi-file-text"></i>
            Laporan & Penilaian
        </h2>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-lg shadow border border-gray-200">

        <div class="p-6">

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 font-semibold">
                            <th class="px-4 py-3 border-b">Nama</th>
                            <th class="px-4 py-3 border-b">Email</th>
                            <th class="px-4 py-3 border-b">NIM</th>
                            <th class="px-4 py-3 border-b text-center">Total Presensi</th>
                            <th class="px-4 py-3 border-b text-center">Total Logbook</th>
                            <th class="px-4 py-3 border-b">Penilaian Terakhir</th>
                            <th class="px-4 py-3 border-b text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        <?php $__empty_1 = true; $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    <?php echo e($mhs->name); ?>

                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    <?php echo e($mhs->email); ?>

                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    <?php echo e($mhs->nim ?? '-'); ?>

                                </td>

                                <td class="px-4 py-3 text-center font-semibold">
                                    <?php echo e($mhs->attendances_count); ?>

                                </td>

                                <td class="px-4 py-3 text-center font-semibold">
                                    <?php echo e($mhs->logbooks_count); ?>

                                </td>

                                <td class="px-4 py-3">
                                    <?php if($mhs->assessments->count() > 0): ?>
                                        <span class="font-semibold text-gray-800">
                                            <?php echo e($mhs->assessments->last()->grade); ?>

                                        </span>
                                        <span class="text-xs text-gray-500">
                                            (<?php echo e($mhs->assessments->last()->total_score); ?>)
                                        </span>
                                    <?php else: ?>
                                        <span class="text-sm text-gray-400 italic">
                                            Belum dinilai
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <a href="<?php echo e(route('admin.reports.show', ['user' => $mhs->id])); ?>"
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-medium text-white shadow-sm hover:bg-blue-700 transition">
                                        <i class="bi bi-eye"></i>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">
                                    Tidak ada data mahasiswa
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\PKL\TesAbsen\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>