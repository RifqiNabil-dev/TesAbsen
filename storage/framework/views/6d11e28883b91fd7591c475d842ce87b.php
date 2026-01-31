

<?php $__env->startSection('title', 'Tambah Logbook'); ?>

<?php $__env->startSection('content'); ?>

    <!-- Card -->
    <div class="max-w-3xl mx-auto border bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h5 class="text-lg font-semibold">Tambah Logbook</h5>
        </div>

        <div class="p-6">
            <form method="POST" action="<?php echo e(route('mahasiswa.logbooks.store')); ?>">
                <?php echo csrf_field(); ?>

                <!-- Tanggal -->
                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium mb-1">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="date" name="date" value="<?php echo e(old('date', today()->format('Y-m-d'))); ?>"
                        placeholder="Pilih tanggal" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200
                                  px-3 py-2 datepicker">
                </div>

                <!-- Aktivitas -->
                <div class="mb-4">
                    <label for="activity" class="block text-sm font-medium mb-1">
                        Aktivitas <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="activity" name="activity" value="<?php echo e(old('activity')); ?>" required class="w-full rounded-lg border border-gray-900 focus:border-blue-500 focus:ring focus:ring-blue-200
                                  px-3 py-2">
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium mb-1">
                        Deskripsi Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="description" name="description" rows="5" required class="w-full rounded-lg border border-gray-900 focus:border-blue-500 focus:ring focus:ring-blue-200
                                     px-3 py-2"><?php echo e(old('description')); ?></textarea>
                </div>

                <!-- Waktu (Auto-filled from Schedule) -->
                <!-- Inputs removed as requested -->

                <!-- Action -->
                <div class="flex flex-col sm:flex-row justify-between gap-3">
                    <a href="<?php echo e(route('mahasiswa.logbooks.index')); ?>" class="w-full sm:w-auto text-center bg-gray-500 hover:bg-gray-600 text-white
                              px-5 py-2 rounded-lg">
                        Batal
                    </a>

                    <button type="submit" class="w-full sm:w-auto bg-blue-500 hover:bg-blue-600 text-white
                                   px-6 py-2 rounded-lg font-medium">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\PKL\TesAbsen\resources\views/mahasiswa/logbooks/create.blade.php ENDPATH**/ ?>