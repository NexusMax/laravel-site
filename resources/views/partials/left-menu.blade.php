<?php
use Jenssegers\Date\Date;
Date::setLocale('ru');
?>

<?php
$segment = request()->segment(2);
?>

<aside class="db-sidebar">
    <ul>
        <li  @if ($segment == 'myaccount') class="active" @endif>
            <a href="{{ route('myaccount') }}">
                <mark class="icon-wrap">
                    <img src="/../../img/icons/user.svg" class="svg" alt="">
                </mark>
                <span>Личный кабинет</span>
            </a>
        </li>
        <li @if ($segment == 'detail') class="active" @endif>
            <a href="{{ route('detail') }}">
                <mark class="icon-wrap">
                    <img src="/../../img/icons/file.svg" class="svg" alt="">
                </mark>
                <span>Детальная анкета</span>
            </a>
        </li>
        <li @if ($segment == 'trainings') class="active" @endif>
            <a href="{{ route('trainings') }}">
                <mark class="icon-wrap">
                    <img src="/../../img/icons/dumbbell.svg" class="svg" alt="">
                </mark>
                <span>Тренировки</span>
            </a>
        </li>
        <li @if ($segment == 'wizard') class="active" @endif>
            <a href="{{ route('wizard') }}">
                <mark class="icon-wrap">
                    <img src="/../../img/icons/school-material.svg" class="svg" alt="">
                </mark>
                <span>Конструктор</span>
            </a>
        </li>
        <li @if ($segment == 'food') class="active" @endif>
            <a href="{{ route('food') }}">
                <mark class="icon-wrap">
                    <img src="/../../img/icons/cutlery.svg" class="svg" alt="">
                </mark>
                <span>Питание</span>
            </a>
        </li>
        <li @if ($segment == 'calendar') class="active" @endif>
            <a href="{{ route('calendar') }}">
                <mark class="icon-wrap notifications">
                    <img src="/../../img/icons/calendar.svg" class="svg" alt="">
                </mark>
                <span>Календарь</span>
            </a>
        </li>
        <li @if ($segment == 'diary') class="active" @endif>
            <a href="{{ route('diary') }}">
                <mark class="icon-wrap">
                    <img src="/../../img/icons/notebook.svg" class="svg" alt="">
                </mark>
                <span>Дневник</span>
            </a>
        </li>
        <li @if ($segment == 'bookmarks') class="active" @endif>
            <a href="{{ route('bookmarks') }}">
                <mark class="icon-wrap">
                    <img src="/../../img/icons/bookmark.svg" class="svg" alt="">
                </mark>
                <span>Закладки</span>
            </a>
        </li>
        <li >
            <a href="#">
                <mark class="icon-wrap">
                    <img src="/../../img/icons/price-tag.svg" class="svg" alt="">
                </mark>
                <span>Тарифы</span>
            </a>
        </li>
    </ul>
</aside>