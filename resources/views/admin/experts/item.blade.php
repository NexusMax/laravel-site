<?php /**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 12.12.2017
 * Time: 11:25
 */ ?>
@extends('admin.layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            @if (empty($response['item']))
                Новый эксперт
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
            <form action="{{ route('admin/experts/store') }}" method="POST" role="form" id="storeItem" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (!empty($response['item']))
                    <input type="hidden" name="id" value="{{ $response['item']->id }}" />
                    <div class="form-group col-md-3 col-xs-3">
                        <label class="container col-xs-12">Активен
                            <input type="checkbox" class="input-group" name="active" value="1" {{ ($response['item']['active']==1)?'checked=""':'' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Описание</label>
                        <textarea class="form-control editor" name="body">{{ $response['item']['body'] }}</textarea>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-title</label>
                        <input class="form-control" type="text" name="meta_title" value="{{ $response['item']['meta_title'] }}" />
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-description</label>
                        <input class="form-control" name="meta_desc" id="description" value="{{ $response['item']['meta_desc'] }}" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Link FB</label>
                        <input class="form-control" type="text" name="link_fb" value="{{ $response['item']['link_fb'] }}" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Link Instagram</label>
                        <input class="form-control" type="text" name="link_in" value="{{ $response['item']['link_in'] }}" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Порядковый номер</label>
                        <input class="form-control" type="number" name="position" value="{{ $response['item']['position'] }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Группа эксперта</label>
                        <select name="group_id" id="group" class="form-control form-control-lg">
                            @foreach($response['groups'] as $group)
                                <option value="{{ $group->id }}" @if($response['item']->group_id==$group->id) selected=""@endif>{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Пользователь</label>
                        (<a href="#edit_user">изменить</a>)
                        <div class="block view_user">
                            <a href="/admin/users/{{ $response['user']->id }}" target=_blank>{{ $response['user']->name }} {{ $response['user']->lastname }}</a>
                        </div>
                        <div class="edit_user" style='display:none;'>
                            <input type=hidden name=user_id value='{{ $response['item']->user_id }}'>
                            <input type=text id='user' class="input_autocomplete" placeholder="Выберите пользователя">
                        </div>
                    </div>
                @else
                    <div class="form-group col-md-3 col-xs-3">
                        <label class="container col-xs-12">Активен
                            <input type="checkbox" class="input-group" name="active" value="1" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Описание</label>
                        <textarea class="form-control editor" name="body"></textarea>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-title</label>
                        <input class="form-control" type="text" name="meta_title" value="" />
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-description</label>
                        <input class="form-control" name="meta_desc" id="description" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Link FB</label>
                        <input class="form-control" type="text" name="link_fb" value="" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Link Instagram</label>
                        <input class="form-control" type="text" name="link_in" value="" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Порядковый номер</label>
                        <input class="form-control" type="number" name="position" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Группа</label>
                        <select name="group_id" id="role" class="form-control form-control-lg">
                            @foreach($response['groups'] as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Пользователь</label>
                        <div class="edit_user">
                            <input type=hidden name=user_id value=''>
                            <input type=text id='user' class="input_autocomplete" placeholder="Выберите пользователя">
                        </div>
                    </div>
                @endif
                <div class="form-group col-xs-12">
                    <a href="{{ route('admin/experts') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
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
                        console.log(suggestion);
                        console.log(r.item.data.id);
                        $('input[name=user_id]').val(r.item.data.id);
                    }
            }).on('mouseup', function() {
                $(this).select();
            });
        });
    </script>
@endsection