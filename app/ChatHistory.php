<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int chat_id
 * @property int user_id
 * @property string user_name
 * @property string user_avatar
 * @property int user_role
 * @property string message_id
 * @property string message
 */
class ChatHistory extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'chat_history';

    public function getTime(){
        $date = date_create_from_format('Y-m-d H:i:s',$this->created_at);
        $formated = date_format($date,"H:i");
        return $formated;
    }

}
