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
                Новая группа экспертов
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
            <form action="{{ route('admin/experts/groups/store') }}" method="POST" role="form" id="storeItem" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (!empty($response['item']))
                    <input type="hidden" name="id" value="{{ $response['item']->id }}" />
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Наименование</label>
                        <input class="form-control" type="text" name="name" value="{{ $response['item']->name }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">URL</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">/</span>
                            <input type="text" class="form-control" placeholder="alias" aria-describedby="sizing-addon2" name="alias" value="{{ $response['item']['alias'] }}" />
                        </div>
                    </div>
                    <div class="form-group col-md-3 col-xs-3">
                        <label class="container col-xs-12">Активен
                            <input type="checkbox" class="input-group" name="active" value="1" {{ ($response['item']['active']==1)?'checked=""':'' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-title</label>
                        <input class="form-control" type="text" name="meta_title" value="{{ $response['item']['meta_title'] }}" />
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-description</label>
                        <input class="form-control" name="meta_desc" id="description" value="{{ $response['item']['meta_desc'] }}" />
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
                    <div class="form-group col-md-3 col-xs-3">
                        <label class="container col-xs-12">Активен
                            <input type="checkbox" class="input-group" name="active" value="1" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-title</label>
                        <input class="form-control" type="text" name="meta_title" value="" />
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Meta-description</label>
                        <input class="form-control" name="meta_desc" id="description" value="" />
                    </div>
                @endif
                <div class="form-group col-xs-12">
                    <a href="{{ route('admin/experts/groups') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection