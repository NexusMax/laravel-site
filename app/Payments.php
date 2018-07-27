<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Payments extends Model
{
    protected $table = 'sp_payments';
    protected $fillable = [
        'sum',
        'user_id',
        'deal',
        'dt',
        'type',
        'status',
        'count_days',
    ];

    public function signature($type, $user, $id = 0, $total_price = 0, $bonuses = 0) {
        $payment = 'CC';
        $url = config('payment.platon.url');
        $key = config('payment.platon.key');
        $pass = config('payment.platon.pass');

        $data = new \stdClass();
        if ($type == 'event') {
            $item = ItemsEvents::where('id', $id)->first();
            $data->id = $item['id'];
            $data->deal = $item['name'];
            $data->sum = $item['price'];
            $data->ext1 = 'event-'.$user['id'].'-'.$item['id'].'-'.$bonuses;
        } else {
            $data = Payments::where('id', $id)->first();
            $data->ext1 = 'payment-'.$user['id'].'-'.$data['id'].'-'.$bonuses;
        }

        //$total = max(0.01, $data->sum - floor ($bonuses)/100);
        //$total = max(0.01, $data->sum);

//        dump((float)$total);
//        dump( $data->sum / 2);
//        die;
       // if((float)$total !== (float)$total_price && $type != 'event') return false;


        if($total_price < $data->sum / 2){
            $total = $data->sum;
        }else{
            $total = $total_price;
        }

        $currency_usd_uah = Settings::where('param', 'currency_usd_uah')->first();
        if ($currency_usd_uah)
            $currency_usd_uah = $currency_usd_uah->value;
        else
            $currency_usd_uah = 1;

        $data->total = max(0.01, $total);
        $total = max(0.01, $total) * $currency_usd_uah;
        $data->pass = $pass;
        $data->key = $key;
        $data->url = $url;
        $data->data = base64_encode(json_encode(array(
            'amount' => number_format($total, 2),
            'description' => $data->deal,
            'currency' => 'UAH'
        )));
        $data->payment = $payment;
        $data->sign = md5(strtoupper(
            strrev($data->key).
            strrev($data->payment).
            strrev($data->data).
            strrev($data->url).
            strrev($data->pass)
        ));

        return $data;
    }
}
