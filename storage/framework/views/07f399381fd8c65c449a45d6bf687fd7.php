

<?php $__env->startSection('title', 'Presensi'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clock-history"></i> Presensi</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Durasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($attendance->date->format('d/m/Y')); ?></td>
                            <td><?php echo e($attendance->location->name ?? '-'); ?></td>
                            <td><?php echo e($attendance->check_in ? $attendance->check_in->format('H:i') : '-'); ?></td>
                            <td><?php echo e($attendance->check_out ? $attendance->check_out->format('H:i') : '-'); ?></td>
                            <td><?php echo e($attendance->work_duration ? $attendance->work_duration . ' jam' : '-'); ?></td>
                            <td>
                                <?php if($attendance->status === 'hadir'): ?>
                                    <span class="badge bg-success">Hadir</span>
                                <?php elseif($attendance->status === 'terlambat'): ?>
                                    <span class="badge bg-warning">Terlambat</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Tidak Hadir</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data presensi</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <?php echo e($attendances->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Magang\resources\views/mahasiswa/attendance/index.blade.php ENDPATH**/ ?>