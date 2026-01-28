

<?php $__env->startSection('title', 'Tambah Kelompok'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl space-y-4">

    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">
            ➕ Tambah Kelompok
        </h2>
    </div>

    <!-- CARD -->
    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="p-6 space-y-6">

            <form method="POST" action="<?php echo e(route('admin.groups.store')); ?>">
                <?php echo csrf_field(); ?>

                <!-- NAMA KELOMPOK -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Kelompok <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?php echo e(old('name')); ?>"
                        required
                        class="w-full rounded border px-3 py-2 text-sm
                               focus:ring focus:ring-blue-200 focus:outline-none
                               <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    >
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- DESKRIPSI -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                               focus:ring focus:ring-blue-200 focus:outline-none"
                    ><?php echo e(old('description')); ?></textarea>
                </div>

                <!-- STATUS AKTIF -->
                <div class="flex items-center gap-2">
                    <input
                        type="checkbox"
                        id="is_active"
                        name="is_active"
                        value="1"
                        <?php echo e(old('is_active', true) ? 'checked' : ''); ?>

                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    >
                    <label for="is_active" class="text-sm text-gray-700">
                        Aktif
                    </label>
                </div>

                <hr class="border-gray-200">

                <!-- PILIH MAHASISWA -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Mahasiswa untuk Kelompok
                    </label>

                    <div class="max-h-72 overflow-y-auto rounded border border-gray-300 p-3 space-y-2">
                        <?php $__empty_1 = true; $__currentLoopData = $availableMahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mahasiswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <label
                                for="user_<?php echo e($mahasiswa->id); ?>"
                                class="flex items-start gap-3 rounded p-2 hover:bg-gray-50 cursor-pointer"
                            >
                                <input
                                    type="checkbox"
                                    name="user_ids[]"
                                    value="<?php echo e($mahasiswa->id); ?>"
                                    id="user_<?php echo e($mahasiswa->id); ?>"
                                    <?php echo e(in_array($mahasiswa->id, old('user_ids', [])) ? 'checked' : ''); ?>

                                    class="mt-1 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                >

                                <div class="text-sm">
                                    <p class="font-semibold text-gray-800">
                                        <?php echo e($mahasiswa->name); ?>

                                    </p>
                                    <p class="text-gray-500">
                                        <?php echo e($mahasiswa->email); ?>

                                    </p>
                                    <?php if($mahasiswa->nim): ?>
                                        <p class="text-gray-500">
                                            NIM: <?php echo e($mahasiswa->nim); ?>

                                        </p>
                                    <?php endif; ?>
                                </div>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-sm text-gray-500">
                                Tidak ada mahasiswa yang tersedia (semua sudah terdaftar di kelompok lain)
                            </p>
                        <?php endif; ?>
                    </div>

                    <p class="mt-2 text-xs text-gray-500">
                        Pilih satu atau lebih mahasiswa untuk ditambahkan ke kelompok ini.
                    </p>
                </div>

                <!-- ACTION BUTTON -->
                <div class="flex justify-between pt-4">
                    <a href="<?php echo e(route('admin.groups.index')); ?>"
                       class="rounded bg-gray-500 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-600">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Magang\resources\views/admin/groups/create.blade.php ENDPATH**/ ?>