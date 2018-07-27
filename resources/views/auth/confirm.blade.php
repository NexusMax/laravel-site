@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 confirm-email">
                <div class=" text-center">
                    <h2>Мы отправили Вам письмо. <br/>Пожалуйста проверьте Вашу почту.</h2>
                    @if(isset($urlMail))
                    <a href="{{ $urlMail }}" target="_blank">{{ $userEmail }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
