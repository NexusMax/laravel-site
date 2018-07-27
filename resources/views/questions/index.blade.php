
@extends('layouts.app')

@section('content')
    <div id="pjax-main" class="question-page">

        @include('partials.pagelogo', ['title' => 'Вопрос/Ответ', 'background' => '/../img/training_bg.jpg'])
        <div id="pjax-container">
            <div class="training-wrapper faq-wrapper clearfix">
                <div class="container">
                    <div class="row clearfix">
                        <div class="training-content">
                            <form action="{{ url(Request::url()) }}" method="GET" class="faq-search clearfix">
                                <input type="search" name="q" class="training-search" placeholder="Поиск" value="{{ old('q') }}">
                            </form>

                            {!! $voprosOtvet['fulltext'] !!}

                        </div>

                        @include('partials.sidebar', [
                            'categories' => $categories,
                            'popularItems' => $popularItems
                        ])
                    </div>
                </div>

            </div>
        </div>
        @guest
        @include('partials.moreinf', ['title' => 'Хотите получить доступ ко всем материалам?'])
        @endguest

    </div>

@endsection