<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petshooterapplication extends Model
{
    use HasFactory;
    protected $table = 'petshooter_applications';
    protected $fillable = [
        'petshooter_id',
        'verification_status',
    ];
    protected $primaryKey = 'petshooterAppID';

    public function petshooter()
    {
        return $this->belongsTo(User::class, 'petshooter_id', 'userID');

    }
}
