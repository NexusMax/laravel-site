<?php

namespace App\Http\Controllers\Auth;

use App\Mail\RegisterMail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use URL;
use App\Orders;
use Proengsoft\JsValidation;
//use Request;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        global $noindex;
        $noindex = true;

        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, User::getRegisterRules(), User::getRegisterMessages());
    }


    protected function redirectTo()
    {
        return route('home') . '/myaccount';
    }


    public function showRegistrationForm()
    {
//        $request->session()->flash('status', 'Task was successful!');
//        dd($request->session());
//        die;
        return redirect(route('home'));
//        return redirect(route('home', ['auth' => 'true']));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $hash = mb_substr(md5(time()), 0, 6);
        $password = $data['password'];

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'referal' => $hash,
            'confirm_text' => $hash,
        ]);
        $role = Role::where('name', '=', 'User')->first();
        $user->attachRole($role);

//        Mail::to($user->email)->send(new RegisterMail($user->email, $password, $hash));

        Mail::send('vendor.mail.html.register', [
            'email' => $user->email,
            'password' => $password,
            'actionUrl' => route('confirm', ['hash' => $hash],true),
        ], function ($m) use ($user) {
            $m->from('info@sportcasta.com', 'Sport Casta');
            $m->to($user->email, $user->name)->subject('Подтверждения регистрации');
        });

        Orders::create([
            'bonus' => '100',
            'user_id' => $user->id,
            'deal' => User::BonusInf()[0],
            'status' => 1,
            'dt' => date('Y-m-d H:i:s', strtotime('+2 weeks'))
        ]);

        if(!empty($_COOKIE['Referal'])){
            $userReferalId = $_COOKIE['Referal']['user_id'];
//            Orders::create([
//                'bonus' => '1',
//                'user_id' => $user->id,
//                'deal' => User::BonusInf()[5],
//                'status' => 1,
//                'dt' => date('Y-m-d H:i:s')
//            ]);
//            $user->increment('balance');

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


        $user->increment('balance', 100);

        return $user;
    }

    public function sendGA($hash = '', $el = 'form', $ec = 'form', $ea = 'registration')
    {
        if(isset($_COOKIE['_ga'])){

            $__ga = explode('.', $_COOKIE['_ga']);
            $cid = $__ga[2] . '.' . $__ga[3];
            $sc_userid = $hash;

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

    public function getRegister()
    {
        $validator = JsValidator::validator(
            $this->validator([])
        );
        return view('auth.register', ['validator'=>$validator]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));


        return redirect(route('confirm', ['id' => $user->id]));
        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    public function confirm(Request $request)
    {
        $mail = '';
        $urlMail = '';
        $userEmail = '';

        if($request->exists('hash')){

            $user = User::where('confirm_text', $request->get('hash'))->where('confirm', 0)->first();

            if($user){
                $user->confirm = 1;
                $user->save();

                Auth::login($user);

                setcookie('sc_userid', strtotime($user->created_at) . $user->id, time()+60*60*24*365, '/');

                $this->sendGA(strtotime($user->created_at) . $user->id);
                $this->sendGA(strtotime($user->created_at) . $user->id,'form', 'form', 'login');

                return view('auth.confirmed');
            }
        }

        if($request->exists('id')){
            $user = User::where('id', $request->get('id'))->first();
            preg_match_all('/(@[\w+.]+)/i', $user->email, $mail);
            $mail = mb_substr($mail[1][0], 1);

            $userEmail = $user->email;

            $mails = [
                'mail.ru' => 'https://mail.ru',
                'gmail.com' => 'https://mail.google.com',
                'yandex.ru' => 'https://yandex.ru',
                'yandex.ua' => 'https://yandex.ua',
            ];

            if(isset($mails[$mail])){
                $urlMail = $mails[$mail];
            }else{
                $urlMail = 'https://' . $mail;
            }

            return view('auth.confirm', [
                'urlMail' => $urlMail,
                'mail' => $mail,
                'userEmail' => $userEmail,
            ]);

        }


        return redirect('/');
    }
}
