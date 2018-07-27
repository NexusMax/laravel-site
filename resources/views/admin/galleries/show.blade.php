<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 18.12.2017
 * Time: 13:45
 */ ?>
@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="media">
            <img class="media-object pull-left" alt="{{$album->name}}" src="/albums/{{$album->cover_image}}" width="200px">
            <div class="media-body">
                <h2 class="media-heading" style="font-size: 26px;">Наименование:</h2>
                <p>{{$album->name}}</p>
                <div class="media">
                    <h2 class="media-heading" style="font-size: 26px;">Описание:</h2>
                    <p>{{$album->description}}</p>
                    <a href="{{URL::route('add_image', array('id'=>$album->id))}}">
                        <button type="button" class="btn btn-primary btn-large">Добавить изображение</button>
                    </a>
                    <a href="{{URL::route('delete_album', array('id'=>$album->id))}}" onclick="return confirm('Вы уверены?')">
                        <button type="button" class="btn btn-danger btn-xs btn-large">Удалить альбом</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($album->Photos as $k=>$photo)
                <div class="col-lg-3">
                    <div class="thumbnail" style="min-height: 350px;">
                        <img alt="{{$album->name}}" src="/albums/{{$photo->image}}">
                        <div class="caption">
                            <p>{{$photo->description}}</p>
                            <p>Дата создания:  {{ date("d F Y",strtotime($photo->created_at)) }} в {{ date("g:ha",strtotime($photo->created_at)) }}</p>
                            <a href="{{ URL::route('delete_image', array('id'=>$photo->id)) }}" onclick="return confirm('Вы уверены?')">
                                <button type="button" class="btn btn-danger btn-xs btn-small">Удалить изображение</button>
                            </a>
                            <p>Переместить в альбом:</p>
                            <form name="move" method="POST" action="{{ URL::route('move_image') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <select name="new_album">
                                    @foreach($albums as $others)
                                        <option value="{{$others->id}}">{{$others->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="photo" value="{{$photo->id}}" />
                                <button type="submit" class="btn btn-small btn-info" onclick="return confirm('Вы уверены?')">Переместить</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if (($k+1)%3 == 0)
                    <div class="row"></div>
                @endif
            @endforeach
        </div>
    </div>

@endsection
