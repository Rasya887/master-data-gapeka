<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ExportController;

// Auth
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Master Data
use App\Http\Controllers\DaopController;
use App\Http\Controllers\StasiunController;
use App\Http\Controllers\JarakController;

// RBAC
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;

use App\Models\Stasiun;
use App\Models\Jarak;
use App\Models\Daop;


/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard dengan data
    Route::get('/dashboard', function () {
        // Ambil jumlah data
        $totalStasiun = Stasiun::count();
        $totalJarak = Jarak::count();

        // Contoh grouping data jarak per daop
        $jarakPerDaop = Jarak::selectRaw('id_daop, COUNT(*) as total')
            ->groupBy('id_daop')
            ->with('daop:id,nama') // relasi daop kalau ada
            ->get();

        // Contoh grouping stasiun per daop
        $stasiunPerDaop = Stasiun::selectRaw('id_daop, COUNT(*) as total')
            ->groupBy('id_daop')
            ->with('daop:id,nama')
            ->get();

        return Inertia::render('Dashboard', [
            'totalStasiun' => $totalStasiun,
            'totalJarak'   => $totalJarak,
            'jarakPerDaop' => $jarakPerDaop,
            'stasiunPerDaop' => $stasiunPerDaop,
        ]);
    })->name('dashboard');


    // View-only for all roles
    Route::get('/daops', [DaopController::class, 'index'])->name('daops.index');
    Route::get('/stasiuns', [StasiunController::class, 'index'])->name('stasiuns.index');
    Route::get('/jarak', [JarakController::class, 'index'])->name('jarak.index');

});

/*
|--------------------------------------------------------------------------
| Admin Only Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Master Data CRUD
    Route::resource('daops', DaopController::class)->except(['index', 'show']);
    Route::get('/daops/{id}/show', [DaopController::class, 'show'])->name('daops.show');
    Route::resource('stasiuns', StasiunController::class)->except(['index', 'show']);
    Route::get('/stasiuns/{id}/show', [StasiunController::class, 'show'])->name('stasiuns.show');
    Route::resource('jarak', JarakController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/jarak/{id}/show', [JarakController::class, 'show'])->name('jarak.show');

    // RBAC Management
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('menus', MenuController::class)->except(['show']);
});

Route::get('/export', function () {
    return Inertia::render('Export/Index');
})->name('export.index');

// Route export action
Route::get('/export/daop/excel', [ExportController::class, 'exportDaopExcel']);
Route::get('/export/daop/pdf', [ExportController::class, 'exportDaopPdf']);
Route::get('/export/stasiun/excel', [ExportController::class, 'exportStasiunExcel']);
Route::get('/export/stasiun/pdf', [ExportController::class, 'exportStasiunPdf']);
Route::get('/export/jarak/excel', [ExportController::class, 'exportJarakExcel']);
Route::get('/export/jarak/pdf', [ExportController::class, 'exportJarakPdf']);