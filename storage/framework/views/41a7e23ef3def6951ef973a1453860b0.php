
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <?php
        $fields = [
            'attendance_score' => 'Presensi',
            'discipline_score' => 'Disiplin',
            'performance_score' => 'Kinerja',
            'initiative_score' => 'Inisiatif',
            'cooperation_score' => 'Kerja Sama',
        ];
    ?>

    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                <?php echo e($label); ?> <span class="text-red-500">*</span>
            </label>

            <input
                type="number"
                name="<?php echo e($name); ?>"
                min="0"
                max="20"
                value="<?php echo e(old($name, $assessment->$name ?? '')); ?>"
                class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                       focus:ring focus:ring-blue-200 focus:border-blue-500
                       <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                required
            >

            <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-xs text-red-600">
                    <?php echo e($message); ?>

                </p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<hr class="my-6">


<div class="grid grid-cols-1 gap-6">

    
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Kelebihan
        </label>

        <textarea
            name="strengths"
            rows="3"
            class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                   focus:ring focus:ring-blue-200 focus:border-blue-500"
        ><?php echo e(old('strengths', $assessment->strengths ?? '')); ?></textarea>
    </div>

    
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Kekurangan
        </label>

        <textarea
            name="weaknesses"
            rows="3"
            class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                   focus:ring focus:ring-blue-200 focus:border-blue-500"
        ><?php echo e(old('weaknesses', $assessment->weaknesses ?? '')); ?></textarea>
    </div>

    
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Rekomendasi
        </label>

        <textarea
            name="recommendations"
            rows="3"
            class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                   focus:ring focus:ring-blue-200 focus:border-blue-500"
        ><?php echo e(old('recommendations', $assessment->recommendations ?? '')); ?></textarea>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/reports/partials/form.blade.php ENDPATH**/ ?>