

<?php $__env->startSection('title', 'Detail Logbook'); ?>

<?php $__env->startSection('content'); ?>

<!-- Card -->
<div class="max-w-3xl mx-auto bg-white border rounded-lg shadow">
    <div class="px-6 py-4 border-b">
        <h5 class="text-lg font-semibold">Detail Logbook</h5>
    </div>

    <div class="p-6">

        <!-- Detail Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <tbody class="divide-y">

                    <tr>
                        <th class="py-3 pr-4 text-left font-medium text-gray-600 w-48">
                            Tanggal
                        </th>
                        <td class="py-3">
                            <?php echo e($logbook->date->format('d/m/Y')); ?>

                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 pr-4 text-left font-medium text-gray-600">
                            Aktivitas
                        </th>
                        <td class="py-3">
                            <?php echo e($logbook->activity); ?>

                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 pr-4 text-left font-medium text-gray-600">
                            Deskripsi
                        </th>
                        <td class="py-3 whitespace-pre-line">
                            <?php echo e($logbook->description); ?>

                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 pr-4 text-left font-medium text-gray-600">
                            Waktu
                        </th>
                        <td class="py-3">
                            <?php echo e($logbook->start_time); ?> - <?php echo e($logbook->end_time); ?>

                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 pr-4 text-left font-medium text-gray-600">
                            Status
                        </th>
                        <td class="py-3">
                            <?php if($logbook->status === 'pending'): ?>
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">
                                    Pending
                                </span>
                            <?php elseif($logbook->status === 'approved'): ?>
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                    Disetujui
                                </span>
                            <?php else: ?>
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">
                                    Ditolak
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <?php if($logbook->admin_notes): ?>
                        <tr>
                            <th class="py-3 pr-4 text-left font-medium text-gray-600">
                                Catatan Admin
                            </th>
                            <td class="py-3">
                                <?php echo e($logbook->admin_notes); ?>

                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php if($logbook->approved_by): ?>
                        <tr>
                            <th class="py-3 pr-4 text-left font-medium text-gray-600">
                                Disetujui Oleh
                            </th>
                            <td class="py-3">
                                <?php echo e($logbook->approver->name); ?>

                                <span class="text-gray-500 text-xs">
                                    (<?php echo e($logbook->approved_at->format('d/m/Y H:i')); ?>)
                                </span>
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>

        <!-- Action -->
        <div class="mt-6">
            <a href="<?php echo e(route('mahasiswa.logbooks.index')); ?>"
               class="inline-block bg-gray-500 hover:bg-gray-600 text-white
                      px-5 py-2 rounded-lg">
                Kembali
            </a>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/mahasiswa/logbooks/show.blade.php ENDPATH**/ ?>