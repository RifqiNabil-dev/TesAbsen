

<?php $__env->startSection('title', 'Edit Kelompok'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Kelompok</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.groups.update', $group)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="name" class="form-label">Nama Kelompok <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" value="<?php echo e(old('name', $group->name)); ?>" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo e(old('description', $group->description)); ?></textarea>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?php echo e(old('is_active', $group->is_active) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_active">
                        Aktif
                    </label>
                </div>
            </div>

            <hr class="my-4">

            <div class="mb-3">
                <label class="form-label">Pilih Mahasiswa untuk Kelompok</label>
                <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                    <?php $__empty_1 = true; $__currentLoopData = $availableMahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mahasiswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="user_ids[]" value="<?php echo e($mahasiswa->id); ?>" id="user_<?php echo e($mahasiswa->id); ?>" 
                                <?php echo e((old('user_ids') ? in_array($mahasiswa->id, old('user_ids')) : $mahasiswa->group_id == $group->id) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="user_<?php echo e($mahasiswa->id); ?>">
                                <strong><?php echo e($mahasiswa->name); ?></strong>
                                <small class="text-muted">(<?php echo e($mahasiswa->email); ?>)</small>
                                <?php if($mahasiswa->nim): ?>
                                    <br><small class="text-muted">NIM: <?php echo e($mahasiswa->nim); ?></small>
                                <?php endif; ?>
                                <?php if($mahasiswa->group_id == $group->id): ?>
                                    <span class="badge bg-success ms-2">Anggota saat ini</span>
                                <?php elseif($mahasiswa->group_id): ?>
                                    <span class="badge bg-warning ms-2">Di kelompok lain</span>
                                <?php endif; ?>
                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted mb-0">Tidak ada mahasiswa yang tersedia</p>
                    <?php endif; ?>
                </div>
                <small class="form-text text-muted">Centang mahasiswa yang ingin ditambahkan ke kelompok ini. Mahasiswa yang sudah di kelompok lain akan dipindahkan ke kelompok ini.</small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('admin.groups.index')); ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\Sistem_Magang\resources\views/admin/groups/edit.blade.php ENDPATH**/ ?>