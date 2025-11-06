<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CarServiceDateController;
use App\Http\Controllers\GrupoTrabajoController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::resource('tareas', TareaController::class);

    // Fechas de mantenimiento
    Route::resource('carservicedates', CarServiceDateController::class);

    // Autos
    Route::get('/cars/export/pdf', [CarController::class, 'exportPDF'])->name('cars.exportPdf');
    Route::resource('cars', CarController::class);

    // Usuarios
    Route::resource('users', UserController::class);

    Route::get('grupotrabajos/{grupo}/asignar-tarea', [GrupoTrabajoController::class, 'formAsignarTarea'])->name('grupotrabajos.formAsignarTarea');
    Route::post('grupotrabajos/{grupo}/asignar-tarea', [GrupoTrabajoController::class, 'asignarTarea'])->name('grupotrabajos.asignarTarea');
    Route::resource('grupotrabajos', GrupoTrabajoController::class);
});
