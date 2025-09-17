<?php

namespace App\Http\Controllers;

use App\Models\CarServiceDate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarServiceDateRequest;
use App\Http\Requests\UpdateCarServiceDateRequest;
use App\Models\Car;
use App\Models\CarService;

class CarServiceDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carservicedates = CarServiceDate::with('car.carService')->get();
        return view('carservicedates.index', compact('carservicedates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarServiceDateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarServiceDateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarServiceDate  $carServiceDate
     * @return \Illuminate\Http\Response
     */
    public function show(CarServiceDate $carServiceDate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarServiceDate  $carServiceDate
     * @return \Illuminate\Http\Response
     */
    public function edit(CarServiceDate $carServiceDate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarServiceDateRequest  $request
     * @param  \App\Models\CarServiceDate  $carServiceDate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarServiceDateRequest $request, CarServiceDate $carServiceDate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarServiceDate  $carServiceDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarServiceDate $carServiceDate)
    {
        //
    }
}
