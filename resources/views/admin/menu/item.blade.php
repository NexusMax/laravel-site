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
                Новый пользователь
            @else
                Изменение {{ $response->name }}
            @endif
        </div>
        <div class="panel-body">
            <form action="{{ route('admin/menu/create') }}" method="POST" role="form" id="storeItem">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (!empty($response))
                    <input type="hidden" name="id" value="{{ $response->id }}" />
                    <div class="form-group col-xs-12">
                        <label class="h4">Наименование</label>
                        <input class="form-control" type="text" name="name" value="{{ $response->name }}" />
                    </div>
                @else
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="" />
                    <div class="form-group col-xs-12">
                        <label class="h4">Наименование</label>
                        <input class="form-control" type="text" name="name" value="" />
                    </div>
                @endif
                <div class="button-group">
                    <a href="{{ route('admin/menu') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
