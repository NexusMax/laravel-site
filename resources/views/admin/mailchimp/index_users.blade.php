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

            $scope.removeItem = function (e) {
                console.log(this);
                $("input[name=id]").val(this.item.id);
            };
        });
    </script>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-5 col-xs-12">
                {{--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#item_edit">Добавить</button>--}}
                <a href="#add" type="button" id="add" class="btn btn-success">Добавить</a>
                {{--<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#item_remove">Удалить</button>--}}
                <a href="#update" type="button" id="update" class="btn btn-info">Обновить группы</a>
                <a href="#sync" type="button" id="sync" class="btn btn-warning">Синхронизация</a>
            </div>
            <div class="col-md-7 col-xs-12 input-group custom-search-form">
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

        <div class="panel panel-default users" style="display: none">
            <div class="panel-body">
                <h2>Добавление в группу</h2>
                <div class="col-md-6">
                    <label class="h4">Группа</label>
                    <select name="group_id" id="group_id"></select>
                </div>
                <div class="col-md-6">
                    <label class="h4">Пользователь</label>
                    <select name="user_id" id="user_id"></select>
                </div>
            </div>
            <div class="panel-footer">
                <a href="#save_user" type="button" class="btn btn-info" id="save_user">Подписать</a><br/>
            </div>
        </div>

        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
            <tr>
                <td>Подписчик <a href="javascript:" data-ng-click="sortType = 'user'; sortReverse = !sortReverse">
                        <i data-ng-show="(sortType == 'user' && sortReverse) || sortType != 'user'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'user' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td>Группа <a href="javascript:" data-ng-click="sortType = 'group.id'; sortReverse = !sortReverse">
                        <i data-ng-show="(sortType == 'group.id' && sortReverse) || sortType != 'group.id'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'group.id' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td>Управление</td>
            </tr>
            </thead>
            <tbody>
            <tr data-ng-repeat="item in items | orderBy:sortType:!sortReverse | filter:searchItem">
                <td><a href="/admin/users/@{{ item.id }}">@{{ item.user }}</a>
                     (@{{ item.email }})
                </td>
                <td>@{{ item.group.name }}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#item_remove" data-user-id="@{{ item.id }}" data-group-id="@{{ item.group.id }}" data-ng-click="removeItem()"><i class="fa fa-times" aria-hidden="true"></i></button>
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
                    <input type="hidden" name="user_id" value="" />
                    <input type="hidden" name="group_id" value="" />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Удалить</button>
                    </div>
                </form>
                <script type="text/javascript">
                    $(function(){
                        var groups,
                            total,
                            suggestions_users,
                            suggestions_groups,
                            users,
                            total_groups,
                            total_users,
                            group,
                            list_id;
                        $('a[href*=add]').on('click', function(){
                            $.post({
                                type: 'POST',
                                url: '/admin/subscribers/users/get',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataType: 'json',
                                success: function(r) {
                                    $('.users').show(500);
                                    suggestions_users += '<option value="" disabled selected>Выберите пользователя</option>';
                                    $.each(r, function(i, value) {
                                        suggestions_users += '<option value="' + value.data.id + '">' + value.value + '</option>';
                                    });
                                    $('select#user_id').html(suggestions_users);
                                }
                            });
                            suggestions = '';
                            $.post({
                                type: 'POST',
                                url: '/admin/subscribers/groups/get_list',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataType: 'json',
                                success: function(r) {
                                    $('.user').show(500);
                                    suggestions_groups += '<option value="" disabled selected>Выберите группу</option>';
                                    $.each(r, function(i, value) {
                                        suggestions_groups += '<option value="' + value.data.id + '">' + value.value + '</option>';
                                    });
                                    $('select#group_id').html(suggestions_groups);
                                }
                            });
                            return false;
                        });

                        $("a#save_user").on('click', function (event) {
                            event.preventDefault();
                            $_user = $('select[name*=user_id]').val();
                            $_group = $('select[name*=group_id]').val();
                            console.log($_user + ' - ' + $_group);
                            $.ajax({
                                type: 'POST',
                                url: '/admin/subscribers/users/store',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    user: $_user,
                                    group: $_group
                                },
                                dataType: 'json',
                                success: function (r) {
                                    location.reload();
                                },
                                error: function(xhr, status, errorThrown) {
                                    alert(errorThrown+'\n'+xhr.responseText);
                                }
                            });
                            return false;
                        });

                        $('a#update').on('click', function () {
                            $("#progressbar").show(200);
                            $.post({
                                type: 'POST',
                                url: '/admin/subscribers/users/get',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataType: 'json',
                                success: function(r) {
                                    users = r;
                                    total = users.length;
                                    $("#progressbar").show('200');
                                    do_check();
                                }
                            });
                            return false;
                        });

                        function do_check(id) {
                            id = typeof(id) !== 'undefined' ? id : 1;
                            $.ajax({
                                url: "/admin/subscribers/users/update",
                                type: "POST",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    item: users[id-1],
                                    id: id,
                                    total: total
                                },
                                dataType: 'json',
                                success: function(r){
                                    console.log(r);
                                    if(r && !r.end) {
                                        $("#progressbar div[role=progressbar]").css('width', Math.round(100*r.id/r.total)+'%');
                                        do_check(r.id*1+1);
                                    } else {
                                        $("#progressbar div[role=progressbar]").css('width', '100%');
                                        location.reload();
                                    }
                                },
                                error:function(xhr, status, errorThrown) {
                                    alert(errorThrown+'\n'+xhr.responseText);
                                }
                            });
                        }

                        $('a#sync').on('click', function () {
                            $("#progressbar").show(200);
                            $.post({
                                type: 'POST',
                                url: '/admin/subscribers/groups/get_list',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                dataType: 'json',
                                success: function(r) {
                                    console.log(r);
                                    if (r.length !== undefined) {
                                        total_groups = r.length;
                                        groups = r;
                                        check_group();
                                    }
                                }
                            });
                            return false;
                        });

                        function check_group(group_id) {
                            group_id = typeof(group_id) !== 'undefined' ? group_id : 1;
                            group = group_id;
                            if (typeof(groups[group-1]) !== 'undefined') {
                                $("#progressbar div[role=progressbar]").css('width', '10%');
                                $.post({
                                    type: 'POST',
                                    url: '/admin/subscribers/emails',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: {
                                        list_id: groups[group-1].data.list_id
                                    },
                                    dataType: 'json',
                                    success: function (r) {
//                                        console.log(r);
//                                        r = $.parseJSON(r);
                                        users = r;
                                        total_users = users.length;
                                        check_email();
//                                        check_group(group+1);
                                    }
                                });
                            } else {
                                location.reload();
                            }
                        }

                        function check_email(id) {
                            id = typeof(id) !== 'undefined' ? id : 1;
//                            console.log('users.length '+users.length);
                            if(users.length > 0 && id <= total_users && typeof(users[id-1]) !== 'undefined') {
                                console.log(id+'-'+users[id-1]['email']+'-'+users[id-1]['list_id']);
                                $.post({
                                    type: 'POST',
                                    url: '/admin/subscribers/update',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: {
                                        id: id,
                                        list_id: users[id-1].list_id,
                                        total: total_users,
                                        email: users[id-1].email
                                    },
                                    dataType: 'json',
                                    success: function (r) {
                                        console.log(r);
//                                        r = $.parseJSON(r);
                                        if (r && !r.end) {
                                            $("#progressbar div[role=progressbar]").css('width', Math.round(100*r.id/r.total)+'%');
                                            check_email(r.id*1+1);
                                        } else {
                                            $("#progressbar div[role=progressbar]").css('width', '100%');
                                            console.log(group+'-'+total_groups);
                                            if (total_groups !== undefined && group <= total_groups) {
                                                check_group(group+1);
                                            }
                                        }
                                    }
                                });
                            } else {
                                $("#progressbar div[role=progressbar]").css('width', '100%');
                                check_group(group+1);
                            }
                        }

                        $("button[data-target='#item_remove']").on('click',function(e){
                            $('#destroyItem input[name=user_id]').val($(this).data('user-id'));
                            $('#destroyItem input[name=group_id]').val($(this).data('group-id'));
                        });

                        $('#destroyItem').on('submit',function(e){
                            $.ajax({
                                type: "POST",
                                url: '/admin/subscribers/users/destroy',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    _token: $('#token').val(),
                                    user: $(this).find("input[name=user_id]").val(),
                                    group: $(this).find("input[name=group_id]").val()
                                },
                                dataType: 'json',
                                success: function(r){
                                    location.reload();
                                },
                                error: function(xhr, status, errorThrown) {
                                    alert(errorThrown+'\n'+xhr.responseText);
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
