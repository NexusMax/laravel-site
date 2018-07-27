

<aside class="training-sidebar">
    <div class="title">Основные разделы:</div>
    <ul class="categories">
        @foreach($categories as $key)
            <li class="<?php if(Request::is('*'.$key['alias'].'*')) echo 'active' ?>">
                @if($key['alias'] === 'questions')
                    <a href="{{ route('questions') }}">
                        @if(!empty( $key['icon_mini'] ))
                        <img class="img-visible" src="/img/icons/mini/{{ $key['icon_mini'] }}" alt="{{ $key['name'] }}">
                        @endif
                        @if(!empty( $key['icon_mini_2'] ))
                        <img class="img-hover" src="/img/icons/mini/{{ $key['icon_mini_2'] }}" alt="{{ $key['name'] }} 1">
                        @endif
                        {{ $key['name'] }}
                    </a>
                @else
                    <a href="{{ route('training/category', ['alias' => $key['alias']]) }}"><img class="img-visible" src="/img/icons/mini/{{ $key['icon_mini'] }}" alt="{{ $key['name'] }}"><img class="img-hover" src="/img/icons/mini/{{ $key['icon_mini_2'] }}" alt="{{ $key['name'] }} 1">{{ $key['name'] }}</a>
                @endif
            </li>
        @endforeach
    </ul>
    <div class="title">Популярное на сайте</div>
    <div class="popular-wrapper">

        @foreach($popularItems as $key)
            <div class="popular-item thumbnail clearfix box-shadow">
                <div class="img-wrapper">
                    <div class="mask">
                        <a href="{{ route('training/view', ['alias' => $key['category']['alias'], 'view' => $key['alias']]) }}">

                            @if(!empty($key['img']) && file_exists(public_path() . '/img/' . $key['img']))

                            <img src="{{ Image::url('/img/' . $key['img'],115,100,array('crop')) }}" alt="{{ $key['name'] }} 2">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="text-block">
                    <a href="{{ route('training/view', ['alias' => $key['category']['alias'], 'view' => $key['alias']]) }}" class="title">{{ mb_substr($key['name'], 0) }}</a>
                    <div class="cat">Категория: {{ $key['category']['name'] }}</div>
                    <?php $created_at = new Date($key['created_at']); ?>
                    <div class="cat">{{ $key['user']['name'] . ' ' . $key['user']['lastname']}}, {{ $created_at->format('d.m.Y') }}</div>
                </div>
            </div>
        @endforeach

    </div>
    @guest
    <?php $segment = Request::segment(1) ?>
    <a href="#" target="popup" data-mfp-src="#popup-special_propos" class="btn popup-with-form">Подписка на рассылку</a>
    @endguest
</aside>