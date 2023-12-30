<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Pet;

class Petcredentialimages extends Model
{
    use HasFactory;

    protected $table = 'petcredential_images';
    protected $fillable = [
        'owner_id',
        'pet_id',
        'image_path'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'owner_id');
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'petID', 'pet_id');
    }
}
