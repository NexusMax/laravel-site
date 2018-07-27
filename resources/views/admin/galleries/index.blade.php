<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 18.12.2017
 * Time: 13:37
 */ ?>
@extends('admin.layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            {{--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#item_edit">Добавить</button>--}}
            <a href="{{ route('admin/galleries/create') }}" type="button" class="btn btn-success">Добавить</a>
            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#item_remove">Удалить</button>
        </div>
    </div>
    <div class="row">
        @foreach($albums as $k=>$album)
            <div class="col-lg-3">
                <div class="thumbnail" style="min-height: 514px;">
                    <img alt="{{$album->name}}" src="/albums/{{$album->cover_image}}">
                    <div class="caption">
                        <h3>{{$album->name}}</h3>
                        <p>{{$album->description}}</p>
                        <p>{{count($album->Photos)}} image(s).</p>
                        <p>Created date:  {{ date("d F Y",strtotime($album->created_at)) }} at {{date("g:ha",strtotime($album->created_at)) }}</p>
                        <p><a href="{{ URL::route('admin/galleries') . '/' . $album->id }}" class="btn btn-big btn-default">Show Gallery</a></p>
                    </div>
                </div>
            </div>
            @if (($k+1)%3 == 0)
                <div class="row"></div>
            @endif
        @endforeach
    </div>

@endsection
