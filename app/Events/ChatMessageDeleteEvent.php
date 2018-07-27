<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatMessageDeleteEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $chat_id;
    public $message_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($chatId, $messageId)
    {
        $this->chat_id = $chatId;
        $this->message_id = $messageId;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }
}
