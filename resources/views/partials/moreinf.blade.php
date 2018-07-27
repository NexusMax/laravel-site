
<div class="training-bot" id="read-more">
    <div class="container">
        <div class="row">

            <div class="title wow fadeInUp">{{ $title }}</div>
            <div class="description wow fadeInUp">Здесь действительно много интересного!</div>


            <form action="{{ route('login') }}" class="subscribe_form" METHOD="POST" id="login-more-inf">
                {{ csrf_field() }}

                <div class="wrap-validation">

                    <input class="wow fadeIn input-form" type="email" name="email" placeholder="Введите Ваш Email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="wrap-validation">
                    <input class="wow fadeIn input-form" type="password" name="password" placeholder="Введите Ваш пароль">
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <button type="submit" class="btn wow fadeIn">авторизоваться</button>
            </form>
            <div class="log_in_soc log_in_soc_more">

                <ul>
                    <li><a href="#" target="popup" data-uloginbutton="facebook" class="facebook-auth"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    {{--<li><a href="#" data-uloginbutton="vkontakte"><i class="fa fa-vk vk-auth" aria-hidden="true"></i></a></li>--}}
                    <li><a href="#" target="popup" data-uloginbutton="google" class="google-auth"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            <span>Еще не зарегистрированы у нас? </span><a href="#" target="popup" class="popup-with-form popup-register" data-mfp-src="#popup-check_in" >Зарегистрироваться</a>
            
        </div>
    </div>
</div>
