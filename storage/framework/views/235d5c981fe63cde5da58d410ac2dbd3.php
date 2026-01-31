

<?php $__env->startSection('title', 'Detail Logbook - ' . $selectedUser->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-4">

        <!-- BREADCRUMB / HEADER -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="<?php echo e(route('admin.logbooks.index')); ?>" class="hover:text-blue-600">Logbook</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="font-medium text-gray-900"><?php echo e($selectedUser->name); ?></span>
        </div>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Riwayat Logbook: <span class="text-blue-600"><?php echo e($selectedUser->name); ?></span>
            </h2>
            <a href="<?php echo e(route('admin.logbooks.index')); ?>" class="text-gray-600 hover:text-gray-900 flex items-center gap-2 text-sm font-medium">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <!-- FILTER -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 p-4">
            <form method="GET" action="<?php echo e(route('admin.logbooks.index')); ?>" class="flex flex-wrap items-center gap-4">
                <input type="hidden" name="user_id" value="<?php echo e($selectedUser->id); ?>">
                
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-gray-700">Filter Status:</span>
                    <select name="status" onchange="this.form.submit()" 
                            class="rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua</option>
                        <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="approved" <?php echo e(request('status') == 'approved' ? 'selected' : ''); ?>>Disetujui</option>
                        <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>Ditolak</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- TABLE (Original Logic) -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white shadow-sm">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-700 font-semibold border-b">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Aktivitas</th>
                        <th class="px-4 py-3">Waktu</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__empty_1 = true; $__currentLoopData = $logbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logbook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-900">
                                <?php echo e($logbook->date->format('d-m-Y')); ?>

                            </td>
                            <td class="px-4 py-3">
                                <?php echo e(Str::limit($logbook->activity, 50)); ?>

                            </td>
                            <td class="px-4 py-3 text-gray-500">
                                <?php echo e($logbook->start_time); ?> - <?php echo e($logbook->end_time); ?>

                            </td>
                            <td class="px-4 py-3">
                                <?php if($logbook->status === 'pending'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                <?php elseif($logbook->status === 'approved'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="<?php echo e(route('admin.logbooks.show', $logbook)); ?>" 
                                   class="inline-flex items-center gap-1 rounded bg-sky-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-sky-700 shadow-sm transition">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                Tidak ada logbook ditemukan untuk filter ini.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($logbooks->appends(request()->query())->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\PKL\TesAbsen\resources\views/admin/logbooks/detail.blade.php ENDPATH**/ ?>