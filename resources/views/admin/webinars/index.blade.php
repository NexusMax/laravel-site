<?php  /**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 18.04.2018
 * Time: 17:38
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
                response[item.id].created_at = Date.parse(response[item.id].created_at);
                response[item.id].updated_at = Date.parse(response[item.id].updated_at);
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

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-4 col-xs-12">
                {{--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#item_edit">Добавить</button>--}}
                <a href="{{ URL::route('admin/webinars/create') }}" type="button" class="btn btn-success">Добавить</a>
                {{--<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#item_remove">Удалить</button>--}}
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
        <table width="100%" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td width="1%"><input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="selectedAll" data-ng-click="checkAll()" /></td>
                <td width="10%"><a href="javascript:" data-ng-click="sortType = 'event_name'; sortReverse = !sortReverse">
                        <span>Название</span>
                        <i data-ng-show="(sortType == 'event_name' && sortReverse) || sortType != 'event_name'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'event_name' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="10%"><a href="javascript:" data-ng-click="sortType = 'email'; sortReverse = !sortReverse">
                        <span>Email</span>
                        <i data-ng-show="(sortType == 'email' && sortReverse) || sortType != 'email'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'email' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="5%"><a href="javascript:" data-ng-click="sortType = 'price'; sortReverse = !sortReverse">
                        <span>Оплачено</span>
                        <i data-ng-show="(sortType == 'price' && sortReverse) || sortType != 'price'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'price' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="5%"><a href="javascript:" data-ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
                        <span>Создано</span>
                        <i data-ng-show="(sortType == 'created_at' && sortReverse) || sortType != 'created_at'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'created_at' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="5%"><a href="javascript:" data-ng-click="sortType = 'updated_at'; sortReverse = !sortReverse">
                        <span>Изменено</span>
                        <i data-ng-show="(sortType == 'updated_at' && sortReverse) || sortType != 'updated_at'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'updated_at' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="1%">Управление</td>
            </tr>
            </thead>
            <tbody>
            <tr data-ng-repeat="item in items | orderBy:sortType:!sortReverse | filter:searchItem">
                <td width="1%">
                    <input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="item.Selected" />
                    @{{ item.id }}
                </td>
                <td width="10%"><a href="/admin/event/@{{ item.event_id }}" target="_blank">@{{ item.event_name }}</a></td>
                <td width="10%">@{{ item.email }}</td>
                <td width="5%">@{{ item.price }}</td>
                <td width="5%">@{{ item.created_at | date:'dd.MM.yyyy HH:mm' }}</td>
                <td width="5%">@{{ item.updated_at | date:'dd.MM.yyyy HH:mm' }}</td>
                <td width="1%">
                    {{--<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#item_edit" data-id="@{{ item.id }}" data-ng-click="editItem()"><i class="fa fa-pencil" aria-hidden="true"></i></button>--}}
                    <a type="button" class="btn btn-warning btn-xs" href="/admin/webinars/@{{ item.id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
                                url: '/admin/webinars/destroy',
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
