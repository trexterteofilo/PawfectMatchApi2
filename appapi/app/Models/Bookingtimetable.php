<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookingtimetable extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_time',
        'booking_time_status'
    ];
}
