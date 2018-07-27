<?php
use App\Items;
use Jenssegers\Date\Date;
Date::setLocale('ru');
?>

@extends('layouts.app')

@section('content')
<div class="wrapper-h-screen" style="background-image: url('/img/home_bg.jpg');">
<section class="h-screen" >
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="h-text">
                    <h1 class="h2 wow fadeInUp" data-wow-delay='.1s'>ДЕРЖИ ПЛАНКУ</h1>
                    <p class="wow fadeInUp" data-wow-delay='.3s'>Присоединяйся к сообществу успешных персональных тренеров</p>
                    @guest
                    <a href="#" data-mfp-src="#popup-special_propos" class="btn call-btn wow fadeIn popup-with-form" data-wow-delay='.5s'>Присоединиться</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section></div>
<section class="s-cat">
    <div class="s-cat_wrapper">
        <div class="s-car_container clearfix">
            @foreach($featureCategories as $key)
            <div class="s-cat_item wow fadeInUp col-lg-2 col-md-6" data-wow-delay='.{{ $loop->index + 2 }}s'>
                <a href="{{ route('training/category', ['alias' => $key['alias']]) }}" class="s-cat-link">
                <div class="cat-item_padding ">
                    <div class="cat-item-img-wrapper">
                        <img src="/img/icons/{{ $key['icon'] }}" alt="{{ $key['name'] }}" class="icon-start">
                        <img src="/img/icons/{{ $key['icon_3'] }}" alt="{{ $key['name'] }} 1" class="none icon-hover">
                    </div>
                    <h3>{{ $key['name'] }}</h3>
                    <p>{{ $key['title'] }}</p>
                    <span class="s-cat_num">{{ $loop->iteration }}</span>
                    <span class="s-cat-more">подробнее <img src="img/icons/arrow-right-white.png" alt="{{ $key['name'] }} 3"></span>
                </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="s-cat-small">
    <div class="s-cat_wrapper">
        <div class="s-car_container owl-carousel owl-carousel-cat-small owl-theme clearfix">
            @foreach($featureCategories as $key)
            <div class="s-cat_item wow">
                <a href="{{ route('training/category', ['alias' => $key['alias']]) }}" class="s-cat-link">
                <div class="cat-item_padding">
                    <div class="cat-item-img-wrapper">
                        <img src="/img/icons/{{ $key['icon'] }}" alt="{{ $key['name'] }} 4" class="icon-start">
                    </div>
                    <h3>{{ $key['name'] }}</h3>
                    <p>{{ $key['title'] }}</p>
                    <span class="s-cat-more">подробнее <img src="img/icons/arrow-right-green.png" alt="{{ $key['name'] }} 5"></span>
                </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>



</section>
@include('partials.events',[
    'itemsEvents' => $itemsEvents
])

<section class="society">
    <div class="container-fluid">
        <div class="row">
            <div class="society-img col-lg-6 col-md-6" style="background-image: url(../img/casta_home_1.png); background-size: cover;
    height: 650px;"></div>
            <div class="col-lg-6 col-md-6">
                <div class="society-text text-center">
                    <h3 class="titleh3 wow fadeInUp">Сообщество Sport<span>Casta</span></h3>
                    <p>SportCasta - это новый информационно-образовательный интернет-портал, который объединяет персональных тренеров с экспертами фитнес-индустрии и смежных с ней областей. Подписка на SportCasta - это самый короткий путь получения актуальной и правдивой информации, необходимой современному тренеру.</p>
                </div>
                <div class="society-cols clearfix text-center">
                    <div class="society-col wow fadeInUp" data-wow-delay='.1s'>
                        <img src="img/icons/mission.png" alt="САМЫЕ СОВРЕМЕННЫЕ ЗНАНИЯ">
                        <h3>САМЫЕ СОВРЕМЕННЫЕ ЗНАНИЯ</h3>
                        <p>Удобная форма информации: кейсы, статьи, видео, вебинары.</p>
                    </div>
                    <div class="society-col wow fadeInUp" data-wow-delay='.1s'>
                        <img src="img/icons/target.png" alt="ЦЕЛИ ПРОЕКТА">
                        <h3>ЦЕЛИ ПРОЕКТА</h3>
                        <p>Создание онлайн-плаформы для обучения и общения тренеров.</p>
                    </div>
                    <div class="society-col wow fadeInUp" data-wow-delay='.1s'>
                        <img src="img/icons/values.png" alt="ЦЕННОСТИ SPORTCASTA">
                        <h3>ЦЕННОСТИ SPORTCASTA</h3>
                        <p>Высокий уровень компетентности и осознанности персональных тренеров.</p>
                    </div>

                </div>
                @guest
                <a href="#" data-mfp-src="#popup-special_propos" class="popup-with-form btn wow fadeIn">Присоединиться к Sport Casta</a>
                @endguest
            </div>
        </div>
    </div>
