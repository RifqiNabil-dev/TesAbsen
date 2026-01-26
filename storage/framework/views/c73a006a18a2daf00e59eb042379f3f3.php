

<?php $__env->startSection('title', 'Data Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people"></i> Data Mahasiswa</h2>
    <a href="<?php echo e(route('admin.mahasiswa.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIM</th>
                        <th>Institusi</th>
                        <th>Periode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($mhs->name); ?></td>
                            <td><?php echo e($mhs->email); ?></td>
                            <td><?php echo e($mhs->nim ?? '-'); ?></td>
                            <td><?php echo e($mhs->institution ?? '-'); ?></td>
                            <td>
                                <?php if($mhs->start_date && $mhs->end_date): ?>
                                    <?php
                                        $startDate = is_string($mhs->start_date) ? \Carbon\Carbon::parse($mhs->start_date) : $mhs->start_date;
                                        $endDate = is_string($mhs->end_date) ? \Carbon\Carbon::parse($mhs->end_date) : $mhs->end_date;
                                    ?>
                                    <?php echo e($startDate->format('d/m/Y')); ?> - <?php echo e($endDate->format('d/m/Y')); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.mahasiswa.show', $mhs)); ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('admin.mahasiswa.edit', $mhs)); ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('admin.mahasiswa.destroy', $mhs)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data mahasiswa</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <?php echo e($mahasiswa->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\Sistem_Magang\resources\views/admin/mahasiswa/index.blade.php ENDPATH**/ ?>