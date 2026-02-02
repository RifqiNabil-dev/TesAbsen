

<?php $__env->startSection('title', 'Daftar Izin Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto">

    <h2 class="text-xl font-bold text-gray-800 mb-6">Daftar Izin Mahasiswa</h2>

    <?php if(session('success')): ?>
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 border-b">
                    <tr class="text-left text-gray-700">
                        <th class="px-4 py-3">Nama Mahasiswa</th>
                        <th class="px-4 py-3 text-center">Jenis Izin</th>
                        <th class="px-4 py-3 text-center">Tanggal Izin</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3"><?php echo e($permission->user->name); ?></td>
                            <td class="px-4 py-3 text-center"><?php echo e(ucfirst($permission->type)); ?></td>
                            <td class="px-4 py-3 text-center"><?php echo e($permission->date->translatedFormat('j F Y')); ?></td>
                            <td class="px-4 py-3"><?php echo e($permission->description); ?></td>
                            <td class="px-4 py-3 text-center">
                                <?php if($permission->status == 'pending'): ?>
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Pending</span>
                                <?php elseif($permission->status == 'approved'): ?>
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Approved</span>
                                <?php else: ?>
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                    <?php if($permission->status == 'pending'): ?>
                                        <form action="<?php echo e(route('admin.permissions.approve', $permission)); ?>" method="POST" class="inline-block">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="text-green-600 hover:text-green-800">
                                                <i class="bi bi-check-circle"></i> Setujui
                                            </button>
                                        </form>

                                        <form action="<?php echo e(route('admin.permissions.reject', $permission)); ?>" method="POST" class="inline-block">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <i class="bi bi-x-circle"></i> Tolak
                                            </button>
                                        </form>
                                    <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php echo e($permissions->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/permissions/index.blade.php ENDPATH**/ ?>