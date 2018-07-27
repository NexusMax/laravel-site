<?php

namespace App\Listeners;

use App\ChatBans;
use App\Events\ChatUserBanEvent;

class ChatUserBanEventListener
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
     * @param  ChatUserBanEvent  $event
     * @return void
     */
    public function handle(ChatUserBanEvent $event)
    {
        $ban = new ChatBans();
        $ban->chat_id = $event->chat_id;
        $ban->user_id = $event->user_id;
        $ban->save();
    }
}
