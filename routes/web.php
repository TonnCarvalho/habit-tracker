<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.autenticate');

//register
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');

    //Dashboard
    Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('site.dashboard');

    //Habits
    Route::get('/habits/create', [HabitController::class, 'create'])->name('habits.create');
    Route::post('/habits', [HabitController::class, 'store'])->name('habits.store');
    Route::get('/habits/{habit}/edit', [HabitController::class, 'edit'])->name('habits.edit');
    Route::patch('/habits/{habit}', [HabitController::class, 'update'])->name('habits.update');
    Route::delete('/habits/{habit}', [HabitController::class, 'destroy'])->name('habits.destroy');
});
