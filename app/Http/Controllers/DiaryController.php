<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemsEvents;
use Auth;
use App\User;


class DiaryController extends Controller
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


        $physicalChart = $this->getChartData();

        $itemsEvents = ItemsEvents::where('published', 1)->where('role_id', $this->currentRole)->orderBy('id', 'desc')->limit(6)->get();

        User::checkInf();

        global $pageTitle;
        global $pageDescription;

        $pageTitle = 'Личный кабинет | SportCasta';
        $pageDescription = 'Личный кабинет ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        $view = 'learner.diary';

        return view($view, [
            'itemsEvents' => $itemsEvents,
            'physicalChart' => $physicalChart
        ]);
    }

    private function getChartData()
    {
        /**
         * @var \App\User $user
         */
        $user = Auth::user();
        $data = $user->physicalMetrics()->orderBy('created_at', 'desc')->limit(12)->get();

        $ruffier_index = [];
        $flexibility = [];
        $pushups = [];
        $twisting = [];
        $situp = [];
        $plank = [];
        $swallow = [];

        foreach ($data as $row) {
            $ruffier_index[] = $row->ruffier_index;
            $flexibility[] = $row->flexibility;
            $pushups[] = $row->pushups;
            $twisting[] = $row->twisting;
            $situp[] = $row->situp;
            $plank[] = $row->plank;
            $swallow[] = $row->swallow;
        }

        $datasets = [
            [
                'data' => $ruffier_index,
                'label' => 'Проба Руфье',
                'borderColor' => '#24ba9b',
                'fill' => false
            ],
            [
                'data' => $flexibility,
                'label' => 'Гибкость',
                'borderColor' => '#a8b3ba',
                'fill' => false
            ],
            [
                'data' => $pushups,
                'label' => 'Отжимания',
                'borderColor' => '#f33',
                'fill' => false
            ],
            [
                'data' => $twisting,
                'label' => 'Сит-апы',
                'borderColor' => '#f68e56',
                'fill' => false
            ],
            [
                'data' => $situp,
                'label' => 'Приседания',
                'borderColor' => '#0072bc',
                'fill' => false
            ],
            [
                'data' => $plank,
                'label' => 'Планка',
                'borderColor' => '#8560a8',
                'fill' => false
            ],
            [
                'data' => $swallow,
                'label' => 'Ласточка',
                'borderColor' => '#00bff3',
                'fill' => false
            ]



        ];

        return json_encode($datasets,JSON_UNESCAPED_UNICODE);



    }

}
