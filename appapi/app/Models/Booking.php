<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_date',
        'booking_day',
        'booking_time',
        'booking_payment',
        'booking_status',
        'requester_id',
        'petshooter_id',
        'booking_time_status',
    ];


    protected $primaryKey = 'bookID';

    public function petshooter()
    {
        return $this->belongsTo(User::class, 'petshooter_id', 'userID');
    }
    public function petshootermodel()
    {
        return $this->belongsTo(Petshooter::class, 'petshooter_id', 'petshooter_id');
    }
    //bali basta hasmany? -> hasmany error naay space
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id', 'userID');
    }
}
