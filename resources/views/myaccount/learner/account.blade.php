<?php
use App\User;

use Jenssegers\Date\Date;
Date::setLocale('ru');
?>
@extends('layouts.learner')

@section('content')

    <style>
        .cancel-i{
            display: none;
        }

        .account-form-el{
            min-height: 0!important;
        }
    </style>

    <main class="dashboard-main">
        <div class="dashboard container">
            <div class="row">
                <div class="dashboard-wrapper">

                    @include('partials.left-menu',[])

                    <div class="db-content">
                        <div class="db-container">
                            <div class="row">

                                <!-- avatar and actions -->
                                <div class="col-lg-3 col-md-2 left-col" style="height: 400px">
                                    <?php
                                    $img = '/../../img/account-avatar.jpg';
                                    if (!empty(Auth::user()->image))
                                        $img = url('/user/' . Auth::user()->image);
                                    ?>

                                    <div class="avatar-crop">
                                        <img src="{{ $img }}" alt="Аватар" style="width: 180px" class="avatar">
                                    </div>

                                        <a href="#" >
                                            <img style="width: 18px;fill: #057a68;" src="/../img/icons/star.svg" class="svg" alt="">
                                            <span>Рейтинг: <em>8.5</em></span>
                                        </a>

                                        <a href="#" >
                                            <img style="width: 18px;fill: #057a68;" src="/../img/icons/gift.svg" class="svg" alt="">
                                            <span>Бонусы: <em>100 sc</em></span>
                                        </a>

                                    <a href="#" class="update-info">
                                        <img src="/../../img/icons/edit.png" alt="Редактировать данные">Редактировать данные
                                    </a>

                                    <label for="avatar" class="none">
                                        <span class="span-a">
                                            <img class=" pr-5" src="/../../img/icons/image.png" alt="Изменить фотографию">Изменить фото
                                        </span>
                                    </label>

                                        @if ($errors->has('image'))
                                        <span class="help-block">
							                <strong>{{ $errors->first('image') }}</strong>
						                </span>
                                    @endif
                                    <a href="#" style="display: none" class="link-save none"><img src="/../../img/icons/edit.png" alt="Сохранить">Сохранить</a>
                                </div>

                                <!-- fields column -->
                                <div class="col-lg-9 col-md-10 right-col">

                                    <!-- header -->
                                    <div class="row">

                                        <span class="left" style="text-transform: uppercase; font-weight: bold;" >Ваши данные</span>
                                        <span class="right account-exit">
                                            <img src="/../../img/icons/exit.png" alt="Выйти">
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
                                        </span>

                                        <form action="{{ route('myaccount/update') }}" class="account-form" method="POST" enctype="multipart/form-data" id="myaccount-form-inf">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="old_img" value="{{ Auth::user()->image }}">
                                            <input type="file" name="image" id="avatar" style="display:none;" value="{{ Auth::user()->image }}">

                                            <!-- firstname and lastname -->
                                            <div class="account-form-row">

                                                <!-- firstname -->
                                                <div class="account-form-el" style="width: 50% !important;">
                                                    <label>Имя</label>

                                                    <div class="wrap-validation {{ $errors->has('name') ? ' has-error' : '' }}">
                                                        <span class="span-input block">{{ Auth::user()->name }}</span>
                                                        <input type="text" name="name" class="val-input none name-first" value="{{ Auth::user()->name }}">

                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('name') }}</strong>
											                </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- lastname -->
                                                <div class="account-form-el" style="width: 50% !important;">
                                                    <label>Фамилия</label>
                                                    <div class="wrap-validation {{ $errors->has('lastname') ? ' has-error' : '' }}">
                                                        <span class="span-input block">{{ Auth::user()->lastname }}</span>
                                                        <input type="text" name="lastname" class="val-input none" value="{{ Auth::user()->lastname }}">

                                                        @if ($errors->has('lastname'))
                                                            <span class="help-block">
												                <strong>{{ $errors->first('lastname') }}</strong>
											                </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- role and birthday -->
                                            <div class="account-form-row">
                                                <!-- role -->
                                                <div class="account-form-el" style="width: 50% !important;">
                                                    <label>Роль</label>
                                                    <span class="span-input block">{{ Auth::user()->getNameRole() }}</span>
                                                    <input type="text" class="val-input none" value="{{ Auth::user()->getNameRole() }}" disabled>
                                                </div>

                                                <!-- birthday -->
                                                <div class="account-form-el" style="width: 50% !important;">
                                                    <label>Дата рождения</label>

                                                    <?php

                                                    if (empty(Auth::user()->birthday)) {
                                                        $date = null;
                                                    } else {
                                                        $date = new Date(strtotime(Auth::user()->birthday));
                                                        $date = $date->format('d') . ' ' . $date->format('F') . ' ' . $date->format('Y');
                                                    }
                                                    ?>

                                                    <div class="wrap-validation {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                                        <span class="span-input block">{{ $date }}</span>
                                                        <div>
                                                            <div class="input-group date form_date dateWrapper"
                                                                 data-date="" data-date-format="dd MM yyyy"
                                                                 data-link-field="dtp_input2"
                                                                 data-link-format="yyyy-mm-dd">

                                                                <input class="form-control dateInput val-input none" readonly name="birthday" size="16" type="text" value="{{ $date }}">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <span class="add-on"><i class="icon-th"></i></span>

                                                        @if ($errors->has('birthday'))
                                                            <span class="help-block">
												                <strong>{{ $errors->first('birthday') }}</strong>
											                </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- country and city -->
                                            <div class="account-form-row">

                                                <!-- country -->
                                                <div class="account-form-el" style="width: 50% !important;">
                                                    <label>Страна</label>
                                                    <div class="wrap-validation {{ $errors->has('country') ? ' has-error' : '' }}">
                                                        <span class="span-input block">{{ Auth::user()->country }}</span>

                                                        <select name="country" id="country" class="val-input none">
                                                            @foreach(Auth::user()->getCountry() as $key)
                                                                <option @if(Auth::user()->country === $key) {{ 'selected' }}  @endif value="{{ $key }}">{{ $key }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('country'))
                                                            <span class="help-block">
												                <strong>{{ $errors->first('country') }}</strong>
											                </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- city -->
                                                <div class="account-form-el" style="width: 50% !important;">
                                                    <label>Город</label>
                                                    <div class="wrap-validation {{ $errors->has('city') ? ' has-error' : '' }}">
                                                        <span class="span-input block">{{ Auth::user()->city }}</span>
                                                        <input type="text" name="city" class="val-input none" value="{{ Auth::user()->city }}">

                                                        @if ($errors->has('city'))
                                                            <span class="help-block">
												                <strong>{{ $errors->first('city') }}</strong>
											                </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- row -->
                                            <div class="account-form-row">
                                                <!-- phone -->
                                                <div class="account-form-el" style="width: 50% !important;">
                                                    <label>Телефон</label>
                                                    <?php empty(Auth::user()->phone) ? $phone = ' ' : $phone = Auth::user()->phone; ?>
                                                    <div class="wrap-validation {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                        <span class="span-input block">{{ str_replace(['-'], '', Auth::user()->phone) }}</span>
                                                        @if(empty(Auth::user()->phone))
                                                            @if(geoip()->getLocation($ip = null)['country'] === 'Ukraine')
                                                                <?php $phon_ = '+380'; ?>
                                                            @else
                                                                <?php $phon_ = '+7'; ?>
                                                            @endif
                                                        @else
                                                            <?php $phon_ = Auth::user()->phone; ?>
                                                        @endif

                                                        <div class="phoneCountry">
                                                            <select name="code_phone" id="code_phone"
                                                                    class="val-input none">
                                                                @foreach(Auth::user()->getNumCode() as $key)
                                                                    <option @if(stristr($phon_, $key)) {{ 'selected' }}  @endif value="{{ $key }}">{{ $key }}</option>
                                                                    @if(stristr($phon_, $key))
                                                                        <?php
                                                                        $phon_ = str_replace($key, '', $phon_);
                                                                        ?>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <input type="text" name="phone"
                                                                   class="val-input none phoneInput"
                                                                   value="<?= $phon_ ?>">
                                                            @if ($errors->has('phone'))
                                                                <span class="help-block">
											<strong>{{ $errors->first('phone') }}</strong>
										</span>

                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- <div class="form-group phoneCountry">
                                                                                            <select id="phone-country" class="form-control">
                                                                                              <option value="ru">+7</option>
                                                                                              <option value="ua">+380</option>
                                                                                            </select>
                                                                                            <input id="phone" type="text" class="form-control telCustom">
                                                    </div> -->
                                                </div>

                                                <!-- email -->
                                                <div class="account-form-el" style="width: 50% !important;">
                                                    <label>E-mail</label>
                                                    <div class="wrap-validation {{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <span class="span-input block">{{ Auth::user()->email }}</span>
                                                        <input type="email" name="email" class="val-input none"
                                                               value="{{ Auth::user()->email }}">
                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
												                <strong>{{ $errors->first('email') }}</strong>
											                </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>



                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <section class="account-bonus">
                <div class="container">
                    <div class="row fb-stretch">
                        <div class="col-lg-6 col-sm-12 referal-wrapper">
                            <h3>Пригласи друзей - <br><span>получи бонусы</span></h3>
                            <p>Твоя реферальная ссылка (<span class="tooltip-how-it-work" data-toggle="tooltip"
                                                              data-placement="top"
                                                              title="Отправь ссылку другу и получи бонус за его регистрацию">как это работает?</span>):
                            </p>
                            <?php
                            isset($_SERVER['HTTPS']) ? $url = 'https://' : $url = 'http://';
                            $url .= $_SERVER['HTTP_HOST'] . '/?a=<span class="span-referal-link">' . Auth::user()->referal . '</span>';
                            ?>
                            <p class="referal-link">{!! $url !!}</p>

                            <a href="{{ route('myaccount/bonuses') }}" class="btn">Получи бонусы</a>
                            {{--<form id="ref-form" action="{{ route('myaccount/referal') }}" method="POST">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<button class="btn" id="ref_btn">сгенерировать партнерскую ссылку</button>--}}
                            {{--</form>--}}
                        </div>
                        <div class="col-lg-6 col-sm-12 bonus-wrapper">
                            <img src="../../img/gift.png" alt="Бонусы">
                            <p>Ваши бонусы</p>
                            <span>{{ Auth::user()->balance }} sc</span><br>
                            <a href="{{ route('payment') }}" class="btn">Купить подписку</a>
                            <a href="{{ route('myaccount/bonus') }}" class="history-bonus-link">История бонусов</a>
                        </div>
                    </div>
                </div>
            </section>

            @include('partials.events',[
                'itemsEvents' => $itemsEvents
            ])
        </div>
@endsection