

<?php $__env->startSection('title', 'Presensi'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clock-history"></i> Presensi</h2>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="<?php echo e(route('admin.attendance.index')); ?>" class="row g-3">
            <div class="col-md-4">
                <label for="user_id" class="form-label">Mahasiswa</label>
                <select class="form-select" id="user_id" name="user_id">
                    <option value="">Semua</option>
                    <?php $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($mhs->id); ?>" <?php echo e(request('user_id') == $mhs->id ? 'selected' : ''); ?>>
                            <?php echo e($mhs->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="date" class="form-label">Tanggal</label>
                <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo e(request('date')); ?>" placeholder="Pilih tanggal">
            </div>
            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="<?php echo e(route('admin.attendance.index')); ?>" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Mahasiswa</th>
                        <th>Lokasi</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($attendance->date->format('d/m/Y')); ?></td>
                            <td><?php echo e($attendance->user->name); ?></td>
                            <td><?php echo e($attendance->location->name ?? '-'); ?></td>
                            <td><?php echo e($attendance->check_in ? $attendance->check_in->format('H:i') : '-'); ?></td>
                            <td><?php echo e($attendance->check_out ? $attendance->check_out->format('H:i') : '-'); ?></td>
                            <td>
                                <?php if($attendance->status === 'hadir'): ?>
                                    <span class="badge bg-success">Hadir</span>
                                <?php elseif($attendance->status === 'terlambat'): ?>
                                    <span class="badge bg-warning">Terlambat</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Tidak Hadir</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.attendance.show', $attendance)); ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data presensi</td>
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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\Sistem_Magang\resources\views/admin/attendance/index.blade.php ENDPATH**/ ?>