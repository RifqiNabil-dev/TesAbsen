<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Sistem Informasi PKL'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

<!-- NAVBAR -->
<nav class="bg-blue-600 text-white"
     x-data="{ mobileOpen:false, profileOpen:false }">

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">

            <!-- LEFT : BRAND -->
            <a href="<?php echo e(auth()->user() && auth()->user()->isAdmin()
                        ? route('admin.dashboard')
                        : (auth()->user()
                            ? route('mahasiswa.dashboard')
                            : route('login'))); ?>"
               class="flex items-center gap-2 font-semibold text-lg">
                <i class="bi bi-book"></i>
                <span>E-Magang</span>
            </a>

            <!-- HAMBURGER -->
            <?php if(auth()->guard()->check()): ?>
            <button @click="mobileOpen = !mobileOpen"
                    class="md:hidden text-2xl focus:outline-none">
                <i class="bi bi-list"></i>
            </button>
            <?php endif; ?>

            <!-- MENU DESKTOP -->
            <?php if(auth()->guard()->check()): ?>
            <ul class="hidden md:flex gap-6 font-medium">
                <?php if(auth()->user()->isAdmin()): ?>
                    <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:underline">Dashboard</a></li>
                    <li><a href="<?php echo e(route('admin.mahasiswa.index')); ?>" class="hover:underline">Mahasiswa</a></li>
                    <li><a href="<?php echo e(route('admin.groups.index')); ?>" class="hover:underline">Kelompok</a></li>
                    <li><a href="<?php echo e(route('admin.schedules.index')); ?>" class="hover:underline">Jadwal</a></li>
                    <li><a href="<?php echo e(route('admin.locations.index')); ?>" class="hover:underline">Lokasi</a></li>
                    <li><a href="<?php echo e(route('admin.attendance.index')); ?>" class="hover:underline">Presensi</a></li>
                    <li><a href="<?php echo e(route('admin.logbooks.index')); ?>" class="hover:underline">Logbook</a></li>
                    <li><a href="<?php echo e(route('admin.reports.index')); ?>" class="hover:underline">Laporan</a></li>
                <?php else: ?>
                    <li><a href="<?php echo e(route('mahasiswa.dashboard')); ?>" class="hover:underline">Dashboard</a></li>
                    <li><a href="<?php echo e(route('mahasiswa.attendance.index')); ?>" class="hover:underline">Presensi</a></li>
                    <li><a href="<?php echo e(route('mahasiswa.logbooks.index')); ?>" class="hover:underline">Logbook</a></li>
                <?php endif; ?>
            </ul>
            <?php endif; ?>

            <!-- PROFILE DESKTOP -->
            <?php if(auth()->guard()->check()): ?>
            <div class="hidden md:block relative">
                <button @click="profileOpen = !profileOpen"
                        class="flex items-center gap-2 focus:outline-none">
                    <i class="bi bi-person-circle text-lg"></i>
                    <span><?php echo e(auth()->user()->name); ?></span>
                </button>

                <div x-show="profileOpen"
                     @click.outside="profileOpen=false"
                     class="absolute right-0 mt-2 w-40 bg-white text-gray-800 rounded shadow-md">
                    <a href="<?php echo e(route('profile.edit')); ?>"
                       class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- MOBILE MENU -->
        <?php if(auth()->guard()->check()): ?>
        <div x-show="mobileOpen" class="md:hidden pb-4 space-y-2">
            <?php if(auth()->user()->isAdmin()): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-2 py-1 hover:bg-blue-500 rounded">Dashboard</a>
                <a href="<?php echo e(route('admin.mahasiswa.index')); ?>" class="block px-2 py-1 hover:bg-blue-500 rounded">Mahasiswa</a>
                <a href="<?php echo e(route('admin.groups.index')); ?>" class="block px-2 py-1 hover:bg-blue-500 rounded">Kelompok</a>
                <a href="<?php echo e(route('admin.schedules.index')); ?>" class="block px-2 py-1 hover:bg-blue-500 rounded">Jadwal</a>
                <a href="<?php echo e(route('admin.locations.index')); ?>" class="block px-2 py-1 hover:bg-blue-500 rounded">Lokasi</a>
                <a href="<?php echo e(route('admin.attendance.index')); ?>" class="block px-2 py-1 hover:bg-blue-500 rounded">Presensi</a>
                <a href="<?php echo e(route('admin.logbooks.index')); ?>" class="block px-2 py-1 hover:bg-blue-500 rounded">Logbook</a>
                <a href="<?php echo e(route('admin.reports.index')); ?>" class="block px-2 py-1 hover:bg-blue-500 rounded">Laporan</a>
            <?php else: ?>
                <a href="<?php echo e(route('mahasiswa.dashboard')); ?>" class="block px-2 py-1 hover:bg-blue-500 rounded">Dashboard</a>
                <a href="<?php echo e(route('mahasiswa.attendance.index')); ?>" class="block px-2 py-1 hover:bg-blue-500 rounded">Presensi</a>
                <a href="<?php echo e(route('mahasiswa.logbooks.index')); ?>" class="block px-2 py-1 hover:bg-blue-500 rounded">Logbook</a>
            <?php endif; ?>

            <hr class="border-blue-400 my-2">

            <a href="<?php echo e(route('profile.edit')); ?>" class="block px-2 py-1 hover:bg-blue-500 rounded">Profil</a>

            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="w-full text-left px-2 py-1 hover:bg-blue-500 rounded">
                    Logout
                </button>
            </form>
        </div>
        <?php endif; ?>

    </div>
</nav>




<!-- MAIN CONTENT -->
<main class="max-w-7xl mx-auto px-4 py-6">

    <!-- SUCCESS -->
    <?php if(session('success')): ?>
        <div class="mb-4 flex items-center justify-between rounded bg-green-100 text-green-800 px-4 py-3">
            <span><?php echo e(session('success')); ?></span>
            <button onclick="this.parentElement.remove()">✕</button>
        </div>
    <?php endif; ?>

    <!-- ERROR -->
    <?php if(session('error')): ?>
        <div class="mb-4 flex items-center justify-between rounded bg-red-100 text-red-800 px-4 py-3">
            <span><?php echo e(session('error')); ?></span>
            <button onclick="this.parentElement.remove()">✕</button>
        </div>
    <?php endif; ?>

    <!-- VALIDATION ERRORS -->
    <?php if($errors->any()): ?>
        <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-3">
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
      <?php echo $__env->yieldContent('content'); ?>
</main>

    <footer class="bg-gray-100 py-4 text-center text-sm text-gray-500">
        Sistem Informasi PKL - Dinas Perpustakaan Umum dan Arsip Daerah Kota Malang
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        // Initialize Flatpickr untuk semua input dengan class datepicker (kecuali yang sudah di-initialize manual)
        document.addEventListener('DOMContentLoaded', function() {
            // Hanya initialize yang belum di-initialize
            document.querySelectorAll('.datepicker:not([data-fp-initialized])').forEach(function(el) {
                flatpickr(el, {
                    dateFormat: 'Y-m-d',
                    locale: 'id',
                    allowInput: true,
                    altInput: true,
                    altFormat: 'd/m/Y',
                    altInputClass: 'form-control',
                    disableMobile: true,
                    monthSelectorType: 'static',
                    yearSelectorType: 'static',
                    static: true
                });
                el.setAttribute('data-fp-initialized', 'true');
            });
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\Sistem_Magang\resources\views/layouts/app.blade.php ENDPATH**/ ?>