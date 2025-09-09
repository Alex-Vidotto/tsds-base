<?php

namespace App\Http\Controllers;
use Iluinate\Suport\Facades\Input;

use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::with('carModel.carBrand')->paginate(5);
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carBrands  = \App\Models\CarBrand::with('carModels')->get();
        return view('cars.create', compact('carBrands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {
        $vehiculo = new Car();
        $vehiculo->matricula = $request->matricula;
        $vehiculo->car_model_id = $request->car_model_id;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $file->move(public_path().'/images/vehiculos/',$file->getClientOriginalName());

            $vehiculo->foto = $file->getClientOriginalName();
        }
        $vehiculo->save();
        return redirect()->route('cars.index')->with('success', 'Coche creado con éxito.');
        $vehiculo = new Car();
        $vehiculo->matricula = $request->matricula;
        $vehiculo->car_model_id = $request->car_model_id;
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $file->move(public_path().'/images/vehiculos/',$file->getClientOriginalName());

            $vehiculo->foto = $file->getClientOriginalName();
        }
        $vehiculo->save();
        return redirect()->route('cars.index')->with('success', 'Coche creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }
}
