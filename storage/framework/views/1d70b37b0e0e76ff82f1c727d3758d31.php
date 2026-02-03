

<?php $__env->startSection('title', 'Tambah Jadwal'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow border border-gray-200">

    <!-- HEADER -->
    <div class="border-b px-6 py-4">
        <h2 class="text-lg font-semibold text-gray-800">
            Tambah Jadwal
        </h2>
    </div>

    <!-- BODY -->
    <div class="p-6">
        <form method="POST" action="<?php echo e(route('admin.schedules.store')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>

            <!-- MAHASISWA SEARCH -->
            <div x-data="{ search: '' }" class="mb-4">
                <label class="block text-sm font-semibold mb-1">
                    Peserta <span class="text-red-500">*</span>
                </label>

                <!-- SEARCH BAR -->
                <input
                    type="text"
                    x-model="search"
                    placeholder="Cari nama, email, atau kelompok..."
                    class="w-full rounded border border-gray-900 px-3 py-2 text-sm
                        focus:ring focus:ring-blue-200 mb-3"
                >

                <!-- LIST MAHASISWA -->
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
                            <?php echo e(old('user_id') == $mhs->id ? 'checked' : ''); ?>

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
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Lokasi (Pilih 1-3) <span class="text-red-500">*</span>
                </label>
                
                <div class="border rounded p-3 max-h-[300px] overflow-y-auto space-y-4">
                    <?php $__currentLoopData = $locations->groupBy('division.name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divisionName => $divLocations): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <h4 class="font-bold text-xs uppercase text-gray-500 mb-2 border-b pb-1">
                                <?php echo e($divisionName ?? 'Lainnya'); ?>

                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <?php $__currentLoopData = $divLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="flex items-center space-x-2 text-sm cursor-pointer p-1 hover:bg-gray-50 rounded">
                                        <input 
                                            type="checkbox" 
                                            name="location_ids[]" 
                                            value="<?php echo e($location->id); ?>"
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                            <?php echo e(in_array($location->id, old('location_ids', [])) ? 'checked' : ''); ?>

                                        >
                                        <span class="text-gray-700"><?php echo e($location->name); ?></span>
                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php $__errorArgs = ['location_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-500 mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php $__errorArgs = ['location_ids.*'];
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

            <!-- PERIODE -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Periode Jadwal <span class="text-red-500">*</span>
                </label>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs text-gray-500">Tanggal Mulai</label>
                        <input
                            type="text"
                            id="start_date"
                            name="start_date"
                            value="<?php echo e(old('start_date')); ?>"
                            required
                            class="datepicker w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        >
                        <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Tanggal Selesai</label>
                        <input
                            type="text"
                            id="end_date"
                            name="end_date"
                            value="<?php echo e(old('end_date')); ?>"
                            required
                            class="datepicker w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        >
                        <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <p class="mt-3 text-sm text-gray-500">
                    ℹ️ Jadwal otomatis dibuat untuk hari kerja (Senin–Jumat)
                    <br>• Senin–Kamis: <b>08:00 – 15:30</b>
                    <br>• Jumat: <b>07:30 – 14:30</b>
                </p>
            </div>

            <!-- INFO -->
            <div class="rounded bg-blue-50 border border-blue-200 p-4 text-sm text-blue-800">
                📅 <strong>Info:</strong> Sabtu dan Minggu akan dilewati secara otomatis.
            </div>

            <!-- CATATAN -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Catatan
                </label>
                <textarea
                    name="notes"
                    rows="3"
                    class="w-full border border-gray-900 px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                ><?php echo e(old('notes')); ?></textarea>
            </div>

            <!-- ACTION -->
            <div class="flex justify-between">
                <a href="<?php echo e(route('admin.schedules.index')); ?>"
                   class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">
                    Batal
                </a>

                <button type="submit"
                        class="px-5 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>


<script>
document.getElementById('searchMahasiswa').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let options = document.querySelectorAll('#user_id option');

    options.forEach(option => {
        option.style.display = option.text.toLowerCase().includes(keyword)
            ? 'block'
            : 'none';
    });
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const start = flatpickr("#start_date", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d-m-Y",
        locale: "id",
        onChange: function(selectedDates) {
            end.set('minDate', selectedDates[0]);
        }
    });

    const end = flatpickr("#end_date", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d-m-Y",
        locale: "id",
        minDate: "today"
    });
});
</script>

<script>
document.getElementById('searchMahasiswa').addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();
    const options = document.querySelectorAll('#user_id option');

    options.forEach(option => {
        option.style.display = option.text.toLowerCase().includes(keyword)
            ? 'block'
            : 'none';
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\PKL\TesAbsen\resources\views/admin/schedules/create.blade.php ENDPATH**/ ?>