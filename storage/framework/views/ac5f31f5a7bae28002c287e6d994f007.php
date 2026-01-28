

<?php $__env->startSection('title', 'Detail Logbook'); ?>

<?php $__env->startSection('content'); ?>

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
                            <?php echo e($logbook->date->format('d/m/Y')); ?>

                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Mahasiswa
                        </th>
                        <td class="py-3">
                            <?php echo e($logbook->user->name); ?>

                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Aktivitas
                        </th>
                        <td class="py-3">
                            <?php echo e($logbook->activity); ?>

                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Deskripsi
                        </th>
                        <td class="py-3 whitespace-pre-line">
                            <?php echo e($logbook->description); ?>

                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Waktu
                        </th>
                        <td class="py-3">
                            <?php echo e($logbook->start_time); ?> - <?php echo e($logbook->end_time); ?>

                        </td>
                    </tr>

                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Status
                        </th>
                        <td class="py-3">
                            <?php if($logbook->status === 'pending'): ?>
                                <span class="inline-block rounded bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                    Pending
                                </span>
                            <?php elseif($logbook->status === 'approved'): ?>
                                <span class="inline-block rounded bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    Disetujui
                                </span>
                            <?php else: ?>
                                <span class="inline-block rounded bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                    Ditolak
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <?php if($logbook->admin_notes): ?>
                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
                            Catatan Admin
                        </th>
                        <td class="py-3">
                            <?php echo e($logbook->admin_notes); ?>

                        </td>
                    </tr>
                    <?php endif; ?>

                    <?php if($logbook->approved_by): ?>
                    <tr>
                        <th class="py-3 font-semibold text-gray-600 text-left">
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

        <!-- APPROVAL FORM -->
        <?php if($logbook->isPending()): ?>
        <form method="POST" action="<?php echo e(route('admin.logbooks.approve', $logbook)); ?>" class="mb-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

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
                ><?php echo e(old('admin_notes')); ?></textarea>
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
        <?php endif; ?>

        <!-- BACK BUTTON -->
        <a
            href="<?php echo e(route('admin.logbooks.index')); ?>"
            class="inline-block rounded bg-gray-500 px-4 py-2 text-sm
                   text-white hover:bg-gray-600"
        >
            Kembali
        </a>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/logbooks/show.blade.php ENDPATH**/ ?>