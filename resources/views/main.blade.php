@extends('layouts.app')

@section('header')
@endsection


@section('content')
<div class="h-screen h-full-screen h-screen-top" style="background-image: url('/img/casta_enter.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-page-div">
                    <a href="{{ url('/') }}" class="main-h-logo h-screen-top h-logo h-logo-main"><h1><img src="/img/logo.svg" alt="Главная"></h1></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 main-page">
                <div class="main-page-div">
                    <a href="{{ url('/trainer') }}" class="btn-main btn wow fadeIn" data-wow-delay='.5s'>Тренер</a>

                    @env('local')
                        <a href="{{ url('/learner') }}" class="btn-main color-s btn wow fadeIn" data-wow-delay='.5s'>Спортсмен</a>
                    @endenv


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@endsection

@section('popupAuth')
@endsection

@section('popupSpecialReg')
@endsection