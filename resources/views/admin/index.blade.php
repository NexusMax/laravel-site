@extends('admin.layout')

@section('content')
    <script type="text/javascript">
        var adminItems = angular.module('adminItems', []);
        adminItems.controller('ItemsList', function ($scope, $http) {});
    </script>

    <div class="row">
        @if($data['items_count'] > 0)
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-table fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data['items_count'] }}</div>
                            <div>Материалы</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin/items') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Подробнее</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        @endif
        @if($data['categories_count'] > 0)
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data['categories_count'] }}</div>
                            <div>Категории</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin/categories') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Подробнее</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        @endif
            @if($data['orders_count'] > 0)
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ $data['orders_count'] }}</div>
                                    <div>Действующие пакеты</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin/orders') }}">
                            <div class="panel-footer">
                                <span class="pull-left">Подробнее</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            @if(count($data['events']) > 0)
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-table fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ count($data['events']) }}</div>
                                    <div>События</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin/event') }}">
                            <div class="panel-footer">
                                <span class="pull-left">Подробнее</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-clock-o fa-fw"></i> Грядущие события
        </div>
        <div class="panel-body">
            <ul class="timeline">
                @if(count($data['events']) > 0)
                @foreach($data['events'] as $k=>$event)
                <li @if($k%2 != 0) class="timeline-inverted"@endif>
                    <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">{{ $event->name }}</h4>
                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{ date("d.m.Y H:i", strtotime($event->end_at)) }}</small>
                            </p>
                        </div>
                        <div class="timeline-body">
                            {!! $event->intro !!}
                        </div>
                    </div>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
@endsection