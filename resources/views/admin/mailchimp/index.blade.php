<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 05.04.2018
 * Time: 14:34
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

//            $scope.editItem = function () {
//                $http.get("/admin/subscribers/" + this.item.id)
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
                {{--            <a href="{{ route('admin/subscribes/create') }}" type="button" class="btn btn-success">Добавить</a>--}}
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#item_remove">Удалить</button>
                <a href="#" type="button" id="update" class="btn btn-info">Обновить</a>
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
                <td>list_id <a href="javascript:" data-ng-click="sortType = 'list_id'; sortReverse = !sortReverse">
                        <i data-ng-show="(sortType == 'list_id' && sortReverse) || sortType != 'list_id'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'list_id' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td>web_id <a href="javascript:" data-ng-click="sortType = 'web_id'; sortReverse = !sortReverse">
                        <i data-ng-show="(sortType == 'web_id' && sortReverse) || sortType != 'web_id'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'web_id' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
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
                <td id="dt#@{{ item.list_id }}">@{{ item.list_id }}</td>
                <td>@{{ item.web_id }}</td>
                <td>@{{ item.created_at }}</td>
                <td>
                    {{--<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#item_edit" data-id="@{{ item.id }}" data-ng-click="editItem()"><i class="fa fa-pencil" aria-hidden="true"></i></button>--}}
                    {{--<a type="button" class="btn btn-warning btn-xs" href="/admin/subscribers/@{{ item.id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>--}}
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
                        var groups,
                            total;
                        $("a#update").click(function(){
                            $("#progressbar").show('200');
                            $("#progressbar div[role=progressbar]").css('width', '2%');
                            $.ajax({
                                type: "POST",
                                url: '/admin/subscribers/groups/get',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataType: 'json',
                                success: function(r){
                                    groups = $.parseJSON(r);
                                    total = (groups.total_items !== undefined) ? Math.max(0, parseInt(groups.total_items)-1) : 0;
                                    console.log(groups);
                                    do_groups();
                                },
                                error: function(r){
                                    console.log(r);
                                }
                            });
                            return false;
                        });

                        do_groups = function(id) {
                            id = typeof(id) !== 'undefined' ? id : 0;
                            console.log(id);
                            console.log(groups.lists);
                            $.ajax({
                                url: "/admin/subscribers/groups/store",
                                type: "POST",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    item: JSON.stringify(groups.lists[id]),
                                    id: id,
                                    total: total
                                },
//                                dataType: 'json',
                                success: function(r){
                                    console.log(r);
                                    $("#progressbar").show('200');
                                    if(r && !r.end) {
                                        $("#progressbar div[role=progressbar]").css('width', Math.round(100*r.id/r.total)+'%');
                                        do_groups(r.id*1+1);
                                    } else {
                                        $("#progressbar div[role=progressbar]").css('width', '100%');
                                        location.reload();
                                    }
                                },
                                error:function(xhr, status, errorThrown) {
//                                    alert(errorThrown+'\n'+xhr.responseText);
                                    console.log(errorThrown+'\n'+xhr.responseText);
                                }
                            });
                        };

                        $("button[data-target='#item_remove']").on('click',function(e){
                            $('#destroyItem input[name=id]').val($(this).attr('data-id'));
                            console.log($(this).attr('data-id'));
                        });

                        $('#destroyItem').on('submit',function(e){
                            $.ajax({
                                type: "POST",
                                url: '/admin/subscribers/groups/destroy',
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
