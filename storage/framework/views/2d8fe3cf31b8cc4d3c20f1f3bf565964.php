

<?php $__env->startSection('title', 'Laporan & Penilaian'); ?>

<?php $__env->startSection('content'); ?>

<div x-data="reportFilter()">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
            <i class="bi bi-file-text"></i>
            Laporan & Penilaian
        </h2>
    </div>

    <!-- SEARCH & FILTER -->
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="flex flex-col md:flex-row gap-4">

            <!-- Search -->
            <div class="flex-1 relative">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text"
                       x-model="search"
                       placeholder="Cari nama, email, atau NIM..."
                       class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
            </div>

            <!-- Filter Penilaian -->
            <div class="w-full md:w-56">
                <select x-model="status"
                        class="w-full rounded-lg border border-gray-300 py-2 px-3 text-sm
                               focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Penilaian</option>
                    <option value="belum">Belum Dinilai</option>
                    <option value="sudah">Sudah Dinilai</option>
                </select>
            </div>

        </div>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-lg shadow border border-gray-200">
        <div class="p-6">

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 font-semibold">
                            <th class="px-4 py-3 border-b">Nama</th>
                            <th class="px-4 py-3 border-b text-center">Email</th>
                            <th class="px-4 py-3 border-b text-center">NIM</th>
                            <th class="px-4 py-3 border-b text-center">Total Presensi</th>
                            <th class="px-4 py-3 border-b text-center">Total Logbook</th>
                            <th class="px-4 py-3 border-b text-center">Penilaian Terakhir</th>
                            <th class="px-4 py-3 border-b text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        <?php $__empty_1 = true; $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr
                                x-show="filterRow($el)"
                                x-transition
                                class="hover:bg-gray-50"
                                data-name="<?php echo e(strtolower($mhs->name)); ?>"
                                data-email="<?php echo e(strtolower($mhs->email)); ?>"
                                data-nim="<?php echo e(strtolower($mhs->nim ?? '')); ?>"
                                data-status="<?php echo e($mhs->assessments->count() > 0 ? 'sudah' : 'belum'); ?>"
                            >
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    <?php echo e($mhs->name); ?>

                                </td>

                                <td class="px-4 py-3 text-gray-600 text-center">
                                    <?php echo e($mhs->email); ?>

                                </td>

                                <td class="px-4 py-3 text-gray-600 text-center">
                                    <?php echo e($mhs->nim ?? '-'); ?>

                                </td>

                                <td class="px-4 py-3 text-center font-semibold">
                                    <?php echo e($mhs->attendances_count); ?>

                                </td>

                                <td class="px-4 py-3 text-center font-semibold">
                                    <?php echo e($mhs->logbooks_count); ?>

                                </td>

                                <td class="px-4 py-3 text-center">
                                    <?php if($mhs->assessments->count() > 0): ?>
                                        <span class="font-semibold text-gray-800">
                                            <?php echo e($mhs->assessments->last()->grade); ?>

                                        </span>
                                        <span class="text-xs text-gray-500">
                                            (<?php echo e($mhs->assessments->last()->total_score); ?>)
                                        </span>
                                    <?php else: ?>
                                        <span class="text-sm text-gray-400 italic">
                                            Belum dinilai
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <?php if($mhs->assessments->count() > 0): ?>
                                        <a href="<?php echo e(route('admin.reports.edit', $mhs->id)); ?>"
                                           class="inline-flex items-center gap-1.5 rounded-lg bg-yellow-500 px-3 py-1.5
                                                  text-xs font-medium text-white shadow-sm hover:bg-yellow-600 transition">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('admin.reports.show', $mhs->id)); ?>"
                                           class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 px-3 py-1.5
                                                  text-xs font-medium text-white shadow-sm hover:bg-blue-700 transition">
                                            <i class="bi bi-eye"></i>
                                            Nilai
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">
                                    Tidak ada data mahasiswa
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<script>
    function reportFilter() {
        return {
            search: '',
            status: '',

            filterRow(row) {
                const name   = row.dataset.name ?? ''
                const email  = row.dataset.email ?? ''
                const nim    = row.dataset.nim ?? ''
                const status = row.dataset.status ?? ''

                const keyword = this.search.toLowerCase()

                const searchMatch =
                    name.includes(keyword) ||
                    email.includes(keyword) ||
                    nim.includes(keyword)

                const statusMatch =
                    this.status === '' || status === this.status

                return searchMatch && statusMatch
            }
        }
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>