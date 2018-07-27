
@extends('layouts.app')

@section('content')

    <div id="pjax-main">
        <div class="expertsWrapper">

            <article class="expertArticle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="expertArticle-imgWrapper">
                                <img src="/img/team/trener4.jpg" alt="Фитнес эксперт - Лилия Савох (Ханас)" class="expertArticle-img">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <div class="expertArticle-descr">
                                <h1 class="expertArticle-descr_name">Лилия Савох (Ханас) <span class="expertArticle-descr_job">фитнес-эксперт</span></h1>
                                <p class="expertArticle-descr_skill">Фитнес-менеджер проекта Sportcasta;</p>
                                <p class="expertArticle-descr_skill">Мастер спорта по пауэрлифтингу (жим лежа);</p>
                                <p class="expertArticle-descr_skill">Опыт работы  - более 16 лет </p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Образование:</span></p>
                                <p class="expertArticle-descr_skill">Луганское медучилище</p>
                                <p class="expertArticle-descr_skill">ЛНУ им. Тараса Шевченко</p>
                                <p class="expertArticle-descr_skill">специальности: </p>
                                <p class="expertArticle-descr_skill">химия и биология;</p>
                                <p class="expertArticle-descr_skill">адаптивная физическая культура и физическая реабилитация</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Деятельность:</span></p>
                                <p class="expertArticle-descr_skill">Преподаватель-методист в школе персонального тренера;</p>
                                <p class="expertArticle-descr_skill">Специалист по физической реабилитации (ЛФК и МФР); </p>
                                <p class="expertArticle-descr_skill">Персональный тренер-универсал высшей категории (категории мастер+VIP);</p>
                                <p class="expertArticle-descr_skill">Тренер по питанию, нутриционист</p>
                                
                                <div class="expertArticle-descr_certificate">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/savoh/1.jpg" alt="Фитнес эксперт - Лилия Савох (Ханас) 1" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/savoh/2.jpg" alt="Фитнес эксперт - Лилия Савох (Ханас) 2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/savoh/3.jpg" alt="Фитнес эксперт - Лилия Савох (Ханас) 3">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/savoh/4.jpg" alt="Фитнес эксперт - Лилия Савох (Ханас) 4">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/savoh/5.jpg" alt="Фитнес эксперт - Лилия Савох (Ханас) 5">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/savoh/6.jpg" alt="Фитнес эксперт - Лилия Савох (Ханас) 6">
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="expertArticles">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="titleh3 wow fadeInUp expertArticles_title">МАТЕРИАЛЫ АВТОРА</h3>
                                <div class="owl-carousel owl-carousel2 owl-theme">
                                    @include('partials.slider-item',['items' => $items_2])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <article class="expertArticle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="expertArticle-imgWrapper">
                                <img src="/img/team/trener1.jpg" alt="Фитнес эксперт - Александр Довгич" class="expertArticle-img">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <div class="expertArticle-descr">
                                <h3 class="expertArticle-descr_name">Александр Довгич <span class="expertArticle-descr_job">фитнес-эксперт</span></h3>
                                <p class="expertArticle-descr_skill">Кандидат наук по физическому воспитанию и спорту;</p>
                                <p class="expertArticle-descr_skill">Доцент кафедры здоровья, фитнеса и рекреации в НУФВС Украины;</p>
                                <p class="expertArticle-descr_skill">КМС по гиревому спорту, обладатель коричневого пояса по карате.</p>
                                <p class="expertArticle-descr_skill">Презентер фитнес конвенций: «Nike», «Lviv Fitness Weekend», «Сезоны»;</p>
                                <p class="expertArticle-descr_skill">Преподаватель на кафедре фитнеса и рекреации в НУФВСУ;</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Образование:</span></p> 
                                <p class="expertArticle-descr_skill">Национальный университет физического воспитания и спорта Украины;</p>
                                <p class="expertArticle-descr_skill">Специальность: тренер-преподаватель.</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Профессиональная деятельность:</span></p>
                                <p class="expertArticle-descr_skill">Персональный тренер категории «эксперт»;</p>
                                <p class="expertArticle-descr_skill">Специалист по физической реабилитации; </p>
                                <p class="expertArticle-descr_skill">Сертифицированный специалист по миофасциальному релизу;</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Научная деятельность:</span></p>
                                <p class="expertArticle-descr_skill">Автор более 15 научных статей;</p>
                                <p class="expertArticle-descr_skill">Автор инновационных подходов в проведении функциональной тренировки.</p>
                                <!-- <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Тренер в соц. сетях:</span><a target="_blank" href="#"><i class="fa fa-facebook"></i></a> <a target="_blank" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></p> -->
                                <div class="expertArticle-descr_certificate">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/dovgich/1.jpg" alt="Фитнес эксперт - Александр Довгич 1">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/dovgich/2.jpg" alt="Фитнес эксперт - Александр Довгич 2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/dovgich/3.jpg" alt="Фитнес эксперт - Александр Довгич 3">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/dovgich/4.jpg" alt="Фитнес эксперт - Александр Довгич 4">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/dovgich/5.jpg" alt="Фитнес эксперт - Александр Довгич 5">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/dovgich/6.jpg" alt="Фитнес эксперт - Александр Довгич 6">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/dovgich/7.jpg" alt="Фитнес эксперт - Александр Довгич 7">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/dovgich/8.jpg" alt="Фитнес эксперт - Александр Довгич 8">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/dovgich/9.jpg" alt="Фитнес эксперт - Александр Довгич 9">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/dovgich/10.jpg" alt="Фитнес эксперт - Александр Довгич 10">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/dovgich/11.jpg" alt="Фитнес эксперт - Александр Довгич 11">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="expertArticles">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="titleh3 wow fadeInUp expertArticles_title">МАТЕРИАЛЫ АВТОРА</h3>
                                <div class="owl-carousel owl-carousel2 owl-theme">
                                    @include('partials.slider-item',['items' => $items])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <article class="expertArticle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="expertArticle-imgWrapper">
                                <img src="/img/team/trener6.jpg" alt="Фитнес эксперт - Артур Янковский" class="expertArticle-img">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <div class="expertArticle-descr">
                                <h3 class="expertArticle-descr_name">Артур Янковский <span class="expertArticle-descr_job">фитнес-эксперт</span></h3>
                                
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Образование:</span></p>
                                <p class="expertArticle-descr_skill">НПУ им. Драгоманова специальность «Физическая реабилитация»</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Деятельность:</span></p>
                                <p class="expertArticle-descr_skill">Персональный тренер высшей категории по фитнесу и силовому атлетизму;</p>
                                <p class="expertArticle-descr_skill">Консультант по питанию;</p>
                                <p class="expertArticle-descr_skill">Специалист по физической реабилитации в медцентре доктора Бубновского;</p>
                                <p class="expertArticle-descr_skill">Специалист по физической реабилитации в клинике Аксимед;</p>
                                <p class="expertArticle-descr_skill">Консультант по предродовому и послеродовому тренингу;</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Достижения:</span></p>
                                <p class="expertArticle-descr_skill">Многократный чемпион Киева по рукопашному бою</p>
                                <p class="expertArticle-descr_skill">Чемпион Украины по кикбоксингу</p>
                                
                                <div class="expertArticle-descr_certificate">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/yanovskiy/1.jpg" alt="Фитнес эксперт - Артур Янковский 1">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/yanovskiy/2.jpg" alt="Фитнес эксперт - Артур Янковский 2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/yanovskiy/3.jpg" alt="Фитнес эксперт - Артур Янковский 3">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/yanovskiy/4.jpg" alt="Фитнес эксперт - Артур Янковский 4">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/yanovskiy/5.jpg" alt="Фитнес эксперт - Артур Янковский 5">
                                            </div>
                                        </div>                                       

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="expertArticles">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="titleh3 wow fadeInUp expertArticles_title">МАТЕРИАЛЫ АВТОРА</h3>
                                <div class="owl-carousel owl-carousel2 owl-theme">
                                    @include('partials.slider-item',['items' => $items_3])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <article class="expertArticle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="expertArticle-imgWrapper">
                                <img src="/img/team/trener7.jpg" alt="Фитнес эксперт - Екатерина Глушко" class="expertArticle-img">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <div class="expertArticle-descr">
                                <h3 class="expertArticle-descr_name">Екатерина Глушко <span class="expertArticle-descr_job">фитнес-эксперт проекта</span></h3>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Направление:</span></p>
                                <p class="expertArticle-descr_skill">stretching, mind body, миофасциальный релиз</p>
                                <p class="expertArticle-descr_skill">Победитель конкурса презентеров ProFit Convention-2016. Сертифицированный специалист в направлениях стретчинг, пилатес, флай(антигравити) фитнес, аэробика и степ, функциональный тренинг, TRX, фитнес для беременных, Port de bras, dance. </p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Образование:</span></p>
                                <p class="expertArticle-descr_skill">Магистр международной экономики Донецкого национального университета, аспирантура по специальности мировое хозяйство и международные экономические отношения ДонНУ</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Профессиональная деятельность:</span></p>
                                <p class="expertArticle-descr_skill">Презентер национальных конвенций</p>
                                <p class="expertArticle-descr_skill">методист Smart fitness Academy и Академии Фитнеса Украины</p>
                                <p class="expertArticle-descr_skill">персональный тренер и фитнес тренер универсал групповых направлений Body Art Fitness.</p>
                                <!-- <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Тренер в соц. сетях:</span><a target="_blank" href="#"><i class="fa fa-facebook"></i></a> <a target="_blank" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></p> -->
                                <div class="expertArticle-descr_certificate">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/ekaterina/1.jpg" alt="Фитнес эксперт - Екатерина Глушко 1">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/ekaterina/2.jpg" alt="Фитнес эксперт - Екатерина Глушко 2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/ekaterina/3.jpg" alt="Фитнес эксперт - Екатерина Глушко 3">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/ekaterina/4.jpg" alt="Фитнес эксперт - Екатерина Глушко 4">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/ekaterina/5.jpg" alt="Фитнес эксперт - Екатерина Глушко 5">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/ekaterina/6.jpg" alt="Фитнес эксперт - Екатерина Глушко 6">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/ekaterina/7.jpg" alt="Фитнес эксперт - Екатерина Глушко 7">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="expertArticles">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="titleh3 wow fadeInUp expertArticles_title">МАТЕРИАЛЫ АВТОРА</h3>
                                <div class="owl-carousel owl-carousel2 owl-theme">
                                    @include('partials.slider-item',['items' => $items_4])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <article class="expertArticle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="expertArticle-imgWrapper">
                                <img src="/img/team/trener9.jpg" alt="Фитнес-эксперт проекта SportCasta - Сергей Пуцов" class="expertArticle-img">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <div class="expertArticle-descr">
                                <h1 class="expertArticle-descr_name">Сергей Пуцов <span class="expertArticle-descr_job">фитнес-эксперт проекта SportCasta</span></h1>
                                <p class="expertArticle-descr_skill">Кандидат наук по физическому воспитанию и спорту;</p>
                                <p class="expertArticle-descr_skill">Мастер спорта по тяжелой атлетике. Чемпион Украины.</p>
                                <p class="expertArticle-descr_skill">Международный презентер по направлениям функциональный тренинг и тяжелая атлетика.</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Образование:</span></p>
                                <p class="expertArticle-descr_skill">Национальный университет физического воспитания и спорта Украины;</p>
                                <p class="expertArticle-descr_skill">International Olympic Academy (Греция).</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Профессиональная деятельность:</span></p>
                                <p class="expertArticle-descr_skill">Главный тренер в <a href="torokhtiy.com">torokhtiy.com</a>, <a href="torwod.com">torwod.com</a>;</p>
                                <p class="expertArticle-descr_skill">Фитнес-директор клуба Discilpine;</p>
                                <p class="expertArticle-descr_skill">Совладелец фитнес-конвенции Lviv Fitness Weekend.</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Научная деятельность:</span></p>
                                <p class="expertArticle-descr_skill">Автор более 20 научных статей.</p>
                                <!-- <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Тренер в соц. сетях:</span><a target="_blank" href="#"><i class="fa fa-facebook"></i></a> <a target="_blank" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></p> -->
                                <div class="expertArticle-descr_certificate">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/putsov/1.jpg" alt="Фитнес-эксперт проекта SportCasta - Сергей Пуцов 1">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/putsov/2.jpg" alt="Фитнес-эксперт проекта SportCasta - Сергей Пуцов 2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/putsov/3.jpg" alt="Фитнес-эксперт проекта SportCasta - Сергей Пуцов 3">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/putsov/4.jpg" alt="Фитнес-эксперт проекта SportCasta - Сергей Пуцов 4">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/putsov/5.jpg" alt="Фитнес-эксперт проекта SportCasta - Сергей Пуцов 5">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/putsov/6.jpg" alt="Фитнес-эксперт проекта SportCasta - Сергей Пуцов 6">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="expertArticles">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="titleh3 wow fadeInUp expertArticles_title">МАТЕРИАЛЫ АВТОРА</h3>
                                <div class="owl-carousel owl-carousel2 owl-theme">
                                    @include('partials.slider-item',['items' => $items_9])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

        </div>
    </div>
@endsection