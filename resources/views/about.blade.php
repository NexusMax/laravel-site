@extends('layouts.app')

@section('content')
    <div id="about">
        <section class="h-video" style="background: url(/img/video-bg.jpg) no-repeat; background-size: cover; background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <a class="popup-with-form2" href="#popup-video" id="aboutPopupVideo"><img src="/img/icons/btn_play.png" alt="Начать" class="abt-video_btn wow fadeIn" data-wow-delay='.2s'></a>
                        <h4 class="timecode wow fadeIn" data-wow-delay='.4s'>2:00</h4>
                        <h1 class="title wow fadeInUp">О нас</h1>
                        @guest
                        <a href="#" target="popup" data-mfp-src="#popup-special_propos" class="btn wow fadeInUp popup-with-form">старт</a>
                        @endguest
                        {{ Breadcrumbs::render() }}
                    </div>
                </div>
            </div>
        </section>
        <section class="abt-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-item wow fadeInLeft clearfix">
                            <div class="about-item_text">
                                <h3 class="title">наша миссия</h3>
                                <!-- <div class="additional-text">Дополнительная фраза. Мотивационный текст</div> -->
                                <p>SPORTCASTA - это новый информационно-образовательный интернет-портал, который объединяет персональных тренеров с экспертами фитнес-индустрии и смежных с ней областей. Подписка на SportCasta - это самый короткий путь получения актуальной и правдивой информации, необходимой современному тренеру. Новички и профессионалы фитнеса найдут здесь полезную информацию, которая раскрывает особенности деятельности персональных тренеров, новые методики, готовые решения и полезные советы.</p>
                            </div>
                            <div class="about-item_img clearfix">
                                <img src="/img/about-item.jpg" alt="наша миссия">
                                <div class="about-item-icon-wrapper about-item_icon-right">  
                                    <img src="/img/icons/mission-white.png" alt="наша миссия 1" class="about-item_icon ">
                                </div>
                            </div>
                        </div>

                        <div class="about-item wow fadeInRight  clearfix">
                            <div class="about-item_text about-item_text-right">
                                <h3 class="title">КАК РОДИЛАСЬ ИДЕЯ ПРОЕКТА:</h3>
                                <!-- <div class="additional-text">Дополнительная фраза. Мотивационный текст</div> -->
                                <p>Путь тренера к высокой квалификации и результативности в своей профессии - чаще всего непрост. Сегодня мы наблюдаем, как рынок фитнеса перенасыщен противоречивой информацией, и разобраться в ней самостоятельно тренеру практически невозможно.</p>
                                <p>Многие выбирают путь - учиться у профессионалов, но зачастую это связано с высокими финансовыми, временными затратами и поездками в другие города.</p>
                                <p>Неоднократно пройдя этот путь самостоятельно, эксперты фитнеса смогли создать портал SPORTCASTA для того, чтобы максимально упростить тренеру процесс его развития и успеха в профессиональной деятельности.</p>
                            </div>
                            <div class="about-item_img about-item_img-left clearfix">
                                <img src="/img/au2.jpg" alt="КАК РОДИЛАСЬ ИДЕЯ ПРОЕКТА">
                                <div class="about-item-icon-wrapper">   
                                    <img src="/img/icons/values-white.png" alt="КАК РОДИЛАСЬ ИДЕЯ ПРОЕКТА 1" class="about-item_icon about-item_icon-left">
                                </div> 
                            </div>
                        </div>

                        <div class="about-item wow fadeInLeft clearfix">
                            <div class="about-item_text">
                                <h3 class="title">ЦЕЛИ SPORTCASTA</h3>
                              <!--   <div class="additional-text">Дополнительная фраза. Мотивационный текст</div> -->
                                <p>Мы создаем союз действующих тренеров со знаниями ведущих экспертов фитнеса, диетологии, психологии и медицины, а также - конструктивный диалог со свободными атлетами, который даст максимально положительный эффект от персональных тренировок. Таким образом, наша цель - сделать фитнес-индустрию по-настоящему осознанной и компетентной, а работу персонального тренера - грамотной и результативной.</p>
                            </div>
                            <div class="about-item_img clearfix">
                                <img src="/img/au3.jpg" alt="ЦЕЛИ SPORTCASTA">
                                <div class="about-item-icon-wrapper about-item_icon-right">  
                                    <img src="/img/icons/target-white.png" alt="ЦЕЛИ SPORTCASTA 1" class="about-item_icon ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-statistic" id="about-statistic_cont" style="display: none;">
            <div class="container">
                <div class="row">
                    <h3 class="title wow fadeInUp">sportcasta в цифрах</h3>
                </div>
                <div class="row">
                    <div class="about-statistic_container" >
                        <div class="statistic_container_item wow slideInRight">
                            <span class="amount"><span class="amount spincrement statistic-counter">870</span>+</span>
                            <span>Участников</span>
                        </div>
                        <div class="statistic_container_item wow slideInRight">
                            <span class="amount"><span class="amount spincrement statistic-counter">14</span>+</span>
                            <span>Экспертов</span>
                        </div>
                        <div class="statistic_container_item wow slideInRight">
                            <span class="amount"><span class="amount spincrement statistic-counter">18</span>+</span>
                            <span>Наград</span>
                        </div>
                        <div class="statistic_container_item wow slideInRight">
                            <span class="amount"><span class="amount spincrement statistic-counter">46</span>+</span>
                            <span>Локаций</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-bonus">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 clearfix">
                        <div class="about-item_text">
                            <h3 class="title wow fadeInLeft" data-wow-delay=".1s">система бонусов sportcasta</h3>
                            <div class="additional-text wow fadeInLeft" data-wow-delay=".2s">Оцени бонусную программу SportCasta!</div>
                            <p class="wow fadeInLeft" data-wow-delay=".3s">
                                Оцени бонусную программу SportCasta! Если ты зарегистрировался на нашем портале, значит ты уже являешься её участником.
                                100 бонусов = 1$. Получить их очень просто: регистрируйся, делись материалами, приглашай друзей в SportCasta и пользуйся всеми преимуществами подписки.
                                Подробнее о бонусах можно узнать <a class="greenText" href="{{ route('myaccount/bonuses') }}">здесь</a>.
                            </p>
                            @guest
                            <?php $segment = Request::segment(1) ?>
                            <a href="#" target="popup" data-mfp-src="#popup-special_propos" class="btn wow fadeIn popup-with-form">Присоединиться</a>
                            @endguest
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <img src="/img/casta_tcl.png" alt="система бонусов sportcasta" class="wow fadeIn">
                    </div>
                </div>
            </div>
        </section>

        @include('partials.team', ['team' => $team])
        <div id="popup-video" class="white-popup-block mfp-hide popup-video">
            <video class="js-player video" id="abt-video" controls="controls">
                <source src="/img/test-video.mp4" type="video/mp4">
            </video>

                {{--<div class='plyr-youtube' data-type="youtube" data-video-id="SRLc05DNJxE"></div>--}}

        </div>
    </div>
@endsection