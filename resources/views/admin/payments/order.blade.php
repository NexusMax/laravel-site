<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 09.01.2018
 * Time: 13:53
 */ ?>
@extends('admin.layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            @if (empty($response))
                Новый пакет
            @else
                Изменение {{ $response->id }}
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
            <form action="{{ route('admin/orders/order') }}" method="POST" role="form" id="storeItem">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (!empty($response))
                    <input type="hidden" name="id" value="{{ $response->id }}" />
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Назначение</label>
                        <input class="form-control" type="text" name="deal" value="{{ $response->deal }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">Сумма</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">$</span>
                            <input type="text" class="form-control" placeholder="XX.XX" aria-describedby="sizing-addon2" name="sum" value="{{ $response->sum }}" />
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Пользователь</label>
                        (<a href="#edit_user">изменить</a>)
                        <div class="block view_user">
                            <a href="/admin/users/{{ $response['user']->id }}" target=_blank>{{ $response['user']->name }} {{ $response['user']->lastname }}</a>
                            {{ $response['user']->phone }} ({{ $response['user']->email }})
                        </div>
                        <div class="edit_user" style='display:none;'>
                            <input type=hidden name=user_id value='{{ $response->user_id }}'>
                            <input type=text id='user' class="input_autocomplete" placeholder="Выберите пользователя">
                        </div>
                    </div>
                    <div class="form-group col-md-3 col-xs-6">
                        <label class="container col-xs-12">Активен
                            <input type="checkbox" class="input-group" name="status" value="1" {{ ($response->status==1)?'checked=""':'' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-12 col-xs-12">
                        <label class="h4">Срок действия</label>
                        <input class="form-control" type="date" name="dt" value="{{ date("Y-m-d", strtotime($response->dt)) }}" />
                    </div>
                @else
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Назначение</label>
                        <input class="form-control" type="text" name="deal" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">Сумма</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">$</span>
                            <input type="text" class="form-control" placeholder="XX.XX" aria-describedby="sizing-addon2" name="sum" value="" />
                        </div>
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
                    <div class="form-group col-md-3 col-xs-6">
                        <label class="container col-xs-12">Активен
                            <input type="checkbox" class="input-group" name="status" value="1" checked="" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-12 col-xs-12">
                        <label class="h4">Срок действия</label>
                        <input class="form-control" type="date" name="dt" value="" />
                    </div>
                @endif
                <div class="form-group col-xs-12">
                    <a href="{{ route('admin/orders') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
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

