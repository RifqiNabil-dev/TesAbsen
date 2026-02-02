<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendance;
use App\Http\Controllers\Admin\LogbookController as AdminLogbook;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\DivisionController;

use App\Http\Controllers\Mahasiswa\PermissionMahasiswaController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;
use App\Http\Controllers\Mahasiswa\AttendanceController as MahasiswaAttendance;
use App\Http\Controllers\Mahasiswa\LogbookController as MahasiswaLogbook;
use App\Http\Controllers\Mahasiswa\ScheduleController as MahasiswaSchedule;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('users', UserController::class)->only(['index', 'edit', 'update', 'destroy']);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::get('schedules/print', [ScheduleController::class, 'print'])->name('schedules.print');
    Route::delete('schedules/bulk-destroy', [ScheduleController::class, 'bulkDestroy'])->name('schedules.bulk-destroy');
    Route::resource('schedules', ScheduleController::class);

    Route::resource('locations', LocationController::class);
    Route::resource('groups', GroupController::class);
    Route::post('/groups/{group}/members', [GroupController::class, 'addMember'])->name('groups.add-member');
    Route::delete('/groups/{group}/members/{user}', [GroupController::class, 'removeMember'])->name('groups.remove-member');

    Route::get('/divisions', [DivisionController::class, 'index'])->name('divisions.index');
    Route::resource('divisions', DivisionController::class);

    Route::get('/attendance', [AdminAttendance::class, 'index'])->name('attendance.index');
    Route::get('/attendance/{attendance}', [AdminAttendance::class, 'show'])->name('attendance.show');
    Route::put('/attendance/{attendance}/update-status', [AdminAttendance::class, 'updateStatus'])->name('attendance.updateStatus');


    Route::get('/logbooks', [AdminLogbook::class, 'index'])->name('logbooks.index');
    Route::get('/logbooks/{logbook}', [AdminLogbook::class, 'show'])->name('logbooks.show');
    Route::patch('/logbooks/{logbook}/approve', [AdminLogbook::class, 'approve'])->name('logbooks.approve');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{user}', [ReportController::class, 'show'])->name('reports.show');
    Route::post('/reports/{user}/assessment', [ReportController::class, 'storeAssessment'])->name('reports.assessment');
    Route::get('/reports/{user}/edit', [ReportController::class, 'edit'])->name('reports.edit');
    Route::put('/reports/{user}', [ReportController::class, 'update'])->name('reports.update');

});

// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaDashboard::class, 'index'])->name('dashboard');

    Route::get('/attendance', [MahasiswaAttendance::class, 'index'])->name('attendance.index');
    Route::post('/attendance/checkin', [MahasiswaAttendance::class, 'checkin'])->name('attendance.checkin');
    Route::post('/attendance/checkout', [MahasiswaAttendance::class, 'checkout'])->name('attendance.checkout');

    Route::resource('logbooks', MahasiswaLogbook::class);
    Route::get('/schedules', [MahasiswaSchedule::class, 'index'])->name('schedules.index');
    Route::get('/locations', [App\Http\Controllers\Mahasiswa\LocationController::class, 'index'])->name('locations.index');

});

require __DIR__ . '/auth.php';