</section>
<section class="s-new">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h3 class="titleh3 wow fadeInUp s-new_title">Новое на нашем сайте</h3>
                <p class="s-team_descr">В открытом доступе вы найдете много статей и полезного видео-контента из области спорта, диетологии, медицины и психологии.</p>
                <div class="s-new_slider">
                    <div class="owl-carousel owl-carousel2 owl-theme">
                        @include('partials.slider-item',['items' => $items])
                    </div>
                </div>
            </div>
            @guest
            <div class="col-lg-12 col-md-12">
                <div class="btn-wrapper">
                    <a href="#" data-mfp-src="#popup-special_propos" class="popup-with-form btn s-new_btn wow fadeIn">Подписка на обновления</a>
                </div>
            </div>
            @endguest
        </div>
    </div>
</section>
@include('partials.team')
<section class="s-subscribe">
    <div class="container">
        <div class="row">
            <h3 id="join" class="titleh3 wow fadeInUp">Преимущества подписки Sport<span>Casta</span></h3>
            <p class="s-team_descr">После оформления подписки на ресурс SportCasta, тебе откроется доступ к практическим рекомендациям и готовым решениям от экспертов в виде текстовых и видео-кейсов.</p>
        </div>
        <div class="row">
            <div class="subscribe-block">
                
                <div class="advantage-item advantage-item1 clearfix wow  slideInLeft " data-wow-delay=".1s">
                    <p class="advantage-title  left ">Просто</p>
                    <p class="advantage-descr  left ">Все, что тебе необходимо,- на одном ресурсе</p>
                    <img class="right advantage-img" src="img/icons/just.svg" alt="Преимущества подписки Sport">
                </div>
                <div class="advantage-item advantage-item2 clearfix wow  slideInLeft " data-wow-delay=".2s">
                    <p class="advantage-title  left ">Актуально</p>
                    <p class="advantage-descr  left ">Динамика сообщества и еженедельное обновление информации</p>
                    <img class="right advantage-img" src="img/icons/act.svg" alt="Преимущества подписки Sport 1">
                </div>
                <div class="advantage-item advantage-item3 clearfix wow  slideInRight " data-wow-delay=".3s">
                    <p class="advantage-title  right ">Современно</p>
                    <p class="advantage-descr  right ">Уникальный опыт, упакованный в пошаговые инструкции именно для тебя</p>
                    <img class="right advantage-img" src="img/icons/beautiful.svg" alt="Преимущества подписки Sport 2">
                </div>
                <div class="advantage-item advantage-item4 clearfix wow  slideInRight " data-wow-delay=".4s">
                    <p class="advantage-title  right ">Доступно</p>
                    <p class="advantage-descr  right ">Получай знания в удобном месте в любое время</p>
                    <img class="right advantage-img" src="img/icons/free.svg" alt="Преимущества подписки Sport 3">
                </div>


                @guest
                <form action="{{ route('subscribe') }}" method="POST" class="subscribe_form subscribe-form" id="subscribe-form">
                    {!! csrf_field() !!}

                    <div class="wrap-validation">
                        <input name="subscribe[name]" value="{{ old('subscribe.name') }}" class="wow fadeIn" type="text" placeholder="Введите Ваше имя">
                        @if ($errors->has('subscribe..name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('subscribe..name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="wrap-validation">
                        <input name="subscribe[email]" value="{{ old('subscribe.email') }}" class="wow fadeIn" type="email" placeholder="Введите Ваш email">
                        @if ($errors->has('subscribe.email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('subscribe.email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="wrap-validation">
                        <button type="submit" class="btn wow fadeIn">оформить подписку</button>
                        <span class="help-block"></span>
                    </div>
                </form>
                @endguest
            </div>
        </div>
    </div>
</section>
@endsection