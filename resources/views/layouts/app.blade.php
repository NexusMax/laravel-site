<?php
use App\Categories;
use App\ExpertsGroup;
use App\User;
use App\ItemsEvents;


$regValidation = JsValidator::make(User::getRegisterRules());
$logValidation = JsValidator::make(User::getLoginRules());
$trainerCategory = Categories::where('published', 1)->where('is_video', 0)->limit(6)->get()->toArray();
$videoCategory = Categories::where('published', 1)->where('is_video', 1)->get()->toArray();

$expertsCategories = ExpertsGroup::where('active', 1)->get();

if(isset($GLOBALS['pageTitle'])){
    $title_ = $GLOBALS['pageTitle'];
}else{
    $title_ = config('app.name', 'Laravel');
}

function getSeeEvents(){
    if(!Auth()->guest()){
        $count = ItemsEvents::where('published', 1)->where('created_at', '>', Auth()->user()->last_event)->count();
        if($count){
            return '<span class="see-event">' . $count . '</span>';
        }
    }
}
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="{{ app()->getLocale() }}"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="{{ app()->getLocale() }}"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="{{ app()->getLocale() }}"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="ru"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#32ba9b" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="yandex-verification" content="7d8773092dd26dca" />
    <meta name="google-signin-client_id" content="198177097285-q34midsb8gcu2bgd28oje1lscp1gc2rq.apps.googleusercontent.com" />

    @if(isset($GLOBALS['ogMeta']) && !empty($GLOBALS['ogMeta']))
        <meta property="og:description" content="<?= strip_tags(html_entity_decode($GLOBALS['ogMeta']['intro'])) ?>" />
        <meta property="og:type" content="{{ $GLOBALS['ogMeta']['og_type'] }}" />
        <meta property="og:locale" content="ru_RU" />
        <meta property="og:site_name" content="sportcasta" />
        <meta property="og:title" content="{{ $GLOBALS['ogMeta']['name'] }}" />
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:image" content="{{ url('/') . '/img/' . $GLOBALS['ogMeta']['img'] }}" />
    @endif
    @if(isset($GLOBALS['canonicalMeta']) && !empty($GLOBALS['canonicalMeta']))
        <link rel="canonical" href="{{ $GLOBALS['canonicalMeta']['url'] }}"/>
    @endif
    @if(isset($GLOBALS['noindex']) && $GLOBALS['noindex'])
        <meta name="robots" content="noindex,nofollow" />
    @endif
    @if(isset($GLOBALS['linkNextPrev']))
        @if(isset($GLOBALS['linkNextPrev']['prev']))
            <link rel="prev" href="{{ $GLOBALS['linkNextPrev']['prev']['url'] }}" />
        @endif
    @endif
    @if(isset($GLOBALS['linkNextPrev']))
        @if(isset($GLOBALS['linkNextPrev']['next']))
            <link rel="next" href="{{ $GLOBALS['linkNextPrev']['next']['url'] }}" />
        @endif
    @endif
    @if(isset($GLOBALS['yandenoindex']) && $GLOBALS['yandenoindex'])
        <meta name="yandex" rel="noindex, follow" />
    @endif

    @if(isset($GLOBALS['pageDescription']))
        <meta name="description" content="{{ $GLOBALS['pageDescription'] }}" />
    @endif

    <title>{{ $title_ }}</title>

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('libs/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/bootstrap-datetimepicker/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('css/popup.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">

    {{--<link rel="stylesheet" href="{{ asset('css/plyr.css') }}">--}}

    {{--<link rel="stylesheet" href="https://cdn.plyr.io/2.0.15/plyr.css">--}}

    <link rel="stylesheet" href="https://cdn.plyr.io/3.3.7/plyr.css">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}?v=<?php echo date('s'); ?>">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}?v=<?php echo date('s'); ?>">


    <script src="https://apis.google.com/js/api.js"></script>
    <script type="text/javascript">
        (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
    </script>


@if(isset($GLOBALS['schema']))
    {!! $GLOBALS['schema'] !!}
@endif

<!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-K9BXBSS');</script>
    <!-- End Google Tag Manager -->

</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K9BXBSS"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

{{--@if(Request::is('*training*'))--}}
{{--@if(!in_array(geoip()->getLocation($ip = null)['country'], ['Ukraine', 'local']))--}}
{{--<div id="vk_api_transport"></div>--}}
{{--<script>--}}
{{--window.vkAsyncInit = function() {--}}
{{--VK.init({--}}
{{--apiId: 6328835--}}
{{--});--}}
{{--};--}}

{{--setTimeout(function() {--}}
{{--var el = document.createElement("script");--}}
{{--el.type = "text/javascript";--}}
{{--el.src = "https://vk.com/js/api/openapi.js?151";--}}
{{--el.async = true;--}}
{{--document.getElementById("vk_api_transport").appendChild(el);--}}
{{--}, 0);--}}
{{--</script>--}}
{{--@endif--}}
{{--@endif  --}}

@if (Session::has('flash_register'))
    <input type="hidden" name="reg_auth" value="reg">
@endif
@section('header')
    <header class="header clearfix ">
        <div class="h-top-row">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-8 h-logo_wrapper">

                        <a href="{{ route('home') }}" class="h-logo"><img src="/img/logo.svg" alt="Онлайн портал Sport Casta"></a>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 h-nav_wrapper">
                        <div class="bars" id="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
                        <nav class="h-nav" >

                            <div class="hidden-profile">
                                <div class="h-profile">
                                    <a href="#"><img src="/img/icons/man.png" alt="Онлайн портал Sport Casta - Вход"></a>

                                    @guest
                                    <a class="popup-with-form" target="popup" data-mfp-src="#popup-check_in" href="#" rel="nofollow">
                                        <span>Вход</span>
                                    </a>
                                    @else
                                        <a href="{{ route('myaccount') }}"><span>{{ Auth::user()->name }}</span></a>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementsByClassName('logout-form_')[0].submit();"><span>Выйти</span></a>

                                        <form id="logout-form2" class="logout-form_" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                                        @endguest

                                        <div class="header-search_wrapperM">
                                            <a href="#" class="header-search h-search" id="h-search2"><img src="/img/icons/search.png" alt="Онлайн портал Sport Casta - Поиск"></a>
                                            <div class="search-window">
                                                <div class="search-wrapper">
                                                    <form action="{{ route('training/search') }}" method="GET" class="search-form">
                                                        <input type="search" name="q" class="training-search" placeholder="Поиск..." value="{{ old('q') }}" required>
                                                        <button type="submit" class="search-btn"></button>
                                                    </form>
                                                    <!-- <a class="search-window-exit"><i class="fa fa-times" aria-hidden="true"></i></a> -->
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>
                            <ul class="headerMenu" id="nav">

                                <li class="{{ Request::is('*about*') ? 'active' : '' }}"><a href="{{ route('about') }}">о нас</a></li>
                                <li class="{{ Request::is('*training*') ? 'active' : '' }}"><a href="{{ route('training') }}">тренерская</a>
                                    <ul class="headerMenu-submenu">
                                        @foreach($trainerCategory as $key)
                                            <li>
                                                @if($key['alias'] === 'questions')
                                                    <a href="{{ route('questions') }}">{{ $key['name'] }}</a>
                                                @else
                                                    <a href="{{ route('training/category', ['alias' => $key['alias']]) }}">{{ $key['name'] }}</a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="{{ Request::is('*trainer/video') || Request::is('*learner/video') ? 'active' : '' }}"><a href="{{ route('video') }}">видео</a>
                                    <ul class="headerMenu-submenu">
                                        <li><a href="{{ route('video/category', ['alias' => 'trenirovky']) }}">По тренировкам</a></li>
                                        <li><a href="{{ route('video/category', ['alias' => 'pitaniye']) }}">По питанию</a></li>
                                        <li><a href="{{ route('video/category', ['alias' => 'psikhologiya']) }}">По психологии</a></li>
                                        <li><a href="{{ route('video/category', ['alias' => 'zdorovie']) }}">По здоровью</a></li>
                                    </ul>
                                </li>
                                <li class="{{ Request::is('*events*') ? 'active' : '' }}"><a href="{{ route('events') }}">события
                                        {!! getSeeEvents() !!}
                                    </a>
                                    <ul class="headerMenu-submenu">
                                        <li><a href="{{ route('events/current') }}">Текущие</a></li>
                                        <li><a href="{{ route('events/future') }}">Ближайшие</a></li>
                                        <li><a href="{{ route('events/past') }}">Прошедшие</a></li>
                                    </ul>
                                </li>
                                <li class="{{ Request::is('*questions*') ? 'active' : '' }}"><a href="{{ route('questions') }}">Вопрос/ответ</a></li>
                                <li class="{{ Request::is('*experts*') ? 'active' : '' }} secondary-click"><a href="{{ route('experts') }}">Наши эксперты</a>
                                    <ul class="headerMenu-submenu">
                                        <?php foreach($expertsCategories as $key): ?>
                                            <li><a href="{{ route('experts/category', ['alias' => $key['alias']]) }}">{{ $key->name }}</a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            </ul>
                        </nav>

                    </div>
                    <div class="col-lg-2 hidden-md hidden-sm hidden-xs h-profile_wrapper">
                        <div class="h-profile">
                            <a href="#"><img src="/img/icons/man.png" alt="Онлайн портал Sport Casta - Вход 1"></a>

                            @guest
                            <a class="popup-with-form" target="popup" data-mfp-src="#popup-check_in" href="#" rel="nofollow"><span>Вход</span></a>
                            @else
                                <a href="{{ route('myaccount') }}"><span>{{ Auth::user()->name }}</span></a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>Выйти</span></a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                                @endguest
                                <div class="header-search_wrapper">
                                    <a href="#" class="header-search h-search" id="h-search"><img src="/img/icons/search.png" alt="Онлайн портал Sport Casta - Поиск"></a>
                                    <div class="search-window">
                                        <div class="search-wrapper">
                                            <form action="{{ route('training/search') }}" method="GET" class="search-form">
                                                <input type="search" name="q" class="training-search" placeholder="Поиск..." value="{{ old('q') }}" required>
                                                <button type="submit" class="search-btn"></button>
                                            </form>
                                            <!-- <a class="search-window-exit"><i class="fa fa-times" aria-hidden="true"></i></a> -->
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@show

@yield('content')

@section('footer')
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 f-info">
                    <a href="{{ route('home') }}" class="h-logo-footer"><img src="/img/logo.svg" alt="Онлайн портал Sport Casta 1"></a>
                    <p>Будь в мейнстриме фитнес-тусовки!</p>
                </div>
                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-6 f-menu">
                    <div class="footer_h3">меню</div>
                    <ul>
                        <li><a href="{{ route('about') }}">О нас</a></li>
                        <li><a href="{{ route('training') }}">Тренерская</a></li>
                        <li><a href="{{ route('video') }}">Видео</a></li>
                        <li><a href="{{ route('events') }}">События</a></li>
                        <li><a href="{{ route('questions') }}">Вопрос/ответ</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 f-coach">
                    <div class="footer_h3">тренерская</div>
                    <ul>
                        @foreach($trainerCategory as $key)
                            <li><a href="{{ route('training/category', ['alias' => $key['alias']]) }}">{{ $key['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 f-inst">
                    <div class="footer_h3">instagram</div>
                    <span class="f-inst">
                    <img src="/img/inst_1.jpg" alt="Онлайн портал Sport Casta - facebook">
                </span>
                    <span class="f-inst">
                <img src="/img/inst_2.jpg" alt="Онлайн портал Sport Casta - youtube">
                </span>
                    <span class="f-inst">
                <img src="/img/inst_3.jpg" alt="Онлайн портал Sport Casta - instagram">
                    </span>
                    <span class="f-inst">
                <img src="/img/inst_4.jpg" alt="Онлайн портал Sport Casta - vk">
                        </span>
                </div>
                <div class="col-lg-3 col-md-12  col-sm-12 col-xs-12 f-contacts">
                    <div class="footer_h3">наши контакты</div>
                    <p><a href="mailto:info@sportcasta.com.ua">info@sportcasta.com.ua</a></p>
                    <div class="f-contacts-socials">
                        <a target="_blank" rel="nofollow" href="https://www.facebook.com/pg/sportcasta/"><i class="fa fa-facebook"></i></a>
                        <a target="_blank" rel="nofollow" href="https://www.youtube.com/channel/UCWbFDQyDz8ejrt-BDD1xVpg"><i class="fa fa-youtube-square"></i></a>
                        <a target="_blank" rel="nofollow" href="https://www.instagram.com/sportcasta/"><i class="fa fa-instagram"></i></a>
                        <a target="_blank" rel="nofollow" href="https://vk.com/sportcasta"><i class="fa fa-vk"></i></a>
                        <a target="_blank" rel="nofollow" href="https://t.me/SportCasta"><i class="fa fa-telegram"></i></a>
                    </div>
                    @guest
                    <div>ПОДПИСКА</div>
                    <form action="{{ route('subscribe') }}" method="POST" class="f-form subscribe-form" id="subscribe-form-footer">
                        {!! csrf_field() !!}
                        <div class="wrap-validation">
                            <input name="subscribe[email]" value="{{ old('subscribe.email') }}" class="wow fadeIn" type="email" placeholder="Введите Ваш email">
                            @if(isset($errors))
                                @if ($errors->has('subscribe.email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subscribe.email') }}</strong>
                                    </span>
                                @endif
                            @endif
                        </div>
                        <button type="submit" class="btn f-btn float-right"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                    </form>
                    @endguest
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 f-copyright">
                    <p>Все права защищены. Sport Casta <?= date('Y', time()) ?></p>
                    <p>Разработка и поддержка сайта Easy Studio</p>
                </div>
            </div>
        </div>
    </footer>
    @show

@section('popupAuth')
    @include('auth.popupAuth')
@show

@section('popupSpecialReg')
    @include('auth.popupSpecialReg')
@show

@section('popupEmail')
    @include('auth.email')
@show

@section('popupEmailPhone')
    @include('auth.emailphone')
@show

@section('popupThanks')
    @include('auth.thanks')
@show


<!--[if lt IE 9]>
    <script src="{{ asset('libs/html5shiv/es5-shim.min.js') }}"></script>
    <script src="{{ asset('libs/html5shiv/es5-shim.min.js') }}"></script>
    <script src="{{ asset('libs/html5shiv/html5shiv.min.js') }}"></script>
    <script src="{{ asset('libs/html5shiv/html5shiv-printshiv.min.js') }}"></script>
    <script src="{{ asset('libs/respond/respond.min.js') }}"></script>
    <![endif]-->



    <script src="{{ asset('libs/jquery/jquery-1.11.2.min.js') }}"></script>



    <script src="{{ asset('libs/jquery/pjax.js') }}"></script>
    <script src="{{ asset('libs/wow.min.js') }}"></script>
    <script src="{{ asset('libs/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('libs/animate/animate-css.js') }}"></script>
    <script src="{{ asset('libs/flipclock.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-datetimepicker/bootstrap.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-datetimepicker/bootstrap-datetimepicker.ru.js') }}"></script>
    <script src="{{ asset('libs/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('libs/tooltip.js') }}"></script>
    <script src="https://use.fontawesome.com/bad8fea332.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    <!-- Polyfills -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=es6,Array.prototype.includes,CustomEvent,Object.entries,Object.values,URL"
            crossorigin="anonymous"></script>
    <script src="https://cdn.plyr.io/3.3.7/plyr.js"></script>
    <!-- Rangetouch to fix <input type="range"> on touch devices (see https://rangetouch.com) -->
    <script src="https://cdn.rangetouch.com/1.0.1/rangetouch.js"></script>


    {{--<script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

    <script src="{{ asset('js/common.js') }}"></script>
    <script>
        //        const players = Plyr.setup('.js-player');
        const player = new Plyr('#js-player');
        const player3 = new Plyr('#js-player3', {controls: ['play-large','play','fast-forward','current-time','duration','mute','volume','settings','airplay','fullscreen'] });
        const player2 = new Plyr('#abt-video');
    </script>


    <script>
        function openTab(evt, name) {
            var i, tabcontent, tablinks;
            tabcontent = $(".tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = $(".tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(name).style.display = "block";
            evt.currentTarget.className += " active";
        }

    </script>

    <script>
        var telegram_user = '';
        function onTelegramAuth(user) {
            telegram_user = user;
            console.log(telegram_user);
            onTelegramAuth2(telegram_user);
        }
    </script>
    <script>


        function onTelegramAuth2(user) {

            var __id = user.id;
            console.log(__id);
            $.ajax({
                type: "POST",
                url: "/trainer/telegram-exists",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "uid": __id
                },
                success: function (msg) {
                    console.log(msg);
                    if (msg === 'no'){
                        $('.popup-with-form-login-phone').magnificPopup('open');
                        return false;
                    }else{
                        window.location.reload();
                    }

                }
            });

        }
    </script>

    {!! JsValidator::formRequest('App\Http\Requests\Subscriber', '#subscribe-form-footer') !!}
    {!! JsValidator::formRequest('App\Http\Requests\Subscriber', '#subscribe-form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\MyaccountInf', '#myaccount-form-inf') !!}

    {!! $regValidation->selector('#register-form')  !!}
    {!! $regValidation->selector('#register-with-special')  !!}
    {!! $logValidation->selector('#login-form')  !!}
    {!! $logValidation->selector('#login-more-inf')  !!}

    {{--@if(!in_array(geoip()->getLocation($ip = null)['country'], ['Ukraine', 'local']))--}}
    {{--<!— Yandex.Metrika counter —>--}}
    {{--<script type="text/javascript" >--}}
    {{--(function (d, w, c) {--}}
    {{--(w[c] = w[c] || []).push(function() {--}}
    {{--try {--}}
    {{--w.yaCounter48147317 = new Ya.Metrika({--}}
    {{--id:48147317,--}}
    {{--clickmap:true,--}}
    {{--trackLinks:true,--}}
    {{--accurateTrackBounce:true--}}
    {{--});--}}
    {{--} catch(e) { }--}}
    {{--});--}}

    {{--var n = d.getElementsByTagName("script")[0],--}}
    {{--s = d.createElement("script"),--}}
    {{--f = function () { n.parentNode.insertBefore(s, n); };--}}
    {{--s.type = "text/javascript";--}}
    {{--s.async = true;--}}
    {{--s.src = "https://d31j93rd8oukbv.cloudfront.net/metrika/watch_ua.js";--}}

    {{--if (w.opera == "[object Opera]") {--}}
    {{--d.addEventListener("DOMContentLoaded", f, false);--}}
    {{--} else { f(); }--}}
    {{--})(document, window, "yandex_metrika_callbacks");--}}
    {{--</script>--}}
    {{--<noscript><div><img src="https://mc.yandex.ru/watch/48147317" style="position:absolute; left:-9999px;" alt="yandex" /></div></noscript>--}}
    {{--<!— /Yandex.Metrika counter —>--}}
    {{--@endif--}}



</body>
</html>

