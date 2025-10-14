<?php

namespace App\Http\Controllers;

use App\Models\GrupoTrabajo;
use App\Http\Requests\StoreGrupoTrabajoRequest;
use App\Http\Requests\UpdateGrupoTrabajoRequest;
use App\Models\Car;
use App\Models\User;


class GrupoTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = GrupoTrabajo::with(['auto', 'empleados', 'tareas'])->get();
        return view('grupotrabajos.index', compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $autos = Car::all();
        $empleados = User::role('empleado')->whereNull('grupo_trabajo_id')->get(); // solo los libres
        return view('grupotrabajos.create', compact('autos', 'empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGrupoTrabajoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGrupoTrabajoRequest $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'car_id' => 'nullable|exists:cars,id',
            'empleados' => 'nullable|array',
            'empleados.*' => 'exists:users,id',
        ]);
    
        $grupo = GrupoTrabajo::create($request->only('nombre', 'car_id'));
    
        // Asignar empleados
        if ($request->filled('empleados')) {
            User::whereIn('id', $request->empleados)->update(['grupo_trabajo_id' => $grupo->id]);
        }
    
        return redirect()->route('grupotrabajos.index')->with('success', 'Grupo creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GrupoTrabajo  $grupoTrabajo
     * @return \Illuminate\Http\Response
     */
    public function show(GrupoTrabajo $grupoTrabajo)
    {
        $grupoTrabajo->load(['auto', 'empleados', 'tareas']);
        return view('grupotrabajos.show', compact('grupoTrabajo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GrupoTrabajo  $grupoTrabajo
     * @return \Illuminate\Http\Response
     */
    public function edit(GrupoTrabajo $grupoTrabajo)
    {
        $autos = Car::all();
        return view('grupotrabajos.edit', compact('grupoTrabajo', 'autos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGrupoTrabajoRequest  $request
     * @param  \App\Models\GrupoTrabajo  $grupoTrabajo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGrupoTrabajoRequest $request, GrupoTrabajo $grupoTrabajo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'car_id' => 'nullable|exists:cars,id',
        ]);

        $grupoTrabajo->update($request->only('nombre', 'car_id'));

        return redirect()->route('grupotrabajos.index')->with('success', 'Grupo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GrupoTrabajo  $grupoTrabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrupoTrabajo $grupoTrabajo)
    {
        \Log::info('Eliminando grupo ID: ' . $grupoTrabajo->id);
        
        // Guardar el ID para logging
        $grupoId = $grupoTrabajo->id;
        
        // Liberar relaciones
        $grupoTrabajo->empleados()->update(['grupo_trabajo_id' => null]);
        $grupoTrabajo->tareas()->update(['grupo_trabajo_id' => null]);
        
        // Eliminar
        $grupoTrabajo->delete();
        
        \Log::info("Grupo {$grupoId} eliminado - Redirigiendo a index");
        
        return redirect()->route('grupotrabajos.index')
                        ->with('success', "Grupo #{$grupoId} eliminado correctamente.");
    }  
}
