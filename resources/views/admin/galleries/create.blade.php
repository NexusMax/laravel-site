<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 18.12.2017
 * Time: 13:45
 */ ?>
@extends('admin.layout')

@section('content')
    <div class="span4" style="display: inline-block;margin-top:100px;">
        @if(count( $errors ) > 0)
            <div class="alert alert-block alert-error fade in"id="error-block">
                <?php
                $messages = $errors->all(':message');
                ?>
                <button type="button" class="close" data-dismiss="alert">×</button>

                <h4>Warning!</h4>
                <ul>
                    @foreach($messages as $message)
                        {{ $message }}
                    @endforeach

                </ul>
            </div>
        @endif

        <form name="createnewalbum" method="POST" action="{{ URL::route('admin/galleries/create') }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
                <legend>Создать альбом</legend>
                <div class="form-group">
                    <label for="name">Название</label>
                    <input name="name" type="text" class="form-control" placeholder="Album Name" value="{{ Input::old('name') }}">
                </div>
                <div class="form-group">
                    <label class="h4" for="basic-url">URL</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon2">/</span>
                        <input type="text" class="form-control" placeholder="alias" aria-describedby="sizing-addon2" name="alias" value="{{ Input::old('alias') }}" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" class="form-control" placeholder="Albumdescription">{{ Input::old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="cover_image">Изображение альбома</label>
                    {{ Form::file('cover_image') }}
                </div>
                <button type="submit" class="btn btn-default">Создать</button>
            </fieldset>
        </form>
    </div>
@endsection
