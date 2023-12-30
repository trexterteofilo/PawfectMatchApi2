<?php

namespace App\Console\Commands;

use App\Models\Adoptionrequest;


use Illuminate\Console\Command;
use Carbon\Carbon;

class ExpiredAdoptionRequests extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //   protected $signature = 'adoptionrequests:expire';
    protected $signature = 'adoptionrequests:expire';
    //  protected $schedule = call(new UpdateTasks())->daily();
    protected $description = 'Expire adoption requests that are due within three days.';


    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $threeDaysAgo = Carbon::now()->subDays(3)->toDateString();

        $requestsToExpire = Adoptionrequest::whereDate('pickup_date', '<=', $threeDaysAgo)
            ->where('adoption_req_status', 'Pending') // Adjust status criteria as needed
            ->get();

        foreach ($requestsToExpire as $request) {
            $request->update([
                'adoption_req_status' => 'Expired',
                'cancelled_by' => 'System'
            ]);
            // Perform any additional actions needed when expiring requests
        }


        // $this->info('Adoption requests expired successfully.');
        \Log::info('Adoption requests expired successfully.');
    }
}
