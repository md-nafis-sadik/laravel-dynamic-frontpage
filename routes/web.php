<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Models\Plan;

Route::get('/', [FrontPageController::class, 'index']);


Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/google',  'googleLogin')->name('auth.google');
    Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');

    Route::get('auth/facebook', [SocialiteController::class, 'facebookLogin'])->name('auth.facebook');
Route::get('auth/facebook-callback', [SocialiteController::class, 'facebookAuthentication'])->name('auth.facebook-callback');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Employee CRUD routes
    // Route::resource('employees', EmployeeController::class);

    // Employee routes
    Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');


        // Plan routes
        Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
        Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
        Route::post('plans', [PlanController::class, 'store'])->name('plans.store');
        Route::get('plans/{plan}', [PlanController::class, 'show'])->name('plans.show');
        Route::get('plans/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit');
        Route::put('plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
        Route::delete('plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');
});


require __DIR__.'/auth.php';
