<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScrapingFinished
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
