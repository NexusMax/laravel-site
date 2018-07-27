<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use App\User;
use App\ExpertsGroup;
use App\Experts;

class ExpertsController extends Controller
{
    public $request;
	
	public function __construct(Request $request)
    {
        $this->request = $request;

        parent::__construct();
    }

    public function index()
    {

        $title = 'Наши эксперты';

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



        $items = Experts::where('active', 1)
            ->with('userWithItems')
            ->with('category');


        return view('experts/view', [
            'items' => $items->get(),
        ]);
    }

    public function fitness()
    {

        $title = 'Фитнес эксперты';

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

        $lilia = User::where('id', 31)->first();
        $alexandr = User::where('id', 55)->first();
        $artur = User::where('id', 35)->first();
        $ekaterina = User::where('id', 41)->first();
        $serhii = User::where('id', 45)->first();

        $items = Items::with('user')
            ->with('category')
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->orderBy('id', 'desc')
            ->limit(4);
        if(!empty($alexandr)){
            $items = $items->where('author_id', $alexandr['id']);
        }

        $items_2 = Items::with('user')
            ->with('category')
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->orderBy('id', 'desc')
            ->limit(4);
        if(!empty($lilia)){
            $items_2 = $items_2->where('author_id', $lilia['id']);
        }

        $items_3 = Items::with('user')->with('category')
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->orderBy('id', 'desc')
            ->limit(4);
        if(!empty($artur)){
            $items_3 = $items_3->where('author_id', $artur['id']);
        }


        $items_4 = Items::with('user')->with('category')
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->orderBy('id', 'desc')
            ->limit(4);
        if(!empty($ekaterina)){
            $items_4 = $items_4->where('author_id', $ekaterina['id']);
        }

        $items_9 = Items::with('user')->with('category')
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->orderBy('id', 'desc')
            ->limit(4);
        if(!empty($serhii)){
            $items_9 = $items_9->where('author_id', $serhii['id']);
        }


        return view('experts/fitness',[
            'items' => $items->get(),
            'items_2' => $items_2->get(),
            'items_3' => $items_3->get(),
            'items_4' => $items_4->get(),
            'items_9' => $items_9->get()
        ]);
    }

    public function nutritionist()
    {

        $title = 'Наши диетологи';

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

        $name = User::where('id', 43)->first();

        $items = Items::with('user')
            ->with('category')
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->orderBy('id', 'desc')
            ->limit(4);
        if(!empty($name)){
            $items = $items->where('author_id', $name['id']);
        }


        return view('experts/nutritionist',[
            'items' => $items->get(),
        ]);
    }

    public function psychologist()
    {

        $title = 'Наши психологи';

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

        $name = User::where('id', 32)->first();

        $items = Items::with('user')
            ->with('category')
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->orderBy('id', 'desc')
            ->limit(4);
        if(!empty($name)){
            $items = $items->where('author_id', $name['id']);
        }


        return view('experts/psychologist',[
            'items' => $items->get(),
        ]);
    }

    public function physicalTherapist()
    {

        $title = 'Наши физические терапевты';

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

        $name = User::where('id', 133)->first();
        $artem = User::where('id', 74)->first();

        $items = Items::with('user')
            ->with('category')
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->orderBy('id', 'desc')
            ->limit(4);
        if(!empty($name)){
            $items = $items->where('author_id', $name['id']);
        }

        $items_8 = Items::with('user')
            ->with('category')
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->orderBy('id', 'desc')
            ->limit(4);
        if(!empty($artem)){
            $items_8 = $items_8->where('author_id', $artem['id']);
        }


        return view('experts/physical-therapist',[
            'items' => $items->get(),
            'items_8' => $items_8->get()
        ]);
    }

    public function category($alias)
    {
        $category = ExpertsGroup::where('alias', $alias)->first();
        if(empty($category))
            abort(404);

        global $pageTitle;
        global $pageDescription;
        $pageTitle = $category->name . ' | SportCasta';
        $pageDescription = $category->name . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        global $ogMeta;
        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        $items = Experts::where('group_id', $category->id)
            ->where('active', 1)
            ->with('userWithItems')
        ->with('category');

        return view('experts/view', [
            'items' => $items->get(),
            'category' => $category,
        ]);
    }
}
