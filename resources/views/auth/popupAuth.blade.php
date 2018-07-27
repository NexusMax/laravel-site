
<div id="popup-check_in" class="white-popup-block mfp-hide check_in-form">
    <div class="top-row">
        <div class="top-row_left tablinks active" onclick='openTab(event, "login")'>Авторизация</div>
        <div class="top-row_right tablinks" onclick='openTab(event, "checkin")'>Регистрация</div>
    </div>
    <div id="login" class="tabcontent active">
        <h3 class="check_in-top-title">авторизация пользователя</h3>
        <form id="login-form" method="POST" action="{{ route('login') }}" class="log_in">

            {{ csrf_field() }}

            <input type="email" name="email" placeholder="Логин / E-mail" value="{{ old('email') }}" required>
            @if(isset($errors))
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            @endif
            <input type="password" name="password" placeholder="Пароль" required>
            @if(isset($errors))
                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            @endif

            <button type="submit" name="login[submit]" class="btn">Войти в кабинет</button>
            <a href="{{ route('password.request') }}" class="restore">Забыли пароль?</a>
        </form>
        <div class="log_in_soc">
            <h3>вход через соц сети</h3>
            <ul>
                <li><a href="#" target="popup" data-uloginbutton="facebook"><i class="fa fa-facebook facebook-auth" aria-hidden="true"></i></a></li>
                {{--<li class="login-li"><script async src="https://telegram.org/js/telegram-widget.js?4" data-telegram-login="sportcasta_bot" data-size="medium" data-userpic="false" data-radius="0" data-onauth="onTelegramAuth(user)" data-request-access="write"></script></li>--}}
                {{--<li><a href="#" data-uloginbutton="vkontakte"><i class="fa fa-vk vk-auth" aria-hidden="true"></i></li>--}}
                <li><a href="#" target="popup" data-uloginbutton="google" class="google-auth"><i class="fa fa-google google-auth" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
    <div id="checkin" class="tabcontent">
        <h3>регистрация пользователя</h3>
        <form id="register-form" method="POST" action="{{ route('register') }}" class="log_in">

            {{ csrf_field() }}

            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Имя">
            @if(isset($errors))
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            @endif
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="E-mail (логин)">
            @if(isset($errors))
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            @endif
            <input type="password" name="password" placeholder="Пароль" required>
            @if(isset($errors))
                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            @endif
            <input type="password" name="password_confirmation" placeholder="Подтвердить пароль" required>
            <button type="submit" class="btn">Зарегистрироваться</button>

        </form>
        <div class="log_in_soc">
            <h3>регистрация через соц сети</h3>
                <ul id="list">
                    <li><a href="#" target="popup" data-uloginbutton="facebook"><i class="fa fa-facebook facebook-auth" aria-hidden="true"></i></a></li>
                    {{--<li class="registration-li">--}}
                        {{--<script async src="https://telegram.org/js/telegram-widget.js?4" data-telegram-login="sportcasta_two_bot" data-size="medium" data-userpic="false" data-radius="0" data-onauth="onTelegramAuth(user)" data-request-access="write"></script>--}}
                    {{--</li>--}}

                    {{--<li><a href="#" data-uloginbutton="vkontakte"><i class="fa fa-vk vk-auth" aria-hidden="true"></i></a></li>--}}
                    <li><a href="#" target="popup" data-uloginbutton="google" class="google-auth"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                </ul>
        </div>
    </div>
</div>