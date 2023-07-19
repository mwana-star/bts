<?php

namespace App\Models;

use App\Models\TripRoute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TripFare extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_route_id',
        'base_fare',
        'discount',
        'discount_type',
        'additional_fee',
        'additional_fee_type',
        // Add other fields that may be mass assignable here
    ];

    // Define relationship with TripRoute model
    public function tripRoute()
    {
        return $this->belongsTo(TripRoute::class);
    }
}
