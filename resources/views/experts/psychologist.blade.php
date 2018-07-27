 
@extends('layouts.app')

@section('content')

        <div class="expertsWrapper">
            <article class="expertArticle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="expertArticle-imgWrapper">
                                <img src="/img/team/trener2.jpg" alt="Психолог - Елена Горкун" class="expertArticle-img">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <div class="expertArticle-descr">
                                <h1 class="expertArticle-descr_name">Елена Горкун <span class="expertArticle-descr_job">Психолог</span></h1>
                                <p class="expertArticle-descr_skill">Член Ассоциации врачей и психологов. Специализируется на терапии и превенции расстройств пищевого поведения.</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Образование:</span></p>
                                <p class="expertArticle-descr_skill">НУ «Киево-Могилянская Академия», Магистр социологических наук;</p>
                                <p class="expertArticle-descr_skill">Московский гештальт-институт</p>
                                <p class="expertArticle-descr_skill">Школа психотерапии Игоря Погодина</p>
                                <p class="expertArticle-descr_skill">Специализации: «Диалоговая модель гештальт-терапии», «Расстройства пищевого поведения», «Работа с кризисами и травмами в гештальт-подходе».</p>

                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Деятельность:</span></p>
                                <p class="expertArticle-descr_skill">Гештальт-терапевт;</p>
                                <p class="expertArticle-descr_skill">Персональный тренер;</p>
                                <p class="expertArticle-descr_skill">Методист в Школе фитнес-инструктора «Fitnesservice»</p>
                                <!-- <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Тренер в соц. сетях:</span><a target="_blank" href="#"><i class="fa fa-facebook"></i></a> <a target="_blank" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></p> -->
                                <div class="expertArticle-descr_certificate">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/gorkun/1.jpg" alt="Психолог - Елена Горкун 1">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/gorkun/2.jpg" alt="Психолог - Елена Горкун 2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/gorkun/3.jpg" alt="Психолог - Елена Горкун 3">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/gorkun/4.jpg" alt="Психолог - Елена Горкун 4">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/gorkun/5.jpg" alt="Психолог - Елена Горкун 5">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/gorkun/6.jpg" alt="Психолог - Елена Горкун 6">
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