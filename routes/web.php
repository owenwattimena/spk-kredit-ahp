<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatrixController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\SubKriteriaController;

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
Route::middleware(['guest'])->group(function () { 
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware(['auth'])->group(function () { 
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [UserController::class, 'index'])->name('profil');
    Route::put('/profil', [UserController::class, 'update'])->name('profil.update');
    Route::put('/password', [UserController::class, 'password'])->name('profil.password');
    
    Route::prefix('ahp')->group(function () {
        Route::prefix('kriteria')->group(function () {
            Route::get('/', [KriteriaController::class, 'index'])->name('ahp.kriteria');
            Route::get('/tambah', [KriteriaController::class, 'tambah'])->name('ahp.kriteria.tambah');
            Route::post('/tambah', [KriteriaController::class, 'post'])->name('ahp.kriteria.post');
            Route::get('/{id}/ubah', [KriteriaController::class, 'ubah'])->name('ahp.kriteria.ubah');
            Route::put('/{id}/ubah', [KriteriaController::class, 'put'])->name('ahp.kriteria.put');
            Route::delete('/{id}/hapus', [KriteriaController::class, 'delete'])->name('ahp.kriteria.hapus');
        });
        
        Route::prefix('subkriteria')->group(function () {
            Route::get('/', [SubKriteriaController::class, 'index'])->name('ahp.subkriteria');
            Route::get('/tambah', [SubKriteriaController::class, 'tambah'])->name('ahp.subkriteria.tambah');
            Route::post('/tambah', [SubKriteriaController::class, 'post'])->name('ahp.subkriteria.post');
            Route::get('/{id}/ubah', [SubKriteriaController::class, 'ubah'])->name('ahp.subkriteria.ubah');
            Route::put('/{id}/ubah', [SubKriteriaController::class, 'put'])->name('ahp.subkriteria.put');
            Route::delete('/{id}/hapus', [SubKriteriaController::class, 'delete'])->name('ahp.subkriteria.hapus');
        });
        
        Route::prefix('alternatif')->group(function () {
            Route::get('/', [AlternatifController::class, 'index'])->name('ahp.alternatif');
            Route::get('/{id}/pengajuan', [AlternatifController::class, 'pengajuan'])->name('ahp.alternatif.pengajuan');
            Route::post('/{id}/pengajuan', [AlternatifController::class, 'postPengajuan'])->name('ahp.alternatif.pengajuan.post');
            Route::get('/tambah', [AlternatifController::class, 'tambah'])->name('ahp.alternatif.tambah');
            Route::post('/tambah', [AlternatifController::class, 'post'])->name('ahp.alternatif.post');
            Route::get('/{id}/ubah', [AlternatifController::class, 'ubah'])->name('ahp.alternatif.ubah');
            Route::put('/{id}/ubah', [AlternatifController::class, 'put'])->name('ahp.alternatif.put');
            Route::delete('/{id}/hapus', [AlternatifController::class, 'delete'])->name('ahp.alternatif.hapus');
        });
        
        Route::prefix('matrix')->group(function () {
            Route::get('/', [MatrixController::class, 'index'])->name('ahp.matrix');
            Route::post('/', [MatrixController::class, 'post'])->name('ahp.matrix.post');
        });
        Route::prefix('ranking')->group(function () {
            Route::get('/', [RankingController::class, 'index'])->name('ahp.ranking');
        });
    });
});