<a style="display:none;" class="popup-with-form-login-phone" data-mfp-src="#popup-check_in-login-phone" href="#" rel="nofollow"></a>
<div id="popup-check_in-login-phone" class="white-popup-block mfp-hide check_in-form">
    <div class="top-row">
        <div class="top-row_left tablinks active" onclick='openTab(event, "login1")'>Авторизация</div>
    </div>
    <div id="login1" class="tabcontent active">
        <h3 class="check_in-top-title">авторизация пользователя</h3>
        <form id="login-form-email-phone" method="POST" action="{{ route('login') }}" class="log_in">

            {{ csrf_field() }}

            <select name="code_phone" id="code_phone1" class="val-input" required>
                    <option value="+38">+38</option>
                    <option value="+7">+8</option>
            </select>
            <input type="text" name="phone" class="val-input none phoneInput" required>

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