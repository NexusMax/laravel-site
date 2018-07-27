<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Experts;

class AboutController extends Controller
{
	public $request;
	
	public function __construct(Request $request)
    {
        $this->request = $request;

        parent::__construct();
    }

    public function index()
    {
        $title = 'О нас';

        global $pageTitle;
        global $pageDescription;

        $pageTitle = $title . ' | SportCasta';
        $pageDescription = $title . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';


        global $ogMeta;

        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        $team = Experts::with('user')->with('category')->where('active', 1)->orderBy('position', 'asc')->get()->toArray();


        return view('about', ['team' => $team]);
    }
}
