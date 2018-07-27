@extends('layouts.app')

@section('content')
    <div id="trainer">

        @include('partials.pagelogo', ['title' => 'Восстановление пароля', 'background' => '/../img/trainer_bg.jpg'])

        <section class="trainer-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <h3 class="text-center">Изменить пароль</h3>

                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">Ваш E-Mail</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="training-search form-control reset-input" name="email" value="{{ $email or old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Пароль</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="training-search form-control reset-input" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <label for="password-confirm" class="col-md-4 control-label">Подтвердите пароль</label>
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="training-search form-control reset-input" name="password_confirmation" required>

                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button type="submit" class="btn btn-primary reset-email">
                                                Изменить пароль
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if(!empty($popularItems))

            <section class="s-new">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h3 class="titleh3 wow fadeInUp s-new_title">Популярные материалы</h3>
                            <p class="s-team_descr">В открытом доступе вы найдете много статей и полезного видео-контента из области спорта, диетологии, медицины и психологии.</p>
                            <div class="s-new_slider">
                                <div class="owl-carousel owl-carousel2 owl-theme">
                                    @include('partials.slider-item',['items' => $popularItems])
                                </div>
                            </div>
                        </div>
                        @guest
                        <div class="col-lg-12 col-md-12">
                            <div class="btn-wrapper">
                                <a href="#" data-mfp-src="#popup-special_propos" class="popup-with-form btn s-new_btn wow fadeIn">Подписка на обновления</a>
                            </div>
                        </div>
                        @endguest
                    </div>
                </div>
            </section>

        @endif
    </div>
@endsection
