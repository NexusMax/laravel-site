<?php

namespace App;
use App\Events\OrderStoredEvent;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Orders extends Model
{
    protected $table = 'sp_orders';
    protected $fillable = [
        'sum',
        'bonus',
        'user_id',
        'deal',
        'dt',
        'type',
        'status',
        'ip',
        'country',
        'user_agent',
        'sc_userid'
    ];

    protected $dispatchesEvents = [
        'created' => OrderStoredEvent::class
    ];

    public static function payed($user_id = 0)
    {
        if (!$user_id) $user_id = Auth::user()->id;
        $payed = Orders::where('user_id', $user_id)
            ->where('dt', '>', date('Y-m-d H:i:s'))
            ->orderBy('dt', 'DESC')
            ->limit(1)
            ->first();

        if(!empty($payed))
            return true;
        else
            return false;
    }

    public static function trial($user_id = 0)
    {
        $time = 60 * 60 * 24 * 14;
        if (!$user_id) $user_id = Auth::user()->id;
        $trial = User::where('id', $user_id)
            ->where('created_at', '>', date('Y-m-d H:i:s', time()-$time))
            ->first();
        if(!empty($trial))
            return true;
        else
            return false;
    }

    public static function PlusBonus($user, $text, $count = 1)
    {
        $user->increment('balance', $count);

        return Orders::create([
            'bonus' => $count,
            'user_id' => $user->id,
            'deal' => $text,
            'status' => 1,
            'dt' => date('Y-m-d H:i:s')
        ]);
    }

    public static function MinusBonus($user, $text, $count = 1, $time = 0)
    {
        $user->decrement('balance', $count);

        return Orders::create([
            'bonus' => $count * -1,
            'user_id' => $user->id,
            'deal' => $text,
            'status' => 1,
            'dt' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'))+$time),
        ]);
    }
}