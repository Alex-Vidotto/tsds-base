<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\CarBrand;
use App\Models\CarModel;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::with('carModel.carBrand')->get();
        return view('car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carBrands  = CarBrand::with('carModels')->get();
        $opciones = $this->prepareModelOptions($carBrands);
        return view('car.create', compact('opciones'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return redirect()->route('cars.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        $carModels = \App\Models\CarModel::with('carBrand')->get();
        
        return view('car.edit', compact('car', 'carModels'));
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
        $car->matricula = $request->matricula;
        $car->car_model_id = $request->car_model_id;

        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $file->move(public_path().'/images/vehiculos/',$file->getClientOriginalName());

            $car->foto = $file->getClientOriginalName();
        }
        $car->save();
        return redirect()->route('cars.index')->with('success', 'Coche actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Eliminado con éxito.');
    }


    private function prepareModelOptions($carBrands)
    {
        $options = [];
        
        foreach ($carBrands as $brand) {
            foreach ($brand->carModels as $model) {
                $options[] = [
                    'id' => $model->id,
                    'text' => $model->nombre . ' - ' . $brand->nombre,
                    'brand_name' => $brand->nombre,
                    'model_name' => $model->nombre
                ];
            }
        }
        return $options;
    }
}
