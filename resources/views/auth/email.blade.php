<a style="display:none;" class="popup-with-form-login" data-mfp-src="#popup-check_in-login" href="#" rel="nofollow"></a>
<div id="popup-check_in-login" class="white-popup-block mfp-hide check_in-form">
    <div class="top-row">
        <div class="top-row_left tablinks active" onclick='openTab(event, "login")'>Авторизация</div>
    </div>
    <div id="login" class="tabcontent active">
        <h3 class="check_in-top-title">авторизация пользователя</h3>
        <form id="login-form-email" method="POST" action="{{ route('login') }}" class="log_in">

            {{ csrf_field() }}

            <input type="email" name="email" placeholder="Логин / E-mail" value="{{ old('email') }}" required>
            @if(isset($errors))
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            @endif

            <button type="submit" name="login[submit]" class="btn">Войти в кабинет</button>
        </form>

    </div>
</div>