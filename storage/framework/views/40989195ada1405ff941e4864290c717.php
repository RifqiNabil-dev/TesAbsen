

<?php $__env->startSection('title', 'Detail Kelompok'); ?>

<?php $__env->startSection('content'); ?>
<div x-data="{ openModal: false }" class="space-y-6">

    <!-- ================= HEADER DETAIL ================= -->
    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Detail Kelompok: <?php echo e($group->name); ?>

            </h2>

            <div class="flex gap-2">
                <a href="<?php echo e(route('admin.groups.edit', $group)); ?>"
                    class="rounded bg-yellow-500 px-3 py-2 text-sm font-semibold text-white hover:bg-yellow-600">
                    <i class="bi bi-pencil"></i> Edit
                </a>

                <a href="<?php echo e(route('admin.groups.index')); ?>"
                    class="rounded bg-gray-500 px-3 py-2 text-sm font-semibold text-white hover:bg-gray-600">
                    <i class="bi bi-box-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="p-6">
            <table class="w-full text-sm">
                <tr class="border-b">
                    <th class="w-40 py-2 text-left text-gray-600">Nama Kelompok</th>
                    <td class="py-2 font-medium"><?php echo e($group->name); ?></td>
                </tr>
                <tr class="border-b">
                    <th class="py-2 text-left text-gray-600">Deskripsi</th>
                    <td class="py-2"><?php echo e($group->description ?? '-'); ?></td>
                </tr>
                <tr class="border-b">
                    <th class="py-2 text-left text-gray-600">Status</th>
                    <td class="py-2">
                        <?php if($group->is_active): ?>
                            <span class="rounded bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">
                                Aktif
                            </span>
                        <?php else: ?>
                            <span class="rounded bg-gray-200 px-2 py-1 text-xs font-semibold text-gray-700">
                                Tidak Aktif
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th class="py-2 text-left text-gray-600">Jumlah Anggota</th>
                    <td class="py-2 font-semibold">
                        <?php echo e($group->users->count()); ?> orang
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- ================= ANGGOTA KELOMPOK ================= -->
    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="bi bi-people"></i> Anggota Kelompok
                <span class="ml-2 rounded bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-700">
                    <?php echo e($group->users->count()); ?> anggota
                </span>
            </h3>

            <button @click="openModal = true"
                class="rounded bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                <i class="bi bi-plus-circle"></i> Tambah Anggota
            </button>
        </div>

        <div class="p-6 overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">NIM</th>
                        <th class="px-4 py-3">Institusi</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $group->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium"><?php echo e($user->name); ?></td>
                            <td class="px-4 py-3"><?php echo e($user->email); ?></td>
                            <td class="px-4 py-3"><?php echo e($user->nim ?? '-'); ?></td>
                            <td class="px-4 py-3"><?php echo e($user->institution ?? '-'); ?></td>
                            <td class="px-4 py-3 text-center">
                            <form action="<?php echo e(route('admin.groups.remove-member', [$group, $user])); ?>"
                                method="POST"
                                class="remove"
                                data-name="<?php echo e($user->name); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button type="submit"
                                    class="rounded bg-red-500 px-2 py-1 text-xs font-semibold text-white hover:bg-red-600">
                                    <i class="bi bi-arrow-left-square"></i> Keluarkan
                                </button>
                            </form>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Belum ada anggota di kelompok ini
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= Page TAMBAH ANGGOTA ================= -->
        <template x-teleport="body">
            <div x-data="memberSearch()" x-show="openModal" x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50">

                <div @click.outside="openModal = false" class="w-full max-w-lg rounded-lg bg-white shadow-lg">
                    <!-- HEADER -->
                    <div class="flex items-center justify-between border-b px-5 py-3">
                        <h3 class="font-semibold text-gray-800">Tambah Anggota ke Kelompok</h3>
                        <button @click="openModal = false" class="text-gray-500 hover:text-gray-700">✖</button>
                    </div>

                    <!-- FORM -->
                    <form method="POST" action="<?php echo e(route('admin.groups.add-member', $group)); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="p-5 space-y-4">
                            <input type="text" x-model="search" placeholder="Cari nama / email mahasiswa..."
                                class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none">

                            <div class="max-h-64 overflow-y-auto rounded border border-gray-200">
                                <?php $__currentLoopData = $availableMahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mahasiswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div x-show="match('<?php echo e(strtolower($mahasiswa->name)); ?> <?php echo e(strtolower($mahasiswa->email)); ?>')"
                                        @click="select(<?php echo e($mahasiswa->id); ?>, '<?php echo e($mahasiswa->name); ?>')"
                                        class="cursor-pointer px-4 py-2 hover:bg-blue-50 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-800"><?php echo e($mahasiswa->name); ?></p>
                                            <p class="text-xs text-gray-500">
                                                <?php echo e($mahasiswa->email); ?>

                                                <?php if($mahasiswa->nim): ?>
                                                    • NIM: <?php echo e($mahasiswa->nim); ?>

                                                <?php endif; ?>
                                            </p>
                                        </div>
                                        <span class="text-xs text-blue-600 font-semibold">Pilih</span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <template x-if="selectedName">
                                <div class="rounded bg-blue-50 px-3 py-2 text-sm text-blue-700">
                                    Terpilih: <strong x-text="selectedName"></strong>
                                </div>
                            </template>

                            <input type="hidden" name="user_id" :value="selectedId" required>
                        </div>

                        <div class="flex justify-end gap-2 border-t px-5 py-3">
                            <button type="button" @click="openModal = false"
                                class="rounded bg-gray-500 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-600">
                                Batal
                            </button>
                            <button type="submit" :disabled="!selectedId"
                                class="rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 disabled:opacity-50">
                                Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

</div>

<script>
function memberSearch() {
    return {
        search: '',
        selectedId: null,
        selectedName: '',
        match(text) { return text.includes(this.search.toLowerCase()) },
        select(id, name) { this.selectedId = id; this.selectedName = name }
    }
}


document.addEventListener('submit', function (e) {
    const form = e.target.closest('.remove');
    if (!form) return;

    e.preventDefault();

    const name = form.dataset.name || 'anggota';

    Swal.fire({
        title: 'Yakin?',
        text: `Yakin ingin mengeluarkan ${name} dari kelompok?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, keluarkan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#dc2626',
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/groups/show.blade.php ENDPATH**/ ?>