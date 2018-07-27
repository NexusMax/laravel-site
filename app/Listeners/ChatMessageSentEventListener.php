<?php

namespace App\Listeners;

use App\ChatHistory;
use App\Events\ChatMessageSentEvent;

class ChatMessageSentEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ChatMessageSentEvent  $event
     * @return void
     */
    public function handle(ChatMessageSentEvent $event)
    {
        $record = new ChatHistory();

        $record->chat_id = $event->chat_id;
        $record->user_id = $event->user_id;
        $record->user_name = $event->username;
        $record->user_avatar = $event->user_avatar;
        $record->user_role = $event->user_role;
        $record->message_id = $event->message_id;
        $record->message = $event->message;
        $record->save();
    }
}
