

<?php $__env->startSection('title', 'Edit Jadwal'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Jadwal</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.schedules.update', $schedule)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="user_id" class="form-label">Mahasiswa <span class="text-danger">*</span></label>
                <select class="form-select <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="user_id" name="user_id" required>
                    <option value="">Pilih Mahasiswa</option>
                    <?php $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($mhs->id); ?>" <?php echo e(old('user_id', $schedule->user_id) == $mhs->id ? 'selected' : ''); ?>>
                            <?php echo e($mhs->name); ?>

                            <?php if($mhs->group): ?>
                                - <?php echo e($mhs->group->name); ?>

                            <?php endif; ?>
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['user_id'];
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
                <label for="location_id" class="form-label">Lokasi <span class="text-danger">*</span></label>
                <select class="form-select <?php $__errorArgs = ['location_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="location_id" name="location_id" required>
                    <option value="">Pilih Lokasi</option>
                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($location->id); ?>" <?php echo e(old('location_id', $schedule->location_id) == $location->id ? 'selected' : ''); ?>>
                            <?php echo e($location->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['location_id'];
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
                <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo e(old('date', $schedule->date ? (is_string($schedule->date) ? \Carbon\Carbon::parse($schedule->date)->format('Y-m-d') : $schedule->date->format('Y-m-d')) : '')); ?>" placeholder="Pilih tanggal" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Waktu Mulai <span class="text-danger">*</span></label>
                        <?php
                            $startTime = $schedule->start_time;
                            if (is_string($startTime)) {
                                $startTime = \Carbon\Carbon::parse($startTime)->format('H:i');
                            } elseif ($startTime instanceof \Carbon\Carbon) {
                                $startTime = $startTime->format('H:i');
                            }
                        ?>
                        <input type="time" class="form-control" id="start_time" name="start_time" value="<?php echo e(old('start_time', $startTime)); ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="end_time" class="form-label">Waktu Selesai <span class="text-danger">*</span></label>
                        <?php
                            $endTime = $schedule->end_time;
                            if (is_string($endTime)) {
                                $endTime = \Carbon\Carbon::parse($endTime)->format('H:i');
                            } elseif ($endTime instanceof \Carbon\Carbon) {
                                $endTime = $endTime->format('H:i');
                            }
                        ?>
                        <input type="time" class="form-control" id="end_time" name="end_time" value="<?php echo e(old('end_time', $endTime)); ?>" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Catatan</label>
                <textarea class="form-control" id="notes" name="notes" rows="3"><?php echo e(old('notes', $schedule->notes)); ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('admin.schedules.index')); ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\Sistem_Magang\resources\views/admin/schedules/edit.blade.php ENDPATH**/ ?>