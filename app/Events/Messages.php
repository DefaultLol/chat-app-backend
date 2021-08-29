<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Messages implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $body;
    public $receiver;
    public $sender;
    public $data;

    public function __construct($body,$receiver,$sender,$data)
    {
        $this->body=$body;
        $this->receiver=$receiver;
        $this->sender=$sender;
        $this->data=$data;

    }

    public function broadcastOn()
    {
        //return new Channel('my-channel-'.$this->receiver);

        return new Channel('elfakhar');

    }

    public function broadcastAs()
    {
        return 'elfakhar_event';
    }
}
