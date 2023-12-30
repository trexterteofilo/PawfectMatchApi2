<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'sub_type',
        'subs_plan',
        'subs_user',
        'subs_price'
    ];
    public function subscribers()
    {
        return $this->hasMany(Subscribers::class, 'id', 'subs_id');
    }

}
