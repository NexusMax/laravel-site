<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Items;

class QuestionsController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        parent::__construct();
    }

    public function index()
    {
        $categories = Categories::where('published', 1)->limit(6)->get();
        $popularItems = Items::with('category')
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->with('user')
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();

        if($this->request->exists('q')) {
            return redirect(route('training/search', ['q' => $this->request->get('q')]));
        }
        $items = '';

        $title = 'Вопрос/ответ';

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



        return view('questions/index',[
            'categories' => $categories,
            'popularItems' => $popularItems,
            'items' => $items,
            'voprosOtvet' => Items::where('alias', 'vopros-otvet')->first(),
        ]);
    }
}
