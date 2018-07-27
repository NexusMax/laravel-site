<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 12.12.2017
 * Time: 11:25
 */
?>
@extends('admin.layout')

@section('content')
    <script type="text/javascript">
        var adminItems = angular.module('adminItems', []);
        adminItems.controller('ItemsList', function ($scope, $http) {});
        $(document).ready(function() {
            $("#phone").mask("+99 (999) 999-99-99");
        });
    </script>
    <div class="panel panel-default">
        <div class="panel-heading">
            @if (empty($response['user']))
                Новый пользователь
            @else
                Изменение {{ $response['user']->name }}
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

            <form action="{{ route('admin/users/store') }}" method="POST" role="form" id="storeItem" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (!empty($response['user']))
                    <input type="hidden" name="id" value="{{ $response['user']->id }}" />
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Имя</label>
                        <input class="form-control" type="text" name="name" value="{{ $response['user']->name }}" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Фамилия</label>
                        <input class="form-control" type="text" name="lastname" value="{{ $response['user']->lastname }}" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Пароль</label>
                        <input class="form-control" type="text" name="password" value="" disabled="" style="display: none;" />
                        <div class="row">
                            <button class="btn btn-info" id="password">задать пароль</button>
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <span class="col-xs-2">Изображение</span>
                        @if ($response['user']->image)
                            <img class="input-group" width="200" src="@if ($response['user']->image)/user/{{ $response['user']->image }}@endif">
                            <label class="container col-xs-12">Удалить изображение
                                <input type="checkbox" class="" name="image_r" value="1" />
                                <span class="checkmark"></span>
                            </label>
                        @endif
                        <input type="file" class="input-group" name="image" @if ($response['user']->image)value="/user/{{ $response['user']->image }}"@endif>
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="container col-xs-12">Подтверждён
                            <input type="checkbox" class="input-group" name="confirm" value="1" {{ ($response['user']->confirm==1)?'checked=""':'' }} />
                            <span class="checkmark"></span>
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Текст подтверждения</label>
                        <input class="form-control" type="text" name="confirm_text" value="{{ $response['user']->confirm_text }}" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">E-mail</label>
                        <input class="form-control" type="email" name="email" value="{{ $response['user']->email }}" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Телефон</label>
                        <input class="form-control" type="tel" id="phone" name="phone" placeholder="+38 (XXX) XXX-XX-XX" value="{{ $response['user']->phone }}" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Дата рождения</label>
                        <input class="form-control" type="date" name="birthday" value="{{ date("Y-m-d", strtotime($response['user']->birthday)) }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Страна</label>
                        <input class="form-control" type="text" name="country" value="{{ $response['user']->country }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Город</label>
                        <input class="form-control" type="text" name="city" value="{{ $response['user']->city }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Роль</label>
                        @if(!empty($response['user']['role']))
                            <select name="role" id="role" class="form-control form-control-lg">
                                @foreach($response['roles'] as $role)
                                    <option value="{{ $role->id }}"@if($response['user']['role']->id==$role->id) selected=""@endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        @else
                            <select name="role" id="role" class="form-control form-control-lg">
                                @foreach($response['roles'] as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Опыт</label>
                        <select name="experience" id="experience" class="form-control form-control-lg">
                            <option value="0"@if($response['user']->experience==0) selected=""@endif>0-3 лет</option>
                            <option value="1"@if($response['user']->experience==1) selected=""@endif>3-5 лет</option>
                            <option value="2"@if($response['user']->experience==2) selected=""@endif>5-10 лет</option>
                            <option value="3"@if($response['user']->experience==3) selected=""@endif>> 10 лет</option>
                        </select>
                    </div>
                @else
                    <input type="hidden" name="id" value="" />
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Имя</label>
                        <input class="form-control" type="text" name="name" value="" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Фамилия</label>
                        <input class="form-control" type="text" name="lastname" value="" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Пароль</label>
                        <input class="form-control" type="text" name="password" value="" />
                        <div class="row">
                            <button class="btn btn-info" id="password">задать пароль</button>
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <span class="col-xs-2">Изображение</span>
                        <input type="file" class="input-group" name="image" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="container col-xs-12">Подтверждён
                            <input type="checkbox" class="input-group" name="confirm" value="1" checked="" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Текст подтвержления</label>
                        <input class="form-control" type="text" name="confirm_text" value="" />
                    </div>

                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">E-mail</label>
                        <input class="form-control" type="email" name="email" value="" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Телефон</label>
                        <input class="form-control" type="tel" id="phone" name="phone" value="" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Дата рождения</label>
                        <input class="form-control" type="date" name="birthday" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Страна</label>
                        <input class="form-control" type="text" name="country" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Город</label>
                        <input class="form-control" type="text" name="city" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Роль</label>
                        <select name="role" id="role" class="form-control form-control-lg">
                            @foreach($response['roles'] as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Опыт</label>
                        <select name="experience" id="experience" class="form-control form-control-lg">
                            <option value="0">0-3 лет</option>
                            <option value="1">3-5 лет</option>
                            <option value="2">5-10 лет</option>
                            <option value="3">> 10 лет</option>
                        </select>
                    </div>
                @endif
                <div class="button-group">
                    <a href="{{ route('admin/users') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
        <!-- /.col-lg-6 (nested) -->
    </div>
    <!-- /.panel-body -->
    <script>
        $(function(){
            $("button#password").click(function(){
                console.log(1);
                $_password = PassGenJS.getPassword({
                    symbols: 1,
                    letters: 5,
                    numbers: 4,
                    lettersUpper: 2
                });
                $("input[name=password]").removeAttr("disabled").show().val($_password);

                return false;
            });
        });
    </script>
@endsection
