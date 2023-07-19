<?php

namespace App\Models;

use App\Models\Bus;
use App\Models\User;
use App\Models\TripRoute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bus_id',
        'trip_route_id',
        'rating',
        'comment',
        // Add other fields that may be mass assignable here
    ];

    // Define relationships with User, Bus, and TripRoute models
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function tripRoute()
    {
        return $this->belongsTo(TripRoute::class);
    }
}
