

<?php $__env->startSection('title', 'Daftar Izin'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <h2 class="text-xl sm:text-2xl font-semibold flex items-center gap-2">
            <i class="bi bi-check2-circle text-blue-600"></i> Daftar Izin Saya
        </h2>

        <a href="<?php echo e(route('mahasiswa.permissions.create')); ?>" class="inline-flex items-center justify-center gap-2
                  bg-blue-500 hover:bg-blue-600 text-white
                  px-4 py-2 rounded-lg text-sm sm:text-base
                  w-full sm:w-auto">
            <i class="bi bi-plus-circle"></i> Ajukan izin
        </a>
    </div>

        <!-- Card -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 sm:p-6">

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-center">Jenis Izin</th>
                            <th class="border px-4 py-2 text-center">Tanggal Izin</th>
                            <th class="border px-4 py-2 text-center">Deskripsi</th>
                            <th class="border px-4 py-2 text-center">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="border px-4 py-2 text-center"><?php echo e(ucfirst($permission->type)); ?></td>
                                <td class="border px-4 py-2 text-center"><?php echo e(\Carbon\Carbon::parse($permission->date)->translatedFormat('j F Y')); ?></td>
                                <td class="border px-4 py-2 text-center"><?php echo e($permission->description); ?></td>
                                <td class="border px-4 py-2 text-center">
                                    <?php if($permission->status == 'pending'): ?>
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Pending</span>
                                    <?php elseif($permission->status == 'approved'): ?>
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Approved</span>
                                    <?php else: ?>
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Rejected</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-3 text-center">
                                        <?php if($permission->isPending()): ?>
                                            <form action="<?php echo e(route('mahasiswa.permissions.destroy', $permission)); ?>" method="POST" class="delete-permission">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white
                                                                   px-2 py-1 rounded text-xs text-center">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <?php echo e($permissions->links()); ?>

            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('submit', function (e) {
        const form = e.target.closest('.delete-permission');
        if (!form) return;

        e.preventDefault();

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data izin yang dihapus tidak bisa dikembalikan.',
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

    <?php if(session('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?php echo e(session('success')); ?>',
            confirmButtonColor: '#2563eb'
        });
    <?php endif; ?>

    <?php if(session('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?php echo e(session('error')); ?>',
            confirmButtonColor: '#dc2626'
        });
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/mahasiswa/permissions/index.blade.php ENDPATH**/ ?>