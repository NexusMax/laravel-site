<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 02.01.2018
 * Time: 15:40
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
                <a href="{{ URL::route('admin/event/create') }}" type="button" class="btn btn-success">Добавить</a>
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
        <table width="50%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
            <tr>
                <td width="1%"><input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="selectedAll" data-ng-click="checkAll()" /></td>
                <td width="7%"><a href="javascript:" data-ng-click="sortType = 'name'; sortReverse = !sortReverse">
                        <span>Наименование</span>
                        <i data-ng-show="(sortType == 'name' && sortReverse) || sortType != 'name'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'name' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="5%"><a href="javascript:" data-ng-click="sortType = 'category_id'; sortReverse = !sortReverse">
                        <span>Категория</span>
                        <i data-ng-show="(sortType == 'category_id' && sortReverse) || sortType != 'category_id'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'category_id' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="1%"><a href="javascript:" data-ng-click="sortType = 'published'; sortReverse = !sortReverse">
                        <span>Опубликован</span>
                        <i data-ng-show="(sortType == 'published' && sortReverse) || sortType != 'published'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'published' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="1%"><a href="javascript:" data-ng-click="sortType = 'featured'; sortReverse = !sortReverse">
                        <span>Избранный</span>
                        <i data-ng-show="(sortType == 'featured' && sortReverse) || sortType != 'featured'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'featured' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="10%"><a href="javascript:" data-ng-click="sortType = 'author_fullname'; sortReverse = !sortReverse">
                        <span>Автор</span>
                        <i data-ng-show="(sortType == 'author_fullname' && sortReverse) || sortType != 'author_fullname'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'author_fullname' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="10%"><a href="javascript:" data-ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
                        <span>Дата начала</span>
                        <i data-ng-show="(sortType == 'created_at' && sortReverse) || sortType != 'created_at'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'created_at' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td width="1%"><a href="javascript:" data-ng-click="sortType = 'views'; sortReverse = !sortReverse">
                        <span>Просмотров</span>
                        <i data-ng-show="(sortType == 'views' && sortReverse) || sortType != 'views'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'views' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
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
                <td width="7%">@{{ item.name }}</td>
                <td width="5%">@{{ item.category_name }}</td>
                <td width="1%">
                    <span data-ng-if="item.published==1"><i class="fa fa-circle text-success" aria-hidden="true"></i> Да</span>
                    <span data-ng-if="item.published!=1"><i class="fa fa-circle text-danger" aria-hidden="true"></i> Нет</span>
                </td>
                <td width="1%">
                    <span data-ng-if="item.featured==1">Да</span>
                    <span data-ng-if="item.featured!=1">Нет</span>
                </td>
                <td width="10%">@{{ item.author_fullname }}</td>
                <td width="10%">@{{ item.created_at | date:'dd.MM.yyyy HH:mm' }}</td>
                <td width="1%">@{{ item.views }}</td>
                <td width="1%">
                    {{--<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#item_edit" data-id="@{{ item.id }}" data-ng-click="editItem()"><i class="fa fa-pencil" aria-hidden="true"></i></button>--}}
                    <a type="button" class="btn btn-info btn-xs" href="/trainer/events/@{{ item.alias }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a type="button" class="btn btn-warning btn-xs" href="/admin/event/@{{ item.id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
                                url: '/admin/event/destroy',
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
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
