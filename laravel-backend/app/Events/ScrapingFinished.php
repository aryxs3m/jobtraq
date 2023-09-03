<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScrapingFinished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $totalListings;

    /**
     * Create a new event instance.
     */
    public function __construct(int $totalListings)
    {
        $this->totalListings = $totalListings;
    }
}
