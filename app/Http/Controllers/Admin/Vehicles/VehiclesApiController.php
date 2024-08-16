<?php

namespace App\Http\Controllers\Admin\Vehicles;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehiclesApiController extends Controller
{
    public function fetchVehicles(): JsonResponse
    {
        $vehicles = Vehicle::all();
        $vehicles = $vehicles->map(function ($vehicle) {
            return [
                'id' => $vehicle->id,
                'name' => $vehicle->name,
                'brand' => $vehicle->brand,
                'model' => $vehicle->model,
                'category' => $vehicle->category ? $vehicle->category->name : '',
                'agency' => $vehicle->agency ? $vehicle->agency->name : '',
                'in_service' => $vehicle->in_service,
                'registration_number' => $vehicle->registration_number,
                'chassis_number' => $vehicle->chassis_number,
                'fuel' => $vehicle->fuel ? $vehicle->fuel->name : '',
                'doors_number' => $vehicle->doors_number,
                'fiscal_power' => $vehicle->fiscal_power,
                'circulation_start_date' => $vehicle->circulation_start_date,
                'last_mileage' => $vehicle->last_mileage,
                'purchase_value' => $vehicle->purchase_value,
                'dealer' => $vehicle->dealer,
                'is_rented' => $vehicle->is_rented,
                'image_path' => $vehicle->image_path,
                'description' => $vehicle->description,
            ];
        });

        return response()->json($vehicles);
    }
}
