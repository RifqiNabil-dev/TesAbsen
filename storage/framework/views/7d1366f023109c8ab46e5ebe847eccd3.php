

<?php $__env->startSection('title', 'Laporan Peserta'); ?>

<?php $__env->startSection('content'); ?>

    <!-- ================= DATA MAHASISWA ================= -->
    <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">

        <div class="border-b px-6 py-4">
            <h5 class="text-lg font-semibold text-gray-800">Data Peserta</h5>
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

    <!-- ================= PENILAIAN TERAKHIR ================= -->
    <?php if($latestAssessment): ?>
        <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">

            <div class="border-b px-6 py-4">
                <h5 class="text-lg font-semibold text-gray-800">Penilaian Terakhir</h5>
            </div>

            <div class="p-6">
                <table class="w-full text-sm">
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600 w-56">Tanggal Penilaian</th>
                        <td><?php echo e($latestAssessment->created_at->format('d-m-Y')); ?></td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Dinilai Oleh</th>
                        <td><?php echo e($latestAssessment->assessor->name); ?></td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Nilai Kehadiran</th>
                        <td><?php echo e($latestAssessment->attendance_score); ?>/20</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Nilai Kedisiplinan</th>
                        <td><?php echo e($latestAssessment->discipline_score); ?>/20</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Nilai Kinerja</th>
                        <td><?php echo e($latestAssessment->performance_score); ?>/20</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Nilai Inisiatif</th>
                        <td><?php echo e($latestAssessment->initiative_score); ?>/20</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Nilai Kerjasama</th>
                        <td><?php echo e($latestAssessment->cooperation_score); ?>/20</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Total Nilai</th>
                        <td class="font-semibold"><?php echo e($latestAssessment->total_score); ?>/100</td>
                    </tr>
                    <tr>
                        <th class="py-1 pr-4 text-left text-gray-600">Grade</th>
                        <td class="text-2xl font-bold text-blue-600">
                            <?php echo e($latestAssessment->grade); ?>

                        </td>
                    </tr>

                    <?php if($latestAssessment->strengths): ?>
                        <tr>
                            <th class="py-1 pr-4 text-left text-gray-600">Kekuatan</th>
                            <td><?php echo e($latestAssessment->strengths); ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if($latestAssessment->weaknesses): ?>
                        <tr>
                            <th class="py-1 pr-4 text-left text-gray-600">Kelemahan</th>
                            <td><?php echo e($latestAssessment->weaknesses); ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if($latestAssessment->recommendations): ?>
                        <tr>
                            <th class="py-1 pr-4 text-left text-gray-600">Rekomendasi</th>
                            <td><?php echo e($latestAssessment->recommendations); ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <!-- ================= FORM PENILAIAN BARU ================= -->
    <div class="bg-white rounded-lg shadow border border-gray-200">

        <div class="border-b px-6 py-4">
            <h5 class="text-lg font-semibold text-gray-800">Buat Penilaian Baru</h5>
        </div>

        <div class="p-6">
            <form method="POST" action="<?php echo e(route('admin.reports.assessment', $user)); ?>">
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1">Nilai Kehadiran (0–20)</label>
                        <input type="number" name="attendance_score" min="0" max="20"
                            value="<?php echo e(old('attendance_score', 0)); ?>"
                            class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">Nilai Kedisiplinan (0–20)</label>
                        <input type="number" name="discipline_score" min="0" max="20"
                            value="<?php echo e(old('discipline_score', 0)); ?>"
                            class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                            required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1">Nilai Kinerja (0–20)</label>
                        <input type="number" name="performance_score" min="0" max="20"
                            value="<?php echo e(old('performance_score', 0)); ?>"
                            class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">Nilai Inisiatif (0–20)</label>
                        <input type="number" name="initiative_score" min="0" max="20"
                            value="<?php echo e(old('initiative_score', 0)); ?>"
                            class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                            required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Nilai Kerjasama (0–20)</label>
                    <input type="number" name="cooperation_score" min="0" max="20" value="<?php echo e(old('cooperation_score', 0)); ?>"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Kekuatan</label>
                    <textarea name="strengths" rows="3"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"><?php echo e(old('strengths')); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Kelemahan</label>
                    <textarea name="weaknesses" rows="3"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"><?php echo e(old('weaknesses')); ?></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-1">Rekomendasi</label>
                    <textarea name="recommendations" rows="3"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200"><?php echo e(old('recommendations')); ?></textarea>
                </div>

                <div class="flex justify-between">
                    <a href="<?php echo e(route('admin.reports.index')); ?>"
                        class="rounded bg-gray-500 px-4 py-2 text-sm text-white hover:bg-gray-600">
                        Kembali
                    </a>

                    <button type="submit"
                        class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                        Simpan Penilaian
                    </button>
                </div>

            </form>
        </div>
    </div>

<script>
    <?php if(session('alert') === 'assessment_saved'): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Penilaian berhasil disimpan.',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });

        setTimeout(() => {
            window.location.href = "<?php echo e(route('admin.reports.index')); ?>";
        }, 3000);
    <?php endif; ?>
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\PKL\TesAbsen\resources\views/admin/reports/show.blade.php ENDPATH**/ ?>