<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'SIM (Sistem Informasi Magang) Dispussipda Malang'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="bg-gray-50 text-gray-900 font-sans antialiased">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 transition-all duration-300"
        x-data="{ mobileOpen:false, profileOpen:false }">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- LEFT : BRAND -->
                <a href="<?php echo e(auth()->user() && auth()->user()->isAdmin() ? route('admin.dashboard') : (auth()->user()
                        ? route('mahasiswa.dashboard') : route('login'))); ?>" class="flex items-center gap-3">
                    <img src="<?php echo e(asset('img/logo_instansi.png')); ?>" alt="Logo Instansi"
                        class="h-12 w-auto object-contain">
                </a>

                <!-- HAMBURGER -->
                <?php if(auth()->guard()->check()): ?>
                    <button @click="mobileOpen = !mobileOpen"
                        class="md:hidden text-2xl text-gray-600 focus:outline-none hover:text-blue-600 transition">
                        <i class="bi bi-list"></i>
                    </button>
                <?php endif; ?>

                <!-- MENU DESKTOP -->
                <?php if(auth()->guard()->check()): ?>
                    <ul class="hidden md:flex gap-8 text-sm font-medium text-gray-600">
                        <?php if(auth()->user()->isAdmin()): ?>
                            <li><a href="<?php echo e(route('admin.dashboard')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('admin.dashboard') ? 'text-blue-600' : ''); ?>">Dashboard</a>
                            </li>
                            <li><a href="<?php echo e(route('admin.mahasiswa.index')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('admin.mahasiswa.*') ? 'text-blue-600' : ''); ?>">Peserta</a>
                            </li>
                            <li><a href="<?php echo e(route('admin.groups.index')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('admin.groups.*') ? 'text-blue-600' : ''); ?>">Kelompok</a>
                            </li>
                            <li><a href="<?php echo e(route('admin.schedules.index')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('admin.schedules.*') ? 'text-blue-600' : ''); ?>">Jadwal</a>
                            </li>
                            <li><a href="<?php echo e(route('admin.locations.index')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('admin.locations.*') ? 'text-blue-600' : ''); ?>">Lokasi</a>
                            </li>
                            <li><a href="<?php echo e(route('admin.attendance.index')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('admin.attendance.*') ? 'text-blue-600' : ''); ?>">Presensi</a>
                            </li>
                            <li><a href="<?php echo e(route('admin.logbooks.index')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('admin.logbooks.*') ? 'text-blue-600' : ''); ?>">Logbook</a>
                            </li>
                            <li><a href="<?php echo e(route('admin.reports.index')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('admin.reports.*') ? 'text-blue-600' : ''); ?>">Laporan</a>
                            </li>
                            <li><a href="<?php echo e(route('admin.users.index')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('admin.users.index') ? 'text-blue-600' : ''); ?>">User Role</a>
                            </li>
                        <?php else: ?>
                            <li><a href="<?php echo e(route('mahasiswa.dashboard')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('mahasiswa.dashboard') ? 'text-blue-600' : ''); ?>">Dashboard</a>
                            </li>
                            <li><a href="<?php echo e(route('mahasiswa.attendance.index')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('mahasiswa.attendance.*') ? 'text-blue-600' : ''); ?>">Presensi</a>
                            </li>
                            <li><a href="<?php echo e(route('mahasiswa.logbooks.index')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('mahasiswa.logbooks.*') ? 'text-blue-600' : ''); ?>">Logbook</a>
                            </li>
                            <li><a href="<?php echo e(route('mahasiswa.schedules.index')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('mahasiswa.schedules.*') ? 'text-blue-600' : ''); ?>">Jadwal</a>
                            </li>
                            <li><a href="<?php echo e(route('mahasiswa.locations.index')); ?>"
                                    class="hover:text-blue-600 transition <?php echo e(request()->routeIs('mahasiswa.locations.*') ? 'text-blue-600' : ''); ?>">Informasi
                                    Lokasi</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>

                <!-- PROFILE DESKTOP -->
                <?php if(auth()->guard()->check()): ?>
                    <div class="hidden md:block relative">
                        <button @click="profileOpen = !profileOpen"
                            class="flex items-center gap-2 focus:outline-none text-gray-700 hover:text-blue-600 transition">
                            <span class="font-medium text-sm"><?php echo e(auth()->user()->name); ?></span>
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        </button>

                        <div x-show="profileOpen" @click.outside="profileOpen=false" x-cloak
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg border border-gray-100 py-1 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs text-gray-500">Signed in as</p>
                                <p class="text-sm font-semibold truncate"><?php echo e(auth()->user()->email); ?></p>
                            </div>
                            <a href="<?php echo e(route('profile.edit')); ?>"
                                class="block px-4 py-2 text-sm hover:bg-gray-50 transition flex items-center gap-2">
                                <i class="bi bi-person-gear"></i> Profil
                            </a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition flex items-center gap-2">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- MOBILE MENU -->
            <?php if(auth()->guard()->check()): ?>
                <div x-show="mobileOpen" x-cloak x-transition class="md:hidden pb-4 space-y-1">
                    <div class="pt-2 pb-3 space-y-1">
                        <?php if(auth()->user()->isAdmin()): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Dashboard</a>
                            <a href="<?php echo e(route('admin.mahasiswa.index')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Peserta</a>
                            <a href="<?php echo e(route('admin.groups.index')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Kelompok</a>
                            <a href="<?php echo e(route('admin.schedules.index')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Jadwal</a>
                            <a href="<?php echo e(route('admin.locations.index')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Lokasi</a>
                            <a href="<?php echo e(route('admin.attendance.index')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Presensi</a>
                            <a href="<?php echo e(route('admin.logbooks.index')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Logbook</a>
                            <a href="<?php echo e(route('admin.reports.index')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Laporan</a>
                            <a href="<?php echo e(route('admin.users.index')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">User Role</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('mahasiswa.dashboard')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Dashboard</a>
                            <a href="<?php echo e(route('mahasiswa.attendance.index')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Presensi</a>
                            <a href="<?php echo e(route('mahasiswa.logbooks.index')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Logbook</a>
                            <a href="<?php echo e(route('mahasiswa.schedules.index')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Jadwal</a>
                            <a href="<?php echo e(route('mahasiswa.locations.index')); ?>"
                                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Informasi
                                Lokasi</a>
                        <?php endif; ?>
                    </div>

                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                    <i class="bi bi-person-fill text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800"><?php echo e(auth()->user()->name); ?></div>
                                <div class="text-sm font-medium text-gray-500"><?php echo e(auth()->user()->email); ?></div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <a href="<?php echo e(route('profile.edit')); ?>"
                                class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Profil</a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button
                                    class="w-full text-left block px-4 py-2 text-base font-medium text-red-600 hover:text-red-800 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- VALIDATION ERRORS -->
        <?php if($errors->any()): ?>
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 shadow-sm">
                <div class="flex items-center gap-2 font-semibold mb-2">
                    <i class="bi bi-x-circle-fill text-red-500"></i>
                    Terdapat Kesalahan:
                </div>
                <ul class="list-disc list-inside space-y-1 text-sm">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-white border-t border-gray-200 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-gray-500">
                &copy; <?php echo e(date('Y')); ?> SIM (Sistem Informasi Magang) Dispussipda Malang
            </p>
        </div>
    </footer>



    <script>

        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.datepicker:not([data-fp-initialized])').forEach(function (el) {
                flatpickr(el, {
                    dateFormat: 'Y-m-d',
                    locale: 'id',
                    allowInput: true,
                    altInput: true,
                    altFormat: 'd-m-Y',
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

</html><?php /**PATH C:\Users\intan\Downloads\PKL\TesAbsen\resources\views/layouts/app.blade.php ENDPATH**/ ?>