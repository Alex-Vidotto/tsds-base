<?php

namespace App\Http\Controllers;

use App\Models\GrupoTrabajo;
use App\Http\Requests\StoreGrupoTrabajoRequest;
use App\Http\Requests\UpdateGrupoTrabajoRequest;
use App\Models\Car;
use App\Models\User;
use App\Models\Tarea;


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
        $autos = Car::whereDoesntHave('grupoTrabajo')->get();
        $empleados = User::role('empleado')
            ->whereDoesntHave('grupoTrabajo')
            ->get();
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
            $grupo->empleados()->sync($request->empleados);
        }
        //->update(['grupo_trabajo_id' => $grupo->id])
    
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
       \Log::info('Intentando eliminar grupo: ' . $grupoTrabajo->id);
        
        // Verificamos si tiene relaciones activas
        \Log::info('Auto asociado: ' . ($grupoTrabajo->car_id ?? 'ninguno'));
        \Log::info('Empleados asociados: ' . $grupoTrabajo->empleados()->count());
        \Log::info('Tareas asociadas: ' . $grupoTrabajo->tareas()->count());
        
        // Liberamos relaciones
        $grupoTrabajo->auto()->dissociate();
        $grupoTrabajo->save();
        
        $grupoTrabajo->empleados()->detach();
        $grupoTrabajo->tareas()->detach();
        
        // Intentamos eliminar
        $resultado = $grupoTrabajo->delete();
        
        \Log::info('Resultado de delete(): ' . ($resultado ? 'true' : 'false'));
        
        dd('Método destroy ejecutado, resultado: ' . ($resultado ? 'true' : 'false'));
        return redirect()->route('grupotrabajos.index')->with('success', 'Grupo actualizado correctamente.');
    }

    public function formAsignarTarea(GrupoTrabajo $grupo)
    {
        $tareas = Tarea::all();
        return view('grupotrabajos.asignar-tarea', compact('grupo', 'tareas'));
    }

    public function asignarTarea(Request $request, GrupoTrabajo $grupo)
    {
        $request->validate([
            'tarea_id' => 'required|exists:tareas,id',
            'cliente' => 'required|string|max:255',
            'costo_final' => 'required|numeric|min:0',
            'notas_cliente' => 'nullable|string',
            'estado' => 'required|in:pendiente,en_proceso,completado',
        ]);

        $grupo->tareas()->attach($request->tarea_id, [
            'cliente' => $request->cliente,
            'costo_final' => $request->costo_final,
            'notas_cliente' => $request->notas_cliente,
            'estado' => $request->estado,
        ]);

        return redirect()->route('grupotrabajos.show', $grupo)->with('success', 'Tarea asignada correctamente.');
    }
}
