<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\RiwayatKelasController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Menghapus deklarasi manual untuk 'siswa.index' yang sudah ada
    // Route::get('siswa',[SiswaController::class, 'index'])->name('siswa.index');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    // Route::get('/guru', [GuruController::class, 'index'])->name('guru');
Route::resource('guru', GuruController::class);

 
    //semua route dalam grup ini hanya bisa diakses siswa
});


Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
 
    //semua route dalam grup ini hanya bisa diakses siswa
});

// Menambahkan route resource untuk SiswaController

Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{nisn}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');


// Menambahkan guru

// kelas
Route::resource('kelas', KelasController::class);

//tahun ajaran
Route::resource('tahunajaran', TahunAjaranController::class);

//riwayatkelas
Route::resource('riwayatkelas', RiwayatKelasController::class);

//izin
Route::resource('izin', IzinController::class);

//user
Route::resource('user', UserController::class);
Route::get('/user/{id}/password/edit', [UserController::class, 'editPassword'])->name('user.password.edit');
Route::post('/user/{id}/password/update', [UserController::class, 'updatePassword'])->name('user.password.update');










require __DIR__ . '/auth.php';
