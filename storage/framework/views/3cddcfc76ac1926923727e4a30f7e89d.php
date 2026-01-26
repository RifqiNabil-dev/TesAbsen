

<?php $__env->startSection('title', 'Kelompok Magang'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people-fill"></i> Kelompok Magang</h2>
    <a href="<?php echo e(route('admin.groups.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Kelompok
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Kelompok</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Anggota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><strong><?php echo e($group->name); ?></strong></td>
                            <td><?php echo e($group->description ?? '-'); ?></td>
                            <td>
                                <span class="badge bg-info"><?php echo e($group->users_count); ?> anggota</span>
                            </td>
                            <td>
                                <?php if($group->is_active): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.groups.show', $group)); ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a href="<?php echo e(route('admin.groups.edit', $group)); ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="<?php echo e(route('admin.groups.destroy', $group)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kelompok ini? Semua anggota akan dikeluarkan dari kelompok.')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data kelompok</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <?php echo e($groups->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\Sistem_Magang\resources\views/admin/groups/index.blade.php ENDPATH**/ ?>