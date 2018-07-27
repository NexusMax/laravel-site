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

        <!-- /.panel-heading -->
        <div class="panel-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <td width="80px"><input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="selectedAll" data-ng-click="checkAll()" />
                            <a href="javascript:" data-ng-click="sortType = 'id'; sortReverse = !sortReverse">
                                <span>id</span>
                                <i data-ng-show="(sortType == 'id' && sortReverse) || sortType != 'id'" class="fa fa-angle-down" aria-hidden="true"></i>
                                <i data-ng-show="sortType == 'id' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td><a href="javascript:" data-ng-click="sortType = 'param'; sortReverse = !sortReverse">
                                <span>Событие</span>
                                <i data-ng-show="(sortType == 'param' && sortReverse) || sortType != 'param'" class="fa fa-angle-down" aria-hidden="true"></i>
                                <i data-ng-show="sortType == 'param' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                            </a>
                        </td>

                    </tr>
                </thead>
                <tbody>
                    <tr data-ng-repeat="item in items | orderBy:sortType:!sortReverse | filter:searchItem">
                        <td><input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="item.Selected" />
                            @{{ item.id }}</td>
                        <td><a href="/admin/chat/@{{ item.id }}">@{{ item.name }}</a></td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.panel-body -->


@endsection
