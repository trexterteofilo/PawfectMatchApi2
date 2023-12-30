<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;
    protected $fillable = [
        'agreement_date',
        'recipient_id',
        'requester_id',
        'pettype',
        'recipient_pet_id',
        'requester_pet_id',
        'agreement_location',
        'agreement_payperson',
        'agreement_shooter',
        'first_session',
        'second_session',
        'third_session',
        'agreement_payment',
        'agreement_paymode',
        'agreement_info',
        'agreement_status'
    ];

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id', 'userID', );
    }
    public function recipient()
    {
        return $this->hasOne(User::class, 'userID', 'recipient_id', );
    }
    public function requesterpet()
    {
        return $this->belongsTo(Pet::class, 'requester_pet_id', 'petID');
    }
    public function recipientpet()
    {
        return $this->belongsTo(Pet::class, 'recipient_pet_id', 'petID');
    }


    protected $primaryKey = 'agreementID';



}
