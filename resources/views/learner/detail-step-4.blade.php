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
                        <form action="{{ route('step',['step' => 5]) }}" class="account-form" method="POST" enctype="multipart/form-data" id="myaccount-form-inf">
                            {{ csrf_field() }}
                        <div class="db-container">

                            <div class="detail-info-progressbar">
                                <div class="progress-line">
                                    <div class="progressbar" style="width: 75%;"></div>
                                </div>
                                <a href="{{ route('detail') }}" class="detail-info-step check">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/fingerprint.svg" class="svg svg-default" alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Персональные данные</span>
                                </a>
                                <a href="{{ route('step',['step' => 2 ]) }}"  class="detail-info-step check">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/target.svg" class="svg svg-rotate svg-default"
                                             alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Цель</span>
                                </a>
                                <a href="{{ route('step',['step' => 3 ]) }}"  class="detail-info-step check">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/muscles.svg" class="svg svg-default" alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Физическое состояние</span>
                                </a>
                                <a href="{{ route('step',['step' => 4 ]) }}"  class="detail-info-step active">
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
                            <div class="physical-state-row">
                                <span class="account-title">Здоровье</span>
                                <div class="physical-state-text">
                                    <em>Уровень здозовья</em>
                                    <p>(вы можете определить свойуровень, пройдя тест «Контрэкс-1»)</p>
                                </div>
                                <div class="level-range-wrapper d-flex-wrap">
                                    <div class="level-range">
                                        <input type="text" id="health-level" value="" name="healthlevel"/>
                                    </div>
                                    <a href="{{route('health')}}" class="btn-gray">Определить уровень</a>
                                </div>
                            </div>
                            <div class="physical-state-row">
                                <div class="physical-state-text">
                                    <em style="margin-bottom: 30px;">Особенности опорно-двигательного аппарата</em>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="checkbox-wrapper">
                                            <input id="health1" type="checkbox" name="muscule[]" value="1" @if (in_array("1",$health_muscule)) checked @endif>
                                            <label for="health1">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">грыжи</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health2" type="checkbox" name="muscule[]" value="2" @if (in_array("2",$health_muscule)) checked @endif>
                                            <label for="health2">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">грыжи Шморля</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health3" type="checkbox" name="muscule[]" value="3" @if (in_array("3",$health_muscule)) checked @endif>
                                            <label for="health3">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">артроз</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health4" type="checkbox" name="muscule[]" value="4" @if (in_array("4",$health_muscule)) checked @endif>
                                            <label for="health4">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">остеопороз</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox-wrapper">
                                            <input id="health5" type="checkbox" name="muscule[]" value="5" @if (in_array("5",$health_muscule)) checked @endif>
                                            <label for="health5">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">протрузии</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health6" type="checkbox" name="muscule[]" value="6" @if (in_array("6",$health_muscule)) checked @endif>
                                            <label for="health6">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">остеохондроз</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health7" type="checkbox" name="muscule[]" value="7" @if (in_array("7",$health_muscule)) checked @endif>
                                            <label for="health7">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">артрит</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health8" type="checkbox" name="muscule[]" value="8" @if (in_array("8",$health_muscule)) checked @endif>
                                            <label for="health8">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">боли в коленном суставе</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox-wrapper">
                                            <input id="health9" type="checkbox" name="muscule[]" value="9" @if (in_array("9",$health_muscule)) checked @endif>
                                            <label for="health9">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">боли в локтевом суставе</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health10" type="checkbox" name="muscule[]" value="10" @if (in_array("10",$health_muscule)) checked @endif>
                                            <label for="health10">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">боли в плечевом суставе</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health11" type="checkbox" name="muscule[]" value="11" @if (in_array("11",$health_muscule)) checked @endif>
                                            <label for="health11">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">боли в тазобедренном суставе</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health12" type="checkbox" name="muscule[]" value="12" @if (in_array("12",$health_muscule)) checked @endif>
                                            <label for="health12">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">другое</span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="physical-state-row">
                                <div class="physical-state-text">
                                    <em style="margin-bottom: 30px;">Особенности сердечно-сосудистой системы</em>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="checkbox-wrapper">
                                            <input id="health13" type="checkbox" name="cardio[]" value="1" @if (in_array("1",$health_cardio)) checked @endif>
                                            <label for="health13">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">сердечная недостаточность</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health14" type="checkbox" name="cardio[]" value="2" @if (in_array("2",$health_cardio)) checked @endif >
                                            <label for="health14">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">гипертония</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health15" type="checkbox" name="cardio[]" value="3" @if (in_array("3",$health_cardio)) checked @endif>
                                            <label for="health15">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">другое</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox-wrapper">
                                            <input id="health16" type="checkbox" name="cardio[]" value="4" @if (in_array("4",$health_cardio)) checked @endif>
                                            <label for="health16">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">инфаркт</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health17" type="checkbox" name="cardio[]" value="5" @if (in_array("5",$health_cardio)) checked @endif>
                                            <label for="health17">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">варикоз</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox-wrapper">
                                            <input id="health18" type="checkbox" name="cardio[]" value="6" @if (in_array("6",$health_cardio)) checked @endif>
                                            <label for="health18">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">ИБС</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health19" type="checkbox" name="cardio[]" value="7" @if (in_array("7",$health_cardio)) checked @endif>
                                            <label for="health19">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">нарушения сердечного ритма</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="search-holder">
                                    <input type="search" placeholder="Другие особенности сердечно-сосудистой системы " name="cardiocustom" value="{{$extraFields->health_cardio_custom}}">
                                </div>
                            </div>
                            <div class="physical-state-row">
                                <div class="physical-state-text">
                                    <em style="margin-bottom: 30px;">Особенности обмена веществ</em>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="checkbox-wrapper">
                                            <input id="health20" type="checkbox" name="meta[]" value="1" @if (in_array("1",$health_meta)) checked @endif>
                                            <label for="health20">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">ожирение</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox-wrapper">
                                            <input id="health21" type="checkbox" name="meta[]" value="2" @if (in_array("2",$health_meta)) checked @endif>
                                            <label for="health21">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">сахарный диабет</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox-wrapper">
                                            <input id="health22" type="checkbox" name="meta[]" value="3" @if (in_array("3",$health_meta)) checked @endif>
                                            <label for="health22">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">другие эндокринные заболевания</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="physical-state-row">
                                <div class="physical-state-text">
                                    <em style="margin-bottom: 30px;">Особенности нервной системы</em>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="checkbox-wrapper">
                                            <input id="health23" type="checkbox" name="nerv[]" value="1" @if (in_array("1",$health_nerv)) checked @endif>
                                            <label for="health23">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">инсульт</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input id="health24" type="checkbox" name="nerv[]" value="2" @if (in_array("2",$health_nerv)) checked @endif>
                                            <label for="health24">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">другое</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox-wrapper">
                                            <input id="health25" type="checkbox" name="nerv[]" value="3" @if (in_array("3",$health_nerv)) checked @endif>
                                            <label for="health25">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">ВСД</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox-wrapper">
                                            <input id="health26" type="checkbox" name="nerv[]" value="4" @if (in_array("4",$health_nerv)) checked @endif>
                                            <label for="health26">
														<span class="check-wrap">
															<div class="checkmark draw"></div>
														</span>
                                                <span class="health-text">невроз</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="search-holder">
                                    <input type="search" placeholder="Другие особенности нервной системы" name="nervcustom" value="{{$extraFields->health_nervous_custom}}">
                                </div>
                            </div>

                            @if ($user->gender == 1)
                            <div class="physical-state-row">
                                <div class="physical-state-text">
                                    <em style="margin-bottom: 30px;">Беременность</em>
                                </div>
                                <div class="sex-wrapper">
                                    <div class="sex-input radio-input-wrapper">
                                        <input id="pregnancy1" type="radio" name="pregnancy" value="1">
                                        <label for="pregnancy1">да</label>
                                    </div>
                                    <div class="sex-input radio-input-wrapper">
                                        <input id="pregnancy2" type="radio" name="pregnancy" value="0">
                                        <label for="pregnancy2">нет</label>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                            <div class="next-step-button">
                                <input type="submit" class="btn" value="Далее">
                            </div>
                        </form>

                    </div>


                </div>
            </div>


            @include('partials.events',[
                'itemsEvents' => $itemsEvents
            ])
        </div>
    </main>

    @if ($extraFields->physical_level)
        <script type="text/javascript">
            var rangevalue = {{$extraFields->physical_level}} - 1 + 0.1;
            var expvalue = {{$extraFields->physical_exp_years}} + 0.1;
            var healhvalue = {{$extraFields->health_level}} - 1 + 0.1;
        </script>
    @endif
@endsection