<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $contactBookId;
    public function __construct($contactBookId)
    {
        $this->contactBookId = $contactBookId;
    }
    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('contact-book.' . $this->contactBookId);
    }
}
