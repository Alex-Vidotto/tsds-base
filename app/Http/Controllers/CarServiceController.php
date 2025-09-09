<?php

namespace App\Http\Controllers;

use App\Models\CarService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarServiceRequest;
use App\Http\Requests\UpdateCarServiceRequest;

class CarServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreCarServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarServiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarService  $carService
     * @return \Illuminate\Http\Response
     */
    public function show(CarService $carService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarService  $carService
     * @return \Illuminate\Http\Response
     */
    public function edit(CarService $carService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarServiceRequest  $request
     * @param  \App\Models\CarService  $carService
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarServiceRequest $request, CarService $carService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarService  $carService
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarService $carService)
    {
        //
    }
}
