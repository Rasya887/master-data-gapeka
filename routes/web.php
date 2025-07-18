<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaopController;
use App\Http\Controllers\StasiunController;
use App\Http\Controllers\JarakController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;


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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/import-jarak', [ImportController::class, 'showForm']);
    Route::post('/import-jarak', [ImportController::class, 'import'])->name('jarak.import');

    
Route::get('/import/daop', [ImportController::class, 'formDaop'])->name('import.daop.form');
Route::post('/import/daop', [ImportController::class, 'importDaop'])->name('import.daop');

    // Semua role bisa akses index (baca)
    Route::get('daop', [DaopController::class, 'index'])->name('daop.index');
    Route::get('stasiun', [StasiunController::class, 'index'])->name('stasiun.index');
    Route::get('jarak', [JarakController::class, 'index'])->name('jarak.index');

    // Hanya Admin & Editor yang bisa CRUD penuh
    Route::middleware(['role:Admin|Editor'])->group(function () {
        Route::resource('daop', DaopController::class)->except(['index']);
Route::resource('stasiun', StasiunController::class)->except(['index']);
Route::resource('jarak', JarakController::class)->except(['index']);

    });
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['role:Admin|Editor'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('menus', MenuController::class);
    });

