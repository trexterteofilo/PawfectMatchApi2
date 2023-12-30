<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetShooterCredentialImg extends Model
{
    use HasFactory;
    protected $table = 'petshooter_cred_img';
    protected $fillable = [
        'petshooter_id',
        'image',
    ];
    protected $primaryKey = 'credimgID';

    public function petshooter()
    {
        return $this->belongsTo(User::class, 'petshooter_id', 'userID');

    }
}
