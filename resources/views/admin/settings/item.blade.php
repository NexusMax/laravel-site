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
                Новая настройка
            @else
                Изменение {{ $response->param }}
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
            <form action="{{ route('admin/settings/store') }}" method="POST" role="form" id="storeItem" accept-charset="UTF-8" enctype="multipart/form-data">
                @if (!empty($response))
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $response->id }}" />
                    <div class="form-group col-xs-12">
                        <label class="h4">Параметр</label>
                        <input class="form-control" type="text" name="param" value="{{ $response->param }}" />
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Значение</label>
                        <input class="form-control" type="text" name="value" value="{{ $response->value }}" />
                    </div>
                @else
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="" />
                    <div class="form-group col-xs-12">
                        <label class="h4">Параметр</label>
                        <input class="form-control" type="text" name="param" value="" />
                    </div>
                    <div class="form-group col-xs-12">
                        <label class="h4">Значение</label>
                        <input class="form-control" type="text" name="value" value="" />
                    </div>
                @endif
                <div class="button-group">
                    <a href="{{ route('admin/settings') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
        <!-- /.col-lg-6 (nested) -->
    </div>
    <!-- /.panel-body -->
@endsection
