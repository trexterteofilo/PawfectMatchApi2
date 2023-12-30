<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petpreference extends Model
{
    use HasFactory;

    protected $fillable = [

        'vaccined',
        'dewormed',
        'personality',
        'petcolor',
        'peteyecolor',
        'petage',
        'petbreed',
        'pettype',
        'petsize',
        'petgender',
        'owner_id'
    ];
    protected $primaryKey = 'petpreferID';
    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'userID');

    }
}
