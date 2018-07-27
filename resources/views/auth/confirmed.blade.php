@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-10 col-md-offset-1 confirm-email">
                <div class=" text-center">
                    <h2>Поздравляем, Вы успешно зарегистрировались на портале SportCasta</h2>
                    <a class="btn call-btn wow fadeIn"
                       {{--data-mfp-src="#popup-check_in" --}}
                       href="{{ route('myaccount') }}"
                       rel="nofollow"><span>ВОЙТИ В КАБИНЕТ</span></a>
                </div>
            </div>

        </div>
    </div>
@endsection
