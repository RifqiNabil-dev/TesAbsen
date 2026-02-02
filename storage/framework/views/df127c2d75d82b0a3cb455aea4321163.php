

<?php $__env->startSection('title', 'Data Peserta'); ?>

<?php $__env->startSection('content'); ?>
<div x-data="mahasiswaFilter()" class="space-y-4">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Data Peserta</h2>
        <a href="<?php echo e(route('admin.mahasiswa.create')); ?>"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
            <i class="bi bi-plus-circle"></i> Tambah Peserta
        </a>
    </div>

    <!-- SEARCH & FILTER -->
    <div class="flex flex-col md:flex-row gap-3">
        <!-- Search -->
        <input type="text"
               x-model="search"
               placeholder="Cari nama / email..."
               class="w-full md:w-1/3 rounded border border-gray-300 px-3 py-2 text-sm
                      focus:ring focus:ring-blue-200 focus:outline-none">

        <!-- Filter Kelompok -->
        <select x-model="institution"
                class="w-full md:w-1/4 rounded border border-gray-300 px-3 py-2 text-sm
                       focus:ring focus:ring-blue-200 focus:outline-none">
            <option value="">Semua Kelompok</option>
            <?php $__currentLoopData = $mahasiswa->pluck('institution')->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($inst): ?>
                    <option value="<?php echo e(strtolower($inst)); ?>"><?php echo e($inst); ?></option>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <!-- Filter Periode -->
        <select x-model="periode"
                class="w-full md:w-1/4 rounded border border-gray-300 px-3 py-2 text-sm
                       focus:ring focus:ring-blue-200 focus:outline-none">
            <option value="">Semua Periode</option>
            <option value="aktif">Sedang Magang</option>
            <option value="selesai">Sudah Selesai</option>
            <option value="belum">Belum Mulai</option>
        </select>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3 text-center">Email</th>
                    <th class="px-4 py-3 text-center">NIM</th>
                    <th class="px-4 py-3 text-center">Kelompok</th>
                    <th class="px-4 py-3 text-center">Periode</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $start = $mhs->start_date ? \Carbon\Carbon::parse($mhs->start_date) : null;
                        $end   = $mhs->end_date ? \Carbon\Carbon::parse($mhs->end_date) : null;
                    ?>

                    <tr
                        x-show="filterRow($el)"
                        x-transition
                        class="border-t hover:bg-gray-50"
                        data-name="<?php echo e(strtolower($mhs->name)); ?>"
                        data-email="<?php echo e(strtolower($mhs->email)); ?>"
                        data-institution="<?php echo e(strtolower($mhs->institution ?? '')); ?>"
                        data-start="<?php echo e($mhs->start_date); ?>"
                        data-end="<?php echo e($mhs->end_date); ?>"
                    >
                        <td class="px-4 py-3 font-medium"><?php echo e($mhs->name); ?></td>
                        <td class="px-4 py-3 text-center"><?php echo e($mhs->email); ?></td>
                        <td class="px-4 py-3 text-center"><?php echo e($mhs->nim ?? '-'); ?></td>
                        <td class="px-4 py-3 text-center"><?php echo e($mhs->institution ?? '-'); ?></td>
                        <td class="px-4 py-3 text-center">
                            <?php if($start && $end): ?>
                                <?php echo e($start->translatedFormat('j F Y')); ?> - <?php echo e($end->translatedFormat('j F Y')); ?>

                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-center space-x-1">
                            <a href="<?php echo e(route('admin.mahasiswa.show', $mhs)); ?>"
                               class="inline-block rounded bg-blue-500 px-2 py-1 text-white hover:bg-blue-600">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?php echo e(route('admin.mahasiswa.edit', $mhs)); ?>"
                               class="inline-block rounded bg-yellow-500 px-2 py-1 text-white hover:bg-yellow-600">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="<?php echo e(route('admin.mahasiswa.destroy', $mhs)); ?>"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                        class="rounded bg-red-500 px-2 py-1 text-white hover:bg-red-600">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                            Tidak ada data peserta ditemukan
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div>
        <?php echo e($mahasiswa->links()); ?>

    </div>
</div>

<script>
    function mahasiswaFilter() {
        return {
            search: '',
            institution: '',
            periode: '',

            filterRow(row) {
                const name        = row.dataset.name ?? ''
                const email       = row.dataset.email ?? ''
                const institution = row.dataset.institution ?? ''

                const start  = row.dataset.start
                const end    = row.dataset.end
                const today = new Date().toISOString().split('T')[0]

                const keyword = this.search.toLowerCase()

                const searchMatch =
                    name.includes(keyword) ||
                    email.includes(keyword)

                const institutionMatch =
                    this.institution === '' ||
                    institution === this.institution

                let periodeMatch = true

                if (this.periode === 'aktif') {
                    periodeMatch = start && end && start <= today && end >= today
                }

                if (this.periode === 'selesai') {
                    periodeMatch = end && end < today
                }

                if (this.periode === 'belum') {
                    periodeMatch = start && start > today
                }

                return searchMatch && institutionMatch && periodeMatch
            }
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/admin/mahasiswa/index.blade.php ENDPATH**/ ?>