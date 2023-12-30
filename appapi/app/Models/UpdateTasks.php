<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateTasks extends Model
{
    public function __invoke()
    {
        // do your task here...e.g.
        //   $requestsToExpire = Adoptionrequest::whereDate('pickup_date', '<=', $threeDaysAgo)
        //     ->where('status', 'Pending') // Adjust status criteria as needed
        //     ->get();
        Adoptionrequest::whereDate('pickup_date', '<', today())->where('adoption_req_status', 'Pending')->update(['adoption_req_status' => 'expired']);
    }
}
