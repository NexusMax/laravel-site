<?php

namespace App\Http\Controllers;

use App\Logging;
use App\Orders;
use App\Payments;
use App\Settings;
use App\User;
use App\ItemsEvents;
use App\EventsOrder;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    protected $request;
    protected $pass;
    protected $data;
    protected $salt;


    public function __construct(Request $request)
    {
        $this->salt = '6lYVGOwBvo5Th3uPDV7npfhJoTervdpN';

        $this->request = $request;
        $this->data['payment'] = 'CC';
        $this->data['url'] = config('payment.platon.url');
        $this->data['key'] = config('payment.platon.key');
        $this->pass['pass'] = config('payment.platon.pass');
    }

    public function index()
    {
        $forms = Payments::where(['status' => 1])->get();
        return view('payment.payment' , [
            'data' => json_decode(json_encode($forms))
        ]);
    }

    public function success(Request $request)
    {
        $url = "//" . $_SERVER['HTTP_HOST'] . "/trainer/payment";
        $success = 0;
        if ($user = Auth::user()) {
            $model = new Payments();
            $id = $request->input('id');
            $package = $request->input('package');
            $bonuses = $request->input('quant');
            $total_price = (float)$request->input('total-price');


            if ($total_price > 0) {
                if (!empty($id)) {
                    $data = $model->signature('event', $user, $id, $total_price);
                } else {
                    $data = $model->signature('payment', $user, $package, $total_price, $bonuses);
                }

                if($data){
                    header("Access-Control-Allow-Origin: *");
                    return view('payment.success')->with('data', json_decode(json_encode($data)));
                }else{
                    Session::flash('response', 'Неверно.');
                    return redirect()->back();
                }

            } else if ($bonuses > 0 && $package > 0) {
                if ($user['balance'] >= $bonuses) {

                    if ($payment = Payments::where(['id' => intval($package), 'status' => 1])->first()) {
                        $today = strtotime(date('Y-m-d H:i:s'));
                        $mc = $payment['count_days'] * 24 * 60 * 60;
                        Orders::MinusBonus($user, 'Оплата пакета '.$payment['deal'].' за бонусы', $bonuses, $mc);

                        $success = 1;
                        $url = "//" . $_SERVER['HTTP_HOST'] . "/trainer/myaccount/bonus";
                    }
                }
                if ($success) {
                    Session::flash('response', 'Спасибо. Оплата прошла успешно!');
                    return redirect($url);
                }
                Session::flash('response', 'Не хватает бонусов для оплаты.');
                return redirect()->route('payment');
            }
        }
    }

    public function get(Request $request) {
        $success = 0;
        $order = $request->input('order');
        $url = "//" . $_SERVER['HTTP_HOST'] . "/trainer/payment";

        $status = '';
        if ($log = Logging::where('action', 'order')->where('object_id', $order)->first()) {
            $data = json_decode($log['json']);
            $ext1 = explode('-', $data->ext1);

            $type = $ext1[0];
            $user_id = $ext1[1];
            $pid = $ext1[2];


            if ($type == 'payment') {
                $success = 1;
                $url = "//" . $_SERVER['HTTP_HOST'] . "/trainer/myaccount";
            } else if ($type == 'event') {
                if ($item = ItemsEvents::find(intval($pid))) {
                    $success = 1;
                    $url = "//" . $_SERVER['HTTP_HOST'] . "/trainer/events/" . $item['alias'];
                }
            }

            if($success){
                $status = '&status=success';
            }
        }


//        if ($success) {
//            Session::flash('response', 'Спасибо. Оплата прошла успешно!');
//            return redirect($url);
//        } else {
//            Session::flash('order', $order);
//        }
//        return redirect()->route('payment');
        echo "<script>window.top.location.href = '".$url."?order=".$order . $status ."'; </script>";
        exit();
    }

    public function post(Request $request) {
        $mailto = 0;
        $json = json_encode($request->all());
        file_put_contents("help.html", date('Y-m-d H:i:s').' | '.$json."\n", FILE_APPEND);

        // Внутренний номер покупки продавца
        // В этом поле передается id заказа в нашем магазине.
        $order = $request->input('order');
        $email = $request->input('email');

        if ($log = Logging::where('action', 'order')->where('object_id', $order)->first())
            die("order is exists\n");

        // Логируем данные
        Logging::create([
            'action' => 'order',
            'object_id' => $order,
            'email' => strval($email),
            'json' => $json,
        ]);

        // Сумма, которую заплатил покупатель. Дробная часть отделяется точкой.
        $amount = $request->input('amount');
        $currency_usd_uah = Settings::where('param', 'currency_usd_uah')->first();
        if ($currency_usd_uah)
            $currency_usd_uah = $currency_usd_uah->value;
        else
            $currency_usd_uah = 1;
        $total_price = max(0.01, round($amount / $currency_usd_uah, 2));

        $description = $request->input('description');

        // Контрольная подпись
        $sign = $request->input('sign');

        // Проверим статус
        if($request->input('status') !== 'SALE')
            die('Incorrect Status');

        // Проверяем контрольную подпись
        $card = $request->input('card');
        $my_sign = md5(strtoupper(strrev($email).$this->pass['pass'].$order.strrev(substr($card,0,6).substr($card,-4))));
        if($sign !== $my_sign)
            die("bad sign\n");

        $ext1 = explode('-', $request->input('ext1'));

        $type = $ext1[0];
        $user_id = $ext1[1];
        $pid = $ext1[2];
        $bonuses = $ext1[3];

        $user = User::find(intval($user_id));
        if ($bonuses > 0)
            Orders::MinusBonus($user, 'Частичная оплата за бонусы '.$description, $bonuses);

        if ($type == 'payment') {
            if ($payment = Payments::where(['id' => intval($pid), 'status' => 1])->first()) {
                $today = strtotime(date('Y-m-d H:i:s'));
                $mc = $payment['count_days'] * 24 * 60 * 60;
                Orders::create([
                    'sum' => $total_price,
                    'user_id' => $user_id,
                    'deal' => $description,
                    'dt' => date('Y-m-d H:i:s', $today+$mc),
                    'type' => null,
                    'status' => 1
                ]);
                $to_ing = (int) $total_price;
                $this->sendGA($description, 'billing', 'paid_subscription', $to_ing, strtotime($user->created_at) . $user->id);
            }
        } else if ($type == 'event') {
            $item = ItemsEvents::find(intval($pid));
            if(!empty($item)){
                $mailto = 1;
                EventsOrder::create([
                    'event_id' => $item['id'],
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'price' => $total_price,
                ]);
                $to_ing = (int)$total_price;
                $this->sendGA($item['name'], 'billing', 'vebinar', $to_ing, strtotime($user->created_at) . $user->id);
            }
        }

        Orders::PlusBonus($user, $description, $total_price * 0.1);

        if ($mailto && !empty($item)) {
            Mail::send('vendor.mail.html.events.event_reg', [
                'name' => $user['name'],
                'item' => $item,
                'subject' => 'Регистрация на вебинаре',
            ], function ($m) use ($user) {
                $m->from('info@sportcasta.com', 'Sport Casta');
                $m->to($user['email'], $user['name'])->subject('Регистрация на вебинаре');
            });

        }

        return response()->json(null, 200);
    }

    public function eventsuccess()
    {
        $emails = $this->request->input('emails');

        $id = $this->request->get('id');
        $item = ItemsEvents::where('id', $id)->first();

        $price = $item['price'];

        if(empty($item))
            abort(404);

        $orders = EventsOrder::where('event_id', $item['id'])->get();

        if(count($orders) + count($emails) + 1 < $item['count_people']){

            if(isset($emails)){
                $price = count($emails) * $price + $price;

                foreach($emails as $key){
                    Mail::send('vendor.mail.html.events.event_reg', [
                        'name' => $key,
                        'item' => $item,
                        'subject' => 'Регистрация на вебинаре',
                    ], function ($m) use ($key) {
                        $m->from('info@sportcasta.com', 'Sport Casta');
                        $m->to($key, $key)->subject('Регистрация на вебинаре');
                    });
                }
            }

            $user = Auth::user();
            Mail::send('vendor.mail.html.events.event_reg', [
                'name' => $user->name,
                'item' => $item,
                'subject' => 'Регистрация на вебинаре',
            ], function ($m) use ($user) {
                $m->from('info@sportcasta.com', 'Sport Casta');
                $m->to($user->email, $user->name)->subject('Регистрация на вебинаре');
            });

        }


        $data = '';


        return view('payment.success')->with('data', json_decode(json_encode($data)));
    }

    public function event()
    {
        $id = $this->request->get('id');

        $item = ItemsEvents::where('id', $id)->first();

        if(empty($item))
            abort(404);

        $orders = EventsOrder::where('event_id', $item['id'])->get();



        return view('payment.event' ,[
            'item_event' => $item,
            'orders' => $orders,
            'id' => $id,
        ]);
    }



    public function sendGA($el = 'client_10', $ec = 'billing', $ea = 'paid_subscription', $ev = '', $hash = '')
    {
        if(isset($_COOKIE['_ga'])){

            $sc_userid = '';

            $__ga = explode('.', $_COOKIE['_ga']);
            $cid = $__ga[2] . '.' . $__ga[3];
            if(!empty($hash)){

                $sc_userid = $hash;
            }elseif(isset($_COOKIE['sc_userid'])){
                $sc_userid = $_COOKIE['sc_userid'];
            }

            $url = 'http://www.google-analytics.com/collect?v=1&t=event&tid=UA-109131275-1&cid=' . $cid . '&ec=' . $ec . '&ea=' . $ea;
            if(!empty($ev)){
                $url .= '&ev=' . $ev;
            }

            $url .= '&el=' . urlencode($el);

            if($ea === 'vebinar'){
                $url .= ' ' . $sc_userid;
            }else{
                $url .= '_' . $sc_userid;
            } 
//            $curl = curl_init();
//            curl_setopt_array($curl, array(
//                CURLOPT_RETURNTRANSFER => 1,
//                CURLOPT_URL => $url,
//            ));
//
//            $resp = curl_exec($curl);
//            curl_close($curl);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '');
            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        }else{
            Log::error('GA event handle failed! No _ga cookie found!');
        }
    }

    public function zero()
    {

        if(!Auth()->guest()){
            $id = $this->request->get('id');

            $item = ItemsEvents::where('id', $id)->first();

            if( empty($item) || ($item['price'] > 0.01) )
                return redirect()->back();

            $user = Auth()->user();

            EventsOrder::create([
                'event_id' => $item['id'],
                'user_id' => $user->id,
                'email' => !empty($user->email) ? $user->email : '',
                'price' => 0,
            ]);

            $this->sendGA($item['name'], 'billing', 'vebinar', 0, strtotime($user->created_at) . $user->id);

            Mail::send('vendor.mail.html.events.event_reg', [
                'name' => $user->name,
                'item' => $item,
                'subject' => 'Регистрация на вебинаре',
            ], function ($m) use ($user) {
                $m->from('info@sportcasta.com', 'Sport Casta');
                $m->to($user->email, $user->name)->subject('Регистрация на вебинаре');
            });

//            return redirect(route('events/view', ['alias' => $item->alias]) . '?status=success');
        }

        return redirect()->back();
    }
}
