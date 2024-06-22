<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Libros
Route::get('/', [LibroController::class, 'index'])->name('welcome');

//prestamos
Route::get('/dashboard', [PrestamoController::class, 'index'])->name('dashboard');
Route::post('/reservar/{id_libro}', [PrestamoController::class, 'reservar'])->name('reservar');
Route::post('prestamos/devolver/{id}', [PrestamoController::class, 'devolver'])->name('devolver.libro');




require __DIR__.'/auth.php';
