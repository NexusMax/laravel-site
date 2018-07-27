<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $trainer = 4;
    protected $learner = 5;
    protected $currentRole;

    public function __construct()
    {
        if(Request::is('*trainer*')){
            $this->currentRole = $this->trainer;
        }elseif(Request::is('*learner*')){
            $this->currentRole = $this->learner;
        }

        $urlSuccess = ['admin','trainer', 'learner', '', '404', 'google-reg', 'session'];
        if(!in_array(Request::segment(1), $urlSuccess)){
            abort(404);
        }

        if(Auth()->guest() && isset($_COOKIE['sc_userid'])){
            setcookie('sc_userid', null, -1, '/');

        }

        if(Auth()->guest() && Request::is('*admin*')){
            abort(404);
        }

        Session::put('url.intended', URL::full());

    }

    protected function formatValidationErrors(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $status = 422;
        return [
            "message" => $status . " error",
            "errors" => [
                "message" => $validator->getMessageBag()->first(),
                "info" => [$validator->getMessageBag()->keys()[0]],
            ],
            "status_code" => $status
        ];
    }

    public function translit($s) {
        $uk = explode('-', "А-а-Б-б-В-в-Ґ-ґ-Г-г-Д-д-Е-е-Ё-ё-Є-є-Ж-ж-З-з-И-и-І-і-Ї-ї-Й-й-К-к-Л-л-М-м-Н-н-О-о-П-п-Р-р-С-с-Т-т-У-у-Ф-ф-Х-х-Ц-ц-Ч-ч-Ш-ш-Щ-щ-Ъ-ъ-Ы-ы-Ь-ь-Э-э-Ю-ю-Я-я");
        $en = explode('-', "A-a-B-b-V-v-G-g-G-g-D-d-E-e-E-e-E-e-Zh-zh-Z-z-Y-y-I-i-I-i-J-j-K-k-L-l-M-m-N-n-O-o-P-p-R-r-S-s-T-t-U-u-F-f-H-h-Ts-ts-Ch-ch-Sh-sh-Sch-sch---Y-y---E-e-Yu-yu-Ya-ya");

        $s = str_replace($uk, $en, $s);
        $s = preg_replace("/[\s]+/ui", '-', $s);
        $s = preg_replace("/[^a-zA-Z0-9\.\_\-]+/ui", '-', $s);
        $s = strtolower($s);
        return $s;
    }

    public function get_filename($filename) {
        $file_name = $this->translit(pathinfo($filename, PATHINFO_FILENAME)) . time();
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        return $file_name . '.' .  $extension;
    }
}
