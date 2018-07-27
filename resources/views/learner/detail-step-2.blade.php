<?php

use App\User;

use Jenssegers\Date\Date;

Date::setLocale('ru');
?>
@extends('layouts.learner')

@section('content')
    <main class="dashboard-main">
        <div class="dashboard container">
            <div class="row">
                <div class="dashboard-wrapper">

                    @include('partials.left-menu',[])
                    <div class="db-content">

                        <div class="db-container">
                            <div class="detail-info-progressbar">
                                <div class="progress-line">
                                    <div class="progressbar" style="width: 25%;"></div>
                                </div>
                                <a href="{{ route('detail') }}" class="detail-info-step check">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/fingerprint.svg" class="svg svg-default" alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Персональные данные</span>
                                </a>
                                <a href="{{ route('step',['step' => 2 ]) }}"  class="detail-info-step active">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/target.svg" class="svg svg-rotate svg-default"
                                             alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Цель</span>
                                </a>
                                <a href="{{ route('step',['step' => 3 ]) }}"  class="detail-info-step">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/muscles.svg" class="svg svg-default" alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Физическое состояние</span>
                                </a>
                                <a href="{{ route('step',['step' => 4 ]) }}"  class="detail-info-step">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/cardiogram.svg" class="svg svg-default" alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Здоровье</span>
                                </a>
                                <a href="{{ route('step',['step' => 5 ]) }}"  class="detail-info-step">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/fitness.svg" class="svg svg-default" alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Телосложение</span>
                                </a>
                            </div>
                            <div class="personal-data">
                                <span class="account-title">Цель <em>(Выберите один из вариантов)</em></span>
                                <div class="goal-select-wrapper">
                                    <div class="cattegory-item cattegory-item-click">
                                        <div class="mask-cat">
                                            <img src="/../../img/tr1.jpg" alt="" class="img-bg">
                                            <div class="icon-wrapper">
                                                <div class="checkmark draw"></div>
                                            </div>
                                            <div class="text-goal-wrapper">
                                                <h3>Снижение общей массы тела, похудеть</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam
                                                    velit, vulputate eu pharetra nec, mattis ac neque.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cattegory-item cattegory-item-click">
                                        <div class="mask-cat">
                                            <img src="/../../img/tr1.jpg" alt="" class="img-bg">
                                            <div class="icon-wrapper">
                                                <div class="checkmark draw"></div>
                                            </div>
                                            <div class="text-goal-wrapper">
                                                <h3>Форма и рельеф</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam
                                                    velit, vulputate eu pharetra nec, mattis ac neque.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cattegory-item cattegory-item-click">
                                        <div class="mask-cat">
                                            <img src="/../../img/tr1.jpg" alt="" class="img-bg">
                                            <div class="icon-wrapper">
                                                <div class="checkmark draw"></div>
                                            </div>
                                            <div class="text-goal-wrapper">
                                                <h3>Проработка отдельных мышечных групп</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam
                                                    velit, vulputate eu pharetra nec, mattis ac neque.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cattegory-item cattegory-item-click">
                                        <div class="mask-cat">
                                            <img src="/../../img/tr1.jpg" alt="" class="img-bg">
                                            <div class="icon-wrapper">
                                                <div class="checkmark draw"></div>
                                            </div>
                                            <div class="text-goal-wrapper">
                                                <h3>Коррекция осанки и улучшение здоровья ОДА</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam
                                                    velit, vulputate eu pharetra nec, mattis ac neque.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('step',['step' => 3 ]) }}">
                            <div class="next-step-button">
                                <button class="btn" value="Далее">Далее</button>
                            </div>
                        </a>

                    </div>


                </div>
            </div>


            @include('partials.events',[
                'itemsEvents' => $itemsEvents
            ])
        </div>
    </main>
    <script type="text/javascript">
        var healhvalue = 1;
        var rangevalue = 1;
        var expvalue = 1;
    </script>
@endsection