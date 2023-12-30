<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'subs_benefit',
        'subs_id',
        'subs_cons',
    ];
    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subs_id', 'id');
    }
}
