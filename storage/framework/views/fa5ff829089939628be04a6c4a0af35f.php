

<?php $__env->startSection('title', 'Tambah Jadwal'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Tambah Jadwal</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.schedules.store')); ?>">
            <?php echo csrf_field(); ?>

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
                        <option value="<?php echo e($mhs->id); ?>" <?php echo e(old('user_id') == $mhs->id ? 'selected' : ''); ?>>
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
                <select class="form-select" id="location_id" name="location_id" required>
                    <option value="">Pilih Lokasi</option>
                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($location->id); ?>" <?php echo e(old('location_id') == $location->id ? 'selected' : ''); ?>>
                            <?php echo e($location->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Periode Jadwal <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-md-6">
                        <label for="start_date" class="form-label small">Tanggal Mulai</label>
                        <input type="text" class="form-control datepicker <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="start_date" name="start_date" value="<?php echo e(old('start_date')); ?>" placeholder="Pilih tanggal mulai" required>
                        <?php $__errorArgs = ['start_date'];
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
                    <div class="col-md-6">
                        <label for="end_date" class="form-label small">Tanggal Selesai</label>
                        <input type="text" class="form-control datepicker <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="end_date" name="end_date" value="<?php echo e(old('end_date')); ?>" placeholder="Pilih tanggal selesai" required>
                        <?php $__errorArgs = ['end_date'];
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
                </div>
                <small class="form-text text-muted">
                    <i class="bi bi-info-circle"></i> Sistem akan otomatis membuat jadwal untuk hari kerja (Senin-Jumat) dengan waktu:
                    <br>• Senin s.d Kamis: 08:00 - 16:00 WIB
                    <br>• Jumat: 07:30 - 15:00 WIB
                </small>
            </div>

            <div class="alert alert-info">
                <i class="bi bi-calendar-check"></i> <strong>Info:</strong> Jadwal akan dibuat otomatis untuk setiap hari kerja dalam periode yang dipilih. Sabtu dan Minggu akan dilewati.
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Catatan</label>
                <textarea class="form-control" id="notes" name="notes" rows="3"><?php echo e(old('notes')); ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('admin.schedules.index')); ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        
        if (startDateInput && endDateInput && !startDateInput.hasAttribute('data-fp-initialized')) {
            const startPicker = flatpickr(startDateInput, {
                dateFormat: 'Y-m-d',
                locale: 'id',
                allowInput: true,
                altInput: true,
                altFormat: 'd/m/Y',
                altInputClass: 'form-control',
                disableMobile: true,
                monthSelectorType: 'static',
                yearSelectorType: 'static',
                static: true,
                onChange: function(selectedDates) {
                    if (selectedDates.length > 0) {
                        endPicker.set('minDate', selectedDates[0]);
                    }
                }
            });
            
            const endPicker = flatpickr(endDateInput, {
                dateFormat: 'Y-m-d',
                locale: 'id',
                allowInput: true,
                altInput: true,
                altFormat: 'd/m/Y',
                altInputClass: 'form-control',
                disableMobile: true,
                monthSelectorType: 'static',
                yearSelectorType: 'static',
                static: true,
                minDate: startDateInput.value || 'today'
            });
            
            startDateInput.setAttribute('data-fp-initialized', 'true');
            endDateInput.setAttribute('data-fp-initialized', 'true');
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\Sistem_Magang\resources\views/admin/schedules/create.blade.php ENDPATH**/ ?>