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
            @if (empty($response))
                Новая категория
            @else
                Изменение {{ $response->name }}
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
            <form action="{{ route('admin/categories/store') }}" method="POST" role="form" id="storeItem">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (!empty($response))
                    <input type="hidden" name="id" value="{{ $response->id }}" />
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Наименование</label>
                        <input class="form-control" type="text" name="name" value="{{ $response->name }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">URL</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">/</span>
                            <input type="text" class="form-control" placeholder="alias" aria-describedby="sizing-addon2" name="alias" value="{{ $response->alias }}" />
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Изображение</label>
                        @if ($response->img)
                            <img class="input-group" width="200" src="/img/{{ $response->img }}" />
                            <label class="container col-xs-12">Удалить изображение
                                <input type="checkbox" class="" name="image_r" value="1" />
                                <span class="checkmark"></span>
                            </label>
                        @endif
                        <input type="file" class="input-group" name="img" @if ($response->img)value="/img/{{ $response->img }}"@endif>
                    </div>
                    <div class="form-group col-md-3 col-xs-6">
                        <label class="container col-xs-12">Активен
                            <input type="checkbox" class="input-group" name="published" value="1" {{ ($response->published==1)?'checked=""':'' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-3 col-xs-6">
                        <label class="container col-xs-12">Избранный
                            <input type="checkbox" class="input-group" name="featured" value="1" {{ ($response->featured==1)?'checked=""':'' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-3 col-xs-6">
                        <label class="container col-xs-12">Категория для видео
                            <input type="checkbox" class="input-group" name="is_video" value="1" {{ ($response->is_video==1)?'checked=""':'' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Короткое описание</label>
                        <textarea class="form-control editor" name="about">{{ $response->about }}</textarea>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-title</label>
                        <input class="form-control" type="text" name="title" value="{{ $response->title }}" />
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-description</label>
                        <input class="form-control" name="description" id="description" value="{{ $response->description }}" />
                    </div>
                    <div class="panel panel-default col-xs-12">
                        <div class="panel panel-header">Иконки</div>
                        <div class="form-group col-xs-2">
                            <label class="h4">Не активная</label>
                            @if ($response->icon)
                                <img class="input-group" width="50" src="/img/icons/{{ $response->icon }}" />
                                <label class="container col-xs-12">Удалить
                                    <input type="checkbox" class="" name="icon_r" value="1" />
                                    <span class="checkmark"></span>
                                </label>
                            @endif
                            <input type="file" class="input-group" name="icon" @if ($response->icon)value="/img/icons/{{ $response->icon }}"@endif>
                        </div>
                        <div class="form-group col-xs-2">
                            <label class="h4">Наведённая</label>
                            @if ($response->icon_hover)
                                <img class="input-group" width="50" src="/img/icons/{{ $response->icon_hover }}" />
                                <label class="container col-xs-12">Удалить
                                    <input type="checkbox" class="" name="icon_hover_r" value="1" />
                                    <span class="checkmark"></span>
                                </label>
                            @endif
                            <input type="file" class="input-group" name="icon_hover" @if ($response->icon_hover)value="/img/icons/{{ $response->icon_hover }}"@endif>
                        </div>
                        <div class="form-group col-xs-2">
                            <label class="h4">Активная</label>
                            @if ($response->icon_3)
                                <img class="input-group" width="50" src="/img/icons/{{ $response->icon_3 }}" />
                                <label class="container col-xs-12">Удалить
                                    <input type="checkbox" class="" name="icon_3_r" value="1" />
                                    <span class="checkmark"></span>
                                </label>
                            @endif
                            <input type="file" class="input-group" name="icon_3" @if ($response->icon_3)value="/img/icons/{{ $response->icon_3 }}"@endif>
                        </div>
                        <div class="form-group col-xs-2">
                            <label class="h4">Мини</label>
                            @if ($response->icon_mini)
                                <img class="input-group" width="50" src="/img/icons/{{ $response->icon_mini }}" />
                                <label class="container col-xs-12">Удалить
                                    <input type="checkbox" class="" name="icon_mini_r" value="1" />
                                    <span class="checkmark"></span>
                                </label>
                            @endif
                            <input type="file" class="input-group" name="icon_mini" @if ($response->icon_mini)value="/img/icons/{{ $response->icon_mini }}"@endif>
                        </div>
                        <div class="form-group col-xs-4">
                            <label class="h4">Мини 2</label>
                            @if ($response->icon_mini_2)
                                <img class="input-group" width="50" src="/img/icons/{{ $response->icon_mini_2 }}" />
                                <label class="container col-xs-12">Удалить
                                    <input type="checkbox" class="" name="icon_mini_2_r" value="1" />
                                    <span class="checkmark"></span>
                                </label>
                            @endif
                            <input type="file" class="input-group" name="icon_mini_2" @if ($response->icon_mini_2)value="/img/icons/{{ $response->icon_mini_2 }}"@endif>
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label class="h4">Наименование статьи</label>
                            <input class="form-control" type="text" name="name_article" value="{{ $response->name_article }}" />
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label class="h4">Наименование кейса</label>
                            <input class="form-control" type="text" name="name_briefcases" value="{{ $response->name_briefcases }}" />
                        </div>
                    </div>
                @else
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Наименование</label>
                        <input class="form-control" type="text" name="name" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">URL</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">/</span>
                            <input type="text" class="form-control" placeholder="alias" aria-describedby="sizing-addon2" name="alias" value="" />
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Изображение</label>
                        <input type="file" class="input-group" name="img" />
                    </div>
                    <div class="form-group col-md-3 col-xs-6">
                        <label class="container col-xs-12">Активен
                            <input type="checkbox" class="input-group" name="published" value="1" checked="" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-3 col-xs-6">
                        <label class="container col-xs-12">Избранный
                            <input type="checkbox" class="input-group" name="featured" value="1" checked="" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-3 col-xs-6">
                        <label class="container col-xs-12">Категория для видео
                            <input type="checkbox" class="input-group" name="is_video" value="1" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Короткое описание</label>
                        <textarea class="form-control editor" name="about"></textarea>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-title</label>
                        <input class="form-control" type="text" name="title" value="" />
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-description</label>
                        <input class="form-control" name="description" id="description" value="" />
                    </div>
                    <div class="panel panel-default col-xs-12">
                        <div class="panel panel-header">Иконки</div>
                        <div class="form-group col-xs-4">
                            <label class="h4">Не активная</label>
                            <input type="file" class="input-group" name="icon" />
                        </div>
                        <div class="form-group col-xs-4">
                            <label class="h4">Наведённая</label>
                            <input type="file" class="input-group" name="icon_hover" />
                        </div>
                        <div class="form-group col-xs-4">
                            <label class="h4">Активная</label>
                            <input type="file" class="input-group" name="icon_3" />
                        </div>
                    </div>
                @endif
                <div class="form-group col-xs-12">
                    <a href="{{ route('admin/categories') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
        <!-- /.col-lg-6 (nested) -->
    </div>
    <!-- /.panel-body -->
@endsection