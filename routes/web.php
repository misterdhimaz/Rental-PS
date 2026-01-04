<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| ALIA RENTAL PS PRO - MASTER SYSTEM ROUTES
|--------------------------------------------------------------------------
*/

// [1] HALAMAN PUBLIK
Route::get('/', [ConsoleController::class, 'index'])->name('home');
Route::get('/console/{slug}', [ConsoleController::class, 'show'])->name('console.show');


// [2] HALAMAN KHUSUS USER (AUTH & VERIFIED)
Route::middleware(['auth', 'verified'])->group(function () {

    // Smart Dashboard Redirect
    Route::get('/dashboard', function () {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return app(DashboardController::class)->index();
    })->name('dashboard');

    // Booking Action
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

    // Profile Management (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// [3] HALAMAN KHUSUS ADMIN (FULL COMMAND CENTER)
// Perhatikan: prefix('admin') sudah otomatis menambah /admin/ di depan rute
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard & Booking Status
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/booking/{id}/status', [AdminController::class, 'updateStatus'])->name('booking.status');

    // CRUD UNIT CONSOLE (Inventory)
    Route::get('/consoles', [AdminController::class, 'manageConsoles'])->name('consoles.index');
    Route::post('/consoles/store', [AdminController::class, 'storeConsole'])->name('consoles.store');
    Route::put('/consoles/{id}/update', [AdminController::class, 'updateConsole'])->name('consoles.update');
    Route::delete('/consoles/{id}/delete', [AdminController::class, 'deleteConsole'])->name('consoles.delete');

    // CRUD KATEGORI
    Route::get('/categories', [AdminController::class, 'manageCategories'])->name('categories.index');
    Route::post('/categories/store', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{id}/update', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{id}/delete', [AdminController::class, 'deleteCategory'])->name('categories.delete');

    // Laporan Keuangan
    Route::get('/reports', [AdminController::class, 'revenueReport'])->name('reports.index');
});


// [4] AUTH PROTOCOL (BREEZE)
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}
