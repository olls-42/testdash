<?php

use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::get('/', function () {
    return Inertia::render('Welcome', [ ]);
})->name('home');

Route::get('/plans', function () {
    return Inertia::render('Plans', [
        'current_plan' => Auth::user()?->plan()->first(),
        'plans' => Plan::where('is_active', 1)->limit(3)->get(),
    ]);
})->name('plans');

Route::middleware(['auth', 'verified'])->group(function () {
    // maybe bettor organize with extract domain routes from
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [App\Http\Controllers\DashboardController::class, 'store'])->name('dashboard.store');
    Route::put('/dashboard/{domain}', [App\Http\Controllers\DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/{domain}',[App\Http\Controllers\DashboardController::class, 'update'])->name('dashboard.update');

    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::post('/user/{user}/buy/{plan}', [App\Http\Controllers\UserController::class, 'buyFeature'])->name('user.buy');
});
