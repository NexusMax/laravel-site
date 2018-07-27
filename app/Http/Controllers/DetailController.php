<?php

namespace App\Http\Controllers;

use App\ExtraUser;
use App\HealthMetricsHistory;
use App\PhysicalMetricsHistory;
use Illuminate\Http\Request;
use App\ItemsEvents;
use App\User;
use Illuminate\Support\Facades\Auth;


class DetailController extends Controller
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

        /** @var User $user */
        $user = Auth::user();

        $extraFields = $user->extraFields()->first();

        if (!$extraFields) {
            $extraFields = new ExtraUser();
            $extraFields->initNewUser($user->id);
            $extraFields->save();
        }

        global $pageTitle;
        global $pageDescription;

        $pageTitle = 'Личный кабинет | SportCasta';
        $pageDescription = 'Личный кабинет ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        $view = 'learner.detail';

        return view($view, [
            'itemsEvents' => $itemsEvents,
            'extraFields' => $extraFields,
            'user' => $user
        ]);
    }

    public function step(Request $request)
    {
        $step = $request->step;

        /** @var User $user */
        $user = Auth::user();

        $extraFields = $user->extraFields()->first();

        $physical_days = $extraFields->getPhysicalDays();
        $health_muscule = $extraFields->getMusculoskeletal();
        $health_cardio = $extraFields->getCardio();
        $health_meta = $extraFields->getMetabolism();
        $health_nerv = $extraFields->getNervous();


        // Page 5 -> 6
        if ($step == 6 && $request->method() == 'POST') {
            $extraFields->body_type = $request->bodytype;
            $extraFields->wrist_size = $request->wristsize;
            $extraFields->save();
        }

        // Page 4 -> 5
        if ($step == 5 && $request->method() == 'POST') {
            $extraFields->health_level = $this->determinateHealthLevel($request->healthlevel);
            $extraFields->setPhysicalDays($request->muscule);
            $extraFields->setCardio($request->cardio);
            $extraFields->setMusculoskeletal($request->meta);
            $extraFields->setMetabolism($request->nerv);
            $extraFields->health_cardio_custom = ($request->cardiocustom) ? $request->cardiocustom : '';
            $extraFields->health_nervous_custom = ($request->nervcustom) ? $request->nervcustom : '';

            $extraFields->save();
        }

        // Page 3 -> 4
        if ($step == 4 && $request->method() == 'POST') {

            $extraFields->physical_level = $this->determinatePhysicalLevel($request->physicallevel);
            $extraFields->physical_exp_years = $this->determinatePhysicalExpYears($request->physicalexpyears);
            $extraFields->setPhysicalDays($request->day);

            $extraFields->save();
        }

        // Page 1 -> 2
        if ($step == 2 && $request->method() == 'POST') {
            $user->name = $request->firstname;
            $user->lastname = $request->lastname;
            $user->gender = $request->gender;
            $user->save();

            $extraFields->nickname = ($request->nickname) ? $request->nickname : '';
            $extraFields->growth = ($request->growth) ? $request->growth : '';
            $extraFields->weight = ($request->weight) ? $request->weight : '';

            $extraFields->save();
        }


        $itemsEvents = ItemsEvents::where('published', 1)->where('role_id', $this->currentRole)->orderBy('id', 'desc')->limit(6)->get();

        User::checkInf();

        global $pageTitle;
        global $pageDescription;

        $pageTitle = 'Личный кабинет | SportCasta';
        $pageDescription = 'Личный кабинет ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        $view = "learner.detail-step-{$step}";

        return view($view, [
            'itemsEvents' => $itemsEvents,
            'extraFields' => $extraFields,
            'user' => $user,
            'physical_days' => $physical_days,
            'health_muscule' => $health_muscule,
            'health_cardio' => $health_cardio,
            'health_meta' => $health_meta,
            'health_nerv' => $health_nerv,
        ]);

    }

    private function determinateHealthLevel($data)
    {
        preg_match("#(.*);#", $data, $health_level);
        $health_level = $health_level[1];

        switch ($health_level) {
            case  'плохое':
                return 1;
                break;

            case  'хорошее':
                return 2;
                break;

            case  'отличное':
                return 3;
                break;
        }

        return 1;
    }

    private function determinatePhysicalLevel($data)
    {
        preg_match("#(.*);#", $data, $physical_level);
        if (isset($physical_level[1])) {
            $physical_level = $physical_level[1];
            switch ($physical_level) {
                case  'плохое':
                    return 1;
                    break;

                case  'хорошее':
                    return 2;
                    break;

                case  'отличное':
                    return 3;
                    break;
            }


        }

    }

    private function determinatePhysicalExpYears($data)
    {
        preg_match("#(.*);#", $data, $physical_exp_years);
        if (isset($physical_exp_years[1])) {
            $physical_exp_years = $physical_exp_years[1];
            switch ($physical_exp_years) {
                case '0 лет':
                    return 0;
                    break;

                case '3 года':
                    return 1;
                    break;

                case '6 лет':
                    return 2;
                    break;
            }
        }


    }

    public function physicalStep(Request $request)
    {
        $step = $request->step;

        /** @var User $user */
        $user = Auth::user();

        $extraFields = $user->extraFields()->first();
        $physicalMetricsLast = $user->physicalMetrics()->orderBy('created_at', 'desc')->first();

        if (!$physicalMetricsLast) {

            $physicalMetricsLast = new PhysicalMetricsHistory();
            $physicalMetricsLast->initNewUser($user->id);
            $physicalMetricsLast->save();
        } elseif (!empty($physicalMetricsLast->result)) {
            // Запись есть, но тест уже закончен - проходим новый используя результаты старого как базовые значения
            $physicalMetrics = new PhysicalMetricsHistory();
            $physicalMetricsLast = $physicalMetrics->cloneFromLast($physicalMetricsLast);
            $physicalMetricsLast->save();
        }

        // Page 1 -> 2
        if ($step == 2 && $request->method() == 'POST') {
            $physicalMetricsLast->ruffier_p1 = $request->p1;
            $physicalMetricsLast->ruffier_p2 = $request->p2;
            $physicalMetricsLast->ruffier_p3 = $request->p3;

            $physicalMetricsLast->ruffier_index = round((4 *  ($request->p1 + $request->p2 + $request->p3) - 200) / 10);

            $physicalMetricsLast->save();

        }

        // Page 2 -> 3
        if ($step == 3 && $request->method() == 'POST') {
            if (isset($request->flexibility[0]))
                $physicalMetricsLast->flexibility = $request->flexibility[0];
            $physicalMetricsLast->save();
        }

        // Page 3 -> 4
        if ($step == 4 && $request->method() == 'POST') {
            $physicalMetricsLast->pushups = $request->pushups;
            $physicalMetricsLast->save();

        }

        // Page 4 -> 5
        if ($step == 5 && $request->method() == 'POST') {
            $physicalMetricsLast->twisting = $request->twisting;
            $physicalMetricsLast->save();
        }

        // Page 5 -> 6
        if ($step == 6 && $request->method() == 'POST') {
            $physicalMetricsLast->situp = $request->situp;
            $physicalMetricsLast->save();
        }

        // Page 6 -> 7
        if ($step == 7 && $request->method() == 'POST') {
            $physicalMetricsLast->plank = $request->plank;
            $physicalMetricsLast->save();
        }

        if ($step == 8 && $request->method() == 'POST') {
            if (isset($request->swallow[0]))
                $physicalMetricsLast->swallow = $request->swallow[0];

            $physicalMetricsLast->result = 'done';
            $physicalMetricsLast->save();


        }

        $itemsEvents = ItemsEvents::where('published', 1)->where('role_id', $this->currentRole)->orderBy('id', 'desc')->limit(6)->get();

        User::checkInf();

        global $pageTitle;
        global $pageDescription;

        $pageTitle = 'Личный кабинет | SportCasta';
        $pageDescription = 'Личный кабинет ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';
        if ($step)
            $view = "learner.physical-test-step-{$step}";
        else
            $view = "learner.physical-test-step-1";

        return view($view, [
            'itemsEvents' => $itemsEvents,
            'physicalMetricsLast' => $physicalMetricsLast,
        ]);
    }

    public function health(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $extraFields = $user->extraFields()->first();
        $healthMetricsLast = $user->healthMetrics()->orderBy('created_at', 'desc')->first();

        if (!$healthMetricsLast) {
            $healthMetricsLast = new HealthMetricsHistory();
            $healthMetricsLast->initNewUser($user);
            $healthMetricsLast->save();
        }

        if ($request->method() == 'POST') {
            $healthMetricsLast = new HealthMetricsHistory();
            $healthMetricsLast->initNewUser($user);

            $healthMetricsLast->growth = $request->growth;
            $healthMetricsLast->height = $request->height;
            $healthMetricsLast->pressure_sys = $request->pressuresys;
            $healthMetricsLast->pressure_dia = $request->pressuredia;
            $healthMetricsLast->smoking = $request->smoking;
            $healthMetricsLast->alcohol = $request->alcohol;
            $healthMetricsLast->pulse_rest = $request->pulserest;
            $healthMetricsLast->pulse_regen = $request->pulseregen;

            if (isset($request->stamina[0]))
                $healthMetricsLast->stamina = $request->stamina[0];

            $healthMetricsLast->save();

            $result = $this->calculateContrex();

            $healthMetricsLast->result = $result;

            if ($result < 30)
                $extraFields->health_level = '1';

            if ($result > 30 && $result < 170)
                $extraFields->health_level = '2';

            if ($result > 170)
                $extraFields->health_level = '3';

            $extraFields->save();


            return redirect()->route('step', ['step' => 4]);
        }


        $itemsEvents = ItemsEvents::where('published', 1)->where('role_id', $this->currentRole)->orderBy('id', 'desc')->limit(6)->get();
        User::checkInf();

        global $pageTitle;
        global $pageDescription;

        $pageTitle = 'Личный кабинет | SportCasta';
        $pageDescription = 'Личный кабинет ✮ SportCasta ✮ ➤ Все секреты тренировок ✔ Видеоуроки ✔ Советы тренерам ✔ Как организовать питание ✔ Набор массы ✔ Похудение ✔  Общение с профессиональными тренерами ➤ Все ответы на онлайн-портале для настоящих спортсменов ✮ SportCasta ✮';

        $view = "learner.health";

        return view($view, [
            'itemsEvents' => $itemsEvents,
            'extraFields' => $extraFields,
            'healthMetricsLast' => $healthMetricsLast
        ]);
    }

    private function getAge($birthday){

        $year = date('Y', strtotime($birthday));

        return  (date('Y') - $year);
    }

    private function calculatePhysicalState()
    {

    }

    private function calculateContrex()
    {
        /** @var User $user */
        $user = Auth::user();

        $extraFields = $user->extraFields()->first();
        $healthMetrics = $user->healthMetrics()->orderBy('created_at', 'desc')->first();

        // Возраст
        $points = 0;
        $age = $this->getAge($user->birthday);
        $points += $age;

        // Масса тела
        $genderWeightRate = ($user->gender == 0) ? 0.75 : 0.32;

        $normalWeight = (50 + ($healthMetrics->growth - 150));// * $genderWeightRate ) + (($age - 21) / 5);

        $points += 30;

        if ($healthMetrics->height > $normalWeight) {
            $over = $healthMetrics->height - $normalWeight;
            $points -= ($over * 5);
        }

        // Давление

        if ($user->gender == 0) {
            $normalPressureSys = 109 + 0.5 * $age * 0.1 * $healthMetrics->height;
            $normalPressureDia = 74 + 0.1 * $age * 0.15 * $healthMetrics->height;
        } else {
            $normalPressureSys = 102 + 0.7 * $age * 0.15 * $healthMetrics->height;
            $normalPressureDia = 78 + 0.17 * $age * 0.1 + $healthMetrics->height;
        }

        $points += 30;

        if ($healthMetrics->pressure_sys > $normalPressureSys) {
            $over = round(($healthMetrics->pressure_sys - $normalPressureSys) / 5);
            $points -= $over;
        }

        if ($healthMetrics->pressure_dia > $normalPressureDia) {
            $over = round(($healthMetrics->pressure_dia - $normalPressureDia) / 5);
            $points += $over;
        }

        // smoking

        $points += 30 - $healthMetrics->smoking;

        // alcohol
        $points += 30 - (round($healthMetrics->alcohol / 100) * 2);

        // pulse rest

        if ($healthMetrics->pulse_rest < 90) {
            $points += (90 - $healthMetrics->pulse_rest);
        }

        // pulse regen
        $pulseDiff = $healthMetrics->pulse_rest - $healthMetrics->pulse_regen;

        if ($pulseDiff < 10)
            $points += 30;

        if ($pulseDiff > 10 && $pulseDiff <= 15)
            $points += 10;

        if ($pulseDiff > 15 && $pulseDiff <= 20)
            $points += 5;

        if ($pulseDiff > 20)
            $points -= 10;

        // stamina

        if ($healthMetrics->stamina == 1 || $healthMetrics->stamina == 2)
            $points += 25;
        if ($healthMetrics->stamina == 3)
            $points += 20;
        if ($healthMetrics->stamina == 4)
            $points += 10;
        if ($healthMetrics->stamina == 5)
            $points += 5;


        return $points;


    }

}
