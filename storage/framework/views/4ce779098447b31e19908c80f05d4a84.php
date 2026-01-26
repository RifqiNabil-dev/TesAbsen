

<?php $__env->startSection('title', 'Jadwal PKL'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-calendar-event"></i> Jadwal PKL</h2>
    <a href="<?php echo e(route('admin.schedules.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Jadwal
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Mahasiswa</th>
                        <th>Kelompok</th>
                        <th>Lokasi</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php
                                    $scheduleDate = is_string($schedule->date) ? \Carbon\Carbon::parse($schedule->date) : $schedule->date;
                                    $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                    $dayName = $dayNames[$scheduleDate->dayOfWeek];
                                ?>
                                <?php echo e($scheduleDate->format('d/m/Y')); ?>

                            </td>
                            <td>
                                <span class="badge bg-secondary"><?php echo e($dayName); ?></span>
                            </td>
                            <td><?php echo e($schedule->user->name); ?></td>
                            <td>
                                <?php if($schedule->user->group): ?>
                                    <span class="badge bg-info"><?php echo e($schedule->user->group->name); ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($schedule->location->name); ?></td>
                            <td>
                                <?php
                                    $startTime = is_string($schedule->start_time) ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i') : ($schedule->start_time instanceof \Carbon\Carbon ? $schedule->start_time->format('H:i') : $schedule->start_time);
                                    $endTime = is_string($schedule->end_time) ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i') : ($schedule->end_time instanceof \Carbon\Carbon ? $schedule->end_time->format('H:i') : $schedule->end_time);
                                ?>
                                <?php echo e($startTime); ?> - <?php echo e($endTime); ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.schedules.edit', $schedule)); ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('admin.schedules.destroy', $schedule)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                            <td colspan="7" class="text-center">Tidak ada data jadwal</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <?php echo e($schedules->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Magang\resources\views/admin/schedules/index.blade.php ENDPATH**/ ?>