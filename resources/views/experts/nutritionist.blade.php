
@extends('layouts.app')

@section('content')


        <div class="expertsWrapper">

            <article class="expertArticle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="expertArticle-imgWrapper">
                                <img src="/img/team/trener3.jpg" alt="Диетолог - Кристина Шевченко" class="expertArticle-img">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <div class="expertArticle-descr">
                                <h1 class="expertArticle-descr_name">Кристина Шевченко <span class="expertArticle-descr_job">Диетолог</span></h1>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Образование:</span></p>
                                <p class="expertArticle-descr_skill">American College of Sports Medicine (ACSM)</p>
                                <p class="expertArticle-descr_skill">Национальний университет физического воспитания и спорта Украины (НУФВСУ)</p>
                                <p class="expertArticle-descr_skill">American Council on Exercise (ACE)</p>
                                <p class="expertArticle-descr_skill">Yale School of Medicine</p>

                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Области исследований:</span></p>
                                <p class="expertArticle-descr_skill">Нутригеномика;</p>
                                <p class="expertArticle-descr_skill">Спортивная диетология;</p>
                                <p class="expertArticle-descr_skill">Долголетие. </p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Деятельность:</span></p>
                                <p class="expertArticle-descr_skill">Хелс Коуч;</p>
                                <p class="expertArticle-descr_skill">Диетолог;</p>
                                <p class="expertArticle-descr_skill">Фитнес эксперт;</p>
                                <p class="expertArticle-descr_skill">Персональный тренер;</p>
                                <p class="expertArticle-descr_skill">Соучредитель компании Myhelix (<a target="blank" rel="nofollow" href="https://myhelix.com.ua">myhelix.com.ua</a>); Соучредитель сообщества «Клуб 120»  (<a target="blank" rel="nofollow" href="https://www.facebook.com/groups/2164656616893540">https://www.facebook.com/groups/2164656616893540</a>) сообщества людей, которые отслеживают биологические маркеры старения и внедряют привычки для достижения активного долголетия</p>
                                <div class="expertArticle-descr_certificate">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/shevchenko/1.jpg" alt="Диетолог - Кристина Шевченко 1">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/shevchenko/2.jpg" alt="Диетолог - Кристина Шевченко 2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/shevchenko/3.jpg" alt="Диетолог - Кристина Шевченко 3">
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

        </div>
@endsection