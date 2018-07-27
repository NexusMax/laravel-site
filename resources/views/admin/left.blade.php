<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 14.12.2017
 * Time: 15:04
 */
?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{ route('admin') }}"><i class="fa fa-dashboard fa-fw"></i> Доска</a>
            </li>
            <li>
                <a href="{{ route('admin/users') }}"><i class="fa fa-users fa-fw"></i> Пользователи</a>
            </li>
            <li>
                <a href="{{ route('admin/experts') }}"><i class="fa fa-users fa-fw"></i> Эксперты<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('admin/experts') }}">Страницы</a>
                    </li>
                    <li>
                        <a href="{{ route('admin/experts/groups') }}">Группы</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin/messages') }}"><i class="fa fa-comments fa-fw"></i> Сообщения<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    {{--<li>--}}
                        {{--<a href="{{ route('admin/messages') }}">Личные сообщения</a>--}}
                    {{--</li>--}}
                    <li>
                        <a href="{{ route('admin/subscribers') }}">Подписчики</a>
                    </li>
                    <li>
                        <a href="{{ route('admin/subscribers/users') }}">MailChimp</a>
                    </li>
                    <li>
                        <a href="{{ route('admin/subscribers/groups') }}">Группы рассылок</a>
                    </li>
                    <li>
                        <a href="{{ route('admin/subscribes') }}">Рассылки</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            {{--<li>--}}
                {{--<a href="{{ route('admin/menu') }}"><i class="fa fa-bars fa-fw"></i> Меню</a>--}}
            {{--</li>--}}
            <li>
                <a href="{{ route('admin/items') }}"><i class="fa fa-table fa-fw"></i> Материалы<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('admin/items') }}">Все материалы</a>
                    </li>
                    <li>
                        <a href="{{ route('admin/event') }}">Все события</a>
                    </li>
                    <li>
                        <a href="{{ route('admin/categories') }}">Все категории</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="{{ route('admin/components') }}"><i class="fa fa-th fa-fw"></i> Компоненты<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('admin/lib') }}">Библиотека</a>
                    </li>
                    <li>
                        <a href="{{ route('admin/galleries') }}">Фотогалереи</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            {{--<li>--}}
                {{--<a href="{{ route('admin/modules') }}"><i class="fa fa-th-large fa-fw"></i> Модули</a>--}}
            {{--</li>--}}
            <li>
                <a href="{{ route('admin/payments') }}"><i class="fa fa-shopping-cart fa-fw"></i> Бухгалтерия<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('admin/payments') }}">Пакеты</a>
                    </li>
                    <li>
                        <a href="{{ route('admin/orders') }}">Заказы</a>
                    </li>
                    <li>
                        <a href="{{ route('admin/webinars') }}">Вебинары</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin/chat') }}"><i class="fa fa-send fa-fw"></i> Чаты</a>
            </li>

            <li>
                <a href="{{ route('admin/settings') }}"><i class="fa fa-cogs fa-fw"></i> Настройки</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
