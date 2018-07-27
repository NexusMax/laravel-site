<?php

namespace App\Listeners;

use App\ChatHistory;
use App\Events\ChatMessageDeleteEvent;

class ChatMessageDeleteEventListener
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
     * @param  ChatMessageDeleteEvent  $event
     * @return void
     */
    public function handle(ChatMessageDeleteEvent $event)
    {
        $message = ChatHistory::where('message_id',$event->message_id)->first();
        if($message)
            $message->delete();
    }
}
