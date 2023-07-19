<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyConsumption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location',
        'electricity_usage',
        'cooking_fuel_type',
        'generator_fuel_consumption',
    ];

    // Define the user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
