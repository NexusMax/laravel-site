<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use URL;
use Request as BaseRequest;
use App\User;
use Illuminate\Http\Request as MainRequest;
use JsValidation;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/';
    protected $loginPath = '/login';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        global $noindex;
        $noindex = true;


        $this->middleware('guest')->except('logout');
    }


    public function redirectTo()
    {
        $intended = Session::get('url.intended');

        if (!empty($intended)) {
            Session::forget('url.intended');
            return $intended;
        }


        return route('home') . '/myaccount';
    }


    public function authenticate()
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            return redirect()->intended('myaccount');
        }
    }

    public function sendGA($el = 'form', $ec = 'form', $ea = 'registration')
    {
        if(isset($_COOKIE['sc_userid']) && isset($_COOKIE['_ga'])){

            $__ga = explode('.', $_COOKIE['_ga']);
            $cid = $__ga[2] . '.' . $__ga[3];
            $sc_userid = $_COOKIE['sc_userid'];

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

    public function login(\Illuminate\Http\Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->guard()->validate($this->credentials($request))) {
            $user = $this->guard()->getLastAttempted();

            if ($user->confirm && $this->attemptLogin($request)) {

                if($user->created_at === null){
                    $user->created_at = date('Y-m-d H:i:s', time());
                    $user->save();
                }

                if(isset($_COOKIE['sc_userid'])){
                    setcookie('sc_userid', null, -1, '/');
                }

                setcookie('sc_userid', strtotime($user->created_at) . $user->id, time()+60*60*24*365, '/');

                $this->sendGA('form', 'form', 'login');

                return $this->sendLoginResponse($request);
            } else {

                $request->session()->flash('flash_register', 'Task was successful!');

                $this->incrementLoginAttempts($request);
                return redirect()
                    ->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors(['email' => 'Вы должны подтвердить аккаунт.']);
            }
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    public function showLoginForm()
    {
//        return redirect(route('home', ['auth' => 'true']));
//        $request->session()->flash('status', 'Task was successful!');
//        dd($request->session());
//        die;
        return redirect(route('home'));
    }

    public function logout()
    {
        Auth::logout();
        setcookie('sc_userid', null, -1, '/');
        return redirect()->back();
    }

    protected function validateLogin(MainRequest $request)
    {
        $this->validate($request, User::getLoginRules());
    }
}
