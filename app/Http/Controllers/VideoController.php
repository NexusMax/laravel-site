<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use App\Categories;

class VideoController extends Controller
{
    protected $request;
    protected $currentNumberPage = 0;
    protected $lastNumberPage = 0;

    public function __construct(Request $request)
    {
        $this->request = $request;

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

        parent::__construct();
    }

    public function afterAction()
    {
        global $linkNextPrev;
        if($this->request->exists('page')){

            global $noindex;

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
        $categories = Categories::where('is_video', 1)->where('published', 1)->get();
        $categories_ids = [];
        foreach ($categories as $key){
            $categories_ids[] = $key->id;
        }

        $items = Items::with('user')
            ->with(['category' => function($query){
                $query->where('is_video', '1');
            }])
            ->whereIn('category_id', $categories_ids)
            ->where('published', 1)
            ->where('video', '<>', 'null')
//            ->where('role_id', $this->currentRole)
            ->orderBy('id', 'desc')
            ->sortable();

        if($this->request->exists('q')) {
            $items->where('name', 'like', '%' . $this->request->get('q') . '%');
            $this->request->flashOnly('q');
        }

        $items = $items->paginate(6);

        $title = 'Информативный видеоконтент от экспертов SportCasta';
        global $pageTitle;
        global $pageDescription;

        $pageTitle = $title . ' смотреть на сайте | SportCasta';
        $pageDescription = $title . ' ➤ Смотрите онлайн на сайте ✮ SportCasta ✮ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        global $ogMeta;

        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        $this->currentNumberPage = $items->currentPage();
        $this->lastNumberPage = $items->lastPage();
        $this->afterAction();

        return view('video',[
            'category' => '',
            'items' => $items,
            'videoCategory' => Categories::where('published', 1)->where('is_video', 1)->get()->toArray(),
            'title' => 'Информативный видеоконтент <br /> от экспертов SportCasta',
        ]);
    }

    public function category($alias)
    {

        $category = Categories::where('alias', 'like', '%' . $alias . '%')->where('is_video', '1')->first();
        $items = Items::with('user')
            ->with('category')
            ->where('published', 1)
            ->where('video', '<>', 'null')
            ->where('category_id', $category['id'])
//            ->where('role_id', $this->currentRole)
            ->sortable()
            ->orderBy('id', 'desc');

        if(empty($category))
            abort(404);

        if($this->request->exists('q')) {
            $items->where('name', 'like', '%' . $this->request->get('q') . '%');
            $this->request->flashOnly('q');
        }

        $items = $items->paginate(6);


        if(!empty($category['name_video'])){
            $title = 'Видеозаписи о ' . $category['name_video'];
        }else{
            $title = 'Видеозаписи о ' . $category['name'];
        }

        global $pageTitle;
        global $pageDescription;

        $pageTitle = $title . ' смотреть на сайте | SportCasta';
        $pageDescription = $title . ' ➤ Смотрите онлайн на сайте ✮ SportCasta ✮ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        global $ogMeta;

        $item['og_type'] = 'video';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        $this->currentNumberPage = $items->currentPage();
        $this->lastNumberPage = $items->lastPage();
        $this->afterAction();

        return view('video', [
            'category' => $category,
            'items' => $items,
            'videoCategory' => Categories::where('published', 1)->where('is_video', 1)->get()->toArray(),
            'title' => 'Информативный видеоконтент <br /> от экспертов SportCasta',
        ]);
    }
}
