<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarbonFootprint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'carbon_footprint',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
