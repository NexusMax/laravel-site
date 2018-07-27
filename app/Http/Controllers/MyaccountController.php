<?php

namespace App\Http\Controllers;

use App\EventsOrder;
use App\Logging;
use App\Orders;
use App\Settings;
use Illuminate\Http\Request;
use App\ItemsEvents;
use Illuminate\Http\Response;
use jeremykenedy\LaravelRoles\Models\Role;
use Auth;
use App\Items;
use App\Categories;
use App\User;
use App\Http\Requests\MyaccountInf;
use Jenssegers\Date\Date;



class MyaccountController extends Controller
{
    protected $request;

    private $botApi = '586485257:AAH4kGo7LId9yysMlt7rJWVfXcfW-_Nyd4A';


    public function __construct(Request $request)
    {
        global $noindex;

        $noindex = true;

        $this->request = $request;

        parent::__construct();
    }

    public function index()
    {
        $itemsEvents = ItemsEvents::where('published', 1)
        // ->where('role_id', $this->currentRole)
        ->where('created_at', '<', date('Y-m-d H-i-s', strtotime('+1 month')))
        ->where('created_at', '>', date('Y-m-d H-i-s', time()))
        ->orWhere('without_date', '=', '1')
        ->orderBy('created_at', 'asc')
        ->limit(6)
        ->get();

        User::checkInf();

        global $pageTitle;
        global $pageDescription;

        $pageTitle = 'Личный кабинет | SportCasta';
        $pageDescription = 'Личный кабинет ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        $segment = request()->segment(1);


        // TODO: use another layout for learner pages
        $view = 'myaccount.account';
        if ($segment == 'learner')
            $view = 'myaccount.learner.account';


        $sub = Orders::where('user_id', Auth::user()->id)
            ->where('dt', '>', date('Y-m-d H:i:s'))
            ->orderBy('dt', 'DESC')
            ->limit(1)
            ->first();

        $subscription = false;
        if(!empty($sub)){
            $subscription = 'Подписка действительна до: ' . date('d.m.Y', strtotime($sub->dt));
        }


        return view( $view,[
            'itemsEvents' => $itemsEvents,
            'subscription' => $subscription
        ]);
    }

    public function social()
    {
        $redirect = $this->request->segment(1) . '/myaccount';

        //$s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
        $user = [];
//        $user = json_decode($s, true);
        $user['first_name'] = $this->request->get('first_name');
        $user['last_name'] = $this->request->get('last_name');
        $user['uid'] = $this->request->get('uid');
        $user['email'] = $this->request->get('email');
        $user['network'] = 'facebook';

        $this->createUser($user, true);
        return response()->json('login');
    }

    public function exists()
    {
        $issetUser = User::where('uid', $this->request->get('uid'))->first();

        if(!empty($issetUser)){

            if(!empty($issetUser->email)){
                return response()->json($issetUser->email);
            }

        }
        return response()->json('no');
    }

    public function telegramexists()
    {
        $issetUser = User::where('uid_telegram', $this->request->get('uid'))->first();

        if(!empty($issetUser)){

            if(!empty($issetUser->email)){
                Auth::login($issetUser);
                return response()->json($issetUser->email);
            }

        }
        return response()->json('no');
    }

    public function session()
    {
        $this->request->session()->put('redirect', $this->request->get('url'));
        if($this->request->ajax()){
            return response()->json('success');
        }

        return redirect()->back();
    }

