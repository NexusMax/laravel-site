<?php

use App\User;

use Jenssegers\Date\Date;

Date::setLocale('ru');
?>
@extends('layouts.learner')

@section('content')
    <main class="dashboard-main">
        <div class="dashboard container">
            <div class="testing-top">
                <a href="{{route('step',['step' => 3])}}" class="button-back">
                    <i class="fa fa-long-arrow-left"></i>
                    Назад к анкете
                </a>
                <span class="account-title">Тест на определения уровня физической подготовленности</span>
            </div>

            <div class="db-container">
                <div class="tests-content tests-content-result">
                    <img src="img/icons/brawn.svg" class="svg" alt="">
                    <p style="text-align: center">Ваш уровень физической подготовленности</p>
                    <h2>удовлетворительный</h2>
                    <p>Рекомендуем упражнения и тренировки начального уровня.</p>
                    <p>Quo id purto inani. Assum percipitur necessitatibus has ea, in justo causae electram pro. Appetere abhorreant vis ut, minimum prodesset dissentiet mea ex. Offendit sapientem repudiare et eum.</p>
                    <p>Mel ne nonumes intellegat expetendis. Te qui feugiat inimicus. Usu in habemus explicari similique. Has ei eius nostrud tractatos. Ut erant dicant mollis eum.</p>
                    <p>Prima equidem eos in, mei augue offendit ex, posse noster ceteros mea ei. Eligendi epicurei maiestatis vix no. Et eam duis aeterno, dicta detraxit definitionem pro no. Molestiae voluptatum eam no. Pri summo minimum constituam ne.</p>
                    <p>Ei prima quando eirmod est, vim semper legimus recusabo id. Ea ius quod iisque singulis, inermis rationibus ad pri, atqui nostro omnium an nec. His bonorum feugait ex, an dolore corpora mel, has in quidam dictas repudiare. Sit mundi verterem incorrupte id, duo solet nostro adversarium ea. Putent viderer aliquando vix an, quodsi aliquam omnesque at vix.</p>
                </div>
            </div>

            @include('partials.events',[
                'itemsEvents' => $itemsEvents
            ])
        </div>
    </main>
@endsection