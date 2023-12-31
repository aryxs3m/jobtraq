<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScrapingFinished implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public int $totalListings;

    /**
     * Create a new event instance.
     */
    public function __construct(int $totalListings)
    {
        $this->totalListings = $totalListings;
    }
}
