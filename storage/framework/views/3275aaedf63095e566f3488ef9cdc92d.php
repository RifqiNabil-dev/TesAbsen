

<?php $__env->startSection('title', 'Laporan Peserta'); ?>

<?php $__env->startSection('content'); ?>

    <!-- ================= DATA MAHASISWA ================= -->
    <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">

        <div class="flex items-center justify-between border-b px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Detail Statistik Peserta 
            </h2>

            <div class="flex gap-2">
                <a href="<?php echo e(route('admin.reports.index')); ?>"
                    class="rounded bg-gray-500 px-3 py-2 text-sm font-semibold text-white hover:bg-gray-600">
                    <i class="bi bi-box-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- BIODATA -->
            <div>
                <table class="w-full text-sm">
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600 w-40">Nama</th>
                        <td class="text-gray-800"><?php echo e($user->name); ?></td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Email</th>
                        <td><?php echo e($user->email); ?></td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">NIM</th>
                        <td><?php echo e($user->nim ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Institusi</th>
                        <td><?php echo e($user->institution ?? '-'); ?></td>
                    </tr>
                </table>
            </div>

            <!-- STATISTIK -->
            <div>
                <h6 class="font-semibold text-gray-700 mb-2">Statistik</h6>
                <ul class="text-sm space-y-1">
                    <li><strong>Total Presensi Hadir:</strong> <?php echo e($totalAttendance); ?></li>
                    <li><strong>Total Presensi Terlambat:</strong> <?php echo e($totalLate); ?></li>
                    <li><strong>Total Presensi Tidak Hadir:</strong> <?php echo e($totalAbsent); ?></li>
                    <li><strong>Total Logbook Disetujui:</strong> <?php echo e($totalLogbooks); ?></li>
                </ul>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/reports/show.blade.php ENDPATH**/ ?>