<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
