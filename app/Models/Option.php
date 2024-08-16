<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;

class Option extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'options';

    protected $fillable = [
        'id',
        'label',
        'description',
    ];

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'vehicle_has_options', 'option_id', 'vehicle_id');
    }
}
