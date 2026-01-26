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
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo e(auth()->user() && auth()->user()->isAdmin() ? route('admin.dashboard') : (auth()->user() ? route('mahasiswa.dashboard') : route('login'))); ?>">
                <i class="bi bi-book"></i> Sistem PKL
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php if(auth()->guard()->check()): ?>
                <ul class="navbar-nav me-auto">
                    <?php if(auth()->user()->isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('admin.mahasiswa.index')); ?>">Mahasiswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('admin.groups.index')); ?>">Kelompok</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('admin.schedules.index')); ?>">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('admin.locations.index')); ?>">Lokasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('admin.attendance.index')); ?>">Presensi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('admin.logbooks.index')); ?>">Logbook</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('admin.reports.index')); ?>">Laporan</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('mahasiswa.dashboard')); ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('mahasiswa.attendance.index')); ?>">Presensi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('mahasiswa.logbooks.index')); ?>">Logbook</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?php echo e(auth()->user()->name); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="container-fluid py-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-light text-center py-3 mt-5">
        <div class="container">
            <small class="text-muted">Sistem Informasi PKL - Dinas Perpustakaan Umum dan Arsip Daerah Kota Malang</small>
        </div>
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
</body>
</html>

<?php /**PATH C:\xampp\htdocs\Sistem_Magang\resources\views/layouts/app.blade.php ENDPATH**/ ?>