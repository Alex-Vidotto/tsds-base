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

    Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
    Route::post('/tareas', [TareaController::class, 'store']);
    Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
    Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy'])->name('tareas.destroy');
    Route::get('/tareas{tarea}', [TareaController::class, 'show'])->name('tareas.show');
    Route::get('/tareas/{tarea}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
    Route::put('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update');

    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::post('/cars', [CarController::class, 'store']);
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

    Route::get('/carservicedates', [carservicedateController::class, 'index'])->name('carservicedates.index');
    Route::post('/carservicedates', [carservicedateController::class, 'store']);
    Route::get('/carservicedates/create', [carservicedateController::class, 'create'])->name('carservicedates.create');
    Route::get('/carservicedates/{carservicedate}/edit', [carservicedateController::class, 'edit'])->name('carservicedates.edit');
    Route::put('/carservicedates/{carservicedate}', [carservicedateController::class, 'update'])->name('carservicedates.update');
    Route::delete('/carservicedates/{carservicedate}', [carservicedateController::class, 'destroy'])->name('carservicedates.destroy');
    Route::get('/carservicedates/{carservicedate}', [carservicedateController::class, 'show'])->name('carservicedates.show');

});

