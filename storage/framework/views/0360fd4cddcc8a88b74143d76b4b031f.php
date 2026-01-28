

<?php $__env->startSection('title', 'Lokasi'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <i class="bi bi-geo-alt"></i> Lokasi
        </h2>

        <a
            href="<?php echo e(route('admin.locations.create')); ?>"
            class="inline-flex items-center gap-2 rounded bg-blue-600 px-4 py-2
                   text-sm font-semibold text-white hover:bg-blue-700"
        >
            <i class="bi bi-plus-circle"></i> Tambah Lokasi
        </a>
    </div>

    <!-- TABLE CARD -->
    <div class="bg-white rounded-lg shadow border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 border-b">
                    <tr class="text-left text-gray-700">
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Koordinat</th> <!-- Kolom koordinat -->
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 w-32">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    <?php $__empty_1 = true; $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">
                                <?php echo e($location->name); ?>

                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                <?php echo e(Str::limit($location->description, 50)); ?>

                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                <?php echo e($location->latitude); ?>, <?php echo e($location->longitude); ?> <!-- Kolom Koordinat -->
                            </td>

                            <td class="px-4 py-3">
                                <?php if($location->is_active): ?>
                                    <span class="inline-block rounded bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">
                                        Aktif
                                    </span>
                                <?php else: ?>
                                    <span class="inline-block rounded bg-gray-200 px-2 py-1 text-xs font-semibold text-gray-600">
                                        Tidak Aktif
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a
                                        href="<?php echo e(route('admin.locations.edit', $location)); ?>"
                                        class="rounded bg-yellow-400 p-2 text-white hover:bg-yellow-500"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        action="<?php echo e(route('admin.locations.destroy', $location)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?')"
                                    >
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button
                                            type="submit"
                                            class="rounded bg-red-600 p-2 text-white hover:bg-red-700"
                                            title="Hapus"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada data lokasi
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/locations/index.blade.php ENDPATH**/ ?>