<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'body',
        'recipient_id',
        'sender_id',
        'notification_status',
        'route',
    ];
    protected $primaryKey = 'notificationID';

    public function usersender()
    {
        return $this->hasone(User::class, 'sender_id', 'userID');
    }
    public function userrecipient()
    {
        return $this->hasOne(User::class, 'userID', 'recipient_id');
    }

}
