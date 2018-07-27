@extends('layouts.app')

@section('content')
    <div id="trainer">

        @include('partials.pagelogo', ['title' => 'Восстановление пароля', 'background' => '/../img/trainer_bg.jpg'])

        <section class="trainer-content">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success text-center">
                            {{ session('status') }}
                        </div>

                    @else
                    <h3 class="text-center">Для восстановления пароля введите e-mail</h3>
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">


                            <div class="col-md-6 col-md-offset-3">
                                <input id="email" type="email" class="form-control training-search reset-input" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary reset-email">
                                    Отправить
                                </button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
        </section>
    </div>
@endsection
