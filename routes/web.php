<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColocationController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ColocationController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'check.banned'])->group(function () {

    Route::get('/colocations/create', [ColocationController::class , 'create'])
        ->name('colocations.create');

    Route::post('/colocations', [ColocationController::class , 'store'])
        ->name('colocations.store');

    Route::post('/colocations/{colocation}/invite', [ColocationController::class , 'invite'])
        ->name('colocations.invite');

    Route::get('/colocations/accept/{token}', [ColocationController::class , 'accept'])
        ->name('colocations.accept');

    Route::get('/colocations/{colocation}', [ColocationController::class , 'show'])
        ->name('colocations.show');

    Route::post('/colocations/{id}/leave', [ColocationController::class , 'leave'])
        ->name('colocations.leave');
});


require __DIR__ . '/auth.php';
