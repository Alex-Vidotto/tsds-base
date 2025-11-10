<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupoTrabajoRequest;
use App\Http\Requests\UpdateGrupoTrabajoRequest;
use App\Models\Car;
use App\Models\GrupoTrabajo;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Http\Request;

class GrupoTrabajoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver grupo de trabajo', ['only' => ['index', 'show']]);
        $this->middleware('permission:crear grupo de trabajo', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar grupo de trabajo', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar grupo de trabajo', ['only' => ['destroy']]);
    }

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
        // ->update(['grupo_trabajo_id' => $grupo->id])

        return redirect()->route('grupotrabajos.index')->with('success', 'Grupo creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupoTrabajo = GrupoTrabajo::findOrFail($id);
        $grupoTrabajo->load(['auto', 'empleados', 'tareas']);

        return view('grupotrabajos.show', compact('grupoTrabajo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $grupoTrabajo = GrupoTrabajo::findOrFail($id);
    $autos = Car::whereDoesntHave('grupoTrabajo')->orWhere('id', $grupoTrabajo->car_id)->get();
    
    // Incluir empleados que ya están en ESTE grupo + disponibles
    $empleados = User::role('empleado')
        ->where(function($query) use ($grupoTrabajo) {
            $query->whereDoesntHave('grupoTrabajo')
                  ->orWhereHas('grupoTrabajo', function($q) use ($grupoTrabajo) {
                      $q->where('grupo_trabajos.id', $grupoTrabajo->id);
                  });
        })
        ->get();

    return view('grupotrabajos.edit', compact('grupoTrabajo', 'autos', 'empleados'));    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGrupoTrabajoRequest $request, $id)
    {
        $grupoTrabajo = GrupoTrabajo::findOrFail($id);
    
        $request->validate([
            'nombre' => 'required|string|max:255',
            'car_id' => 'nullable|exists:cars,id',
            'empleados' => 'nullable|array',
            'empleados.*' => 'exists:users,id' // Validar cada empleado
        ]);
    
        // Actualizar campos directos
        $grupoTrabajo->update($request->only('nombre', 'car_id'));
    
        // SINCRONIZAR la relación muchos a muchos con empleados
        if ($request->has('empleados')) {
            $grupoTrabajo->empleados()->sync($request->empleados);
        } else {
            // Si no se enviaron empleados, eliminar todos
            $grupoTrabajo->empleados()->sync([]);
        }
    
        return redirect()->route('grupotrabajos.index')->with('success', 'Grupo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupoTrabajo = GrupoTrabajo::findOrFail($id);
        // Liberamos relaciones
        $grupoTrabajo->empleados()->detach();
        $grupoTrabajo->tareas()->detach();

        // Eliminamos el grupo
        $grupoTrabajo->delete();

        return redirect()->route('grupotrabajos.index')->with('success', 'Grupo eliminado correctamente.');
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
