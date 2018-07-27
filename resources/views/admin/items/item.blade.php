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
    <div class="panel panel-default">
        <div class="panel-heading">
            @if (empty($response['item']))
                Новый материал
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
            <form action="{{ route('admin/items/store') }}" method="POST" role="form" id="storeItem"
                  accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (!empty($response['item']))
                    <input type="hidden" name="id" value="{{ $response['item']->id }}"/>

                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label class="h4">Наименование</label>
                            <input class="form-control" type="text" name="name" value="{{ $response['item']->name }}"/>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class="h4">Категория</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    @foreach ($response['categories'] as $c)
                                        <option @if ($c->id == $response['item']->category_id)selected=""
                                                @endif value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">

                                <label class="h4">Дата публикации</label>
                                <div class="input-group">
                                    <input id="created-at-edit" class="form-control" type="datetime-local"
                                           name="created_at"
                                           value="{{ date("Y-m-d", strtotime($response['item']->created_at)).'T'.date("H:i", strtotime($response['item']->created_at)) }}"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>

                            </div>
                        </div>


                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="h4" for="basic-url">URL</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon2">/</span>
                                    <input type="text" class="form-control" placeholder="alias"
                                           aria-describedby="sizing-addon2" name="alias"
                                           value="{{ $response['item']['alias'] }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <div class="form-group">
                                <label class="container col-xs-12">Активен
                                    <input type="checkbox" class="input-group" name="published"
                                           value="1" {{ ($response['item']['published']==1)?'checked=""':'' }}>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <div class="form-group">
                                <label class="container col-xs-12">Избранный
                                    <input type="checkbox" class="input-group" name="featured"
                                           value="1" {{ ($response['item']['featured']==1)?'checked=""':'' }}>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>


                    </div>




                    <div class="form-group col-xs-12">
                        <label class="h4">Короткое описание</label>
                        <textarea class="form-control editor" name="intro">{{ $response['item']['intro'] }}</textarea>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Подробное описание</label>
                        <textarea class="form-control editor"
                                  name="fulltext">{{ $response['item']['fulltext'] }}</textarea>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-title</label>
                        <input class="form-control" type="text" name="title" value="{{ $response['item']['title'] }}"/>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-description</label>
                        <input class="form-control" name="description" id="description"
                               value="{{ $response['item']['description'] }}"/>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Изображение</label>
                        @if ($response['item']->img)
                            <img class="input-group" width="200" src="/img/{{ $response['item']->img }}"/>
                            <label class="container col-xs-12">Удалить изображение
                                <input type="checkbox" class="" name="image_r" value="1"/>
                                <span class="checkmark"></span>
                            </label>
                        @endif
                        <input type="file" class="input-group" name="img"
                               @if ($response['item']->img)value="/img/{{ $response['item']->img }}"@endif>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Иконки</label>
                        @if ($response['item']->icons)
                            <img class="input-group" width="50" src="/img/icons/{{ $response['item']->icons }}"/>
                            <label class="container col-xs-12">Удалить изображение
                                <input type="checkbox" class="" name="icons_r" value="1"/>
                                <span class="checkmark"></span>
                            </label>
                        @endif
                        <input type="file" class="input-group" name="icons"/>
                    </div>
                    <div class="form-group col-md-12 col-xs-12">
                        <label class="h4" for="basic-url">Видео</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">https://www.youtube.com/watch?v=</span>
                            <input type="text" class="form-control" placeholder="youtube link"
                                   aria-describedby="sizing-addon2" name="video"
                                   value="{{ $response['item']['video'] }}"/>
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Фотоальбом</label>
                        <select class="form-control" name="gallery_id" id="gallery_id">
                            <option @if (!$response['item']->gallery_id)selected="" @endif value="">Отсутствует</option>
                            @foreach ($response['photoalbums'] as $p)
                                <option @if ($p->id == $response['item']->gallery_id)selected=""
                                        @endif value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Роль</label>
                        <select name="role_id" id="role" class="form-control form-control-lg">
                            @foreach($response['roles'] as $role)
                                <option value="{{ $role->id }}"
                                        @if($response['item']->role_id==$role->id) selected=""@endif>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Для кого предназначен</label>
                        <select name="user_type" id="user_type" class="form-control form-control-lg">
                            <option value="teacher" @if($response['item']->user_type=='teacher') selected=""@endif>Для
                                тренеров
                            </option>
                            <option value="learner" @if($response['item']->user_type=='learner') selected=""@endif>Для
                                учеников
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Тип</label>
                        <select name="type" id="type" class="form-control form-control-lg">
                            <option value="all" @if($response['item']->type=='all') selected=""@endif>Для всех</option>
                            <option value="private" @if($response['item']->type=='private') selected=""@endif>
                                Приватный
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Тип материала</label>
                        <select name="is_type" id="is_type" class="form-control form-control-lg">
                            <option value="article" @if($response['item']->is_type=='article') selected=""@endif>
                                Статья
                            </option>
                            <option value="case" @if($response['item']->is_type=='case') selected=""@endif>Кейс</option>
                            <option value="book" @if($response['item']->is_type=='book') selected=""@endif>Книги
                            </option>
                            <option value="tutorials" @if($response['item']->is_type=='tutorials') selected=""@endif>
                                Учебники
                            </option>
                            <option value="paper" @if($response['item']->is_type=='paper') selected=""@endif>Статьи
                                библиотеки
                            </option>
                            <option value="benefits" @if($response['item']->is_type=='benefits') selected=""@endif>
                                Пособия
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Автор</label>
                        (<a href="#edit_author">изменить</a>)
                        <div class="block view_author">
                            <a href="/admin/users/{{ $response['author']->id }}"
                               target=_blank>{{ $response['author']->name }} {{ $response['author']->lastname }}</a>
                            {{ $response['author']->phone }} ({{ $response['author']->email }})
                        </div>
                        <div class="edit_author" style='display:none;'>
                            <input type=hidden name=author_id value='{{ $response['item']->author_id }}'>
                            <input type=text id='author' class="input_autocomplete" placeholder="Выберите пользователя">
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label class="h4">Наименование</label>
                            <input class="form-control" type="text" name="name" value=""/>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class="h4">Категория</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    @foreach ($response['categories'] as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class="h4">Дата публикации</label>

                                <div class="input-group">
                                    <input id="created-at-edit" class="form-control" type="datetime-local"
                                           name="created_at"
                                           value=""/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label class="h4" for="basic-url">URL</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon2">/</span>
                                    <input type="text" class="form-control" placeholder="alias"
                                           aria-describedby="sizing-addon2" name="alias" value=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <div class="form-group">
                                <label class="container col-xs-12">Активен
                                    <input type="checkbox" class="input-group" name="published" value="1"/>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <div class="form-group">
                                <label class="container col-xs-12">Избранный
                                    <input type="checkbox" class="input-group" name="featured" value="1"/>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
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
                        <input class="form-control" type="text" name="title" value=""/>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-description</label>
                        <input class="form-control" name="description" id="description" value=""/>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Изображение</label>
                        <input type="file" class="input-group" name="img"/>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Иконки</label>
                        <input type="file" class="input-group" name="icons"/>
                    </div>
                    <div class="form-group col-md-12 col-xs-12">
                        <label class="h4" for="basic-url">Видео</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">https://www.youtube.com/</span>
                            <input type="text" class="form-control" placeholder="youtube link"
                                   aria-describedby="sizing-addon2" name="video" value=""/>
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Фотоальбом</label>
                        <select class="form-control" name="gallery_id" id="gallery_id">
                            <option value="">Отсутствует</option>
                            @foreach ($response['photoalbums'] as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Роль</label>
                        <select name="role_id" id="role" class="form-control form-control-lg">
                            @foreach($response['roles'] as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Для кого предназначен</label>
                        <select name="user_type" id="user_type" class="form-control form-control-lg">
                            <option value="teacher">Для тренеров</option>
                            <option value="learner">Для учеников</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Тип доступа</label>
                        <select name="type" id="type" class="form-control form-control-lg">
                            <option value="all" selected="">Для всех</option>
                            <option value="private">Приватный</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Тип материала</label>
                        <select name="is_type" id="is_type" class="form-control form-control-lg">
                            <option value="article" selected="">Статья</option>
                            <option value="case">Кейс</option>
                            <option value="book">Книги</option>
                            <option value="tutorials">Учебники</option>
                            <option value="paper">Статьи библиотеки</option>
                            <option value="benefits">Пособия</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Автор</label>
                        (<a href="#edit_author">изменить</a>)
                        <div class="block view_author">
                            <a href="/admin/users/{{ Auth::user()->id }}"
                               target=_blank>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</a>
                            {{ Auth::user()->phone }} ({{ Auth::user()->email }})
                        </div>
                        <div class="edit_author" style='display:none;'>
                            <input type=hidden name=author_id value='{{ Auth::user()->id }}'>
                            <input type=text id='author' class="input_autocomplete" placeholder="Выберите пользователя">
                        </div>
                    </div>
                @endif
                <div class="form-group col-xs-12">
                    <a href="{{ route('admin/items') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $('#created-at-edit').datetimepicker({
                locale: 'ru',
                format: 'YYYY-MM-DDTHH:mm'
            });
        });
    </script>

    <script>
        $(function () {
            $("a[href*=edit_author]").click(function () {
                $("div.view_author").hide();
                $("div.edit_author").show();
                return false;
            });
            $("input#author").autocomplete({
                source: '/admin/users/get',
                minlenght: 0,
                autoFocus: true,
                noCache: false,
                select:
                    function (suggestion, r) {
                        console.log(suggestion);
                        console.log(r.item.data.id);
                        $('input[name=author_id]').val(r.item.data.id);
                    }
            }).on('mouseup', function () {
                $(this).select();
            });
        });
    </script>
@endsection