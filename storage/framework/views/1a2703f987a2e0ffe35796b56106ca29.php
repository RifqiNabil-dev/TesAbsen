

<?php $__env->startSection('title', 'Tambah Peserta'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow border border-gray-200">

        <!-- Header -->
        <div class="border-b px-6 py-4">
            <h2 class="text-lg font-bold text-gray-800">Tambah Peserta</h2>
        </div>

        <!-- Body -->
        <div class="p-6">
            <form method="POST" action="<?php echo e(route('admin.mahasiswa.store')); ?>">
                <?php echo csrf_field(); ?>

                <!-- Nama -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">
                        Nama <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
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

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                    <?php $__errorArgs = ['email'];
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

                <!-- Password -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-sm font-semibold mb-1">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" required
                            class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold mb-1">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password_confirmation" required
                            class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                    </div>
                </div>

                <!-- NIM -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">NIM</label>
                    <input type="text" name="nim" value="<?php echo e(old('nim')); ?>"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                </div>

                <!-- Institusi -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Institusi</label>
                    <input type="text" name="institution" value="<?php echo e(old('institution')); ?>"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                </div>

                <!-- No Telepon -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">No. Telepon</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                </div>

                <!-- Periode Magang -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold mb-1">
                            Tanggal Mulai
                        </label>
                    <input type="text" id="start_date" name="start_date" value="<?php echo e(request('start_date')); ?>"
                            class="datepicker w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">
                            Tanggal Selesai
                        </label>
                    <input type="text" id="end_date" name="end_date" value="<?php echo e(request('end_date')); ?>"
                            class="datepicker w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Action -->
                <div class="flex justify-between items-center">
                    <a href="<?php echo e(route('admin.mahasiswa.index')); ?>"
                        class="rounded bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600">
                        Batal
                    </a>

                    <button type="submit"
                        class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/mahasiswa/create.blade.php ENDPATH**/ ?>