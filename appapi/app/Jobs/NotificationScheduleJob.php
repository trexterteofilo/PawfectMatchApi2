<?php

namespace App\Jobs;

use App\Http\Controllers\NotificationController;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotificationScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected $title;
    protected $body;
    protected $key;
    public function __construct($title, $body, $key)
    {
        $this->title = $title;
        $this->body = $body;
        $this->key = $key;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        NotificationController::notify($this->title, $this->body, $this->key);
    }
}
