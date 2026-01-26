

<?php $__env->startSection('title', 'Edit Logbook'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Logbook</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('mahasiswa.logbooks.update', $logbook)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo e(old('date', $logbook->date->format('Y-m-d'))); ?>" placeholder="Pilih tanggal" required>
            </div>

            <div class="mb-3">
                <label for="activity" class="form-label">Aktivitas <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="activity" name="activity" value="<?php echo e(old('activity', $logbook->activity)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Kegiatan <span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description" rows="5" required><?php echo e(old('description', $logbook->description)); ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Waktu Mulai <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="start_time" name="start_time" value="<?php echo e(old('start_time', $logbook->start_time)); ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="end_time" class="form-label">Waktu Selesai <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="end_time" name="end_time" value="<?php echo e(old('end_time', $logbook->end_time)); ?>" required>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('mahasiswa.logbooks.index')); ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Magang\resources\views/mahasiswa/logbooks/edit.blade.php ENDPATH**/ ?>