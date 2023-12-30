<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petcredentialtype extends Model
{
    use HasFactory;

    protected $table = 'petcredential_types';

    protected $fillable = [
        'owner_id',
        'pet_id',
        'cred_type'
    ];
}
