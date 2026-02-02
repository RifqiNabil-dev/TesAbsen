

<?php $__env->startSection('title', 'Detail Presensi'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0"> <i class="bi bi-info-square"></i> Detail Presensi</h2>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">Tanggal</th>
                    <td><?php echo e($attendance->date->format('d-m-Y')); ?></td>
                </tr>
                <tr>
                    <th>Peserta</th>
                    <td><?php echo e($attendance->user->name); ?></td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td><?php echo e($attendance->location->name ?? '-'); ?></td>
                </tr>
                <tr>
                    <th>Check In</th>
                    <td><?php echo e($attendance->check_in ? $attendance->check_in->translatedFormat('j F Y H:i') : '-'); ?></td>
                </tr>
                <tr>
                    <th>Check Out</th>
                    <td><?php echo e($attendance->check_out ? $attendance->check_out->translatedFormat('j F Y H:i') : '-'); ?></td>
                </tr>
                <tr>
                    <th>Durasi Magang</th>
                    <td><?php echo e($attendance->work_duration ? $attendance->work_duration . ' jam' : '-'); ?></td>
                </tr>
                <tr>
                    <th>Status lokasi</th>
                    <td>
                        <?php if($attendance->location_status === 'berada dilokasi magang'): ?>
                            <span class="text-green-700 text-xs font-medium flex items-center gap-1">
                                <i class="bi bi-geo-alt-fill"></i> Di Lokasi
                            </span>
                        <?php elseif($attendance->location_status === 'diluar lokasi magang'): ?>
                            <span class="text-red-700 text-xs font-medium flex items-center gap-1">
                                <i class="bi bi-geo-alt"></i> Diluar Lokasi
                            </span>
                        <?php else: ?>
                            <span class="text-gray-400">-</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Latitude</th>
                    <td><?php echo e($attendance->latitude ?? '-'); ?></td>
                </tr>
                <tr>
                    <th>Longitude</th>
                    <td><?php echo e($attendance->longitude ?? '-'); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <!-- Update Status Form -->
                        <form action="<?php echo e(route('admin.attendance.updateStatus', $attendance->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <select name="status" class="form-select">
                                <option value="hadir" <?php echo e($attendance->status === 'hadir' ? 'selected' : ''); ?>>Hadir</option>
                                <option value="terlambat" <?php echo e($attendance->status === 'terlambat' ? 'selected' : ''); ?>>Terlambat</option>
                                <option value="tidak_hadir" <?php echo e($attendance->status === 'tidak_hadir' ? 'selected' : ''); ?>>Tidak Hadir</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                        </form>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/attendance/show.blade.php ENDPATH**/ ?>