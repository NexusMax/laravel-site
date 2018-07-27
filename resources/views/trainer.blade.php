@extends('layouts.app')

@section('content')
    <div id="trainer">

    @include('partials.pagelogo', ['title' => 'Самые полезные<br>и ценные материалы - на одном ресурсе', 'background' => '../img/trainer_bg.jpg'])
    <div class="trainer-content">
        <div class="container">
            <div class="row cattegory-items-wrapper">

                @foreach($categories as $key)
                @if($key['alias'] === 'questions')
                    <a href="{{ route('questions') }}">
                @else
                    <a href="{{ route('training/category', ['alias' => $key['alias']]) }}">
                @endif

                <div class="cattegory-item" id="t-cat{{ $loop->iteration }}">
                    <div class="mask-cat">
                        <img src="/img/{{ $key['img'] }}" alt="{{ $key['name'] }}" class="img-bg">

                        <div class="icon-wrapper">
                            <img src="/img/icons/{{ $key['icon'] }}" alt="{{ $key['name'] }} 1" class="icon icon-start">
                            <img src="/img/icons/{{ $key['icon_hover'] }}" alt="{{ $key['name'] }} 2" class="icon icon-hover" style="display: none;">

                        </div>
                        <div class="title">{{ $key['name'] }}</div>
                        <p class="descr">{{ $key['title'] }}</p>
                        <div class="btn">Перейти в раздел</div>
                    </div>
                </div>
            </a>
                @endforeach

            </div>
        </div>
    </div>
    </div>
@endsection