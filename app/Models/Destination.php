<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    // app/Models/Destination.php

public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function bookings()
{
    return $this->hasMany(Booking::class);
}

}
