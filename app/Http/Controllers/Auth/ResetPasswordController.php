<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Items;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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

    protected function redirectTo()
    {
        return route('home');
    }

    public function showResetForm(Request $request, $token = null)
    {
        $popularItems = Items::with('category')
            ->with('user')
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();


        return view('auth.passwords.reset', ['popularItems' => $popularItems])->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
