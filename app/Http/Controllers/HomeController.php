<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarService;
use App\Models\GrupoTrabajo;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $grupoTrabajoCount = GrupoTrabajo::count();
        $carCount = Car::count();
        $userCount = User::count();
        $carServiceCount = CarService::count();

        return view('home', compact('grupoTrabajoCount', 'carCount', 'userCount', 'carServiceCount'));
    }
}
