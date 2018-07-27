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
    <script src="{{ asset('libs/emoji/emojione.js') }}"></script>



    <div class="panel panel-default">
        <div class="panel-heading">
            История чата
        </div>
        <div class="panel-body">
            @foreach($response as $item)

                <p class="message">[{{$item->created_at}}]:<strong>{{$item->user_name}}</strong>:{{$item->message}}</p>

            @endforeach
        </div>
        <!-- /.col-lg-6 (nested) -->
    </div>
    <!-- /.panel-body -->


    <script>

            let messages = document.getElementsByClassName('message');

            $('.message').each(function (index) {
                let msgText = $(this).text();
                $(this).text(emojione.shortnameToUnicode(msgText));
            });


    </script>
@endsection
