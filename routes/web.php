<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'regist'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('berita-user', [BeritaController::class, 'berita_page'])->name('berita-user');
Route::get('berita-user/{id}', [BeritaController::class, 'isi_berita'])->name('berita-user.show');
Route::get('diskusi', [ForumController::class, 'forum_page'])->name('diskusi');

Route::middleware(['isuser'])->group(function () {
    Route::get('/profile-user', [ProfileController::class, 'index'])->name('profile-user');
    Route::put('/profile-user', [ProfileController::class, 'update_user'])->name('profile-user.update');
    Route::put('/profile-user/password', [ProfileController::class, 'updatePassword'])->name('profile-user.password');

    Route::get('laporan-user', [LaporanController::class, 'laporan_page'])->name('laporan-user');
    Route::post('/laporan-user', [LaporanController::class, 'store'])->name('laporan-user.store');

    Route::get('/riwayat-user', [LaporanController::class, 'riwayat'])->name('riwayat-user');
    Route::get(('/ubah-password'), [AuthController::class, 'change'])->name('ubah-password');

    Route::get('/forum/{id}', [ForumController::class, 'isi_forum'])->name('forum.show');
    Route::post('/forum/{id}', [ForumController::class, 'chat'])->name('forum.reply');
});

Route::middleware(['isadmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('users', [DashboardController::class, 'users'])->name('users');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('berita', [DashboardController::class, 'berita'])->name('berita');
    Route::post('berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::put('berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');


    Route::get('laporan', [DashboardController::class, 'laporan'])->name('laporan');
    Route::put('/laporan/{id}/status', [LaporanController::class, 'updateStatus'])->name('admin.laporan.updateStatus');
    Route::delete('/laporan/{id}', [LaporanController::class, 'delete'])->name('admin.laporan.delete');


    Route::get('forum', [DashboardController::class, 'forum'])->name('forum');
    Route::put('/forum/{id}/status', [ForumController::class, 'update'])->name('forum.update');
    Route::delete('/forum/{id}', [ForumController::class, 'destroy'])->name('forum.destroy');
});
    Route::post('forum', [ForumController::class, 'store'])->name('forum.store');
