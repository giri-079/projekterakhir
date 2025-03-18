<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\RiwayatKelasController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/cekhash', function () {
    $user = User::where('username', 'fais')->first();
    if ($user && Hash::check('87654321', $user->password)) {
        echo "benar";
    } else {
        echo "salah";
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'level:siswa'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});


Route::middleware(['auth', 'level:siswa'])->group(function () {
    Route::get('/guru', function () {
        return view('guru.persetujuan'); // Halaman persetujuan dan riwayat kelas
    });
});


Route::middleware(['auth', 'level:siswa'])->group(function () {
    Route::get('/siswa', function () {
        return view('siswa.form_izin'); // Form izin siswa
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Menghapus deklarasi manual untuk 'siswa.index' yang sudah ada
    // Route::get('siswa',[SiswaController::class, 'index'])->name('siswa.index');
});

// Route::middleware(['auth', 'role:'])->group(function () {
//     Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');

//     //semua route dalam grup ini hanya bisa diakses siswa
// });

// Route::middleware(['auth', 'role:siswa'])->group(function () {
//     Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');

//     //semua route dalam grup ini hanya bisa diakses siswa
// });

// Menambahkan route resource untuk SiswaController
Route::get('/siswa', [SiswaController::class, 'index'])
    ->name('siswa.index')
    ->middleware('level:guru'); // Pastikan user memiliki level 'siswa'

    

Route::get('/siswa/create', [SiswaController::class, 'create'])
    ->name('siswa.create');
    // ->middleware('level:siswa');

Route::post('/siswa', [SiswaController::class, 'store'])
    ->name('siswa.store')
    ->middleware('level:siswa');

Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])
    ->name('siswa.edit')
    ->middleware('level:siswa');

Route::put('/siswa/{nisn}', [SiswaController::class, 'update'])
    ->name('siswa.update')
    ->middleware('level:siswa');

Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])
    ->name('siswa.destroy')
    ->middleware('level:siswa');


// Rute untuk Guru
Route::get('/guru', [GuruController::class, 'index'])
    ->name('guru.index')
    ->middleware('level:guru');

Route::get('/guru/create', [GuruController::class, 'create'])
    ->name('guru.create')
    ->middleware('level:guru');

Route::post('/guru', [GuruController::class, 'store'])
    ->name('guru.store')
    ->middleware('level:guru');

Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])
    ->name('guru.edit')
    ->middleware('level:guru');

Route::put('/guru/{id}', [GuruController::class, 'update'])
    ->name('guru.update')
    ->middleware('level:guru');

Route::delete('/guru/{id}', [GuruController::class, 'destroy'])
    ->name('guru.destroy')
    ->middleware('level:guru');

// Rute untuk Kelas
Route::get('/kelas', [KelasController::class, 'index'])
    ->name('kelas.index');
    // ->middleware('level:guru');

Route::get('/kelas/create', [KelasController::class, 'create'])
    ->name('kelas.create');
    // ->middleware('level:admin');

Route::post('/kelas', [KelasController::class, 'store'])
    ->name('kelas.store');
    // ->middleware('level:admin');

Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])
    ->name('kelas.edit')
    ->middleware('level:admin');

Route::put('/kelas/{id}', [KelasController::class, 'update'])
    ->name('kelas.update');
    // ->middleware('level:admin');

Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])
    ->name('kelas.destroy');
    // ->middleware('level:admin');

// Rute Tahun Ajaran
Route::get('/tahunajaran', [TahunAjaranController::class, 'index'])
    ->name('tahunajaran.index')
    ->middleware('level:admin');

Route::get('/tahunajaran/create', [TahunAjaranController::class, 'create'])
    ->name('tahunajaran.create')
    ->middleware('level:admin');

Route::post('/tahunajaran', [TahunAjaranController::class, 'store'])
    ->name('tahunajaran.store')
    ->middleware('level:admin');

Route::get('/tahunajaran/{id}/edit', [TahunAjaranController::class, 'edit'])
    ->name('tahunajaran.edit')
    ->middleware('level:admin');

Route::put('/tahunajaran/{id}', [TahunAjaranController::class, 'update'])
    ->name('tahunajaran.update')
    ->middleware('level:admin');

Route::delete('/tahunajaran/{id}', [TahunAjaranController::class, 'destroy'])
    ->name('tahunajaran.destroy')
    ->middleware('level:admin');

// Rute Riwayat Kelas (khusus Guru)
Route::get('/riwayatkelas', [RiwayatKelasController::class, 'index'])
    ->name('riwayatkelas.index')
    ->middleware('level:guru');

Route::get('/riwayatkelas/{id}', [RiwayatKelasController::class, 'show'])
    ->name('riwayatkelas.show')
    ->middleware('level:guru');

// Rute Izin (khusus Siswa & persetujuan oleh Admin)
Route::get('/izin', [IzinController::class, 'index'])
    ->name('izin.index')
    ->middleware('level:siswa');

Route::get('/izin/create', [IzinController::class, 'create'])
    ->name('izin.create')
    ->middleware('level:siswa');

Route::post('/izin', [IzinController::class, 'store'])
    ->name('izin.store')
    ->middleware('level:siswa');

Route::get('/izin/{id}/edit', [IzinController::class, 'edit'])
    ->name('izin.edit')
    ->middleware('level:siswa');

Route::put('/izin/{id}', [IzinController::class, 'update'])
    ->name('izin.update')
    ->middleware('level:admin');

Route::delete('/izin/{id}', [IzinController::class, 'destroy'])
    ->name('izin.destroy')
    ->middleware('level:admin');

// Rute User (khusus Admin)
Route::get('/user', [UserController::class, 'index'])
    ->name('user.index')
    ->middleware('level:admin');

Route::get('/user/create', [UserController::class, 'create'])
    ->name('user.create')
    ->middleware('level:admin');

Route::post('/user', [UserController::class, 'store'])
    ->name('user.store')
    ->middleware('level:admin');

Route::get('/user/{id}/edit', [UserController::class, 'edit'])
    ->name('user.edit')
    ->middleware('level:admin');

Route::put('/user/{id}', [UserController::class, 'update'])
    ->name('user.update')
    ->middleware('level:admin');

Route::delete('/user/{id}', [UserController::class, 'destroy'])
    ->name('user.destroy')
    ->middleware('level:admin');

Route::get('/user/{id}/password/edit', [UserController::class, 'editPassword'])
    ->name('user.password.edit')
    ->middleware('level:admin');

Route::post('/user/{id}/password/update', [UserController::class, 'updatePassword'])
    ->name('user.password.update')
    ->middleware('level:admin');


Route::get('/unauthorized', function () {
    return view('unauthorized');
});


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');









require __DIR__ . '/auth.php';
