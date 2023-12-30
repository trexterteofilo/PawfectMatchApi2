<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Pet;
use App\Models\Adoption;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent;



class Adoptionrequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_id',
        'adoption_id',
        'requester_id',
        'pet_id',
        'adoption_req_status',
        'pickup_date',
        'pickup_location',
        'old_owner_id',
        'cancelled_by'
    ];

    protected $primaryKey = 'adoptreqID';

    public function user()
    {
        return $this->belongsTo(User::class, 'requester_id', 'userID');
    }
    public function userowner()
    {
        return $this->hasOne(User::class, 'userID', 'owner_id');
    }
    public function pet()
    {
        return $this->hasOne(Pet::class, 'petID', 'pet_id');
    }

    public function adoption()
    {
        return $this->hasOne(Adoption::class, 'adoptID', 'adoption_id');
    }



}