<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::prefix('players')->name('players.')->controller(PlayerController::class)->group(function () {
       Route::get('/', 'index')->name('index');
       Route::post('/', 'store')->name('store');
       Route::patch('/{player}', 'update')->name('update');
       Route::delete('/{player}', 'destroy')->name('destroy');
    });

    Route::post('/player/{player}/deposit', [PlayerController::class, 'deposit'])->name('player.deposit');
    Route::get('/player/{player}/history', [PlayerController::class, 'history'])->name('player.history');
    Route::post('/player/{player}/product/{product}', [ProductController::class, 'buyProduct'])->name('buyProduct');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
