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

            response = [];
            angular.forEach($scope.items, function(item, id) {
                response[item.id] = item;
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
            {{--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#item_edit">Добавить</button>--}}
            <a href="{{ route('admin/settings/create') }}" type="button" class="btn btn-success">Добавить</a>
            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#item_remove">Удалить</button>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <td><input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="selectedAll" data-ng-click="checkAll()" />
                            <a href="javascript:" data-ng-click="sortType = 'id'; sortReverse = !sortReverse">
                                <span>id</span>
                                <i data-ng-show="(sortType == 'id' && sortReverse) || sortType != 'id'" class="fa fa-angle-down" aria-hidden="true"></i>
                                <i data-ng-show="sortType == 'id' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td><a href="javascript:" data-ng-click="sortType = 'param'; sortReverse = !sortReverse">
                                <span>Название</span>
                                <i data-ng-show="(sortType == 'param' && sortReverse) || sortType != 'param'" class="fa fa-angle-down" aria-hidden="true"></i>
                                <i data-ng-show="sortType == 'param' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td><a href="javascript:" data-ng-click="sortType = 'value'; sortReverse = !sortReverse">
                                <span>Значение</span>
                                <i data-ng-show="(sortType == 'value' && sortReverse) || sortType != 'value'" class="fa fa-angle-down" aria-hidden="true"></i>
                                <i data-ng-show="sortType == 'value' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>Управление</td>
                    </tr>
                </thead>
                <tbody>
                    <tr data-ng-repeat="item in items | orderBy:sortType:!sortReverse | filter:searchItem">
                        <td><input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="item.Selected" />
                            @{{ item.id }}</td>
                        <td>@{{ item.param }}</td>
                        <td>@{{ item.value }}</td>
                        <td>
                            {{--<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#item_edit" data-id="@{{ item.id }}" data-ng-click="editItem()"><i class="fa fa-pencil" aria-hidden="true"></i></button>--}}
                            <a type="button" class="btn btn-warning btn-xs" href="/admin/settings/@{{ item.id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#item_remove" data-id="@{{ item.id }}" data-ng-click="removeItem()"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.panel-body -->

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
                                url: '/admin/settings/destroy',
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
