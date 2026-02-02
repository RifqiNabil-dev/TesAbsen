

<?php $__env->startSection('title', 'Detail Jadwal Kelompok - ' . $group->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">

        <!-- HEADER / BREADCRUMB -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                    <a href="<?php echo e(route('admin.schedules.index')); ?>" class="hover:text-blue-600 transition">Data Kelompok</a>
                    <i class="bi bi-chevron-right text-xs"></i>
                    <span class="font-medium text-gray-900"><?php echo e($group->name); ?></span>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Jadwal Kelompok</h2>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="<?php echo e(route('admin.schedules.index')); ?>"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition flex items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                
                <a href="<?php echo e(route('admin.schedules.print', request()->all())); ?>" target="_blank"
                    class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200 transition flex items-center gap-2">
                    <i class="bi bi-printer"></i> Cetak Jadwal
                </a>

                <a href="<?php echo e(route('admin.schedules.create')); ?>"
                    class="px-4 py-2 bg-blue-600 rounded-lg text-sm font-medium text-white hover:bg-blue-700 transition flex items-center gap-2 shadow-sm">
                    <i class="bi bi-plus-lg"></i> Tambah Jadwal
                </a>

                <!-- BULK DELETE FORM -->
                <form action="<?php echo e(route('admin.schedules.bulk-destroy')); ?>" method="POST" class="hidden" id="bulkDeleteForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 rounded-lg text-sm font-medium text-white hover:bg-red-700 transition flex items-center gap-2 shadow-sm">
                        <i class="bi bi-trash"></i> Hapus Terpilih
                    </button>
                    <div id="bulkDeleteInputs"></div>
                </form>
            </div>
        </div>

        <!-- FILTER CARD -->
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <form action="<?php echo e(route('admin.schedules.index')); ?>" method="GET"
                class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <input type="hidden" name="group_id" value="<?php echo e($group->id); ?>">

                <!-- Filter User -->
                <div>
                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Peserta</label>
                    <select name="user_id"
                        class="w-full rounded border border-gray-300 px-3 py-2 text-sm
                       focus:ring focus:ring-blue-200 focus:outline-none">
                        <option value="">Semua Peserta</option>
                        <?php $__currentLoopData = $usersInGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($u->id); ?>" <?php echo e(request('user_id') == $u->id ? 'selected' : ''); ?>>
                                <?php echo e($u->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Filter Date Start -->
                <div>
                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Dari Tanggal</label>
                    <input type="text" id="start_date" name="start_date" value="<?php echo e(request('start_date')); ?>"
                            class="datepicker w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Filter Date End -->
                <div>
                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Sampai Tanggal</label>
                    <input type="text" id="end_date" name="end_date" value="<?php echo e(request('end_date')); ?>"
                            class="datepicker w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition flex-1">
                        Filter
                    </button>
                    <a href="<?php echo e(route('admin.schedules.index', ['group_id' => $group->id])); ?>"
                        class="bg-gray-100 text-gray-600 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-200 transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">

            <!-- TOOLBAR: CHECK ALL -->
            <div class="p-3 bg-gray-50 border-b border-gray-200 flex items-center gap-3">
                <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                    <input type="checkbox" id="checkAllHeader"
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="font-medium">Pilih Semua</span>
                </label>
                <div id="selectionStatus" class="text-sm text-gray-500 italic hidden">
                    <span id="selectCount">0</span> jadwal dipilih
                </div>
            </div>

            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-700 font-semibold border-b">
                    <tr>
                        <th class="w-10 px-4 py-3 text-center">
                            #
                        </th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Peserta</th>
                        <th class="px-4 py-3">Jam</th>
                        <th class="px-4 py-3">Lokasi</th>
                        <th class="px-4 py-3">Catatan</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__empty_1 = true; $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition group">
                            <td class="px-4 py-3 text-center">
                                <input type="checkbox" name="ids[]" value="<?php echo e($schedule->id); ?>"
                                    class="schedule-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900">
                                <?php echo e($schedule->date->translatedFormat('j F Y')); ?>

                                <span
                                    class="text-xs text-gray-500 block font-normal"><?php echo e($schedule->date->translatedFormat('l')); ?></span>
                            </td>
                            <td class="px-4 py-3 text-gray-900">
                                <?php echo e($schedule->user->name ?? '-'); ?>

                                <span class="text-xs text-gray-500 block"><?php echo e($schedule->user->nim ?? ''); ?></span>
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                <?php echo e(\Carbon\Carbon::parse($schedule->start_time)->format('H:i')); ?> -
                                <?php echo e(\Carbon\Carbon::parse($schedule->end_time)->format('H:i')); ?>

                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-1">
                                    <?php $__currentLoopData = $schedule->locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span
                                            class="px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                            <?php echo e($loc->name); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-500 truncate max-w-xs" title="<?php echo e($schedule->notes); ?>">
                                <?php echo e($schedule->notes ?? '-'); ?>

                            </td>
                            <td class="px-4 py-3 text-center relative">
                                <form action="<?php echo e(route('admin.schedules.destroy', $schedule)); ?>" method="POST"
                                    data-date="<?php echo e($schedule->date->translatedFormat('j F Y')); ?>"
                                    class="delete-jadwal inline-flex items-center gap-1">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <a href="<?php echo e(route('admin.schedules.edit', $schedule)); ?>"
                                        class="p-1.5 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded transition"
                                        title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button type="submit"
                                        class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded transition"
                                        title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="bi bi-calendar4-week text-3xl text-gray-300"></i>
                                    <p>Belum ada jadwal untuk kelompok ini.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($schedules->appends(request()->query())->links()); ?>

        </div>
    </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const checkAll = document.getElementById('checkAllHeader');
                const checkboxes = document.querySelectorAll('.schedule-checkbox');
                const bulkDeleteForm = document.getElementById('bulkDeleteForm');
                const bulkDeleteInputs = document.getElementById('bulkDeleteInputs');
                const selectionStatus = document.getElementById('selectionStatus');
                const selectCount = document.getElementById('selectCount');

                function updateUI() {
                    const checked = Array.from(checkboxes).filter(c => c.checked);

                    if (checked.length > 0) {
                        bulkDeleteForm.classList.remove('hidden');
                        bulkDeleteForm.classList.add('flex');
                        selectionStatus.classList.remove('hidden');
                        selectCount.textContent = checked.length;

                        // Re-render hidden inputs
                        bulkDeleteInputs.innerHTML = '';
                        checked.forEach(c => {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'ids[]';
                            input.value = c.value;
                            bulkDeleteInputs.appendChild(input);
                        });
                    } else {
                        bulkDeleteForm.classList.add('hidden');
                        bulkDeleteForm.classList.remove('flex');
                        selectionStatus.classList.add('hidden');
                    }
                }

                checkAll.addEventListener('change', function () {
                    checkboxes.forEach(c => c.checked = checkAll.checked);
                    updateUI();
                });

                checkboxes.forEach(c => {
                    c.addEventListener('change', function () {
                        const allChecked = Array.from(checkboxes).length > 0 && Array.from(checkboxes).every(c => c.checked);
                        checkAll.checked = allChecked;
                        updateUI();
                    });
                });
            });

            document.addEventListener('submit', function (e) {
                const form = e.target.closest('#bulkDeleteForm');
                if (!form) return;

                e.preventDefault();

                const selectedCount = form.querySelectorAll('#bulkDeleteInputs input[name="ids[]"]').length;

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: `${selectedCount} jadwal yang dipilih akan dihapus dan tidak bisa dikembalikan.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#dc2626', // merah
                    cancelButtonColor: '#6b7280',  // abu (opsional)
                    reverseButtons: true,
                    focusCancel: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            <?php if(session('success')): ?>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: <?php echo json_encode(session('success'), 15, 512) ?>,
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                        });
                    });
            <?php endif; ?>

            <?php if(session('error')): ?>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: <?php echo json_encode(session('error'), 15, 512) ?>,
                        });
                    });
            <?php endif; ?>
            
            document.addEventListener('submit', function (e) {
                const form = e.target.closest('.delete-jadwal');
                if (!form) return;

                e.preventDefault();

                const date = form.dataset.date || '';

                Swal.fire({
                    title: 'Hapus jadwal?',
                    text: date ? `Hapus jadwal tanggal ${date}? Data tidak bisa dikembalikan.` : 'Data tidak bisa dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    reverseButtons: true,
                    focusCancel: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

        </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\intan\Downloads\PKL\TesAbsen\resources\views/admin/schedules/detail.blade.php ENDPATH**/ ?>