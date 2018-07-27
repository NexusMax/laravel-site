<?php

namespace App\Http\Controllers;

use App\ChatBans;
use App\ChatHistory;
use App\Events\ChatMessageDeleteEvent;
use App\Events\ChatMessageSentEvent;
use App\Events\ChatUserBanEvent;
use App\ItemsEvents;
use App\User;
use Illuminate\Http\Request;
use Auth;

class ChatController extends Controller
{
    protected $request;

    /**
     * @param Request $request
     */
    public function sendMessage(Request $request)
    {
        $chat = $request->chat_id;
        $text = $request->message;
        $user = Auth::user();
        $name = "{$user->name} {$user->lastname}";

        $img = '/../../img/account-avatar.jpg';
        if (!empty($user->image))
            $img = url('/user/' . $user->image);

        $role = $user->role->role_id;

        $ts = time();

        $messageId = $request->id;
        event(new ChatMessageSentEvent($chat,$user->id,$name,$img,$role,$text,$messageId,$ts));
        return $messageId;
    }


    public function deleteMessage(Request $request){
        $chat = $request->chat_id;
        $messageId = $request->id;
        event(new ChatMessageDeleteEvent($chat,$messageId));
        return $messageId;
    }

    public function banUser(Request $request){
        $userId = $request->id;
        $chat = $request->chat_id;

        $ban = ChatBans::where('chat_id',$chat)->where('user_id',$userId)->first();

        if(!$ban)
            event(new ChatUserBanEvent($chat,$userId));

        return $userId;
    }


    public function index()
    {

    }

}
