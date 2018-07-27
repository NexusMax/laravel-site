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
    @if (!empty($result))
        {{ $result }}
    @endif
    <script>
        tinyMCE.init({
            selector:'textarea',
            language: 'uk',
            plugins: 'advlist,autolink,link,image,lists,charmap,print,preview,pagebreak,paste,fullscreen,visualchars',
            height: '300px'
        });
    </script>

    @if (!empty($response['module']))
    <form action="/admin/modules/store" method="POST" role="form" id="storeItem">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $response['module']->id }}" />
        <div class="form-group col-xs-12">
            <label class="h4">Наименование</label>
            <input class="form-control" type="text" name="name" value="{{ $response['module']->name }}" />
        </div>
        <div class="form-group col-xs-12">
            <label class="h4">Контент</label>
            <textarea class="form-control" name="content">{{ $response['module']['content'] }}</textarea>
        </div>
        <div class="form-group col-xs-12">
            <span class="col-xs-2">Активен</span>
            <input type="checkbox" class="input-group" name="published" value="1" />
        </div>
        <div class="form-group col-xs-12">
            <label class="h4">Тип</label>
            <select class="form-control" name="type" id="type">
                <option @if ($response['module']->type==0)selected="" @endif value="0">0</option>
                <option @if ($response['module']->type==1)selected="" @endif value="1">1</option>
                <option @if ($response['module']->type==2)selected="" @endif value="2">2</option>
                <option @if ($response['module']->type==3)selected="" @endif value="3">3</option>
            </select>
        </div>
        <div class="form-group col-xs-12">
            <label class="h4">Категория</label>
            <select class="form-control" name="role_id" id="role_id">
                @foreach ($response['role'] as $c)
                    <option @if ($c->id == $response['module']->role_id)selected="" @endif value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-xs-12">
            <label class="h4">Заголовок</label>
            <input class="form-control" type="text" name="showname" value="{{ $response['module']['showname'] }}" />
        </div>
        <div class="form-group col-xs-12">
            <label class="h4">Материал</label>
            <select class="form-control" name="item_id" id="item_id">
                @foreach ($response['items'] as $c)
                    <option @if ($c->id == $response['module']->item_id)selected="" @endif value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-xs-12">
            <label class="h4">Настройки</label>
            <input class="form-control" type="text" name="settings" value="{{ $response['module']['settings'] }}" />
        </div>
        <div class="form-group col-xs-12">
            <label class="h4">Классы</label>
            <input class="form-control" type="text" name="classes" value="{{ $response['module']['classes'] }}" />
        </div>

        <div class="button-group">
            <a href="/admin/modules" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
    @else
        <form action="/admin/modules/store" method="POST" role="form" id="storeItem">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="" />
            <div class="form-group col-xs-12">
                <label class="h4">Наименование</label>
                <input class="form-control" type="text" name="name" value="" />
            </div>
            <div class="form-group col-xs-12">
                <label class="h4">Контент</label>
                <textarea class="form-control" name="content"></textarea>
            </div>
            <div class="form-group col-xs-12">
                <span class="col-xs-2">Активен</span>
                <input type="checkbox" class="input-group" name="published" value="1" />
            </div>
            <div class="form-group col-xs-12">
                <label class="h4">Тип</label>
                <select class="form-control" name="type" id="type">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="form-group col-xs-12">
                <label class="h4">Категория</label>
                <select class="form-control" name="role_id" id="role_id">
                    @foreach ($response['role'] as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-xs-12">
                <label class="h4">Заголовок</label>
                <input class="form-control" type="text" name="showname" value="" />
            </div>
            <div class="form-group col-xs-12">
                <label class="h4">Материал</label>
                <select class="form-control" name="item_id" id="item_id">
                    @foreach ($response['items'] as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-xs-12">
                <label class="h4">Настройки</label>
                <input class="form-control" type="text" name="settings" value="" />
            </div>
            <div class="form-group col-xs-12">
                <label class="h4">Классы</label>
                <input class="form-control" type="text" name="classes" value="" />
            </div>

            <div class="button-group">
                <a href="/admin/modules" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    @endif
@endsection