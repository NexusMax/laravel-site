<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 20.12.2017
 * Time: 13:45
 */ ?>
@extends('admin.layout')

@section('content')
    <div class="span4" style="display: inline-block;margin-top:100px;">
        @if(count( $errors ) > 0)
            <div class="alert alert-block alert-error fade in" id="error-block">
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
        <form name="addimagetoalbum" method="POST" action="{{ URL::route('add_image_to_album') }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="album_id" value="{{$album->id}}" />
            <fieldset>
                <legend>Добавить изображение в альбом {{$album->name}}</legend>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" class="form-control" placeholder="Imagedescription"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Выберите изображение</label>
                    {{ Form::file('image') }}
                </div>
                <button type="submit" class="btn btn-default">Добавить!</button>
            </fieldset>
        </form>
    </div>
@endsection
