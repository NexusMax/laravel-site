<?php
use App\User;
?>
@extends('layouts.app')

@section('content')
    <div>

    @include('partials.pagelogo', [
        'title' => 'История бонусов',
        'background' => '/../img/events_bg.jpg',
    ])

        <section class="payment profile">
            <div class="container">
                <div class="row">
                    <h3 class="title">История бонусов</h3>
                </div>

                <div class="row">
                    <div class="payment-wrapper">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Сумма</th>
                                <th>К-во бонусов</th>
                                <th>Значение</th>
                            </tr>
                            @foreach($orders as $key)
                            <tr>
                                <td>{{ $key['id'] }}</td>
                                <td>{{ intval($key['sum']) }}</td>
                                <td>{{ intval($key['bonus']) }}</td>
                                <td>{{ $key['deal'] }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection