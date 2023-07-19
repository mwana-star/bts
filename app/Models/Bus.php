<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_seats',
        'model',
        'manufacture_year',
        'registration_number',
        'description',
        'is_available',
        'image',
        'driver_name',
        'contact_number',
        'wifi_available',
        'air_conditioned',
        'wheelchair_accessible',
        'created_by',
    ];

    // Assuming there's a 'users' table for user management, define the user relationship
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
