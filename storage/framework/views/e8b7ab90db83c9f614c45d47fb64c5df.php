

<?php $__env->startSection('title', 'Edit Kelompok'); ?>

<?php $__env->startSection('content'); ?>
<div
    x-data="{ search: '' }"
    class="max-w-4xl mx-auto bg-white rounded-lg shadow border border-gray-200"
>

    <!-- HEADER -->
    <div class="border-b px-6 py-4">
        <h2 class="text-lg font-bold text-gray-800">Edit Kelompok</h2>
    </div>

    <!-- BODY -->
    <div class="p-6">
        <form method="POST" action="<?php echo e(route('admin.groups.update', $group)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- NAMA -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">
                    Nama Kelompok <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    value="<?php echo e(old('name', $group->name)); ?>"
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

            <!-- DESKRIPSI -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Deskripsi</label>
                <textarea
                    name="description"
                    rows="3"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                ><?php echo e(old('description', $group->description)); ?></textarea>
            </div>

            <!-- STATUS -->
            <div class="mb-6">
                <label class="inline-flex items-center gap-2">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        <?php echo e(old('is_active', $group->is_active) ? 'checked' : ''); ?>

                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    >
                    <span class="text-sm">Aktif</span>
                </label>
            </div>

            <hr class="my-6">

            <!-- SEARCH BAR -->
            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">
                    Cari Peserta
                </label>
                <input
                    type="text"
                    x-model="search"
                    placeholder="Cari nama, email, atau NIM..."
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                >
            </div>

            <!-- LIST MAHASISWA -->
            <div class="border rounded max-h-[320px] overflow-y-auto p-3 space-y-2">
                <?php $__empty_1 = true; $__currentLoopData = $availableMahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mahasiswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <label
                    x-show="
                        '<?php echo e(strtolower($mahasiswa->name.' '.$mahasiswa->email.' '.$mahasiswa->nim)); ?>'
                        .includes(search.toLowerCase())
                    "
                    class="flex items-start gap-3 rounded p-3 hover:bg-gray-50 cursor-pointer border"
                >
                    <input
                        type="checkbox"
                        name="user_ids[]"
                        value="<?php echo e($mahasiswa->id); ?>"
                        class="mt-1 rounded border-gray-300 text-blue-600"
                        <?php echo e((old('user_ids') ? in_array($mahasiswa->id, old('user_ids')) : $mahasiswa->group_id == $group->id) ? 'checked' : ''); ?>

                    >

                    <div class="text-sm">
                        <p class="font-semibold text-gray-800">
                            <?php echo e($mahasiswa->name); ?>

                        </p>
                        <p class="text-xs text-gray-500">
                            <?php echo e($mahasiswa->email); ?>

                            <?php if($mahasiswa->nim): ?>
                                • NIM: <?php echo e($mahasiswa->nim); ?>

                            <?php endif; ?>
                        </p>

                        <div class="mt-1">
                            <?php if($mahasiswa->group_id == $group->id): ?>
                                <span class="inline-block rounded bg-green-100 px-2 py-0.5 text-xs text-green-700">
                                    Anggota saat ini
                                </span>
                            <?php elseif($mahasiswa->group_id): ?>
                                <span class="inline-block rounded bg-yellow-100 px-2 py-0.5 text-xs text-yellow-700">
                                    Kelompok lain
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-gray-500 text-center">
                        Tidak ada mahasiswa tersedia
                    </p>
                <?php endif; ?>
            </div>

            <p class="text-xs text-gray-500 mt-2">
                Centang mahasiswa yang ingin menjadi anggota kelompok ini.
                Peserta dari kelompok lain akan otomatis dipindahkan.
            </p>

            <!-- ACTION -->
            <div class="flex justify-between items-center mt-6">
                <a
                    href="<?php echo e(route('admin.groups.index')); ?>"
                    class="rounded bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700"
                >
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/groups/edit.blade.php ENDPATH**/ ?>