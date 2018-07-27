<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Cookie;
use Auth;

class IndexController extends Controller
{
    public $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct();
    }

    public function index()
    {
        $title = 'Онлайн портал SportCasta';

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

        global $schema;

        $schema = $this->getSchemeOgranization($pageTitle);

        if($this->request->has('a')){
            $a = $this->request->get('a');
            $user = User::where('referal', $a)->first();
            if(Auth::guest()){
                setcookie('Referal[user_id]', $user->id, time()+60*60*24*365);
                setcookie('Referal[referal]', $a, time()+60*60*24*365);


            }
        }




        return view('main');
    }

    public function privacy()
    {
        $title = 'Privacy policy SportCasta';


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

        global $schema;

        $schema = $this->getSchemeOgranization($pageTitle);

        return view('index/privacy', [
            'title' => $title,
        ]);
    }

    public function getSchemeOgranization($title)
    {

        $url = route('index', [],true);

        return '
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "WebSite",
                "name": "' . $title . '",
                "url": "' . $url . '",
                "potentialAction": {
                    "@type": "SearchAction",
                    "target": "' . route("training/search", [], true) . '?q={search_term}",
                    "query-input": "required name=search_term"
                }
            }
            </script>

            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Organization",
                "name": "' . $title . '",
                "url": "' . $url . '",
                "logo": "' . $url . '/img/logo.png",
                "sameAs": [
                  "https://www.facebook.com/pg/sportcasta/",
"https://www.instagram.com/sportcasta/"
                ]
            }
            </script>
        ';
    }
}
