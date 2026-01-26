

<?php $__env->startSection('title', 'Laporan Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">Data Mahasiswa</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Nama</th>
                        <td><?php echo e($user->name); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo e($user->email); ?></td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td><?php echo e($user->nim ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th>Institusi</th>
                        <td><?php echo e($user->institution ?? '-'); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6>Statistik</h6>
                <ul class="list-unstyled">
                    <li><strong>Total Presensi Hadir:</strong> <?php echo e($totalAttendance); ?></li>
                    <li><strong>Total Presensi Terlambat:</strong> <?php echo e($totalLate); ?></li>
                    <li><strong>Total Presensi Tidak Hadir:</strong> <?php echo e($totalAbsent); ?></li>
                    <li><strong>Total Logbook Disetujui:</strong> <?php echo e($totalLogbooks); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php if($latestAssessment): ?>
<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">Penilaian Terakhir</h5>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Tanggal Penilaian</th>
                <td><?php echo e($latestAssessment->created_at->format('d/m/Y')); ?></td>
            </tr>
            <tr>
                <th>Dinilai Oleh</th>
                <td><?php echo e($latestAssessment->assessor->name); ?></td>
            </tr>
            <tr>
                <th>Nilai Kehadiran</th>
                <td><?php echo e($latestAssessment->attendance_score); ?>/20</td>
            </tr>
            <tr>
                <th>Nilai Kedisiplinan</th>
                <td><?php echo e($latestAssessment->discipline_score); ?>/20</td>
            </tr>
            <tr>
                <th>Nilai Kinerja</th>
                <td><?php echo e($latestAssessment->performance_score); ?>/20</td>
            </tr>
            <tr>
                <th>Nilai Inisiatif</th>
                <td><?php echo e($latestAssessment->initiative_score); ?>/20</td>
            </tr>
            <tr>
                <th>Nilai Kerjasama</th>
                <td><?php echo e($latestAssessment->cooperation_score); ?>/20</td>
            </tr>
            <tr>
                <th>Total Nilai</th>
                <td><strong><?php echo e($latestAssessment->total_score); ?>/100</strong></td>
            </tr>
            <tr>
                <th>Grade</th>
                <td><strong class="h4"><?php echo e($latestAssessment->grade); ?></strong></td>
            </tr>
            <?php if($latestAssessment->strengths): ?>
            <tr>
                <th>Kekuatan</th>
                <td><?php echo e($latestAssessment->strengths); ?></td>
            </tr>
            <?php endif; ?>
            <?php if($latestAssessment->weaknesses): ?>
            <tr>
                <th>Kelemahan</th>
                <td><?php echo e($latestAssessment->weaknesses); ?></td>
            </tr>
            <?php endif; ?>
            <?php if($latestAssessment->recommendations): ?>
            <tr>
                <th>Rekomendasi</th>
                <td><?php echo e($latestAssessment->recommendations); ?></td>
            </tr>
            <?php endif; ?>
        </table>
    </div>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Buat Penilaian Baru</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.reports.assessment', $user)); ?>">
            <?php echo csrf_field(); ?>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="attendance_score" class="form-label">Nilai Kehadiran (0-20)</label>
                    <input type="number" class="form-control" id="attendance_score" name="attendance_score" 
                           min="0" max="20" value="<?php echo e(old('attendance_score', 0)); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="discipline_score" class="form-label">Nilai Kedisiplinan (0-20)</label>
                    <input type="number" class="form-control" id="discipline_score" name="discipline_score" 
                           min="0" max="20" value="<?php echo e(old('discipline_score', 0)); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="performance_score" class="form-label">Nilai Kinerja (0-20)</label>
                    <input type="number" class="form-control" id="performance_score" name="performance_score" 
                           min="0" max="20" value="<?php echo e(old('performance_score', 0)); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="initiative_score" class="form-label">Nilai Inisiatif (0-20)</label>
                    <input type="number" class="form-control" id="initiative_score" name="initiative_score" 
                           min="0" max="20" value="<?php echo e(old('initiative_score', 0)); ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="cooperation_score" class="form-label">Nilai Kerjasama (0-20)</label>
                <input type="number" class="form-control" id="cooperation_score" name="cooperation_score" 
                       min="0" max="20" value="<?php echo e(old('cooperation_score', 0)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="strengths" class="form-label">Kekuatan</label>
                <textarea class="form-control" id="strengths" name="strengths" rows="3"><?php echo e(old('strengths')); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="weaknesses" class="form-label">Kelemahan</label>
                <textarea class="form-control" id="weaknesses" name="weaknesses" rows="3"><?php echo e(old('weaknesses')); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="recommendations" class="form-label">Rekomendasi</label>
                <textarea class="form-control" id="recommendations" name="recommendations" rows="3"><?php echo e(old('recommendations')); ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('admin.reports.index')); ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\Sistem_Magang\resources\views/admin/reports/show.blade.php ENDPATH**/ ?>