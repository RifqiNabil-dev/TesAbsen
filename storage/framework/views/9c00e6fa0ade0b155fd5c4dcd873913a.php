

<?php $__env->startSection('title', 'Titik Layanan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <i class="bi bi-geo-alt text-blue-600"></i> Informasi Titik Layanan
                </h2>
                <p class="text-sm text-gray-500 mt-1">Daftar lokasi dan titik layanan magang.</p>
            </div>
        </div>

        <!-- LOCATIONS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                    <!-- MAP PREVIEW (Static or Placeholder) -->
                    <div class="h-40 bg-gray-100 relative">
                        <!-- If you have Leaflet or a map image service, put it here. For now, a placeholder. -->
                        <div class="absolute inset-0 flex items-center justify-center text-gray-400 bg-gray-50">
                            <i class="bi bi-map text-4xl opacity-20"></i>
                        </div>
                        <div class="absolute top-3 right-3">
                            <span
                                class="inline-flex items-center rounded-full bg-white/90 px-2.5 py-0.5 text-xs font-medium text-blue-700 shadow-sm backdrop-blur-sm ring-1 ring-inset ring-blue-600/10">
                                <?php echo e($location->division->name ?? 'Umum'); ?>

                            </span>
                        </div>
                    </div>

                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-1"><?php echo e($location->name); ?></h3>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">
                            <?php echo e($location->address ?? 'Alamat belum tersedia.'); ?>

                        </p>

                        <!-- DESCRIPTION -->
                        <?php if($location->description): ?>
                            <div class="mb-4">
                                <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Deskripsi</h4>
                                <p class="text-gray-700 leading-relaxed"><?php echo e($location->description); ?></p>
                            </div>
                        <?php endif; ?>

                        <!-- TASKS -->
                        <?php if($location->tasks): ?>
                            <div class="mb-4">
                                <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tugas / Kegiatan</h4>
                                <ul class="list-disc list-inside text-gray-700 space-y-1">
                                    <?php $__currentLoopData = explode("\n", $location->tasks); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e(trim($task)); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="space-y-2 text-sm border-t pt-3 border-gray-100">
                            <div class="flex items-start gap-2 text-gray-600">
                                <i class="bi bi-geo mt-0.5 text-blue-500"></i>
                                <span>
                                    <span class="font-medium text-gray-900">Koordinat:</span>
                                    <?php echo e($location->latitude); ?>, <?php echo e($location->longitude); ?>

                                </span>
                            </div>
                            <!-- Add more details if available, e.g. operational hours -->
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end">
                            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo e($location->latitude); ?>,<?php echo e($location->longitude); ?>"
                                target="_blank"
                                class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-700">
                                Buka di Maps <i class="bi bi-box-arrow-up-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div
                    class="col-span-full py-12 text-center text-gray-500 bg-white rounded-xl border border-gray-100 border-dashed">
                    <i class="bi bi-geo-alt-fill text-4xl text-gray-300 mb-3 inline-block"></i>
                    <p>Belum ada informasi titik layanan.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- PAGINATION -->
        <div class="mt-6">
            <?php echo e($locations->links()); ?>

        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\PKL\TesAbsen\resources\views/mahasiswa/locations/index.blade.php ENDPATH**/ ?>