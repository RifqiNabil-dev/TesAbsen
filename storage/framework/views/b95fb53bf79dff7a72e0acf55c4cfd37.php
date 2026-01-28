

<?php $__env->startSection('title', 'Detail Presensi'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detail Presensi</h5>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Tanggal</th>
                <td><?php echo e($attendance->date->format('d/m/Y')); ?></td>
            </tr>
            <tr>
                <th>Mahasiswa</th>
                <td><?php echo e($attendance->user->name); ?></td>
            </tr>
            <tr>
                <th>Lokasi</th>
                <td><?php echo e($attendance->location->name ?? '-'); ?></td>
            </tr>
            <tr>
                <th>Check In</th>
                <td><?php echo e($attendance->check_in ? $attendance->check_in->format('d/m/Y H:i') : '-'); ?></td>
            </tr>
            <tr>
                <th>Check Out</th>
                <td><?php echo e($attendance->check_out ? $attendance->check_out->format('d/m/Y H:i') : '-'); ?></td>
            </tr>
            <tr>
                <th>Durasi Kerja</th>
                <td><?php echo e($attendance->work_duration ? $attendance->work_duration . ' jam' : '-'); ?></td>
            </tr>
            <tr>
                <th>Status</th>
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
            <?php if($attendance->notes): ?>
            <tr>
                <th>Catatan</th>
                <td><?php echo e($attendance->notes); ?></td>
            </tr>
            <?php endif; ?>
        </table>
        <a href="<?php echo e(route('admin.attendance.index')); ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Magang\resources\views/admin/attendance/show.blade.php ENDPATH**/ ?>