<?php

namespace App\Http\Controllers;

use App\ItemsFiles;
use Illuminate\Http\Request;
use App\Categories;
use App\Items;
use Auth;
use App\Orders;
use App\User;
use App\Shared;

class TrainingController extends Controller
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
        $categories = Categories::where('published', 1)
            ->where('is_video', 0)
            ->get();

        $title = 'Тренерская';

        global $pageTitle;
        global $pageDescription;

        $pageTitle = $title . ' смотреть на сайте | SportCasta';
        $pageDescription = $title . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';


        global $ogMeta;

        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        return view('trainer',[
            'categories' => $categories,
        ]);
    }

    public function search()
    {
        
        $categories = Categories::where('published', 1)->where('is_video', 0)->limit(6)->get();
        $popularItems = Items::with(['category' => function($query){
            $query->where('is_video', 0);
        }])
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->with('user')
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();

        $items = Items::with('user')
//            ->where('role_id', $this->currentRole)
            ->with(['category' => function($query){
                $query->where('is_video', 0);
            }])
            ->where('published', 1)
            ->whereNotIn('category_id', [11, 16, 14])
            ->sortable()
            ->orderBy('id', 'desc');


        if($this->request->exists('q')) {
            if(empty($this->request->get('q'))){

                return redirect($this->request->url());
            }

            $searchParams = explode(' ', $this->request->get('q'));

            $items->where(function($query) use ($searchParams){

                $query->where(function($subquery) use ($searchParams){
                    foreach($searchParams as $key){
                        if(trim($key) !== ''){
                            $subquery->orWhere('name', 'like', '%' . $key . '%');
                            $subquery->orWhere('fulltext', 'like', '%' . $key . '%');
                        }
                    }
                });
                $query->orWhereHas('user', function ($subquery) use ($searchParams) {
                    foreach($searchParams as $key){
                        if(trim($key) !== '') {
                            $subquery->where('name', 'like', '%' . $key . '%')
                                ->orWhere('lastname', 'like', '%' . $key . '%');
                        }
                    }
                });


            });

            $this->request->flashOnly('q');
        }else{
            return redirect()->back();
        }

        //if(Auth::guest()){
         //   $items = $items->limit(2)->get();
       // }else{
            $items = $items->paginate(5);
            $this->currentNumberPage = $items->currentPage();
            $this->lastNumberPage = $items->lastPage();
       // }

        global $noindex;

        $noindex = true;

        $title = 'Поиск';

        global $pageTitle;
        global $pageDescription;

        $pageTitle = $title . ' смотреть на сайте | SportCasta';
        $pageDescription = $title . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        global $ogMeta;

        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        $this->afterAction();

        return view('training', [
            'categories' => $categories,
            'popularItems' => $popularItems,
            'items' => $items,
        ]);
    }


    public function category($alias)
    {
        $category = Categories::where('alias', $alias)->first();


        $categories = Categories::where('published', 1)->where('is_video', 0)->limit(6)->get();
        $popularItems = Items::with(['category' => function($query){
            $query->where('is_video', 0);
        }])
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->where('created_at', '<=', date("Y-m-d H:i:s"))
//            ->whereNotIn('category_id', [11, 16, 14])
            ->with('user')
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();

        if(empty($category))
            abort(404);

        global $pageTitle;
        global $pageDescription;
        $pageTitle = $category['name'] . ' на онлайн портале | SportCasta';
        $pageDescription = $category['name'] . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        global $ogMeta;

        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        $items = Items::with('user')
            ->where('category_id', $category['id'])
            ->where('published', 1)
            ->where('created_at', '<=', date("Y-m-d H:i:s"))
//            ->where('role_id', $this->currentRole)
            ->sortable()
            ->with(['category' => function($query){
                $query->where('is_video', 0);
            }])
            ->orderBy('id', 'desc');

        if($category['id'] === 5){
            $items->where('is_type', 'book')->with('gallery');
//            $items->with(['files' => function($query){
//                $query->where('type_file', '0'); //book
//            }]);
        }

        if($this->request->exists('q')) {
            $searchParams = explode(' ', $this->request->get('q'));

            $items->where(function($query) use ($searchParams){

                $query->where(function($subquery) use ($searchParams){
                    foreach($searchParams as $key){
                        if(trim($key) !== ''){
                            $subquery->orWhere('name', 'like', '%' . $key . '%');
                            $subquery->orWhere('fulltext', 'like', '%' . $key . '%');
                        }
                    }
                });
                $query->orWhereHas('user', function ($subquery) use ($searchParams) {
                    foreach($searchParams as $key){
                        if(trim($key) !== '') {
                            $subquery->where('name', 'like', '%' . $key . '%')
                                ->orWhere('lastname', 'like', '%' . $key . '%');
                        }
                    }
                });


            });

            $this->request->flashOnly('q');
        }else{
            $items->with('user');
        }

       // if(Auth::guest()){
      //      $items = $items->limit(2)->get();
       // }else{
            $items = $items->paginate(5);
            $this->currentNumberPage = $items->currentPage();
            $this->lastNumberPage = $items->lastPage();
       // }


        $this->afterAction();

        return view('training', [
            'category' => $category,
            'categories' => $categories,
            'popularItems' => $popularItems,
            'items' => $items,
        ]);
    }


    public function article($alias)
    {
        $category = Categories::where('alias', $alias)->first();
        $categories = Categories::where('published', 1)->where('is_video', 0)->limit(6)->get();
        $popularItems = Items::with(['category' => function($query){
            $query->where('is_video', 0);
        }])
            ->with('user')
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();

        global $pageTitle;
        global $pageDescription;
        if(!empty($category['name_article'])){
            $category['name'] = $category['name_article'];
        }
        $pageTitle = $category['name_article'] . ' на онлайн портале | SportCasta';
        $pageDescription = $category['name_article'] . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        global $ogMeta;

        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;


        $items = Items::with('user')
            ->where('category_id', $category['id'])
            ->where('published', 1)
            ->with(['category' => function($query){
                $query->where('is_video', 0);
            }])
//            ->where('role_id', $this->currentRole)
            ->sortable()
            ->orderBy('id', 'desc');

        if($category['id'] === 5){
//            $items = $items->with(['files' => function($query){
//                $query->where('type_file', '1'); //tutorials
//            }]);
            $items->where('is_type', 'tutorials')->with('gallery');
        }else{
            $items->where('is_type', 'article');
        }

        if($this->request->exists('q')) {
            if(empty($this->request->get('q'))){

                return redirect($this->request->url());
            }

            $searchParams = explode(' ', $this->request->get('q'));

            $items->where(function($query) use ($searchParams){

                $query->where(function($subquery) use ($searchParams){
                    foreach($searchParams as $key){
                        if(trim($key) !== ''){
                            $subquery->orWhere('name', 'like', '%' . $key . '%');
                            $subquery->orWhere('fulltext', 'like', '%' . $key . '%');
                        }
                    }
                });
                $query->orWhereHas('user', function ($subquery) use ($searchParams) {
                    foreach($searchParams as $key){
                        if(trim($key) !== '') {
                            $subquery->where('name', 'like', '%' . $key . '%')
                                ->orWhere('lastname', 'like', '%' . $key . '%');
                        }
                    }
                });


            });

            $this->request->flashOnly('q');
        }else{
            $items->with('user');
        }


       // if(Auth::guest()){
       //     $items = $items->limit(2)->get();
       // }else{
            $items = $items->paginate(5);
            $this->currentNumberPage = $items->currentPage();
            $this->lastNumberPage = $items->lastPage();
       // }

        $this->afterAction();


        return view('training', [
            'category' => $category,
            'categories' => $categories,
            'popularItems' => $popularItems,
            'items' => $items,
        ]);
    }

    public function briefcases($alias)
    {
        $category = Categories::where('alias', $alias)->first();
        $categories = Categories::where('published', 1)->where('is_video', 0)->limit(6)->get();
        $popularItems = Items::with(['category' => function($query){
            $query->where('is_video', 0);
        }])
            ->with('user')
            ->where('published', 1)
//            ->where('role_id', $this->currentRole)
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();

        global $pageTitle;
        global $pageDescription;
        if(!empty($category['name_briefcases'])){
            $category['name'] = $category['name_briefcases'];
        }
        $pageTitle = $category['name_briefcases'] . ' на онлайн портале | SportCasta';
        $pageDescription = $category['name_briefcases'] . ' на ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        global $ogMeta;

        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        $items = Items::with('user')
            ->where('category_id', $category['id'])
            ->where('published', 1)
//            ->where('role_id', $this->currentRole)

            ->sortable()
            ->orderBy('id', 'desc');

        if($category['id'] === 5){
//            $items = $items->with(['files' => function($query){
//                $query->where('type_file', '2'); //paper
//            }]);
            $items->where('is_type', 'paper')->with('gallery');
        }else{
            $items->where('is_type', 'case');
        }



        if($this->request->exists('q')) {
            if(empty($this->request->get('q'))){

                return redirect($this->request->url());
            }

            $searchParams = explode(' ', $this->request->get('q'));

            $items->where(function($query) use ($searchParams){

                $query->where(function($subquery) use ($searchParams){
                    foreach($searchParams as $key){
                        if(trim($key) !== ''){
                            $subquery->orWhere('name', 'like', '%' . $key . '%');
                            $subquery->orWhere('fulltext', 'like', '%' . $key . '%');
                        }
                    }
                });
                $query->orWhereHas('user', function ($subquery) use ($searchParams) {
                    foreach($searchParams as $key){
                        if(trim($key) !== '') {
                            $subquery->where('name', 'like', '%' . $key . '%')
                                ->orWhere('lastname', 'like', '%' . $key . '%');
                        }
                    }
                });


            });

            $this->request->flashOnly('q');
        }else{
            $items->with('user');
        }

        ////if(Auth::guest()){
         //   $items = $items->limit(2)->get();
       // }else{
            $items = $items->paginate(5);
            $this->currentNumberPage = $items->currentPage();
            $this->lastNumberPage = $items->lastPage();
        //}

        $this->afterAction();


        return view('training', [
            'category' => $category,
            'categories' => $categories,
            'popularItems' => $popularItems,
            'items' => $items,
        ]);
    }

    public function video($alias)
    {
        $category = Categories::where('alias', $alias)->first();
        $categories = Categories::where('published', 1)->where('is_video', 0)->limit(6)->get();
        $popularItems = Items::with(['category' => function($query){
            $query->where('is_video', 0);
        }])
            ->with('user')
            ->where('published', 1)
//            ->where('role_id', $this->currentRole)
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();

        global $pageTitle;
        global $pageDescription;
        if(!empty($category['name_video'])){
            $category['name'] = $category['name_video'];
        }
        $pageTitle = $category['name_video'] . ' смотреть на сайте | SportCasta';
        $pageDescription = $category['name_video'] . ' ➤ Смотрите онлайн на сайте ✮ SportCasta ✮ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        global $ogMeta;

        $item['og_type'] = 'article';
        $item['intro'] = $pageDescription;
        $item['name'] = $pageTitle;
        $item['img'] = 'article-full-h.jpg';
        $ogMeta = $item;

        $items = Items::with('user')
            ->where('category_id', $category['id'])
            ->where('published', 1)
//            ->where('role_id', $this->currentRole)
            ->sortable()
            ->orderBy('id', 'desc');

        if($category['id'] === 5){
//            $items = $items->with(['files' => function($query){
//                $query->where('type_file', '3'); //benefits
//            }]);
            $items->where('is_type', 'benefits')->with('gallery');
        }else{
            $items->where('video', '<>', null);
        }


        if($this->request->exists('q')) {
            if(empty($this->request->get('q'))){

                return redirect($this->request->url());
            }

            $searchParams = explode(' ', $this->request->get('q'));

            $items->where(function($query) use ($searchParams){

                $query->where(function($subquery) use ($searchParams){
                    foreach($searchParams as $key){
                        if(trim($key) !== ''){
                            $subquery->orWhere('name', 'like', '%' . $key . '%');
                            $subquery->orWhere('fulltext', 'like', '%' . $key . '%');
                        }
                    }
                });
                $query->orWhereHas('user', function ($subquery) use ($searchParams) {
                    foreach($searchParams as $key){
                        if(trim($key) !== '') {
                            $subquery->where('name', 'like', '%' . $key . '%')
                                ->orWhere('lastname', 'like', '%' . $key . '%');
                        }
                    }
                });


            });

            $this->request->flashOnly('q');
        }else{
            $items->with('user');
        }

        //if(Auth::guest()){
        //    $items = $items->limit(2)->get();
       // }else{
            $items = $items->paginate(5);
            $this->currentNumberPage = $items->currentPage();
            $this->lastNumberPage = $items->lastPage();
       // }

        $this->afterAction();

        return view('training', [
            'category' => $category,
            'categories' => $categories,
            'popularItems' => $popularItems,
            'items' => $items,
        ]);
    }

    public function view($alias, $view)
    {
        $categories = Categories::where('published', 1)->where('is_video', 0)->limit(6)->get();
        $popularItems = Items::with(['category' => function($query){
            $query->where('is_video', 0);
        }])
//            ->where('role_id', $this->currentRole)
            ->with('user')
            ->where('published', 1)
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();
        $item = Items::with('category')->with(['user' => function($query){
            $query->with(['expert' => function($inQuery){
                $inQuery->with('category');
            }]);
        }])->where('published', 1)->where('alias', $view)->first();
        if(empty($item))
            abort(404);




        global $ogMeta;

        $item['og_type'] = 'article';
        $ogMeta = $item;

        global $pageTitle;
        global $pageDescription;
        $pageTitle = $item['name'] . ' на онлайн портале | SportCasta';
        $pageDescription = $item['name'] . ' читайте на сайте ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';


        $shared = Shared::getShared($item['id']);

        $item->timestamps = false;
        $item->increment('views', 1);
        $item->timestamps = true;

        $items = Items::with('category')
            ->with('user')
            ->where('category_id', $item['category_id'])
//            ->where('role_id', $this->currentRole)
            ->where('published', 1)
            ->where('id', '!=', $item['id'])
            ->limit(3)
            ->get();

        global $schema;
        if($item['video']){
            $schema = $this->getSchemeOgranizationVideo($pageTitle, $item);
        }else{
            $schema = $this->getSchemeOgranization($pageTitle, $item);
        }


        return view('article-full', [
            'item' => $item,
            'items' => $items,
            'shared' => $shared,
            'categories' => $categories,
            'popularItems' => $popularItems
        ]);
    }

    public function getSchemeOgranization($title, $item)
    {

        $url = route('index', [],true);

        $created_at = date('Y-m-d', strtotime($item['created_at'])) . 'T' . date('H:i:s+00:00', strtotime($item['created_at']));
        $updated_at = date('Y-m-d', strtotime($item['updated_at'])) . 'T' . date('H:i:s+00:00', strtotime($item['updated_at']));


        return '
        <script type="application/ld+json">
            {
                "@context": "https://schema.org/",
                "@type": "Article",
                "mainEntityOfPage": {
                    "@type": "WebPage",
                    "@id": "' . route('training/view', ['alias' => $item['category']['alias'] ,'view' => $item['alias']]) . '"
                },
                "headline": "' . $item['name'] . '",
                "description": "' . strip_tags($item['intro']) . '",
                "image": {
                    "@type": "ImageObject",
                    "url": "' . $url . '/img/' . $item['img'] . '",
                    "height": 800,
                    "width": 800
                },
                "author": {
                    "@type": "Person",
                    "name": "' . $item['user']['name'] . '"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "Онлайн портал Sport Casta | Sport Casta",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "' . $url . '/img/logo.png",
                        "width": 600,
                        "height": 60
                    }
                },
                "datePublished" : "' . $created_at . '",
                "dateCreated" : "' . $created_at . '",
                "dateModified": "' . $updated_at . '"
            }
        </script>
        ';
    }

    public function getSchemeOgranizationVideo($title, $item)
    {

        $url = route('index', [],true);

        $created_at = date('Y-m-d', strtotime($item['created_at'])) . 'T' . date('H:i:s+00:00', strtotime($item['created_at']));

        return '
        <script type="application/ld+json">
            {
              "@context": "http://schema.org",
              "@type": "MusicGroup",
              "name": "' . $item['name'] . '",
              "video": {
                "@type": "VideoObject",
                "description": "' . strip_tags($item['intro']) . '",
                "duration": "T1M33S",
                "name": "' . $item['name'] . '",
                "thumbnail": "' . $url . '/img/' . $item['img'] . '",
                "isFamilyFriendly": "true",
                "uploadDate": "' . $created_at . '"
              }
            }
        </script>
        ';
    }

    public function social(Request $request)
    {

        if($request->method('ajax')){
            $post_id = $request->input('post_id');
            $social = $request->input('social');
            $success_social = ['facebook', 'vk', 'twitter', 'google', 'telegram'];

            if(!Auth::guest())
                $check = Shared::where('post_id', $post_id)->where('user_id', Auth::user()->id)->where('social', $social)->first();

            if( in_array($social, $success_social) && !Auth::guest()){
                Shared::create(['post_id' => $post_id, 'user_id' => Auth::user()->id, 'social' => $social]);
                if( strcmp($success_social[2], $social) !== 0 ){
                    if( empty( $check ) && isset($check)){
                        Orders::create([
                            'bonus' => '20',
                            'user_id' => Auth::user()->id,
                            'deal' => User::BonusInf()[15] . $post_id . ' в ' . $social,
                            'status' => 1,
                            'dt' => date('Y-m-d H:i:s')
                        ]);
                        Auth::user()->increment('balance', 20);
                    }
                }
            }

            if( in_array($social, $success_social) && Auth::guest() ){
                Shared::create(['post_id' => $post_id, 'user_id' => 0, 'social' => $social]);
            }
        }
    }

    public function file($alias)
    {
        $file = ItemsFiles::where('id', $alias)->first();

        $filePath = public_path() . '/../storage/app/public/lib/' . $file->path;


        $this->file_force_download($filePath);

        return redirect()->back();
    }

    public function file_force_download($file)
    {
        if (file_exists($file)) {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // читаем файл и отправляем его пользователю
            readfile($file);
        }
    }
}
