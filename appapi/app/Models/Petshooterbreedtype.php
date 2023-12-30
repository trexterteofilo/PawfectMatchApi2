<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petshooterbreedtype extends Model
{
    use HasFactory;
    protected $table = 'petshooter_breedtypes';


    protected $fillable = [
        'petshooter_id',
        'breedtype',
    ];
    protected $primaryKey = 'breedtypeID';
    public function petshooter()
    {
        return $this->belongsTo(User::class, 'petshooter_id', 'userID');

    }

}
