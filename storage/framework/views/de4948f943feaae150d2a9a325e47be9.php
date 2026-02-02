

<?php $__env->startSection('title', 'Logbook'); ?>

<?php $__env->startSection('content'); ?>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <h2 class="text-xl sm:text-2xl font-semibold flex items-center gap-2">
            <i class="bi bi-journal-text text-blue-600"></i> Logbook
        </h2>

        <a href="<?php echo e(route('mahasiswa.logbooks.create')); ?>" class="inline-flex items-center justify-center gap-2
                  bg-blue-500 hover:bg-blue-600 text-white
                  px-4 py-2 rounded-lg text-sm sm:text-base
                  w-full sm:w-auto">
            <i class="bi bi-plus-circle"></i> Tambah Logbook
        </a>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 sm:p-6">

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border border-gray-600 rounded-lg">
                    <thead class=" border bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Tanggal</th>
                            <th class="p-3 text-left">Aktivitas</th>
                            <th class="p-3 text-left">Waktu</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        <?php $__empty_1 = true; $__currentLoopData = $logbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logbook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">
                                    <?php echo e($logbook->date->format('d-m-Y')); ?>

                                </td>

                                <td class="p-3">
                                    <?php echo e(Str::limit($logbook->activity, 40)); ?>

                                </td>

                                <td class="p-3 whitespace-nowrap">
                                    <?php echo e($logbook->start_time); ?> - <?php echo e($logbook->end_time); ?>

                                </td>

                                <td class="p-3">
                                    <?php if($logbook->status === 'pending'): ?>
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-medium">
                                            Pending
                                        </span>
                                    <?php elseif($logbook->status === 'approved'): ?>
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">
                                            Disetujui
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">
                                            Ditolak
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="p-3">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="<?php echo e(route('mahasiswa.logbooks.show', $logbook)); ?>" class="bg-cyan-500 hover:bg-cyan-600 text-white
                                                      px-2 py-1 rounded text-xs flex items-center">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <?php if($logbook->isPending()): ?>
                                            <a href="<?php echo e(route('mahasiswa.logbooks.edit', $logbook)); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white
                                                              px-2 py-1 rounded text-xs flex items-center">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="<?php echo e(route('mahasiswa.logbooks.destroy', $logbook)); ?>" method="POST" class="delete-logbook">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white
                                                                   px-2 py-1 rounded text-xs flex items-center">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-500">
                                    Belum ada data logbook
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <?php echo e($logbooks->links()); ?>

            </div>

        </div>
    </div>

<script>
    document.addEventListener('submit', function (e) {
        const form = e.target.closest('.delete-logbook');
        if (!form) return;

        e.preventDefault();

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data logbook yang dihapus tidak bisa dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            reverseButtons: true,
            focusCancel: true,
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/mahasiswa/logbooks/index.blade.php ENDPATH**/ ?>