

<?php $__env->startSection('title', 'Edit Lokasi'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-xl mx-auto bg-white rounded-lg shadow border border-gray-200">

    <!-- HEADER -->
    <div class="border-b px-6 py-4">
        <h2 class="text-lg font-bold text-gray-800">
            Edit Lokasi
        </h2>
    </div>

    <!-- BODY -->
    <div class="p-6">
        <form method="POST" action="<?php echo e(route('admin.locations.update', $location)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- NAMA LOKASI -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Nama Lokasi <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    value="<?php echo e(old('name', $location->name)); ?>"
                    required
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200 focus:border-blue-500"
                >
            </div>

            <!-- DESKRIPSI -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Deskripsi
                </label>
                <textarea
                    name="description"
                    rows="3"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200 focus:border-blue-500"
                ><?php echo e(old('description', $location->description)); ?></textarea>
            </div>

            <!-- STATUS -->
            <div class="mb-6">
                <label class="inline-flex items-center gap-2">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        <?php echo e(old('is_active', $location->is_active) ? 'checked' : ''); ?>

                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    >
                    <span class="text-sm text-gray-700">Aktif</span>
                </label>
            </div>

            <!-- ACTION -->
            <div class="flex justify-between items-center">
                <a
                    href="<?php echo e(route('admin.locations.index')); ?>"
                    class="rounded bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold
                           text-white hover:bg-blue-700"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Magang\resources\views/admin/locations/edit.blade.php ENDPATH**/ ?>