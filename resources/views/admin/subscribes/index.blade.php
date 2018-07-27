<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 02.11.2017
 * Time: 11:23
 */
?>
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

//            response = [];
            angular.forEach($scope.items, function(item, id) {
//                $scope.items[item.id] = item;
                item.dt = Date(item.dt);
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

            var total = 0,
                template_id,
                subscribers,
                active = 0;
            $scope.subscribe = function(id) {
                if (typeof(id) == 'undefined' || active === 1) {
                    return false;
                }
                $("#progressbar div[role=progressbar]").css('width', 0);
                $.ajax({
                    url: "/admin/subscribes/to",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {type: "subscribers", template_id: id},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        total = data['total'];
                        subscribers = data['subscribers'];
                        template_id = data['template_id'];
                        active = data['active'];
                        $scope.do_subscribe();
                    }
                });
            };

            $scope.do_subscribe = function(id) {
                id = typeof(id) !== 'undefined' ? id : 1;
                $.ajax({
                    url: "/admin/subscribes/to",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        type: "to_subscribe",
                        item: JSON.stringify(subscribers[id-1]),
                        id: id,
                        total: total,
                        template_id: template_id
                    },
                    dataType: 'json',
                    success: function(data){
                        active = data['active'];
                        $("#progressbar").show('200');
                        if(data && !data.end) {
                            $("#progressbar div[role=progressbar]").css('width', Math.round(100*data.id/data.total)+'%');
                            $scope.do_subscribe(data.id*1+1);
                        } else {
                            $("#progressbar div[role=progressbar]").css('width', '100%');
                            active = 0;
                            $scope.items[template_id-1].dt = Date(data.dt);
                            $scope.$digest();
                        }
                    },
                    error:function(xhr, status, errorThrown) {
                        alert(errorThrown+'\n'+xhr.responseText);
                    }
                });
            };

//            $scope.editItem = function () {
//                $http.get("/admin/subscribes/" + this.item.id)
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

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-4 col-xs-12">
                {{--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#item_edit">Добавить</button>--}}
                <a href="{{ route('admin/subscribes/create') }}" type="button" class="btn btn-success">Добавить</a>
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
        <div class="progress" id="progressbar" style="display:none;height:5px;margin:0">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                <span class="sr-only">0% Complete</span>
            </div>
        </div>
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
            <tr>
                <td><input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="selectedAll" data-ng-click="checkAll()" />
                    <a href="javascript:" data-ng-click="sortType = 'id'; sortReverse = !sortReverse">
                        <i data-ng-show="(sortType == 'id' && sortReverse) || sortType != 'id'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'id' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td>Наименование <a href="javascript:" data-ng-click="sortType = 'name'; sortReverse = !sortReverse">
                        <i data-ng-show="(sortType == 'name' && sortReverse) || sortType != 'name'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'name' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td>Последняя рассылка <a href="javascript:" data-ng-click="sortType = 'email'; sortReverse = !sortReverse">
                        <i data-ng-show="(sortType == 'email' && sortReverse) || sortType != 'email'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'email' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td>Сообщение <a href="javascript:" data-ng-click="sortType = 'message'; sortReverse = !sortReverse">
                        <i data-ng-show="(sortType == 'message' && sortReverse) || sortType != 'message'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'message' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td>Создано <a href="javascript:" data-ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
                        <i data-ng-show="(sortType == 'created_at' && sortReverse) || sortType != 'created_at'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'created_at' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td>Управление</td>
            </tr>
            </thead>
            <tbody>
            <tr data-ng-repeat="item in items | orderBy:sortType:!sortReverse">
                <td><input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="item.Selected" /> @{{ item.id }}</td>
                <td>@{{ item.name }}</td>
                <td id="dt#@{{ item.id }}">@{{ item.dt }}</td>
                <td>@{{ item.message }}</td>
                <td>@{{ item.created_at }}</td>
                <td>
                    {{--<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#item_edit" data-id="@{{ item.id }}" data-ng-click="editItem()"><i class="fa fa-pencil" aria-hidden="true"></i></button>--}}
                    <a type="button" class="btn btn-warning btn-xs" href="/admin/subscribes/@{{ item.id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#item_remove" data-id="@{{ item.id }}" data-ng-click="removeItem()"><i class="fa fa-times" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-success btn-xs" data-id="@{{ item.id }}" data-ng-click="subscribe(item.id)"><i class="fa fa-envelope" aria-hidden="true"></i></button>
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
                                url: '/admin/subscribes/destroy',
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
