

<?php $__env->startSection('title', 'Edit Lokasi'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Lokasi</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.locations.update', $location)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="name" class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $location->name)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo e(old('description', $location->description)); ?></textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" <?php echo e(old('is_active', $location->is_active) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('admin.locations.index')); ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\Sistem_Magang\resources\views/admin/locations/edit.blade.php ENDPATH**/ ?>