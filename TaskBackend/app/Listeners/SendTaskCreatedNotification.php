<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Mail\TaskCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskCreated $event)
    {
        $adminEmail = 'admin@example.com'; // Replace with actual admin email
        Mail::to($adminEmail)->send(new TaskCreatedNotification($event->task));
    }
}
