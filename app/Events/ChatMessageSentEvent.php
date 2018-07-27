<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatMessageSentEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $chat_id;
    public $user_id;
    public $username;
    public $user_avatar;
    public $user_role;
    public $message;
    public $message_id;
    public $ts;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($chatId, $userId, $userName, $userAvatar, $userRole, $message, $messageId,$ts)
    {
        $this->chat_id = $chatId;
        $this->user_id = $userId;
        $this->username = $userName;
        $this->user_avatar = $userAvatar;
        $this->user_role = $userRole;
        $this->message = $message;
        $this->message_id = $messageId;
        $this->ts = $ts;
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
