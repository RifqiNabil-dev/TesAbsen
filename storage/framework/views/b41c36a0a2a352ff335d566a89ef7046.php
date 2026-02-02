

<?php $__env->startSection('title', 'Data Presensi'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-4" x-data="attendanceFilter()">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Data Presensi</h2>
    </div>

    <!-- SEARCH -->
    <div class="mb-4">
        <div class="relative">
            <input type="text"
                   x-model="search"
                   placeholder="Cari nama peserta..."
                   class="w-full md:w-1/3 rounded-lg border border-gray-300 pr-4 py-2 pl-12
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
        </div>
    </div>

    <!-- USER LIST TABLE -->
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm mt-4">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-700 font-semibold border-b">
                <tr>
                    <th class="px-6 py-4">Nama Peserta</th>
                    <th class="px-6 py-4 text-center">Total Kehadiran</th>
                    <th class="px-6 py-4 text-center">Status Hari Ini</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr
                        x-show="filterRow($el)"
                        x-transition
                        data-name="<?php echo e(strtolower($user->name)); ?>"
                        class="hover:bg-blue-50 transition duration-150"
                    >
                        <td class="px-6 py-4 font-medium text-gray-900">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs uppercase">
                                    <?php echo e(substr($user->name, 0, 2)); ?>

                                </div>
                                <?php echo e($user->name); ?>

                            </div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="bg-gray-100 text-gray-700 py-1 px-3 rounded-full text-xs font-bold">
                                <?php echo e($user->total_attendances); ?>

                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <?php if($user->today_attendance > 0): ?>
                                <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">
                                    <i class="bi bi-check-circle-fill"></i> Hadir
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-500">
                                    <i class="bi bi-dash-circle"></i> Belum Absen
                                </span>
                            <?php endif; ?>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <a href="<?php echo e(route('admin.attendance.index', ['user_id' => $user->id])); ?>"
                               class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 px-3 py-1.5
                                      text-xs font-medium text-white shadow-sm hover:bg-blue-700 transition">
                                <i class="bi bi-eye"></i> Detail Presensi
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="bi bi-people text-4xl mb-3 text-gray-300"></i>
                                <p>Tidak ada data peserta ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        <?php echo e($users->withQueryString()->links()); ?>

    </div>
</div>

<script>
    function attendanceFilter() {
        return {
            search: '',

            filterRow(row) {
                const name = row.dataset.name ?? ''
                const keyword = this.search.toLowerCase()

                return name.includes(keyword)
            }
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/attendance/index.blade.php ENDPATH**/ ?>