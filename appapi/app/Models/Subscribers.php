<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribers extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subs_id',
        'price'
    ];
    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subs_id', 'id');
    }
    //bali basta hasmany?
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
