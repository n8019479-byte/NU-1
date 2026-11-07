<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\JamaahController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\OrganisasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDokumentasiController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('berita', BeritaController::class);
Route::get('/', [BeritaController::class, 'index']);

Route::get('/', [BeritaController::class, 'index'])->name('berita.index');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Admin Routes (Hanya Admin yang Bisa Akses)
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});


// Route Publik
Route::get('/organisasi', [OrganisasiController::class, 'index'])->name('organisasi.index');

Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');

// Route Khusus Admin
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    // ... route berita sebelumnya ...
    Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
    Route::post('/kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');
});
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
Route::resource('kegiatan', KegiatanController::class);
Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Berita Actions
    Route::post('/berita/store', [AdminController::class, 'storeBerita'])->name('admin.berita.store');
    Route::delete('/berita/{id}', [AdminController::class, 'destroyBerita'])->name('admin.berita.destroy');
    
    // KARTANU Actions
    Route::post('/kartanu/verifikasi/{id}', [AdminController::class, 'verifikasiKartanu'])->name('admin.kartanu.verifikasi');
});
Route::resource('kegiatan', KegiatanController::class);
Route::post('/login', function (Request $request) {
    // Ambil input email dan password
    $credentials = $request->only('email', 'password');

    // Coba autentikasi bawaan Laravel
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin/dashboard');
    }

    // Jika gagal
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
});
Route::get('/anggota', [JamaahController::class, 'index'])->name('anggota.index');
Route::post('/anggota/daftar', [JamaahController::class, 'store'])->name('anggota.store');
Route::post('/anggota/cek-kta', [JamaahController::class, 'requestKta'])->name('anggota.cek');
Route::post('/anggota/request-code', [JamaahController::class, 'requestCode'])->name('anggota.request_code');
Route::post('/anggota/verify-code', [JamaahController::class, 'verifyCode'])->name('anggota.verify_code');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/jamaah/approve/{id}', [AdminController::class, 'approveJamaah'])->name('admin.jamaah.approve');
});
Route::post('/berita/{id}/apresiasi', [BeritaController::class, 'apresiasi'])->name('berita.apresiasi');
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Rute Jadwal Kegiatan
    Route::get('/jadwal/create', [App\Http\Controllers\KegiatanController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal', [App\Http\Controllers\KegiatanController::class, 'store'])->name('jadwal.store');

    // Rute Dokumentasi Kegiatan yang sebelumnya kita buat
    Route::get('/dokumentasi/create', [App\Http\Controllers\AdminDokumentasiController::class, 'create'])->name('dokumentasi.create');
    Route::post('/dokumentasi', [App\Http\Controllers\AdminDokumentasiController::class, 'store'])->name('dokumentasi.store');
    Route::delete('/dokumentasi/{id}', [App\Http\Controllers\AdminDokumentasiController::class, 'destroy'])->name('dokumentasi.destroy');
});
Route::get('/anggota/profil/{nia}', [AnggotaController::class, 'showProfile'])->name('anggota.profil');
Route::get('/admin/berita/{id}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
Route::put('/admin/berita/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');