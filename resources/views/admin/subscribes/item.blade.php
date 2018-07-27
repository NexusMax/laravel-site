<?php
/**
 * Created by PhpStorm.
 * User: Andrii
 * Date: 10.01.2018
 * Time: 1:00
 */ ?>
@extends('admin.layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            @if (empty($response))
                Новая рассылка
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
            <form action="{{ route('admin/subscribes/store') }}" method="POST" role="form" id="storeItem" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (!empty($response))
                    <input type="hidden" name="id" value="{{ $response->id }}" />
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Наименование</label>
                        <input class="form-control" type="text" name="name" value="{{ $response->name }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="container col-xs-12">Блокировка
                            <input type="checkbox" class="input-group" name="active" value="1" {{ ($response->active==1)?'checked=""':'' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Текст рассылки</label>
                        <textarea class="form-control" name="message" id="editor">{{ $response->message }}</textarea>
                    </div>
                @else
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Наименование</label>
                        <input class="form-control" type="text" name="name" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="container col-xs-12">Блокировка
                            <input type="checkbox" class="input-group" name="active" value="1" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Текст рассылки</label>
                        <textarea class="form-control" name="message" id="editor"></textarea>
                    </div>
                @endif
                <div class="form-group col-xs-12">
                    <a href="{{ route('admin/subscribes') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection