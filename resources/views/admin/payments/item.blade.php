<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 04.01.2018
 * Time: 14:23
 */ ?>
@extends('admin.layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            @if (empty($response))
                Новый пакет
            @else
                Изменение {{ $response->deal }}
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
            <form action="{{ route('admin/payments/store') }}" method="POST" role="form" id="storeItem">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (!empty($response))
                    <input type="hidden" name="id" value="{{ $response->id }}" />
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Назначение</label>
                        <input class="form-control" type="text" name="deal" value="{{ $response->deal }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">Сумма</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">$</span>
                            <input type="text" class="form-control" placeholder="XX.XX" aria-describedby="sizing-addon2" name="sum" value="{{ $response->sum }}" />
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Тип</label>
                        <input class="form-control" type="text" name="type" value="{{ $response->type }}" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Коливество дней (в целых числах)</label>
                        <input class="form-control" type="text" name="count_days" value="{{ $response->count_day }}" />
                    </div>
                    <div class="form-group col-md-3 col-xs-6">
                        <label class="container col-xs-12">Открыт для оплаты
                            <input type="checkbox" class="input-group" name="status" value="1" {{ ($response->status==1)?'checked=""':'' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                @else
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Назначение</label>
                        <input class="form-control" type="text" name="deal" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label class="h4" for="basic-url">Сумма</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">$</span>
                            <input type="text" class="form-control" placeholder="XX.XX" aria-describedby="sizing-addon2" name="sum" value="" />
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Тип</label>
                        <input class="form-control" type="text" name="type" value="" />
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label class="h4">Коливество дней (в целых числах)</label>
                        <input class="form-control" type="text" name="count_days" value="" />
                    </div>
                    <div class="form-group col-md-3 col-xs-6">
                        <label class="container col-xs-12">Открыт для оплаты
                            <input type="checkbox" class="input-group" name="status" value="1" checked="" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                @endif
                <div class="form-group col-xs-12">
                    <a href="{{ route('admin/payments') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Вернуться</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
        <!-- /.col-lg-6 (nested) -->
    </div>
    <!-- /.panel-body -->
@endsection
