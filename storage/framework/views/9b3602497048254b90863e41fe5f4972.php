

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-speedometer2"></i> Dashboard</h2>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Presensi</h5>
                <h2 class="mb-0"><?php echo e($totalAttendance); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Logbook Disetujui</h5>
                <h2 class="mb-0"><?php echo e($totalLogbooks); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Jadwal Hari Ini</h5>
                <h4 class="mb-0"><?php echo e($todaySchedule ? $todaySchedule->location->name : '-'); ?></h4>
            </div>
        </div>
    </div>
</div>

<?php if($todaySchedule): ?>
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Jadwal Hari Ini</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Lokasi:</strong> <?php echo e($todaySchedule->location->name); ?></p>
                <p><strong>Waktu:</strong> <?php echo e($todaySchedule->start_time); ?> - <?php echo e($todaySchedule->end_time); ?></p>
            </div>
            <div class="col-md-6">
                <?php if($todayAttendance): ?>
                    <?php if($todayAttendance->check_in && !$todayAttendance->check_out): ?>
                        <form method="POST" action="<?php echo e(route('mahasiswa.attendance.checkout')); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="bi bi-box-arrow-right"></i> Check Out
                            </button>
                        </form>
                    <?php elseif($todayAttendance->check_in && $todayAttendance->check_out): ?>
                        <p class="text-success"><i class="bi bi-check-circle"></i> Sudah check-in dan check-out hari ini</p>
                    <?php endif; ?>
                <?php else: ?>
                    <form method="POST" action="<?php echo e(route('mahasiswa.attendance.checkin')); ?>" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-box-arrow-in-right"></i> Check In
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Presensi Terakhir</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Check In</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentAttendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($attendance->date->format('d/m/Y')); ?></td>
                                    <td><?php echo e($attendance->location->name ?? '-'); ?></td>
                                    <td><?php echo e($attendance->check_in ? $attendance->check_in->format('H:i') : '-'); ?></td>
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
                                    <td colspan="4" class="text-center">Belum ada presensi</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Logbook Terakhir</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Aktivitas</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentLogbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logbook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($logbook->date->format('d/m/Y')); ?></td>
                                    <td><?php echo e(Str::limit($logbook->activity, 30)); ?></td>
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
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada logbook</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\Sistem_Magang\resources\views/mahasiswa/dashboard.blade.php ENDPATH**/ ?>