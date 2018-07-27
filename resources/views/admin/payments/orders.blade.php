<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 09.01.2018
 * Time: 13:40
 */ ?>
@extends('admin.layout')

@section('content')
    <script type="text/javascript">
        var adminItems = angular.module('adminItems', []);
        var response = <?php echo json_encode($response); ?>;
        response = $.parseJSON(response);

        adminItems.controller('ItemsList', function ($scope, $http) {
            $scope.items = response;
            $scope.sortType = 'id';
            $scope.sortReverse  = true;
            $scope.searchItem = '';

            response = [];
            angular.forEach($scope.items, function(item, id) {
                response[item.id] = item;
                response[item.id].dt = Date.parse(response[item.id].dt);
            });

            $scope.checkAll = function () {
                if ($scope.selectedAll) {
                    $scope.selectedAll = true;
                } else {
                    $scope.selectedAll = false;
                }
                angular.forEach($scope.items, function (item) {
                    item.Selected = $scope.selectedAll;
                });
            };

//            $scope.editItem = function () {
//                $http.get("/admin/items/" + this.item.id)
//                    .success(function (response) {
//                        console.log(response);
//
//                        $.each($("form#storeItem input[type=text]"), function (i, v) {
//                            $(v).val(response[$(v).attr('name')]);
//                            console.log($(v).attr('name'));
//                        });
//                        if (tinyMCE.get("textarea[name=" + i + "]") == 'object') {
//                            tinyMCE.get("textarea[name=" + i + "]").setContent(v);
//                        }
//                    });
//            };
            $scope.removeItem = function (e) {
                console.log(this);
                $("input[name=id]").val(this.item.id);
            };
        });
    </script>
    @if (Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('status') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-4 col-xs-12">
                {{--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#item_edit">Добавить</button>--}}
                <a href="{{ URL::route('admin/orders/create_order') }}" type="button" class="btn btn-success">Добавить</a>
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#item_remove">Удалить</button>
            </div>
            <div class="col-md-8 col-xs-12 input-group custom-search-form">
                <input type="text" class="form-control" data-ng-model="searchItem" placeholder="Найти...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
        <!-- /.panel-heading -->
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
            <tr>
                <td width="60px">
                    <input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="selectedAll" data-ng-click="checkAll()" />
                    @{{ item.id }}
                </td>
                <td><a href="javascript:" data-ng-click="sortType = 'deal'; sortReverse = !sortReverse">
                        <span>Назначение</span>
                        <i data-ng-show="(sortType == 'deal' && sortReverse) || sortType != 'deal'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'deal' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td><a href="javascript:" data-ng-click="sortType = 'user_id'; sortReverse = !sortReverse">
                        <span>Покупатель</span>
                        <i data-ng-show="(sortType == 'user_id' && sortReverse) || sortType != 'user_id'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'user_id' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="150px"><a href="javascript:" data-ng-click="sortType = 'ip'; sortReverse = !sortReverse">
                        <span>IP</span>
                        <i data-ng-show="(sortType == 'ip' && sortReverse) || sortType != 'ip'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'ip' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="90px"><a href="javascript:" data-ng-click="sortType = 'country'; sortReverse = !sortReverse">
                        <span>Страна</span>
                        <i data-ng-show="(sortType == 'country' && sortReverse) || sortType != 'country'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'country' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="400px"><a href="javascript:" data-ng-click="sortType = 'user_agent'; sortReverse = !sortReverse">
                        <span>Браузер и ОС</span>
                        <i data-ng-show="(sortType == 'user_agent' && sortReverse) || sortType != 'user_agent'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'user_agent' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="120px"><a href="javascript:" data-ng-click="sortType = 'sc_userid'; sortReverse = !sortReverse">
                        <span>sc_userid</span>
                        <i data-ng-show="(sortType == 'sc_userid' && sortReverse) || sortType != 'sc_userid'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'sc_userid' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="80px"><a href="javascript:" data-ng-click="sortType = 'sum'; sortReverse = !sortReverse">
                        <span>Сумма</span>
                        <i data-ng-show="(sortType == 'sum' && sortReverse) || sortType != 'sum'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'sum' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="140px"><a href="javascript:" data-ng-click="sortType = 'dt'; sortReverse = !sortReverse">
                        <span>Срок действия</span>
                        <i data-ng-show="(sortType == 'dt' && sortReverse) || sortType != 'dt'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'dt' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="80px"><a href="javascript:" data-ng-click="sortType = 'status'; sortReverse = !sortReverse">
                        <span>Открыт</span>
                        <i data-ng-show="(sortType == 'status' && sortReverse) || sortType != 'status'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'status' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td>Управление</td>
            </tr>
            </thead>
            <tbody>
            <tr data-ng-repeat="item in items | orderBy:sortType:!sortReverse | filter:searchItem">
                <td><input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="item.Selected" />
                    @{{ item.id }}</td>
                <td>@{{ item.deal }}</td>
                <td><a href="/admin/users/@{{ item.user_id }}" target="_blank">@{{ item.fullname }}</a></td>
                <td>@{{ item.ip }}</td>
                <td>@{{ item.country }}</td>
                <td>@{{ item.user_agent }}</td>
                <td>@{{ item.sc_userid }}</td>
                <td>@{{ item.sum }}</td>
                <td>@{{ item.dt | date:'dd.MM.yyyy HH:mm' }}</td>
                <td>
                    <span data-ng-if="item.status==1"><i class="fa fa-circle text-success" aria-hidden="true"></i> Да</span>
                    <span data-ng-if="item.status!=1"><i class="fa fa-circle text-danger" aria-hidden="true"></i> Нет</span>
                </td>
                <td>
                    {{--<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#item_edit" data-id="@{{ item.id }}" data-ng-click="editItem()"><i class="fa fa-pencil" aria-hidden="true"></i></button>--}}
                    <a type="button" class="btn btn-warning btn-xs" href="/admin/orders/@{{ item.id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#item_remove" data-id="@{{ item.id }}" data-ng-click="removeItem()"><i class="fa fa-times" aria-hidden="true"></i></button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="item_remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="h3 modal-title" id="exampleModalLabel">Удалить?</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="danger">
                        Вы уверены, что хотите удалить <span class="name"></span>?
                    </div>
                </div>
                <form action="" method="POST" id="destroyItem">
                    <input type="hidden" name="_token" content="{{ csrf_token() }}" />
                    <input type="hidden" name="id" value="" />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Удалить</button>
                    </div>
                </form>
                <script type="text/javascript">
                    $(function(){

                        $("button[data-target='#item_remove']").on('click',function(e){
                            $('#destroyItem input[name=id]').val($(this).attr('data-id'));
                            console.log($(this).attr('data-id'));
                        });

                        $('#destroyItem').on('submit',function(e){
                            $.ajax({
                                type: "POST",
                                url: '/admin/orders/destroy',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    "_token": $('#token').val(),
                                    "id": $(this).find("input[name=id]").val()
                                },
//                                dataType: 'json',
                                success: function(data){
                                    console.log(data);
                                    location.reload();
                                },
                                error: function(data){
                                    console.log(data);
                                }
                            });
                            return false;
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
