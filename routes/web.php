<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PengajuanJudulController as AdminPengajuanJudulController;
use App\Http\Controllers\Admin\LaporanBimbinganController;


use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\PengajuanJudulController as MahasiswaPengajuanJudulController;

use App\Http\Controllers\Dosen\DashboardController as DosenDashboardController;
use App\Http\Controllers\Dosen\PengajuanJudulController as DosenPengajuanJudulController;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Mahasiswa\BimbinganController as MahasiswaBimbinganController;
use App\Http\Controllers\Dosen\BimbinganController as DosenBimbinganController;

use App\Http\Controllers\FileSkripsiController;

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Redirect Dashboard Berdasarkan Role
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'dosen') {
        return redirect()->route('dosen.dashboard');
    }

    if ($user->role === 'mahasiswa') {
        return redirect()->route('mahasiswa.dashboard');
    }

    abort(403, 'Role user tidak dikenali.');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Route Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/pengajuan-judul', [AdminPengajuanJudulController::class, 'index'])
            ->name('pengajuan-judul.index');

        Route::get('/pengajuan-judul/{id}/edit', [AdminPengajuanJudulController::class, 'edit'])
            ->name('pengajuan-judul.edit');

        Route::put('/pengajuan-judul/{id}', [AdminPengajuanJudulController::class, 'update'])
            ->name('pengajuan-judul.update');

        Route::get('/laporan-bimbingan', [LaporanBimbinganController::class, 'index'])
            ->name('laporan-bimbingan.index');

        Route::get('/laporan-bimbingan/export-pdf', [LaporanBimbinganController::class, 'exportPdf'])
            ->name('laporan-bimbingan.export-pdf');
    });

/*
|--------------------------------------------------------------------------
| Route Mahasiswa
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:mahasiswa'])
    ->prefix('mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {
        Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/pengajuan-judul', [MahasiswaPengajuanJudulController::class, 'index'])
            ->name('pengajuan-judul.index');

        Route::get('/pengajuan-judul/create', [MahasiswaPengajuanJudulController::class, 'create'])
            ->name('pengajuan-judul.create');

        Route::post('/pengajuan-judul', [MahasiswaPengajuanJudulController::class, 'store'])
            ->name('pengajuan-judul.store');

        Route::get('/bimbingan', [MahasiswaBimbinganController::class, 'index'])
            ->name('bimbingan.index');

        Route::get('/bimbingan/create', [MahasiswaBimbinganController::class, 'create'])
            ->name('bimbingan.create');

        Route::post('/bimbingan', [MahasiswaBimbinganController::class, 'store'])
            ->name('bimbingan.store');

        Route::get('/bimbingan/{id}', [MahasiswaBimbinganController::class, 'show'])
            ->name('bimbingan.show');
    });

/*
|--------------------------------------------------------------------------
| Route Dosen
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:dosen'])
    ->prefix('dosen')
    ->name('dosen.')
    ->group(function () {
        Route::get('/dashboard', [DosenDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/pengajuan-judul', [DosenPengajuanJudulController::class, 'index'])
            ->name('pengajuan-judul.index');

        Route::put('/pengajuan-judul/{id}/status', [DosenPengajuanJudulController::class, 'updateStatus'])
            ->name('pengajuan-judul.status');

        Route::get('/bimbingan', [DosenBimbinganController::class, 'index'])
            ->name('bimbingan.index');

        Route::get('/bimbingan/{id}', [DosenBimbinganController::class, 'show'])
            ->name('bimbingan.show');

        Route::put('/bimbingan/{id}', [DosenBimbinganController::class, 'update'])
            ->name('bimbingan.update');
    });

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/file-skripsi/{id}/lihat', [FileSkripsiController::class, 'lihat'])
        ->name('file-skripsi.lihat');
});

require __DIR__.'/auth.php';