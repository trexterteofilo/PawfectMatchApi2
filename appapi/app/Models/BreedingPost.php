<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreedingPost extends Model
{
    use HasFactory;

    protected $fillable = [
      
        'breed_status',
        'owner_id',
    //    'requester_id',
        'pet_id',

    ];



    // public function requester()
    // {
    //     return $this->belongsTo(User::class, 'requester_id', 'id');
   // }
   //belongs to format, user column name, then model column name
    public function owner()
    {
        return $this->belongsTo(User::class,  'owner_id' , 'userID');
    }
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id', 'petID');
    }
    // public function recipientpet()
    // {
    //     return $this->hasOne(Pet::class, 'recipient_pet_id', 'petID');
    // }
    // public function agreement()
    // {
    //     return $this->hasMany(Agreement::class, 'agreement_id', 'agreementID');
    // }

    protected $primaryKey = 'breedpostID';
    

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'requester_id', 'id');
    // }
    // public function pet()
    // {
    //     return $this->belongsTo(Pet::class, 'pet_id', 'id');
    // }
    // public function agreement()
    // {
    //     return $this->hasMany(Agreement::class, 'agreement_id', 'id');
    // }
}
