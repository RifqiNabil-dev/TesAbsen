

<?php $__env->startSection('title', 'Tambah Division'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow border border-gray-200">

    <!-- HEADER -->
    <div class="border-b px-6 py-4">
        <h2 class="text-lg font-semibold text-gray-800">Tambah Divisi</h2>
    </div>

    <!-- BODY -->
    <div class="p-6">
        <form method="POST" action="<?php echo e(route('admin.divisions.store')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Division <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="w-full px-4 py-2 rounded border border-gray-300" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-500 mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" class="w-full px-4 py-2 rounded border border-gray-300"><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-500 mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- ACTION -->
            <div class="flex justify-between">
                <a href="<?php echo e(route('admin.divisions.index')); ?>" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-5 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
            </div>

        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/divisions/create.blade.php ENDPATH**/ ?>