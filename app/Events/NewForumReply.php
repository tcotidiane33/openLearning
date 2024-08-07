<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewForumReply implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $threadId;
    public $replyContent;

    public function __construct($threadId, $replyContent)
    {
        $this->threadId = $threadId;
        $this->replyContent = $replyContent;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    use Dispatchable, InteractsWithSockets, SerializesModels;



    public function broadcastOn()
    {
        return new PrivateChannel('forum.' . $this->threadId);
    }
}
