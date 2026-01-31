

<?php $__env->startSection('title', 'Edit Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow border border-gray-200">

    <!-- Header -->
    <div class="border-b px-6 py-4">
        <h2 class="text-lg font-bold text-gray-800">Edit Mahasiswa</h2>
    </div>

    <!-- Body -->
    <div class="p-6">
        <form method="POST" action="<?php echo e(route('admin.mahasiswa.update', $mahasiswa)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Nama -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    value="<?php echo e(old('name', $mahasiswa->name)); ?>"
                    required
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                >
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
                <input
                    type="email"
                    name="email"
                    value="<?php echo e(old('email', $mahasiswa->email)); ?>"
                    required
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                >
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
                        Password Baru
                        <span class="text-gray-500 text-xs">(kosongkan jika tidak diubah)</span>
                    </label>
                    <input
                        type="password"
                        name="password"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                    >
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">
                        Konfirmasi Password Baru
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                    >
                </div>
            </div>

            <!-- NIM -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">NIM</label>
                <input
                    type="text"
                    name="nim"
                    value="<?php echo e(old('nim', $mahasiswa->nim)); ?>"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                >
            </div>

            <!-- Institusi -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Institusi</label>
                <input
                    type="text"
                    name="institution"
                    value="<?php echo e(old('institution', $mahasiswa->institution)); ?>"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                >
            </div>

            <!-- No Telepon -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">No. Telepon</label>
                <input
                    type="text"
                    name="phone"
                    value="<?php echo e(old('phone', $mahasiswa->phone)); ?>"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                >
            </div>

            <!-- Periode Magang -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-semibold mb-1">
                        Tanggal Mulai
                    </label>
                    <input
                        type="date"
                        name="start_date"
                        value="<?php echo e(old('start_date', $mahasiswa->start_date ? \Carbon\Carbon::parse($mahasiswa->start_date)->format('Y-m-d') : '')); ?>"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                    >
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">
                        Tanggal Selesai
                    </label>
                    <input
                        type="date"
                        name="end_date"
                        value="<?php echo e(old('end_date', $mahasiswa->end_date ? \Carbon\Carbon::parse($mahasiswa->end_date)->format('Y-m-d') : '')); ?>"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                    >
                </div>
            </div>

            <!-- Action -->
            <div class="flex justify-between items-center">
                <a
                    href="<?php echo e(route('admin.mahasiswa.index')); ?>"
                    class="rounded bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\PKL\TesAbsen\resources\views/admin/mahasiswa/edit.blade.php ENDPATH**/ ?>