

<?php $__env->startSection('title', 'Daftar Division'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-2xl font-semibold mb-4">Daftar Division</h1>

    <a href="<?php echo e(route('admin.divisions.create')); ?>" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4 inline-block">Tambah Division</a>

    <?php if(session('success')): ?>
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="overflow-hidden shadow-xl sm:rounded-lg">
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Deskripsi</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="border px-4 py-2"><?php echo e($division->name); ?></td>
                        <td class="border px-4 py-2"><?php echo e($division->description); ?></td>
                        <td class="border px-4 py-2">
                            <a href="<?php echo e(route('admin.divisions.edit', $division)); ?>" class="text-blue-600">Edit</a>
                            <form action="<?php echo e(route('admin.divisions.destroy', $division)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/division/index.blade.php ENDPATH**/ ?>