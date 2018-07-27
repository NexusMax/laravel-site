<?php

use App\User;

use Jenssegers\Date\Date;

Date::setLocale('ru');
?>
@extends('layouts.app')

@section('content')
    <div class="container" style="height: 60vh">
        @if($subscriptions)
            <section class="cart-events profile">
                <div class="row">
                    <h3 class="title">Ваши подписки</h3>
                </div>
            </section>
            <table class="table table-hover">
                <tr>
                    <th>№</th>
                    <th>Вид</th>
                    <th>Дата подписки</th>
                    <th>Стоимость подписки</th>
                    <th>Срок действия</th>
                </tr>
                @foreach($subscriptions as $key)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $key['type'] }}</td>
                        <td>{{ $key['date'] }}</td>
                        <td>{{ $key['cost'] }}</td>
                        <td>{{ $sub_expires }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <section class="cart-events profile">
                <div class="row">
                    <h3 class="title">У Вас еще нет подписок</h3>
                </div>
            </section>
        @endif
    </div>
@endsection