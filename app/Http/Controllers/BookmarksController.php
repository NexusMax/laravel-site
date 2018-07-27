<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemsEvents;
use Auth;
use App\User;


class BookmarksController extends Controller
{
    protected $request;


    public function __construct(Request $request)
    {
        global $noindex;
        $noindex = true;
        $this->request = $request;
        parent::__construct();
    }

    public function index()
    {

        $itemsEvents = ItemsEvents::where('published', 1)->where('role_id', $this->currentRole)->orderBy('id', 'desc')->limit(6)->get();

        User::checkInf();

        global $pageTitle;
        global $pageDescription;

        $pageTitle = 'Личный кабинет | SportCasta';
        $pageDescription = 'Личный кабинет ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        $view = 'learner.bookmarks';

        return view( $view,[
            'itemsEvents' => $itemsEvents,
        ]);
    }

}
