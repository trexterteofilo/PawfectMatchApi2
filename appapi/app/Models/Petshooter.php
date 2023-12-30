<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petshooter extends Model
{
    use HasFactory;

    protected $fillable = [
        'petshooter_id',
        'contact_number',
        'experience',
        'petshooterprice'
    ];

    protected $primaryKey = 'petshooterID';

    public function user()
    {
        return $this->belongsTo(User::class, 'petshooter_id', 'userID');
    }
}
