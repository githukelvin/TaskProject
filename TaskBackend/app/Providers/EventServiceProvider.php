<?php

namespace App\Providers;

use App\Events\TaskCreated;
use App\Listeners\SendTaskCreatedNotification;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
    protected array $listen = [
        TaskCreated::class => [
            SendTaskCreatedNotification::class,
        ],
    ];
}
