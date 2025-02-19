<?php

use App\Http\Controllers\DBItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpawnProductsCostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    Route::prefix('minecraft-db')->name('minecraft-db.')->controller(DBItemController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::patch('/{DBItem}', 'update')->name('update');
        Route::delete('/{DBItem}', 'destroy')->name('destroy');
    });

    Route::prefix('products-cost')->name('products-cost.')->controller(SpawnProductsCostController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::patch('/{ProductCost}', 'update')->name('update');
        Route::delete('/{ProductCost}', 'destroy')->name('destroy');
    });

});

require __DIR__.'/auth.php';
