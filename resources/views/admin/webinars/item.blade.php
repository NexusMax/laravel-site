<?php /**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 18.04.2018
 * Time: 17:51
 */ ?>

@extends('admin.layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            @if (empty($response['item']))
                Новая оплата
            @else
                Изменение {{ $response['item']->name }}
            @endif
        </div>
        <div class="panel-body">
            @if(count( $errors ) > 0)
                <div class="alert alert-danger" id="error-block">
                    <?php
                    $messages = $errors->all(':message');
                    ?>
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <ul>
                        @foreach($messages as $message)
                            {{ $message }}
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('status'))
                <div class="alert alert-success">
                    {{ Session::get('status') }}
                </div>
            @endif
            <form action="{{ route('admin/webinars/store') }}" method="POST" role="form" id="storeItem" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (!empty($response['item']))
                    <input type="hidden" name="id" value="{{ $response['item']->id }}" />
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Событие</label>
                        <select class="form-control" name="event_id" id="event_id">
                            @foreach ($response['events'] as $c)
                                <option @if ($c->id == $response['item']->event_id)selected="" @endif value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">Email</label>
                        <input type="text" class="form-control" placeholder="Email" aria-describedby="sizing-addon2" name="email" value="{{ $response['item']['email'] }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">Сумма</label>
                        <input type="text" class="form-control" placeholder="Сумма" aria-describedby="sizing-addon2" name="price" value="{{ $response['item']['price'] }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Пользователь</label>
                        (<a href="#edit_user">изменить</a>)
                        <div class="block view_user">
                            <a href="/admin/users/{{ $response['user']['id'] }}" target=_blank>{{ $response['user']['name'] }} {{ $response['user']['lastname'] }}</a>
                            {{ $response['user']['phone'] }} ({{ $response['user']['email'] }})
                        </div>
                        <div class="edit_user" style='display:none;'>
                            <input type=hidden name=user_id value='{{ $response['item']['user_id'] }}'>
                            <input type=text id='user' class="input_autocomplete" placeholder="Выберите пользователя">
                        </div>
                    </div>
                @else
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Событие</label>
                        <select class="form-control" name="event_id" id="event_id">
                            @foreach ($response['events'] as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">Email</label>
                        <input type="text" class="form-control" placeholder="Email" aria-describedby="sizing-addon2" name="email" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">Сумма</label>
                        <input type="text" class="form-control" placeholder="Сумма" aria-describedby="sizing-addon2" name="price" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Пользователь</label>
                        (<a href="#edit_user">изменить</a>)
                        <div class="block view_user">
                            {{--<a href="/admin/users/{{ Auth::user()->id }}" target=_blank>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</a>--}}
                            {{--{{ Auth::user()->phone }} ({{ Auth::user()->email }})--}}
                        </div>
                        <div class="edit_user">
                            <input type=hidden name=user_id value=''>
                            <input type=text id='user' class="input_autocomplete" placeholder="Выберите пользователя">
                        </div>
                    </div>
                @endif
                <div class="form-group col-xs-12">
                    <a href="{{ route('admin/webinars') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function(){
            $("a[href*=edit_user]").click(function() {
                $("div.view_user").hide();
                $("div.edit_user").show();
                return false;
            });
            $("input#user").autocomplete({
                source:'/admin/users/get',
                minlenght:0,
                autoFocus:true,
                noCache: false,
                select:
                    function(suggestion, r){
//                        console.log(suggestion);
                        console.log(r.item.data);
                        $('input[name=email]').val(r.item.data.email);
                        $('input[name=user_id]').val(r.item.data.id);
                    }
            }).on('mouseup', function() {
                $(this).select();
            });
        });
    </script>
@endsection