<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [

        'petimage',
        'petname',
        'pettype',
        'petbreed',
        'petbirthdate',
        'petgender',
        'petsize',
        'petsterilized',
        'petvaccinated',
        'petdewormed',
        'pet_eye_color',
        'pet_color',
        'petage',
        'owner_id',
        'old_owner_id',
        'score',
        'petstatus',


    ];
    // /**
    //  * Summary of getAgeAttribute
    //  * @param mixed $age
    //  * @return int
    //  */
    // public function getAgeAttribute()
    // {
    //     // Calculate age based on birthdate
    // return Carbon::parse($this->petbirthdate)->age;
    // }  
    // protected static function booted()
    // { 
    //     static::saving(function ($model) {
    //         return $model->petage = Carbon::parse($model->birthdate)->age;
    //     });
    // }

    protected $primaryKey = 'petID';

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'userID');

    }

    public function adopt()
    {
        return $this->belongsTo(Adoption::class, 'adoptID', 'adoption_id');
    }

}
