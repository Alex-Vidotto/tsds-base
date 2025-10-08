<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarServiceDateController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::resource('cars', App\Http\Controllers\CarController::class); // Sigue el estándar de Laravel
//Route::resource('carservicedates', App\Http\Controllers\CarServiceDateController::class);


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index')->middleware('auth');
Route::get('/tareas/ajax', [TareaController::class, 'index'])->name('tareas.ajax')->middleware('auth');
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store')->middleware('auth');
Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create')->middleware('auth');
Route::get('/tareas/{tarea}/edit', [TareaController::class, 'edit'])->name('tareas.edit')->middleware('auth');
Route::put('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update')->middleware('auth');
Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy'])->name('tareas.destroy')->middleware('auth');
Route::get('/tareas{tarea}', [TareaController::class, 'show'])->name('tareas.show')->middleware('auth');
Route::resource('cars', App\Http\Controllers\CarController::class)->middleware('auth'); // Sigue el estándar de Laravel
Route::resource('carservicedates', App\Http\Controllers\CarServiceDateController::class)->middleware('auth');
});