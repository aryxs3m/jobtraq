<?php

namespace App\Providers;

use App\Events\CommentPosted;
use App\Events\ScrapingFinished;
use App\Listeners\Admin\CommentPostNotification;
use App\Listeners\Admin\ScrapeFailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ScrapingFinished::class => [
            ScrapeFailNotification::class,
        ],
        CommentPosted::class => [
            CommentPostNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
