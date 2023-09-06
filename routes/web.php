<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Sampah_dataController;
use App\Http\Controllers\Admin\Sampah_kategoriController;
use App\Http\Controllers\DashboardController;

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

Route::get('/admin', [AuthController::class, 'index'])->middleware('guest');
Route::post('/admin', [AuthController::class, 'login'])->name('login');
Route::post('/admin/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [Sampah_dataController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/create', [Sampah_dataController::class, 'create'])->name('admin.data.create');
    Route::post('/admin/create', [Sampah_dataController::class, 'store'])->name('admin.data.store');
    Route::get('/admin/update/{id}', [Sampah_dataController::class, 'edit'])->name('admin.data.update');
    Route::put('/admin/update/{id}', [Sampah_dataController::class, 'update'])->name('admin.data.update');
    Route::delete('/admin/delete/{id}', [Sampah_dataController::class, 'destroy'])->name('admin.data.delete');

    Route::get('/admin/kategori', [Sampah_kategoriController::class, 'index'])->name('admin.kategori');
    Route::get('/admin/kategori/create', [Sampah_kategoriController::class, 'create'])->name('admin.kategori.create');
    Route::post('/admin/kategori/create', [Sampah_kategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/admin/kategori/update/{id}', [Sampah_kategoriController::class, 'edit'])->name('admin.kategori.update');
    Route::put('/admin/kategori/update/{id}', [Sampah_kategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/admin/kategori/delete/{id}', [Sampah_kategoriController::class, 'destroy'])->name('admin.kategori.delete');

    // Route::get('/admin/content/create', [ContentsController::class, 'create'])->name('admin.content.create');
    // Route::post('/admin/content/create', [ContentsController::class, 'store'])->name('admin.content.store');
    // Route::get('/admin/content/edit/{id}', [ContentsController::class, 'edit'])->name('admin.content.edit');
    // Route::put('/admin/content/edit/{id}', [ContentsController::class, 'edit'])->name('admin.content.update');
    // Route::delete('/admin/content/delete/{id}', [ContentsController::class, 'destroy'])->name('admin.content.delete');
    
});

/*public*/
Route::get('/', [DashboardController::class, 'index']);
Route::get('/sampah', [DashboardController::class, 'data_sampah'])->name('sampah');