    public function socialgoogle()
    {

        $redirect = '/trainer/myaccount';
        if($this->request->session()->exists('redirect')){
            $redirect = $this->request->session()->get('redirect');
        }

        $client_id = '198177097285-q34midsb8gcu2bgd28oje1lscp1gc2rq.apps.googleusercontent.com'; // Client ID
        $client_secret = 'VkSjsTemId6K9F3LicPyFYia'; // Client secret
        $redirect_uri = url('/') . '/google-reg'; // Redirect URI

        if (isset($_GET['code'])) {

            $params = array(
                'client_id'     => $client_id,
                'client_secret' => $client_secret,
                'redirect_uri'  => $redirect_uri,
                'grant_type'    => 'authorization_code',
                'code'          => $_GET['code']
            );

            $url = 'https://accounts.google.com/o/oauth2/token';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);
            $tokenInfo = json_decode($result, true);

            if (isset($tokenInfo['access_token'])) {
                $params['access_token'] = $tokenInfo['access_token'];

                $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo['id'])) {

                    $user = [];
                    $user['first_name'] = !empty($userInfo['given_name']) ? $userInfo['given_name'] : '';
                    $user['last_name'] = !empty($userInfo['family_name']) ? $userInfo['family_name'] : '';
                    $user['uid'] = !empty($userInfo['id']) ? $userInfo['id'] : '';
                    $user['email'] = !empty($userInfo['email']) ? $userInfo['email'] : '';
                    $user['network'] = 'google';

                    $this->createUser($user, false);

                    return redirect($redirect);
                }
            }
        }

        return redirect()->home();
    }


    public function createUser($user, $ajax = false)
    {
        $redirect = $this->request->segment(1) . '/myaccount';

        $issetUser = User::where('uid', $user['uid'])
            ->orWhere('email', $user['email'])
            ->orWhere('uid_google', $user['uid'])
            ->orWhere('uid_telegram', $user['uid'])
            ->first();

        if(!empty($issetUser)){

            if(isset($user['uid'])){
                if(isset($user['network']) && $user['network'] === 'google' && empty($issetUser['uid_google'])){
                    $issetUser['uid_google'] = $user['uid'];
                    $issetUser->save();
                }elseif(isset($user['network']) && $user['network'] === 'facebook' && empty($issetUser['uid'])){
                    $issetUser['uid'] = $user['uid'];
                    if (empty($issetUser['email']) && isset($user['email'])){
                        $issetUser['uid_telegram'] = $user['email'];
                    }
                    $issetUser->save();
                }elseif(isset($user['network']) && $user['network'] === 'telegram' && empty($issetUser['uid_telegram'])){
                    $issetUser['uid_telegram'] = $user['uid'];
                    if (empty($issetUser['email']) && isset($user['email'])){
                        $issetUser['uid_telegram'] = $user['email'];
                    }
                    $issetUser->save();
                }

                $el = $user['network'];
            }else{
                $el = 'form';
            }


            $issetUser->updatedInfo($user);
            Auth::login($issetUser);

            if($issetUser->created_at === null){
                $issetUser->created_at = date('Y-m-d H:i:s', time());
                $issetUser->save();
            }

            setcookie('sc_userid', strtotime($issetUser->created_at) . $issetUser->id, time()+60*60*24*365, '/');

            $this->sendGA($el, 'form', 'login', strtotime($issetUser->created_at) . $issetUser->id);

            if($ajax){
                return response()->json('login');
            }
            return redirect($redirect);
        }
        $hash = mb_substr(md5(time()), 0, 6);
        $userCreate = User::create([
            'name' => !empty($user['first_name']) ? $user['first_name'] : '',
            'lastname' => !empty($user['last_name']) ? $user['last_name'] : '',
            'email' => !empty($user['email']) ? $user['email'] : ' ',
            'password' => bcrypt(time()),
            'birthday' => isset($user['bdate']) ? date('Y-m-d H:i:s', strtotime($user['bdate'])) : '',
            'country' => !empty($user['country']) ? $user['country'] : '',
            'city' => !empty($user['city']) ? $user['city'] : '',
            'referal' => $hash,
            'confirm_text' => $hash,
        ]);

        if(isset($user['uid'])){
            if($user['network'] === 'google'){
                $userCreate->uid_google= $user['uid'];
            }elseif($user['network'] === 'facebook'){
                $userCreate->uid  = $user['uid'];
            }elseif($user['network'] === 'telegram'){
                $userCreate->uid_telegram  = $user['uid'];
            }
            $userCreate->save();

            $el = $user['network'];
        }else{
            $el = 'form';
        }

        $role = Role::where('name', '=', 'User')->first();
        $userCreate->attachRole($role);

        Orders::create([
            'bonus' => '100',
            'user_id' => $userCreate->id,
            'deal' => User::BonusInf()[0],
            'status' => 1,
            'dt' => date('Y-m-d H:i:s', strtotime('+2 weeks'))
        ]);

        if(!empty($_COOKIE['Referal'])){
            $userReferalId = $_COOKIE['Referal']['user_id'];

            $referalUser = User::where('id', $userReferalId)->first();
            Orders::create([
                'bonus' => '50',
                'user_id' => $referalUser->id,
                'deal' => User::BonusInf()[6],
                'status' => 1,
                'dt' => date('Y-m-d H:i:s')
            ]);
            $referalUser->increment('balance', 50);

            setcookie('Referal[user_id]', null, -1);
            setcookie('Referal[referal]', null, -1);
        }

        $userCreate->increment('balance', 100);

        Auth::login($userCreate);

        if($userCreate->created_at === null){
            $userCreate->created_at = date('Y-m-d H:i:s', time());
            $userCreate->save();
        }

//        setcookie('sc_userid', strtotime($userCreate->created_at) . $issetUser->id, time()+60*60*24*365, '/');

        $this->sendGA($el, 'form', 'registration', strtotime($userCreate->created_at) . $userCreate->id);
        $this->sendGA($el, 'form', 'login', strtotime($userCreate->created_at) . $userCreate->id);

        if($ajax){
            return response()->json('login');
        }
        return redirect($redirect);
    }

    public function sendGA($el = 'form', $ec = 'form', $ea = 'registration', $hash = '')
    {
        if(isset($_COOKIE['_ga'])){

            $__ga = explode('.', $_COOKIE['_ga']);
            $cid = $__ga[2] . '.' . $__ga[3];
            if(!empty($hash)){

                $sc_userid = $hash;
            }elseif(isset($_COOKIE['sc_userid'])){
                $sc_userid = $_COOKIE['sc_userid'];
            }

            $url = 'http://www.google-analytics.com/collect?v=1&t=event&tid=UA-109131275-1&cid=' . $cid . '&ec=' . $ec . '&ea=' . $ea . '&el=' . $el . '-' . $sc_userid;
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
        }
    }

    public function telegramreg()
    {
//        $auth_data = $this->checkTelegramAuthorization($_GET);
//        if(is_array($auth_data)){
//
//        }

        $user = [];
        $user['first_name'] = $this->request->get('first_name');
        $user['last_name'] = $this->request->get('last_name');
        $user['uid'] = $this->request->get('uid');
        $user['email'] = $this->request->get('email');
        $user['phone'] = $this->request->get('phone');
        $user['network'] = 'telegram';

        $this->createUser($user, true);

        return response()->json('login');
    }

    function checkTelegramAuthorization($auth_data)
    {
        $check_hash = $auth_data['hash'];
        unset($auth_data['hash']);
        $data_check_arr = [];
        foreach ($auth_data as $key => $value) {
            $data_check_arr[] = $key . '=' . $value;
        }
        sort($data_check_arr);
        $data_check_string = implode("\n", $data_check_arr);
        $secret_key = hash('sha256', $this->botApi, true);
        $hash = hash_hmac('sha256', $data_check_string, $secret_key);
        if (strcmp($hash, $check_hash) !== 0) {
            return false;
        }
        if ((time() - $auth_data['auth_date']) > 86400) {
            return false;
        }
        return $auth_data;
    }

    public function getTelegramUserData()
    {
      if (isset($_COOKIE['tg_user'])) {
            $auth_data_json = urldecode($_COOKIE['tg_user']);
            $auth_data = json_decode($auth_data_json, true);
            return $auth_data;
        }
        return false;
    }

    public function referal()
    {
        $referal = mb_substr(md5(time()), 0, 6);
        User::where('email', Auth::user()->email)
            ->orWhere('uid', Auth::user()->uid)
            ->update(['referal' => $referal]);

        return $referal;
    }

    public function update(MyaccountInf $request)
    {
        $data = $request->except(['_token', 'role_id']);

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = mb_strtolower(str_random(8) . '.' . $file->getClientOriginalExtension());
            $data['image'] = $fileName;
            $file->move(public_path() . '/user/', $fileName);
        }
        if($request->input('old_img') !== $request->input('image')){
            @unlink(public_path() . '/user/'. $request->input('old_img'));
            if(empty($request->input('image')) && !$request->hasFile('image'))
                $data['image'] = null;
        }
        unset($data['old_img']);

        Date::setLocale('ru');
        $dateResult = [];
        preg_match_all('/(\.)/i', mb_strtolower($data['birthday']), $dateResult);


        if(empty($dateResult[0])) {
            $date = Date::createFromFormat('d M Y', mb_strtolower($data['birthday']));
            $data['birthday'] = $date->format('Y-m-d H:i:s');
        }


        if(stristr($data['phone'], $data['code_phone'])){
            $data['phone'] = str_replace ($data['code_phone'], '', $data['phone']);
        }

        $data['phone'] = $data['code_phone'] . $data['phone'];
        unset($data['code_phone']);

        User::where('id', Auth::user()->id)
            ->update($data);

        return redirect()->back();
    }

    public function bonus()
    {
        $orders = Orders::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();



        return view('myaccount.bonus', [
            'orders' => $orders
        ]);
    }

    public function bonuses()
    {
        $categories = Categories::where('published', 1)->limit(6)->get();
        $popularItems = Items::with('category')
            ->where('role_id', $this->currentRole)
            ->with('user')
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();

        global $pageTitle;
        global $pageDescription;

        $pageTitle = 'Бонусная программа | SportCasta';
        $pageDescription = 'Бонусная программа на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        return view('myaccount.bonuses', [
            'categories' => $categories,
            'popularItems' => $popularItems,
        ]);
    }

    /**
     * Renders a view with all user payments
     *
     * @author Tarasovych
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscriptions()
    {
        $userId = Auth::user()->id;
        $logs = Logging::where('action', 'order')->get();

        $filtered = $logs->filter(function ($value) use ($userId) {
            $explode = explode('-', json_decode($value->json)->ext1);
            return $explode[0] == 'payment' && $explode[1] == $userId;
        });

        $currency_usd_uah = Settings::where('param', 'currency_usd_uah')->first()->value;

        $multiplied = $filtered->map(function ($item, $key) use ($currency_usd_uah) {
            $item = json_decode($item->json);
            return [
                'type' => $item->description,
                'date' => $item->date,
                'cost' => round($item->amount/$currency_usd_uah, 2) . ' USD',
            ];
        });

        $sub = Orders::where('user_id', Auth::user()->id)
            ->where('dt', '>', date('Y-m-d H:i:s'))
            ->orderBy('dt', 'DESC')
            ->limit(1)
            ->first();

        $sub_expires = '-';
        if (isset($sub))
        {
            $sub_expires = date('d.m.Y', strtotime($sub->dt));
        }

        $subscriptions = $multiplied->all();

        return view('myaccount.subscriptions', compact('subscriptions', 'sub_expires'));
    }

    public function deleteImg()
    {
        if($this->request->is('ajax')){
            echo '1';
        }
    }
}
