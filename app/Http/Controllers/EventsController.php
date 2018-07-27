<?php

namespace App\Http\Controllers;

use App\ChatBans;
use App\ChatHistory;
use App\Items;
use Illuminate\Http\Request;
use App\ItemsEvents;
use App\Payments;
use App\EventsOrder;
use Auth;


class EventsController extends Controller
{
    protected $request;
    protected $currentTime;

    protected $currentNumberPage = 0;
    protected $lastNumberPage = 0;


    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->currentTime = date('Y-m-d H-i-s', time());

        // ceo
        if($this->request->exists('sort_date') || $this->request->exists('sort')){

            global $canonicalMeta;
            global $noindex;

            $noindex = true;

            $canonicalMeta = [
                'url' => $this->request->url()
            ];
        }
        //

        // check last see events
        if(!Auth()->guest()){
            $user = Auth()->user();

            $eve = ItemsEvents::where('published', 1)->orderBy('created_at', 'desc')->first();

            if(!empty($eve)){
                $user->last_event = $eve->created_at;
            }
            $user->save();
        }


        parent::__construct();
    }

    public function afterAction()
    {
        global $linkNextPrev;
        if($this->request->exists('page')){

            global $noindex;

            global $canonicalMeta;

            $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
            $canonicalMeta['url'] = 'https://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];

            $noindex = false;

            if(!empty($this->currentNumberPage) && $this->currentNumberPage !== 1){
                global $yandenoindex;
                $yandenoindex = true;
                if($this->currentNumberPage === 2){
                    $linkNextPrev['prev']['url'] = $this->request->url();
                }else{
                    $linkNextPrev['prev']['url'] = $this->request->url() . "?page=" . ($this->currentNumberPage - 1);
                }
            }
        }
        if(!empty($this->lastNumberPage) && $this->currentNumberPage !== $this->lastNumberPage){
            $linkNextPrev['next']['url'] = $this->request->url() . "?page=" . ($this->currentNumberPage + 1);
        }
    }

    public function index()
    {
        $title = 'События';
        global $pageTitle;
        global $pageDescription;
        $pageTitle = $title . ' на онлайн портале | SportCasta';
        $pageDescription = $title . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        global $ogMeta;

        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;


        $allEvents = ItemsEvents::where('published', 1)
//            ->where('role_id', $this->currentRole)
            ->get();

        $events = ItemsEvents::where('published', 1)
//            ->where('role_id', $this->currentRole)
            ->orderByRaw('(CASE WHEN DATE(created_at) < DATE("' . $this->currentTime . '") THEN 1 ELSE 0 END) ASC')
            ->orderByRaw('FIELD(without_date, 0, 1) ASC')
            ->sortable(['created_at' => 'asc']);


        if($this->request->exists('sort_date'))
            $events->whereDay('created_at', '=', date('d', strtotime($this->request->get('sort_date'))))
                ->whereMonth('created_at', '=', date('m', strtotime($this->request->get('sort_date'))))
                ->whereYear('created_at', '=', date('Y', strtotime($this->request->get('sort_date'))));

        if($this->request->exists('q')) {
            $events->where('name', 'like', '%' . $this->request->get('q') . '%');
            $this->request->flashOnly('q');
        }

        $events = $events->paginate(5);
        $this->currentNumberPage = $events->currentPage();
        $this->lastNumberPage = $events->lastPage();
        $this->afterAction();



        return view('events',[
            'allEvents' => $allEvents,
            'events' => $events,
            'title' => $title,
        ]);
    }

    public function current()
    {
        $title = 'Текущие события';
        global $pageTitle;
        global $pageDescription;
        $pageTitle = $title . ' на онлайн портале | SportCasta';
        $pageDescription = $title . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';


        global $ogMeta;

        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        $allEvents = ItemsEvents::where('published', 1)
//            ->where('role_id', $this->currentRole)
            ->get();

        $events = ItemsEvents::where('published', 1)
//            ->where('role_id', $this->currentRole)
            ->where('created_at', '<', $this->currentTime)
            ->where('end_at', '>', $this->currentTime)
            ->sortable(['created_at' => 'asc']);

        if($this->request->exists('sort_date'))
            $events->whereDay('created_at', '=', date('d', strtotime($this->request->get('sort_date'))))
                ->whereMonth('created_at', '=', date('m', strtotime($this->request->get('sort_date'))))
                ->whereYear('created_at', '=', date('Y', strtotime($this->request->get('sort_date'))));

        if($this->request->exists('q')) {
            $events->where('name', 'like', '%' . $this->request->get('q') . '%');
            $this->request->flashOnly('q');
        }

        $events = $events->paginate(5);
        $this->currentNumberPage = $events->currentPage();
        $this->lastNumberPage = $events->lastPage();
        $this->afterAction();

        return view('events',[
            'allEvents' => $allEvents,
            'events' => $events,
            'title' => $title,
        ]);
    }

    public function future()
    {
        $title = 'Ближайшие события';
        global $pageTitle;
        global $pageDescription;
        $pageTitle = $title . ' на онлайн портале | SportCasta';
        $pageDescription = $title . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        global $ogMeta;

        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        $allEvents = ItemsEvents::where('published', 1)
//            ->where('role_id', $this->currentRole)
            ->get();

        $events = ItemsEvents::where('published', 1)
            ->where('name', 'like', '%' . $this->request->get('q') . '%')
//            ->where('role_id', $this->currentRole)
            ->where('created_at', '<', date('Y-m-d H-i-s', strtotime('+14 days')))
            ->where('created_at', '>', $this->currentTime)
            ->orWhere('without_date', '=', '1')
            ->sortable(['created_at' => 'asc']);

        if($this->request->exists('sort_date'))
            $events->whereDay('created_at', '=', date('d', strtotime($this->request->get('sort_date'))))
                ->whereMonth('created_at', '=', date('m', strtotime($this->request->get('sort_date'))))
                ->whereYear('created_at', '=', date('Y', strtotime($this->request->get('sort_date'))));

        if($this->request->exists('q')) {
            $events->where('name', 'like', '%' . $this->request->get('q') . '%');
            $this->request->flashOnly('q');
        }

        $events = $events->paginate(5);
        $this->currentNumberPage = $events->currentPage();
        $this->lastNumberPage = $events->lastPage();
        $this->afterAction();


        return view('events',[
            'allEvents' => $allEvents,
            'events' => $events,
            'title' => $title,
        ]);
    }

    public function past()
    {
        $title = 'Прошедшие события';
        global $pageTitle;
        global $pageDescription;
        $pageTitle = $title . ' на онлайн портале | SportCasta';
        $pageDescription = $title . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        global $ogMeta;

        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        $allEvents = ItemsEvents::where('published', 1)
//            ->where('role_id', $this->currentRole)
            ->get();

        $events = ItemsEvents::where('published', 1)
//            ->where('role_id', $this->currentRole)
            ->where('end_at', '<', date('Y-m-d H-i-s', time()))
            ->sortable(['created_at' => 'asc']);

        if($this->request->exists('sort_date'))
            $events->whereDay('created_at', '=', date('d', strtotime($this->request->get('sort_date'))))
                ->whereMonth('created_at', '=', date('m', strtotime($this->request->get('sort_date'))))
                ->whereYear('created_at', '=', date('Y', strtotime($this->request->get('sort_date'))));

        if($this->request->exists('q')) {
            $events->where('name', 'like', '%' . $this->request->get('q') . '%');
            $this->request->flashOnly('q');
        }

        $events = $events->paginate(5);
        $this->currentNumberPage = $events->currentPage();
        $this->lastNumberPage = $events->lastPage();
        $this->afterAction();


        return view('events',[
            'allEvents' => $allEvents,
            'events' => $events,
            'title' => $title,
        ]);
    }


    public function view($view)
    {
        $item = ItemsEvents::where('alias', $view)
//            ->where('role_id', $this->currentRole)
            ->first();

        if(empty($item))
            abort(404);

        $orders = EventsOrder::where('event_id', $item['id'])->get();

        $eventMessage = '';
        $payed = false;

        //if(strtotime($item['created_at']) < time()){

            if(Auth()->guest()){
                $eventMessage = 'Для просмотра вебинара авторизуйтесь';
                $payed = false;
            }else{

                $payment = EventsOrder::where(function($query){
                    $query->where('user_id', Auth::user()->id);
                    $query->orWhere('email', Auth::user()->email);
                })->where('event_id', $item['id'])->get();

                if(!$payment->isEmpty()){
                    $payed = true;
                }
            }

       // }
        $newModel = new Payments();
        $data = $newModel->signature('event', $item['id']);

        $item->timestamps = false;
        $item->increment('views', 1);
        $item->timestamps = true;

        global $ogMeta;

        $item['og_type'] = 'article';
        $ogMeta = $item;

        global $pageTitle;
        global $pageDescription;
        $pageTitle = $item['name'] . ' на онлайн портале | SportCasta';
        $pageDescription = $item['name'] . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';


        global $schema;
        $schema = $this->getSchemeOgranization($pageTitle, $item);


        $user = Auth::user();

        if($item && isset($item['id']) && $user){
            /* Chat data */

            $chat = $item['id'];

            $ban = ChatBans::where('chat_id',$chat)->where('user_id',$user->id)->first();
            $isUserBanned = ($ban)? true: false;
            $mode = 'user';

            if ($user->role->role_id == 1)
                $mode = 'moderator';

            $history = ChatHistory::where('chat_id',$chat)->orderBy('created_at','asc')->get();

        }else{
            $history = [];
            $mode = 'user';
            $isUserBanned = false;
            $chat = null;
        }

        $old_price = '';

        if($item['old_price'] > 0){
            $old_price = '<span class="old-price">' . $item['old_price'] . ' $</span>';
        }



        return view('cart-events', [
            'eventMessage' => $eventMessage,
            'payed' => $payed,
            'item' => $item,
            'orders' => $orders,
            'data' => $data,
            'history' => $history,
            'mode' => $mode,
            'isUserBanned' => $isUserBanned,
            'chatId' => $chat,
            'old_price' => $old_price,
        ]);
    }


    public function getSchemeOgranization($title, $item)
    {
        $url = route('index', [],true);

        $created_at = date('Y-m-d', strtotime($item['created_at'])) . 'T' . date('H:i:s+00:00', strtotime($item['created_at']));
        $end_at = date('Y-m-d', strtotime($item['end_at'])) . 'T' . date('H:i:s+00:00', strtotime($item['end_at']));

        return '
        <script type="application/ld+json">
            {
              "@context": "http://schema.org",
              "@type": "Event",
              "location": {
                "@type": "Place",
                "address": {
                  "@type": "PostalAddress",
                  "addressLocality": "Denver",
                  "addressRegion": "CO",
                  "postalCode": "80209",
                  "streetAddress": "7 S. Broadway"
                },
                "name": "Вебинар"
              },
              "name": "' . $item['name'] . '",
              "offers": {
                "@type": "Offer",
                "availability": "http://schema.org/SoldOut",
                "price": "13.00",
                "priceCurrency": "UA",
                "url": "http://www.ticketfly.com/purchase/309433"
              },
              "description": "' . strip_tags($item['intro']) . '",
              "image": "' . $url . '/img/' . $item['img'] . '",
              "url": "' . route('events/view', ['alias' => $item['alias']]) . '",
              "startDate": "' . $created_at . '",
              "endDate": "' . $end_at . '"
            }
        </script>
        ';
    }
}
