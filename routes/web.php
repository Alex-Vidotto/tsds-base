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

    Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index')->middleware('permission:ver tareas');
    Route::post('/tareas', [TareaController::class, 'store'])->middleware('permission:crear tareas');
    Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create')->middleware('permission:crear tareas');
    Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy'])->name('tareas.destroy')->middleware('permission:borrar tareas');
    Route::get('/tareas{tarea}', [TareaController::class, 'show'])->name('tareas.show');
    Route::get('/tareas/{tarea}/edit', [TareaController::class, 'edit'])->name('tareas.edit')->middleware('permission:editar tareas');
    Route::put('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update')->middleware('permission:editar tareas');

    Route::get('/cars', [CarController::class, 'index'])->name('cars.index')->middleware('permission:ver autos');
    Route::post('/cars', [CarController::class, 'store'])->middleware('permission:crear autos');
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create')->middleware('permission:crear autos');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit')->middleware('permission:editar autos');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update')->middleware('permission:editar autos');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy')->middleware('permission:borrar autos');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

    Route::get('/carservicedates', [carservicedateController::class, 'index'])->name('carservicedates.index')->middleware('permission:ver fechas de mantenimiento');
    Route::post('/carservicedates', [carservicedateController::class, 'store'])->middleware('permission:crear fechas de mantenimiento');
    Route::get('/carservicedates/create', [carservicedateController::class, 'create'])->name('carservicedates.create')->middleware('permission:crear fechas de mantenimiento');
    Route::get('/carservicedates/{carservicedate}/edit', [carservicedateController::class, 'edit'])->name('carservicedates.edit')->middleware('permission:editar fechas de mantenimiento');
    Route::put('/carservicedates/{carservicedate}', [carservicedateController::class, 'update'])->name('carservicedates.update')->middleware('permission:editar fechas de mantenimiento');
    Route::delete('/carservicedates/{carservicedate}', [carservicedateController::class, 'destroy'])->name('carservicedates.destroy')->middleware('permission:borrar fechas de mantenimiento');
    Route::get('/carservicedates/{carservicedate}', [carservicedateController::class, 'show'])->name('carservicedates.show');

});

