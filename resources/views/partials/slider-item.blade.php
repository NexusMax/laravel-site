<?php
use App\Items;
use Jenssegers\Date\Date;
use App\Orders;
Date::setLocale('ru');
?>

@foreach($items as $key)
    <div class="oc2_item">
        <a href="{{ route('training/view', ['alias' => $key['category']['alias'], 'view' => $key['alias']]) }}">
        <div class="mask">

            @if(!empty($key['img']) && file_exists('img/'.$key['img']))
                <img src="/img/{{ $key['img'] }}" alt="{{ $key['name'] }}">
            @else
                <img src="/vendor/img/nophoto.jpg" alt="{{ $key['name'] }}">
            @endif

            @if(Items::isPrivate($key['type']))
                @if(Auth::guest())
                <img src="/img/lock.png" alt="{!! strip_tags(mb_substr($key['intro'], 0 , 55)) . '...' !!} приватная" class="lock">
                @elseif(!Orders::payed())
                <img src="/img/lock.png" alt="{!! strip_tags(mb_substr($key['intro'], 0 , 55)) . '...' !!} приватная" class="lock">
                @endif
            @endif
            <span class="oc2-capture">{{ $key['name'] }}</span>
        </div>
        </a>
        <div class="oc2-item_block">

            <p class="oc2-name">{{ $key['user']['name'] . ' ' .  $key['user']['lastname'] }}</p>
            <?php $created_at = new Date($key['created_at']); ?>
            <p class="oc2-date">{{ $created_at->format('d.m.Y') }}</p>
            <p class="oc2-cat"><strong>Категория:</strong> {{ $key['category']['name'] }}</p>
            <p class="oc2-access"><strong>Уровень доступа:</strong> {{ Items::getNamePermission($key['type']) }}</p>
            <p class="oc2-descr">{!! strip_tags(mb_substr($key['intro'], 0 , 55)) . '...' !!}</p>
        </div>
    </div>
@endforeach