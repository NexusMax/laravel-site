
<div id="popup-special_propos" class="white-popup-block mfp-hide popup-special_propos">
    <h3>специальное предложение</h3>

    <p>Зарегистрируйся и получи полный доступ <br> на <strong>2 недели</strong> ко всему контенту совершенно бесплатно!</p>
    <form class="special_propos-form" id="register-with-special" action="{{ route('register') }}" method="POST">
        {{ csrf_field() }}


            <div>
                <div class="wrap-validation">
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Имя*"  aria-describedby="name-error">
                    <span id="name-error"  class="help-block error-help-block">
                    @if(isset($errors))
                        @if ($errors->has('name'))
                            
                            <strong>{{ $errors->first('name') }}</strong>
                        
                        @endif
                    @else
                        &nbsp;
                    @endif
                    </span>
                </div>
                <div class="wrap-validation">
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="E-mail*" aria-describedby="email-error">
                    <span id="email-error"  class="help-block error-help-block">
                    @if(isset($errors))
                        @if ($errors->has('email'))
                            
                            <strong>{{ $errors->first('email') }}</strong>
                        
                        @endif
                    @else
                        &nbsp;
                    @endif
                    </span>
                </div>
            </div>
            <div>
                <div class="wrap-validation">
                    <input type="password" name="password" placeholder="Пароль" required aria-describedby="password-error">
                    <span id="password-error"  class="help-block error-help-block">
                    @if(isset($errors))
                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    @else
                        &nbsp;
                    @endif
                     </span>
                </div>
                <div class="wrap-validation">
                    <input type="password" name="password_confirmation" placeholder="Подтвердить пароль" required>
                </div>
            </div>

        <br>
        <button class="btn specpopup-btn">регистрация</button>
    </form>
    <span>Здесь действительно много интересного!</span>
    <div class="log_in_soc">
        <h3>регистрация через соц сети</h3>
        <ul>
            <li><a href="#" target="popup" data-uloginbutton="facebook"><i class="fa fa-facebook facebook-auth" aria-hidden="true"></i></a></li>
            {{--<li><a href="#" data-uloginbutton="vkontakte"><i class="fa fa-vk vk-auth" aria-hidden="true"></i></a></li>--}}
            <li><a href="#" target="popup" data-uloginbutton="google" class="google-auth"><i class="fa fa-google" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</div>