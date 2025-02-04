<?php

namespace App\Http\Controllers\Admin\Vehicles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VehicleController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Admin/Vehicles/Index');
    }
}
