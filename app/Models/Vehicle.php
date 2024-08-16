<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'id',
        'name',
        'category_id',
        'in_service',
        'agency_id',
        'brand',
        'model',
        'registration_number',
        'chassis_number',
        'fuel_id',
        'doors_number',
        'fiscal_power',
        'circulation_start_date',
        'last_mileage',
        'purchase_value',
        'dealer',
        'is_rented',
        'image_path',
        'description',
    ];

    public function options()
    {
        return $this->belongsToMany(Option::class, 'vehicle_has_options', 'vehicle_id', 'option_id');
    }
}
