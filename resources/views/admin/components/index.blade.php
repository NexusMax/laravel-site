<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 02.11.2017
 * Time: 11:23
 */
?>
@extends('admin.layout')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

@section('content')
<script type="text/javascript">
    var adminUsers = angular.module('adminUsers', []);
    var response = <?php echo json_encode($response); ?>;
    response = $.parseJSON(response);

    adminUsers.controller('UsersList', function ($scope){
        $scope.users = response;
        $scope.sortType = 'name';
        $scope.sortReverse  = true;

        response = [];
        angular.forEach($scope.users, function(user, id) {
           response[user.id] = user;
        });

        $scope.checkAll = function () {
            if ($scope.selectedAll) {
                $scope.selectedAll = true;
            } else {
                $scope.selectedAll = false;
            }
            angular.forEach($scope.users, function (user) {
                user.Selected = $scope.selectedAll;
            });

        };

        $scope.editUser = function () {
            var id = $(event.target).attr('data-id');
            if (id == undefined) id = $(event.target).parent().attr('data-id');
            var user = response[id];
            var user_container = $('#user_edit');
            user_container.find('#name').text(user.name);
            user_container.find('#username').val(user.name);
            user_container.find('#email').val(user.email);

        };

        $scope.removeUser = function () {
            var id = $(event.target).attr('data-id');
            if (id == undefined) id = $(event.target).parent().attr('data-id');

        };

//        console.log(response);
    });

</script>
<div data-ng-app="adminUsers">
    <div class="col-lg-3">
        <div class="input-group">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#user_edit">Добавить</button>
            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#user_remove">Удалить</button>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
        </div>
    </div>
    <br><br>

    <table class="table table-striped" data-ng-controller="UsersList">
        <tr>
            <td><input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="selectedAll" data-ng-click="checkAll()" />
            </td>
            <td>id <a href="javascript:" data-ng-click="sortType = 'id'; sortReverse = !sortReverse">
                    <i data-ng-show="(sortType == 'id' && sortReverse) || sortType != 'id'" class="fa fa-arrow-down" aria-hidden="true"></i>
                    <i data-ng-show="sortType == 'id' && !sortReverse" class="fa fa-arrow-up" aria-hidden="true"></i>
                </a>
            </td>
            <td>Имя <a href="javascript:" data-ng-click="sortType = 'name'; sortReverse = !sortReverse">
                    <i data-ng-show="(sortType == 'name' && sortReverse) || sortType != 'name'" class="fa fa-arrow-down" aria-hidden="true"></i>
                    <i data-ng-show="sortType == 'name' && !sortReverse" class="fa fa-arrow-up" aria-hidden="true"></i>
                </a>
            </td>
            <td>Email <a href="javascript:" data-ng-click="sortType = 'email'; sortReverse = !sortReverse">
                    <i data-ng-show="(sortType == 'email' && sortReverse) || sortType != 'email'" class="fa fa-arrow-down" aria-hidden="true"></i>
                    <i data-ng-show="sortType == 'email' && !sortReverse" class="fa fa-arrow-up" aria-hidden="true"></i>
                </a>
            </td>
            <td>Created <a href="javascript:" data-ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
                    <i data-ng-show="(sortType == 'created_at' && sortReverse) || sortType != 'created_at'" class="fa fa-arrow-down" aria-hidden="true"></i>
                    <i data-ng-show="sortType == 'created_at' && !sortReverse" class="fa fa-arrow-up" aria-hidden="true"></i>
                </a>
            </td>
            <td>Управление</td>
        </tr>
        <tr data-ng-repeat="user in users | orderBy:sortType:!sortReverse">
            <td><input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="user.Selected" /></td>
            <td>@{{ user.id }}</td>
            <td>@{{ user.name }}</td>
            <td>@{{ user.email }}</td>
            <td>@{{ user.created_at }}</td>
            <td>
                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#user_edit" data-id="@{{ user.id }}" data-ng-click="editUser()"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#user_remove" data-id="@{{ user.id }}" data-ng-click="removeUser()"><i class="fa fa-times" aria-hidden="true"></i></button>
            </td>
        </tr>
    </table>

    <div class="modal fade" id="user_edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Информация о пользователе <span id="name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                        <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-5">
                                    <label for="username">Имя пользователя</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon" id="basic-addon1">@</span>
                                        <input type="text" class="form-control" id="username" placeholder="Имя пользователя" aria-label="Имя пользователя" aria-describedby="basic-username">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-5">
                                    <label for="mail">Email</label>
                                    <div class="input-group input-group-lg">
                                        <input type="text" class="form-control" id="email" placeholder="Email" aria-label="Email" aria-describedby="basic-email">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="pull-xs-left">
                                    <label for="mail">Пароль</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="password" placeholder="Пароль" aria-label="Пароль" aria-describedby="basic-password">
                                    </div>
                                </div>
                                <div class="pull-xs-left">
                                    <label for="mail">Подтвердить пароль</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="check_password" placeholder="Подтвердить пароль" aria-label="Подтвердить пароль" aria-describedby="basic-check_password">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удалить пользователя</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="danger">
                        Вы уверены, что хотите удались пользователя?
                    </div>
                </div>
                <form action="" method="POST">
                    <input type="hidden" name="user_id" value="" />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Удалить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection



<script>


</script>