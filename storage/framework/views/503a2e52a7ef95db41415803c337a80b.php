

<?php $__env->startSection('title', 'Edit Jadwal'); ?>

<?php $__env->startSection('content'); ?>
<div
    x-data="{ search: '' }"
    class="max-w-4xl mx-auto bg-white rounded-lg shadow border border-gray-200"
>

    <!-- HEADER -->
    <div class="border-b px-6 py-4">
        <h2 class="text-lg font-bold text-gray-800">Edit Jadwal</h2>
    </div>

    <!-- BODY -->
    <div class="p-6">
        <form method="POST" action="<?php echo e(route('admin.schedules.update', $schedule)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- MAHASISWA SEARCH -->
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-1">
                    Mahasiswa <span class="text-red-500">*</span>
                </label>

                <!-- SEARCH BAR -->
                <input
                    type="text"
                    x-model="search"
                    placeholder="Cari nama, email, atau kelompok..."
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200 mb-3"
                >

                <!-- LIST -->
                <div class="border rounded max-h-[300px] overflow-y-auto p-3 space-y-2">
                    <?php $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label
                        x-show="
                            '<?php echo e(strtolower($mhs->name.' '.$mhs->email.' '.($mhs->group->name ?? ''))); ?>'
                            .includes(search.toLowerCase())
                        "
                        class="flex items-start gap-3 rounded p-3 border
                               hover:bg-gray-50 cursor-pointer"
                    >
                        <input
                            type="radio"
                            name="user_id"
                            value="<?php echo e($mhs->id); ?>"
                            required
                            class="mt-1 text-blue-600 focus:ring-blue-500"
                            <?php echo e(old('user_id', $schedule->user_id) == $mhs->id ? 'checked' : ''); ?>

                        >

                        <div class="text-sm">
                            <p class="font-semibold text-gray-800">
                                <?php echo e($mhs->name); ?>

                            </p>
                            <p class="text-xs text-gray-500">
                                <?php echo e($mhs->email); ?>

                                <?php if($mhs->group): ?>
                                    • <?php echo e($mhs->group->name); ?>

                                <?php endif; ?>
                            </p>
                        </div>
                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-500 mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- LOKASI -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">
                    Lokasi <span class="text-red-500">*</span>
                </label>
                <select
                    name="location_id"
                    required
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200"
                >
                    <option value="">Pilih Lokasi</option>
                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            value="<?php echo e($location->id); ?>"
                            <?php echo e(old('location_id', $schedule->location_id) == $location->id ? 'selected' : ''); ?>

                        >
                            <?php echo e($location->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['location_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-500 mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- TANGGAL -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">
                    Tanggal <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="date"
                    required
                    value="<?php echo e(old('date', $schedule->date ? (is_string($schedule->date) ? \Carbon\Carbon::parse($schedule->date)->format('Y-m-d') : $schedule->date->format('Y-m-d')) : '')); ?>"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200 datepicker"
                    placeholder="Pilih tanggal"
                >
            </div>

            <!-- WAKTU -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <?php
                    $startTime = $schedule->start_time;
                    if (is_string($startTime)) {
                        $startTime = \Carbon\Carbon::parse($startTime)->format('H:i');
                    } elseif ($startTime instanceof \Carbon\Carbon) {
                        $startTime = $startTime->format('H:i');
                    }

                    $endTime = $schedule->end_time;
                    if (is_string($endTime)) {
                        $endTime = \Carbon\Carbon::parse($endTime)->format('H:i');
                    } elseif ($endTime instanceof \Carbon\Carbon) {
                        $endTime = $endTime->format('H:i');
                    }
                ?>

                <div>
                    <label class="block text-sm font-semibold mb-1">
                        Waktu Mulai <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="time"
                        name="start_time"
                        required
                        value="<?php echo e(old('start_time', $startTime)); ?>"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                               focus:ring focus:ring-blue-200"
                    >
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">
                        Waktu Selesai <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="time"
                        name="end_time"
                        required
                        value="<?php echo e(old('end_time', $endTime)); ?>"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                               focus:ring focus:ring-blue-200"
                    >
                </div>
            </div>

            <!-- CATATAN -->
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-1">Catatan</label>
                <textarea
                    name="notes"
                    rows="3"
                    class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                           focus:ring focus:ring-blue-200"
                ><?php echo e(old('notes', $schedule->notes)); ?></textarea>
            </div>

            <!-- ACTION -->
            <div class="flex justify-between items-center">
                <a
                    href="<?php echo e(route('admin.schedules.index')); ?>"
                    class="rounded bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold
                           text-white hover:bg-blue-700"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/schedules/edit.blade.php ENDPATH**/ ?>