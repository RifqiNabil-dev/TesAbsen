

<?php $__env->startSection('title', 'Detail Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Mahasiswa</h5>
        <div>
            <a href="<?php echo e(route('admin.mahasiswa.edit', $mahasiswa)); ?>" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="<?php echo e(route('admin.reports.show', $mahasiswa)); ?>" class="btn btn-sm btn-info">
                <i class="bi bi-file-text"></i> Laporan
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Nama</th>
                        <td><?php echo e($mahasiswa->name); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo e($mahasiswa->email); ?></td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td><?php echo e($mahasiswa->nim ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th>Institusi</th>
                        <td><?php echo e($mahasiswa->institution ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td><?php echo e($mahasiswa->phone ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th>Periode PKL</th>
                        <td>
                            <?php if($mahasiswa->start_date && $mahasiswa->end_date): ?>
                                <?php
                                    $startDate = is_string($mahasiswa->start_date) ? \Carbon\Carbon::parse($mahasiswa->start_date) : $mahasiswa->start_date;
                                    $endDate = is_string($mahasiswa->end_date) ? \Carbon\Carbon::parse($mahasiswa->end_date) : $mahasiswa->end_date;
                                ?>
                                <?php echo e($startDate->format('d/m/Y')); ?> - <?php echo e($endDate->format('d/m/Y')); ?>

                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6>Statistik</h6>
                <ul class="list-unstyled">
                    <li><strong>Total Presensi:</strong> <?php echo e($mahasiswa->attendances->count()); ?></li>
                    <li><strong>Total Logbook:</strong> <?php echo e($mahasiswa->logbooks->count()); ?></li>
                    <li><strong>Total Jadwal:</strong> <?php echo e($mahasiswa->schedules->count()); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\Sistem_Magang\resources\views/admin/mahasiswa/show.blade.php ENDPATH**/ ?>