<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptionAgreement extends Model
{
    use HasFactory;
    protected $fillable = [
        'adopt_id',
        'owner_id',
        'pet_id',
        'requester_id',
        'pickup_location',
        'pickup_date',

    ];


    protected $primaryKey = 'adoptagreementID';


    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id','userID');
    }
    public function requester()
    {
        return $this->belongsTo(User::class,'requester_id', 'userID' );
    }
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id','petID');
    }

    public function adoption()
    {
        return $this->belongsTo(Adoption::class, 'adopt_id', 'adoptID');
    }

}
