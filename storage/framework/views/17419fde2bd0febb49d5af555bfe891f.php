

<?php $__env->startSection('title', 'Laporan & Penilaian'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-file-text"></i> Laporan & Penilaian</h2>
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
                        <th>Total Presensi</th>
                        <th>Total Logbook</th>
                        <th>Penilaian Terakhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($mhs->name); ?></td>
                            <td><?php echo e($mhs->email); ?></td>
                            <td><?php echo e($mhs->nim ?? '-'); ?></td>
                            <td><?php echo e($mhs->attendances_count); ?></td>
                            <td><?php echo e($mhs->logbooks_count); ?></td>
                            <td>
                                <?php if($mhs->assessments->count() > 0): ?>
                                    <?php echo e($mhs->assessments->last()->grade); ?> (<?php echo e($mhs->assessments->last()->total_score); ?>)
                                <?php else: ?>
                                    <span class="text-muted">Belum dinilai</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.reports.show', $mhs)); ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data mahasiswa</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\Sistem_Magang\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>