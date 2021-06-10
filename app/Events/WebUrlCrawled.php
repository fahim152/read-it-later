<?php

namespace App\Events;

use App\User;
use App\PocketContent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WebUrlCrawled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * @var PocketContent
     */
    public $content;

    /**
     * @var data
     */
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PocketContent $content, $data)
    {
        $this->content = $content;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
