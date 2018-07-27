<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 14.12.2017
 * Time: 14:34
 */
?>
        <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sport Casta') }} > {{ $name }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('backend/vendor/metismenu/metismenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('backend/dist/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/dist/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('backend/vendor/morrisjs/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('backend/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/jquery/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/jquery/jquery.form.min.js') }}"></script>

    <!-- Angular JS-->
    <script src="{{ asset('backend/dist/js/angular.min.js') }}"></script>

    <!-- Mask-->
    <script src="{{ asset('backend/dist/js/jquery.mask.min.js') }}"></script>

    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/select2/js/i18n/ru.js') }}"></script>

    <script>var adminItems = angular.module('adminItems', []);adminItems.controller('ItemsList', function () {});</script>

    <script src="{{ asset('backend/dist/js/PassGenJS.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


    <!-- TimyMCE Editor -->
    @include('admin.tinymce')
</head>

<body>

<div id="wrapper" data-ng-app="adminItems" data-ng-controller="ItemsList">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Навигация</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin') }}">{{ config('app.name', 'Sport Casta') }}</a>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i> Покинуть</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        @include('admin.left')
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ $name }}</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                @yield('content')
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{ asset('backend/vendor/metismenu/metismenu.min.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{ asset('backend/dist/js/sb-admin-2.js') }}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{ asset('backend/vendor/raphael/raphael.min.js') }}"></script>
{{--<script src="{{ asset('backend/vendor/morrisjs/morris.min.js') }}"></script>--}}
{{--<script src="{{ asset('backend/data/morris-data.js') }}"></script>--}}

<script>
    $(function() {
        $('select').select2({
            width: '100%'
        });
    });
</script>

</body>

</html>

