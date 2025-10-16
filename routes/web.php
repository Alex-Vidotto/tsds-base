<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarServiceDateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupoTrabajoController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Tareas
    Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index')->middleware('permission:ver tareas');
    Route::post('/tareas', [TareaController::class, 'store'])->middleware('permission:crear tareas');
    Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create')->middleware('permission:crear tareas');
    Route::get('/tareas/{tarea}/edit', [TareaController::class, 'edit'])->name('tareas.edit')->middleware('permission:editar tareas');
    Route::put('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update')->middleware('permission:editar tareas');
    Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy'])->name('tareas.destroy')->middleware('permission:borrar tareas');
    Route::get('/tareas/{tarea}', [TareaController::class, 'show'])->name('tareas.show')->middleware('permission:ver tareas');

    // Fechas de mantenimiento
    Route::get('/carservicedates', [CarServiceDateController::class, 'index'])->name('carservicedates.index')->middleware('permission:ver fechas de mantenimiento');
    Route::get('/carservicedates/create', [CarServiceDateController::class, 'create'])->name('carservicedates.create')->middleware('permission:crear fechas de mantenimiento');
    Route::post('/carservicedates', [CarServiceDateController::class, 'store'])->name('carservicedates.store')->middleware('permission:crear fechas de mantenimiento');
    Route::get('/carservicedates/{carservicedate}', [CarServiceDateController::class, 'show'])->name('carservicedates.show')->middleware('permission:ver fechas de mantenimiento');
    Route::get('/carservicedates/{carservicedate}/edit', [CarServiceDateController::class, 'edit'])->name('carservicedates.edit')->middleware('permission:editar fechas de mantenimiento');
    Route::put('/carservicedates/{carservicedate}', [CarServiceDateController::class, 'update'])->name('carservicedates.update')->middleware('permission:editar fechas de mantenimiento');
    Route::delete('/carservicedates/{carservicedate}', [CarServiceDateController::class, 'destroy'])->name('carservicedates.destroy')->middleware('permission:borrar fechas de mantenimiento');

    // Autos
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index')->middleware('permission:ver autos');
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create')->middleware('permission:crear autos');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store')->middleware('permission:crear autos');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show')->middleware('permission:ver autos');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit')->middleware('permission:editar autos');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update')->middleware('permission:editar autos');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy')->middleware('permission:borrar autos');

    //Usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('permission:ver usuario');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:crear usuario');
    Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('permission:crear usuario');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('permission:ver usuario');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:editar usuario');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:editar usuario');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:borrar usuario');

    Route::get('/grupotrabajos', [GrupoTrabajoController::class, 'index'])->name('grupotrabajos.index')->middleware('permission:ver grupo de trabajo');
    Route::get('/grupotrabajos/create', [GrupoTrabajoController::class, 'create'])->name('grupotrabajos.create')->middleware('permission:crear grupo de trabajo');
    Route::post('/grupotrabajos', [GrupoTrabajoController::class, 'store'])->name('grupotrabajos.store')->middleware('permission:crear grupo de trabajo');
    Route::get('/grupotrabajos/{grupotrabajo}', [GrupoTrabajoController::class, 'show'])->name('grupotrabajos.show')->middleware('permission:ver grupo de trabajo');
    Route::get('/grupotrabajos/{grupotrabajo}/edit', [GrupoTrabajoController::class, 'edit'])->name('grupotrabajos.edit')->middleware('permission:editar grupo de trabajo');
    Route::put('/grupotrabajos/{grupotrabajo}', [GrupoTrabajoController::class, 'update'])->name('grupotrabajos.update')->middleware('permission:editar grupo de trabajo');
    Route::delete('/grupotrabajos/{grupotrabajo}', [GrupoTrabajoController::class, 'destroy'])->name('grupotrabajos.destroy');//->middleware('permission:borrar grupo de trabajo');

    Route::get('grupotrabajos/{grupo}/asignar-tarea', [GrupoTrabajoController::class, 'formAsignarTarea'])->name('grupotrabajos.formAsignarTarea');
    Route::post('grupotrabajos/{grupo}/asignar-tarea', [GrupoTrabajoController::class, 'asignarTarea'])->name('grupotrabajos.asignarTarea');

});