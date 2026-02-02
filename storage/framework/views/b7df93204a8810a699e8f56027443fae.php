

<?php $__env->startSection('title', 'Ajukan Izin'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow border border-gray-200">

    <div class="border-b px-6 py-4">
        <h2 class="text-lg font-semibold text-gray-800">Ajukan Izin / Sakit</h2>
    </div>

    <div class="p-6">
        <form method="POST" action="<?php echo e(route('mahasiswa.permissions.store')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Tanggal Izin -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Izin</label>
                <input type="text" name="date" value="<?php echo e(old('date')); ?>" required class=" datepicker w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
            </div>

            <!-- Tipe Izin -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Izin</label>
                <select name="type" class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                    <option value="izin" <?php echo e(old('type') == 'izin' ? 'selected' : ''); ?>>Izin</option>
                    <option value="sakit" <?php echo e(old('type') == 'sakit' ? 'selected' : ''); ?>>Sakit</option>
                </select>
            </div>
            
            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:border-blue-500"><?php echo e(old('description')); ?></textarea>
            </div>

            <div class="flex justify-between">
                <a href="<?php echo e(route('mahasiswa.permissions.index')); ?>" class="px-4 py-2 rounded bg-gray-500 text-sm text-white hover:bg-gray-600">Batal</a>
                <button type="submit" class="px-5 py-2 rounded bg-blue-600 text-sm font-semibold text-white hover:bg-blue-700">Ajukan Izin</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/mahasiswa/permissions/create.blade.php ENDPATH**/ ?>