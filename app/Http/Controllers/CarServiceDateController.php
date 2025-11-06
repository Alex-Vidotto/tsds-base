<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarServiceDateRequest;
use App\Http\Requests\UpdateCarServiceDateRequest;
use App\Models\Car;
use App\Models\CarService;
use App\Models\CarServiceDate;

class CarServiceDateController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver fechas de mantenimiento', ['only' => ['index', 'show']]);
        $this->middleware('permission:crear fechas de mantenimiento', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar fechas de mantenimiento', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar fechas de mantenimiento', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $carservicedates = CarServiceDate::with('car.carService')->get();
        $carservicedates = CarServiceDate::whereDate('fecha_mantenimiento', '>=', today())->get();

        return view('carservicedates.index', compact('carservicedates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cars = Car::all();
        $carservices = CarService::all();
        $fechasBloqueadas = CarServiceDate::orderBy('fecha_mantenimiento', 'asc')->pluck('fecha_mantenimiento')->toArray();

        return view('carservicedates.create', compact('cars', 'carservices', 'fechasBloqueadas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarServiceDateRequest $request)
    {

        $validated = $request->validated();
        CarServiceDate::create($validated);

        $car = Car::find($validated['car_id']);
        if ($car) {
            $car->estado = 'En mantenimiento';
            $car->save();
        }

        return redirect()->route('carservicedates.index')->with('success', 'Mantenimiento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(CarServiceDate $carServiceDate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(CarServiceDate $carServiceDate)
    {
        $cars = Car::all();
        $carServices = CarService::all();

        return view('carservicedates.edit', compact('carServiceDate', 'cars', 'carServices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarServiceDateRequest $request, CarServiceDate $carServiceDate)
    {
        $validated = $request->validated();

        // Guardar el estado anterior para comparar
        $carIdAnterior = $carServiceDate->car_id;

        // Actualizar el mantenimiento
        $carServiceDate->update($validated);

        // Actualizar estado del carro actual
        $carActual = $carServiceDate->car;
        if ($carActual) {
            $carActual->estado = 'En mantenimiento';
            $carActual->save();
        }

        // Si cambió de carro, actualizar también el carro anterior
        if ($carIdAnterior != $validated['car_id']) {
            $carAnterior = Car::find($carIdAnterior);
            if ($carAnterior) {
                $carAnterior->actualizarEstado(); // Restablecer estado según sus mantenimientos
                $carAnterior->save();
            }
        }

        return redirect()->route('carservicedates.index')->with('success', 'Mantenimiento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarServiceDate $carServiceDate)
    {
        //
    }
}
