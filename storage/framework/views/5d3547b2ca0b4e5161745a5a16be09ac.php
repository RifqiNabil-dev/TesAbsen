

<?php $__env->startSection('title', 'Detail Logbook'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detail Logbook</h5>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Tanggal</th>
                <td><?php echo e($logbook->date->format('d/m/Y')); ?></td>
            </tr>
            <tr>
                <th>Aktivitas</th>
                <td><?php echo e($logbook->activity); ?></td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td><?php echo e($logbook->description); ?></td>
            </tr>
            <tr>
                <th>Waktu</th>
                <td><?php echo e($logbook->start_time); ?> - <?php echo e($logbook->end_time); ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <?php if($logbook->status === 'pending'): ?>
                        <span class="badge bg-warning">Pending</span>
                    <?php elseif($logbook->status === 'approved'): ?>
                        <span class="badge bg-success">Disetujui</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Ditolak</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php if($logbook->admin_notes): ?>
            <tr>
                <th>Catatan Admin</th>
                <td><?php echo e($logbook->admin_notes); ?></td>
            </tr>
            <?php endif; ?>
            <?php if($logbook->approved_by): ?>
            <tr>
                <th>Disetujui Oleh</th>
                <td><?php echo e($logbook->approver->name); ?> pada <?php echo e($logbook->approved_at->format('d/m/Y H:i')); ?></td>
            </tr>
            <?php endif; ?>
        </table>
        <a href="<?php echo e(route('mahasiswa.logbooks.index')); ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Magang\resources\views/mahasiswa/logbooks/show.blade.php ENDPATH**/ ?>