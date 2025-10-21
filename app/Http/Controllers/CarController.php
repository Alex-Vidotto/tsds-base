<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarService;
use Barryvdh\DomPDF\Facade\Pdf;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carBrands = CarBrand::with('carModels')->get();
        $opciones = $this->prepareModelOptions($carBrands);
        $tiposServicio = CarService::all();

    
        $cars = Car::with(['carModel.carBrand', 'carServiceDates.carService']);
        if ($request->filled('car_model_id')) {
            $cars->where('car_model_id', $request->car_model_id);
        }
        if ($request->filled('car_service_id')) {
            $cars->whereHas('carServiceDates', function ($query) use ($request) {
                $query->where('car_service_id', $request->car_service_id);
            });
        }
        if ($request->filled('desde')) {
            $cars->whereDate('created_at', '>=', $request->desde);
        }
        if ($request->filled('hasta')) {
            $cars->whereDate('created_at', '<=', $request->hasta);
        }
        $cars = $cars->orderBy('created_at', 'desc')->paginate(10);
        if ($request->has('pdf')) {
            return $this->exportPDF($request);
        }
        $cars->getCollection()->each(function ($car) {
            $car->actualizarEstado();
        });

        return view('car.index', [
            'cars' => $cars,
            'opciones' => $opciones,
            'tiposServicio' => $tiposServicio,
            'carModel_id' => $request->carModel_id,
            'desde' => $request->desde,
            'hasta' => $request->hasta,
        ]);
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
        $vehiculo->fichaTecnica()->create([
            'motor' => $request->motor,
            'combustible' => $request->combustible,
            'transmision' => $request->transmision,
            'color' => $request->color,
            'anio' => $request->anio,
        ]);
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
                    'text' => $model->nombre . ' - ' . $brand->nombre
                ];
            }
        }
        return $options;
    }
    public function exportPDF(Request $request)
    {
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $carModel_id = $request->input('car_model_id'); // ← Nombre consistente

        $query = Car::with(['carModel.carBrand', 'fichaTecnica', 'carServiceDates.carService']);

        if ($request->filled('car_service_id')) {
            $query->whereHas('carServiceDates', function ($q) use ($request) {
                $q->where('car_service_id', $request->car_service_id);
            });
        }

        if ($desde && $hasta) {
            $query->whereDate('created_at', '>=', $desde)
                  ->whereDate('created_at', '<=', $hasta);
        }

        if ($carModel_id) { // ← Mismo nombre
            $query->where('car_model_id', $carModel_id);
            $modelo = CarModel::find($carModel_id); // ← Mismo nombre
        }
        else{
            $modelo = null;
        }

        $cars = $query->orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('car.exportPdf', compact('cars', 'modelo', 'desde', 'hasta'))
               ->setPaper('a4', 'landscape');

        return $pdf->download('informe_coches.pdf');
    }
}
