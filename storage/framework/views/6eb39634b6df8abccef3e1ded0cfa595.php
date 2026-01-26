

<?php $__env->startSection('title', 'Logbook'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-journal-text"></i> Logbook</h2>
    <a href="<?php echo e(route('mahasiswa.logbooks.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Logbook
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Aktivitas</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $logbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logbook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($logbook->date->format('d/m/Y')); ?></td>
                            <td><?php echo e(Str::limit($logbook->activity, 40)); ?></td>
                            <td><?php echo e($logbook->start_time); ?> - <?php echo e($logbook->end_time); ?></td>
                            <td>
                                <?php if($logbook->status === 'pending'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php elseif($logbook->status === 'approved'): ?>
                                    <span class="badge bg-success">Disetujui</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Ditolak</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('mahasiswa.logbooks.show', $logbook)); ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <?php if($logbook->isPending()): ?>
                                    <a href="<?php echo e(route('mahasiswa.logbooks.edit', $logbook)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('mahasiswa.logbooks.destroy', $logbook)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data logbook</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <?php echo e($logbooks->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\Sistem_Magang\resources\views/mahasiswa/logbooks/index.blade.php ENDPATH**/ ?>