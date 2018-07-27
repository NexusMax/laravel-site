 
@extends('layouts.app')

@section('content')

        <div class="expertsWrapper">
            <article class="expertArticle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <div class="expertArticle-imgWrapper">
                                <img src="/img/team/trener5.jpg" alt="Физический терапевт - Юрий Бардашевский" class="expertArticle-img">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <div class="expertArticle-descr">
                                <h1 class="expertArticle-descr_name">Юрий Бардашевский <span class="expertArticle-descr_job">Физический терапевт</span></h1>
                                <p class="expertArticle-descr_skill">Кандидат наук по физическому воспитанию и спорту;</p>
                                <p class="expertArticle-descr_skill">Доцент, член Украинской Ассоциации физической терапии;</p>
                                <p class="expertArticle-descr_skill">МСМК по гребле на лодках "Дракон";</p>
                                <p class="expertArticle-descr_skill">Чемпион мира и многократный чемпион Европы, </p>
                                <p class="expertArticle-descr_skill">призер Первенства Украины по гребле на байдарках и каноэ</p> 

                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Профессиональная деятельность:</span></p>
                                <p class="expertArticle-descr_skill">Специалист по физической реабилитации;</p>
                                <p class="expertArticle-descr_skill">Персональный тренер категории “эксперт”</p>
                                <p class="expertArticle-descr_skill">Преподаватель-методист по реабилитационному тренингу, двигательной активности при грыжах межпозвонковых дисков</p>

                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Научная деятельность:</span></p>
                                <p class="expertArticle-descr_skill">Автор 23 научных статей и двух коллективных монографий</p>
                                <!-- <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Тренер в соц. сетях:</span><a target="_blank" href="#"><i class="fa fa-facebook"></i></a> <a target="_blank" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></p> -->
                                <div class="expertArticle-descr_certificate">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/bardashevskiy/1.jpg" alt="Физический терапевт - Юрий Бардашевский 1">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/bardashevskiy/2.jpg" alt="Физический терапевт - Юрий Бардашевский 2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/bardashevskiy/3.jpg" alt="Физический терапевт - Юрий Бардашевский 3">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/bardashevskiy/4.jpg" alt="Физический терапевт - Юрий Бардашевский 4">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/bardashevskiy/5.jpg" alt="Физический терапевт - Юрий Бардашевский 5">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/bardashevskiy/6.jpg" alt="Физический терапевт - Юрий Бардашевский 6">
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
                                <img src="/img/team/trener8.jpg" alt="Физический терапевт - Артём Згурский" class="expertArticle-img">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <div class="expertArticle-descr">
                                <h1 class="expertArticle-descr_name">Артём Згурский <span class="expertArticle-descr_job">Физический терапевт</span></h1>
                                <p class="expertArticle-descr_skill">Преподаватель кафедры физической реабилитации Национального университета физического воспитания и спорта Украины</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Образование:</span></p>
                                <p class="expertArticle-descr_skill">НТУУ «КПИ имени Игоря Сикорського»</p>
                                <p class="expertArticle-descr_skill">Факультет «Физического воспитания и спорта»</p>
                                <p class="expertArticle-descr_skill">Кафедра «Физической реабилитации»</p>
                                <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Деятельность:</span></p>
                                <p class="expertArticle-descr_skill">Физическая терапия при заболеваниях и нарушениях опорно-двигательного аппарата;</p>
                                <p class="expertArticle-descr_skill">2007-2012 гг.– Киевская областная клиническая больница;</p>
                                <p class="expertArticle-descr_skill">2012-2017 гг. – МЦ «Добробут»;</p>
                                <p class="expertArticle-descr_skill">С 2017 г. – частная практика.</p>
                                <!-- <p class="expertArticle-descr_skill"><span class="expertArticle-descr_bold">Тренер в соц. сетях:</span><a target="_blank" href="#"><i class="fa fa-facebook"></i></a> <a target="_blank" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></p> -->
                                <div class="expertArticle-descr_certificate">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/zgurskiy/1.jpg" alt="Физический терапевт - Артём Згурский 1">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/zgurskiy/2.jpg" alt="Физический терапевт - Артём Згурский 2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/zgurskiy/3.jpg" alt="Физический терапевт - Артём Згурский 3">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/zgurskiy/4.jpg" alt="Физический терапевт - Артём Згурский 4">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/zgurskiy/5.jpg" alt="Физический терапевт - Артём Згурский 5">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/zgurskiy/6.jpg" alt="Физический терапевт - Артём Згурский 6">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/zgurskiy/7.jpg" alt="Физический терапевт - Артём Згурский 7">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/zgurskiy/8.jpg" alt="Физический терапевт - Артём Згурский 8">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/zgurskiy/9.jpg" alt="Физический терапевт - Артём Згурский 9">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/zgurskiy/10.jpg" alt="Физический терапевт - Артём Згурский 10">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="expertArticle-descr_certificatewrapper">
                                                <img src="/img/zgurskiy/11.jpg" alt="Физический терапевт - Артём Згурский 11">
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
                                    @include('partials.slider-item',['items' => $items_8])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
@endsection