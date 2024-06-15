<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ToApiKosController;
use App\Http\Controllers\UploadKosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['guest'])->group(function () {
    Route::get('/', [LandingController::class, 'landing']);
    Route::get('/index', [LandingController::class, 'landing'])->name('landing');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login/auth', [AuthController::class, 'login_proses'])->name('login-proses');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register/auth', [AuthController::class, 'register_proses'])->name('register-proses');
    Route::get('/search', [ToApiKosController::class, 'index_kos'])->name('search');
    Route::get('/kos/{id}', [ToApiKosController::class, 'show'])->name('kos.show');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', [BerandaController::class, 'beranda'])->name('beranda');
    Route::get('/upload-kos', [UploadKosController::class, 'upload_kos'])->name('upload-kos');
    Route::post('/upload-kos/store', [ToApiKosController::class, 'store'])->name('upload-kos-proses1');
    Route::post('/upload-kos/store', [ToApiKosController::class, 'store_kos'])->name('upload-kos-proses');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profil');
    Route::post('/profile/upload-picture', [ProfileController::class, 'uploadPicture'])->name('profile.uploadPicture');
    Route::get('/kosi/{id}', [ToApiKosController::class, 'show_login'])->name('kos.show_login');
    Route::get('/searching', [ToApiKosController::class, 'index_kos_login'])->name('search-login');
    
    Route::get('/produk-kos', [ToApiKosController::class, 'produk_kos'])->name('produk-kos');
    Route::get('/produk-kos-update/{id}', [ToApiKosController::class, 'produk_kos_update'])->name('produk-kos-update');
    Route::put('/produk-kos-update/{id}', [ToApiKosController::class, 'update'])->name('produk-kos-update-proses1');
    Route::put('/produk-kos-update/{id}', [ToApiKosController::class, 'update_kos'])->name('produk-kos-update-proses');
    
    Route::delete('/produk-kos-update/{id}', [ToApiKosController::class, 'update'])->name('produk-kos-destroy');


    Route::get('/keluar', [AuthController::class, 'keluar'])->name('logout');
});