<?php

namespace App\Http\Controllers;

use App\Mailchimp;
use App\User;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use App\Http\Requests\Subscriber;
use App\Categories;
use App\ItemsEvents;
use App\Items;
use App\Experts;
use App\Subscriber as BaseSubscriber;

use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    protected $request;


    public function __construct(Request $request)
    {
        $this->request = $request;

        if(isset($_GET['auth'])) {
            global $noindex;
            $noindex = true;
        }

        parent::__construct();
    }

    public function index()
    {
        if($this->request->is('*trainer*')){
            $title = 'Тренер';
        }elseif($this->request->is('*learner*')){
            $title = 'Ученик';
        }

        global $pageTitle;
        global $pageDescription;

        $pageTitle = $title . ' | SportCasta';
        $pageDescription = $title . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        global $ogMeta;

        $item['og_type'] = 'website';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        $itemsEvents = ItemsEvents::where('published', 1)
        // ->where('role_id', $this->currentRole)
        ->where('created_at', '<', date('Y-m-d H-i-s', strtotime('+1 month')))
        ->where('created_at', '>', date('Y-m-d H-i-s', time()))
        ->orWhere('without_date', '=', '1')
        ->orderBy('created_at', 'asc')
        ->limit(6)
        ->get();
        
        $featureCategories = Categories::where('featured', 1)->where('is_video', 0)->get();
        $categories = Categories::where('is_video', 0)->where('published', 1)->get();

        $categories_ids = [];
        foreach ($categories as $key){
            $categories_ids[] = $key->id;
        }
        $items = Items::with('user')
            ->with(['category' => function($query){
                $query->where('is_video', 0);
            }])
                ->whereIn('category_id', $categories_ids)
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();


        $team = Experts::with('user')->with('category')->where('active', 1)->orderBy('position', 'asc')->get()->toArray();

        return view('index',[
            'itemsEvents' => $itemsEvents,
            'featureCategories' => $featureCategories,
            'items' => $items,
            'team' => $team,
        ]);

    }



    public function subscribe(Subscriber $request)
    {
        $name = $request->input('subscribe.name');
        $email = $request->input('subscribe.email');
        $subscriber = BaseSubscriber::create([
            'name' => $name,
            'email' => $email
        ]);

        $mail = new Mailchimp();
        $group = $mail->select('list_id')->where('name', $mail->groups['all'][1])->first();
        if ($group->list_id) {
            $json = '{
            "email_address": "' . $email . '",
            "status": "subscribed"
            }';
            $action = 'lists/' . $group->list_id . '/members';
            $e = $mail::curl('POST', $action, $json);
        }

        $this->sendGA('Подписка на новости', 'form', 'subscribe');

        return redirect()->back();
    }


    public function sendGA($el = 'form', $ec = 'form', $ea = 'registration', $hash = '')
    {
        if(isset($_COOKIE['_ga'])){
            $__ga = explode('.', $_COOKIE['_ga']);
            $cid = $__ga[2] . '.' . $__ga[3];

            $sc_userid = time();

            if(!empty($hash)){
                $sc_userid = $hash;
            }elseif(isset($_COOKIE['sc_userid'])){
                $sc_userid = $_COOKIE['sc_userid'];
            }

            $url = 'http://www.google-analytics.com/collect?v=1&t=event&tid=UA-109131275-1&cid=' . $cid . '&ec=' . $ec . '&ea=' . $ea . '&el=' . urlencode($el) . '-' . $sc_userid;

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

    public function notFound()
    {

        return view('errors.404');
    }

}
