

<?php $__env->startSection('title', 'User'); ?>

<?php $__env->startSection('content'); ?>

<div x-data="userFilter()">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <h2 class="text-xl sm:text-2xl font-semibold flex items-center gap-2">
            <i class="bi bi-people"></i> Daftar Role User
        </h2>
    </div>

    <!-- SEARCH -->
    <div class="mb-4">
        <div class="relative">
            <input type="text"
                   x-model="search"
                   placeholder="Cari nama / email..."
                   class="w-full sm:w-1/3 rounded-lg border border-gray-300 pr-4 py-2 pl-10
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
        </div>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-lg border shadow">
        <div class="p-4 sm:p-6">

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-center">Email</th>
                            <th class="p-3 text-center">Role</th>
                            <th class="p-3 text-center">Tanggal Dibuat</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr
                                x-show="filterRow($el)"
                                x-transition
                                class="hover:bg-gray-50"
                                data-name="<?php echo e(strtolower($user->name)); ?>"
                                data-email="<?php echo e(strtolower($user->email)); ?>"
                            >
                                <td class="p-3 font-medium">
                                    <?php echo e($user->name); ?>

                                </td>

                                <td class="p-3 text-center">
                                    <?php echo e($user->email); ?>

                                </td>

                                <td class="p-3 text-center">
                                    <?php if($user->role === 'admin'): ?>
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-semibold">
                                            Admin
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold">
                                            Mahasiswa
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="p-3 text-gray-600 text-center">
                                    <?php echo e($user->created_at->format('d/m/Y')); ?>

                                </td>

                                <!-- Aksi -->
                                <td class="p-3 text-center">
                                    <div class="flex justify-center gap-2">

                                        <!-- Manage -->
                                        <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>"
                                           class="inline-flex items-center gap-1
                                                  bg-blue-600 hover:bg-blue-700
                                                  text-white text-xs font-semibold
                                                  px-3 py-2 rounded">
                                            <i class="bi bi-gear"></i>
                                            Manage
                                        </a>

                                        <!-- Delete -->
                                        <?php if($user->role !== 'admin'): ?>
                                            <form method="POST"
                                                  action="<?php echo e(route('admin.users.destroy', $user->id)); ?>"
                                                  class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>

                                                <button type="button"
                                                        onclick="confirmDelete(this)"
                                                        class="inline-flex items-center gap-1
                                                               bg-red-600 hover:bg-red-700
                                                               text-white text-xs font-semibold
                                                               px-3 py-2 rounded">
                                                    <i class="bi bi-trash"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-500">
                                    Tidak ada data user
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <?php echo e($users->links()); ?>

            </div>

        </div>
    </div>
</div>

<script>
    function userFilter() {
        return {
            search: '',

            filterRow(row) {
                const name  = row.dataset.name ?? ''
                const email = row.dataset.email ?? ''

                const keyword = this.search.toLowerCase()

                return (
                    name.includes(keyword) ||
                    email.includes(keyword)
                )
            }
        }
    }

    function confirmDelete(button) {
        const form = button.closest('form');

        Swal.fire({
            title: 'Hapus User?',
            text: 'Data user akan dihapus secara permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    // Alert Sukses
    <?php if(session('alert') === 'success'): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'User berhasil dihapus.',
            confirmButtonColor: '#2563eb'
        });
    <?php endif; ?>

    // Alert Gagal
    <?php if(session('alert') === 'error'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Admin tidak dapat dihapus.',
            confirmButtonColor: '#dc2626'
        });
    <?php endif; ?>
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/users/index.blade.php ENDPATH**/ ?>