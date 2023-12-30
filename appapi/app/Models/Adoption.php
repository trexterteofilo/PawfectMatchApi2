<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'adopt_desc',
        'adopt_date',
        'adopt_payment',
        'adopt_status',
        'adopter',
        'old_owner_id',
        'monthsowned',
        'owner_id',
        'pet_id',

    ];
    protected $primaryKey = 'adoptID';


    public function currentOwner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'userID');
    }
    public function previousOwner()
    {
        return $this->belongsTo(User::class, 'old_owner_id', 'userID');
    }
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id', 'petID');
    }
    public function adoptrequest()
    {
        return $this->hasMany(Adoptionrequest::class, 'adoptionrequest_id', 'adoptreqID');
    }
}