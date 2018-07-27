<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 02.01.2018
 * Time: 15:40
 */ ?>
@extends('admin.layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            @if (empty($response['item']))
                Новое событие
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
            <form action="{{ route('admin/event/store') }}" method="POST" role="form" id="storeItem" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (!empty($response['item']))
                    <input type="hidden" name="id" value="{{ $response['item']->id }}" />
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Наименование</label>
                        <input class="form-control" type="text" name="name" value="{{ $response['item']->name }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Категория</label>
                        <select class="form-control" name="category_id" id="category_id">
                            @foreach ($response['categories'] as $c)
                                <option @if ($c->id == $response['item']->category_id)selected="" @endif value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">URL</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">/</span>
                            <input type="text" class="form-control" placeholder="alias" aria-describedby="sizing-addon2" name="alias" value="{{ $response['item']->alias }}" />
                        </div>
                    </div>
                    <div class="form-group col-md-3 col-xs-3">
                        <label class="container col-xs-12">Активен
                            <input type="checkbox" class="input-group" name="published" value="1" {{ ($response['item']->published==1)?'checked=""':'' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-3 col-xs-3">
                        <label class="container col-xs-12">Избранный
                            <input type="checkbox" class="input-group" name="featured" value="1" {{ ($response['item']->featured==1)?'checked=""':'' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Короткое описание</label>
                        <textarea class="form-control editor" name="intro">{{ $response['item']->intro }}</textarea>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Подробное описание</label>
                        <textarea class="form-control editor" name="fulltext">{{ $response['item']->fulltext }}</textarea>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-title</label>
                        <input class="form-control" type="text" name="title" value="{{ $response['item']->title }}" />
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-description</label>
                        <input class="form-control" name="description" id="description" value="{{ $response['item']->description }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Изображение</label>
                        @if ($response['item']->img)
                            <img class="input-group" width="200" src="/img/{{ $response['item']->img }}" />
                            <label class="container col-xs-12">Удалить изображение
                                <input type="checkbox" class="" name="image_r" value="1" />
                                <span class="checkmark"></span>
                            </label>
                        @endif
                        <input type="file" class="input-group" name="img" @if ($response['item']->img)value="/img/{{ $response['item']->img }}"@endif>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Иконки</label>
                        @if ($response['item']->icons)
                            <img class="input-group" width="50" src="/img/icons/{{ $response['item']->icons }}" />
                            <label class="container col-xs-12">Удалить изображение
                                <input type="checkbox" class="" name="icons_r" value="1" />
                                <span class="checkmark"></span>
                            </label>
                        @endif
                        <input type="file" class="input-group" name="icons" />
                    </div>
                    <div class="form-group col-md-12 col-xs-12">
                        <label class="h4" for="basic-url">Видео</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">Vimea video id</span>
                            <input type="text" class="form-control" placeholder="youtube link" aria-describedby="sizing-addon2" name="vimeo" value="{{ $response['item']->vimeo }}" />
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Спикер</label>
                        <input class="form-control" type="text" name="spiker" value="{{ $response['item']->spiker }}" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Дата начала</label>
                        <input class="form-control" type="datetime-local" name="created_at" value="{{ date("Y-m-d", strtotime($response['item']->created_at)).'T'.date("H:i", strtotime($response['item']->created_at)) }}" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="container col-xs-12">Скоро
                            <input type="checkbox" class="input-group" name="without_date" value="1" {{ ($response['item']->without_date==1)?'checked=""':'' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">До когда действует</label>
                        <input class="form-control" type="datetime-local" name="end_at" value="{{ date("Y-m-d", strtotime($response['item']->end_at)).'T'.date("H:i", strtotime($response['item']->end_at)) }}" />
                    </div>
                    <div class="form-group col-md-2 col-xs-12">
                        <label class="h4">Цена</label>
                        <input class="form-control" type="text" name="price" value="{{ $response['item']->price }}" />
                    </div>
                    <div class="form-group col-md-2 col-xs-12">
                        <label class="h4">Старая цена</label>
                        <input class="form-control" type="text" name="old_price" value="{{ $response['item']->old_price }}" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Автор</label>
                        (<a href="#edit_author">изменить</a>)
                        <div class="block view_author">
                            <a href="/admin/users/{{ $response['author']->id }}" target=_blank>{{ $response['author']->name }} {{ $response['author']->lastname }}</a>
                            {{ $response['author']->phone }} ({{ $response['author']->email }})
                        </div>
                        <div class="edit_author" style='display:none;'>
                            <input type=hidden name=author_id value='{{ $response['item']->author_id }}'>
                            <input type=text id='author' class="input_autocomplete" placeholder="Выберите пользователя">
                        </div>
                    </div>
                @else
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Наименование</label>
                        <input class="form-control" type="text" name="name" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Категория</label>
                        <select class="form-control" name="category_id" id="category_id">
                            @foreach ($response['categories'] as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">URL</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">/</span>
                            <input type="text" class="form-control" placeholder="alias" aria-describedby="sizing-addon2" name="alias" value="" />
                        </div>
                    </div>
                    <div class="form-group col-md-3 col-xs-3">
                        <label class="container col-xs-12">Активен
                            <input type="checkbox" class="input-group" name="published" value="1" checked="" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-3 col-xs-3">
                        <label class="container col-xs-12">Избранный
                            <input type="checkbox" class="input-group" name="featured" value="1" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Короткое описание</label>
                        <textarea class="form-control editor" name="intro"></textarea>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Подробное описание</label>
                        <textarea class="form-control editor" name="fulltext"></textarea>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-title</label>
                        <input class="form-control" type="text" name="title" value="" />
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-description</label>
                        <input class="form-control" name="description" id="description" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Изображение</label>
                        <input type="file" class="input-group" name="img" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Иконки</label>
                        <input type="file" class="input-group" name="icons" />
                    </div>
                    <div class="form-group col-md-12 col-xs-12">
                        <label class="h4" for="basic-url">Видео</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">Vimea video id</span>
                            <input type="text" class="form-control" placeholder="youtube link" aria-describedby="sizing-addon2" name="vimeo" value="" />
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Спикер</label>
                        <input class="form-control" type="text" name="spiker" value="" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Дата начала</label>
                        <input class="form-control" type="date" name="created_at" value="" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="container col-xs-12">Скоро
                            <input type="checkbox" class="input-group" name="without_date" value="1" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">До когда действует</label>
                        <input class="form-control" type="datetime-local" name="end_at" value="" />
                    </div>
                    <div class="form-group col-md-2 col-xs-12">
                        <label class="h4">Цена</label>
                        <input class="form-control" type="text" name="price" value="" />
                    </div>
                    <div class="form-group col-md-2 col-xs-12">
                        <label class="h4">Старая цена</label>
                        <input class="form-control" type="text" name="old_price" value="" />
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <label class="h4">Автор</label>
                        (<a href="#edit_author">изменить</a>)
                        <div class="block view_author">
                            <a href="/admin/users/{{ Auth::user()->id }}" target=_blank>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</a>
                            {{ Auth::user()->phone }} ({{ Auth::user()->email }})
                        </div>
                        <div class="edit_author" style='display:none;'>
                            <input type=hidden name=author_id value='{{ Auth::user()->id }}'>
                            <input type=text id='author' class="input_autocomplete" placeholder="Выберите пользователя">
                        </div>
                    </div>
                @endif
                <div class="form-group col-xs-12">
                    <a href="{{ route('admin/event') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function(){
            $("a[href*=edit_author]").click(function() {
                $("div.view_author").hide();
                $("div.edit_author").show();
                return false;
            });
            $("input#author").autocomplete({
                source:'/admin/users/get',
                minlenght:0,
                autoFocus:true,
                noCache: false,
                select:
                    function(suggestion, r){
                        console.log(suggestion);
                        console.log(r.item.data.id);
                        $('input[name=author_id]').val(r.item.data.id);
                    }
            }).on('mouseup', function() {
                $(this).select();
            });
        });
    </script>
@endsection
