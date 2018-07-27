<?php /**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 20.04.2018
 * Time: 13:43
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
            {{--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#item_edit">Добавить</button>--}}
            <a href="#add" type="button" class="btn btn-success">Добавить</a>
            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#item_remove">Удалить</button>
        </div>
        <div class="progress" id="progressbar" style="display:none;height:5px;margin:0">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                <span class="sr-only">0% Complete</span>
            </div>
        </div>

        <div class="panel panel-default files" style="display: none;">
            <div class="panel-body">
                <h2>Файлы</h2>
                <div class="col-md-6">
                    <label class="h4">Материал</label>
                    <select name="item_id" id="item_id"></select>
                </div>
                <div class="col-md-6">
                    <label class="h4">Тип загружаемых файлов</label>
                    <select name="type_files">
                        @foreach($type_files as $i=>$type)
                            <option value="{{ $i }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <label for="attachments">
                    <div id=dropZone>
                        <div id=dropMessage>Перетащите файлы сюда</div>
                        <input type="file" id="attachments" name="attachments[]" multiple class="dropInput">
                    </div>
                </label>
                <div class="files_log well well-lg" style="display: none"></div>
                <div id="files" class="panel panel-default">
                    <div class="panel-body" id="new_files"></div>
                </div>
                <div class="progress" style="display: none;">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        <span class="sr-only"></span>
                    </div>
                </div>
                <div id="add_file"></div>
                <a href="" type="button" class="btn btn-info" id="upload_file">Добавить файлы</a>
                <div class="alert alert-warning" role="alert">Страница будет автоматически перезагружена по окончанию загрузки файлов.</div>
            </div>
        </div>

        <table width="100%" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <td><input type="checkbox" aria-label="Checkbox for following text input" data-ng-model="selectedAll" data-ng-click="checkAll()" />
                    <a href="javascript:" data-ng-click="sortType = 'id'; sortReverse = !sortReverse">
                        <i data-ng-show="(sortType == 'id' && sortReverse) || sortType != 'id'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'id' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td>Материал <a href="javascript:" data-ng-click="sortType = 'item_name'; sortReverse = !sortReverse">
                        <i data-ng-show="(sortType == 'item_name' && sortReverse) || sortType != 'item_name'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'item_name' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
                    </a>
                </td>
                <td>Файл <a href="javascript:" data-ng-click="sortType = 'path'; sortReverse = !sortReverse">
                        <i data-ng-show="(sortType == 'path' && sortReverse) || sortType != 'path'" class="fa fa-angle-down" aria-hidden="true"></i>
                        <i data-ng-show="sortType == 'path' && !sortReverse" class="fa fa-angle-up" aria-hidden="true"></i>
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
                <td><a href="/admin/items/@{{ item.item_url }}">@{{ item.item_name }}</a></td>
                <td id="dt#@{{ item.id }}"><a href="/admin/lib/@{{ item.path }}">@{{ item.path }}</a></td>
                <td>@{{ item.created_at }}</td>
                <td>
                    {{--<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#item_edit" data-id="@{{ item.id }}" data-ng-click="editItem()"><i class="fa fa-pencil" aria-hidden="true"></i></button>--}}
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
                                url: '/admin/lib/destroy',
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

                        $('a[href*=add]').on('click', function(){
                            var suggestions = '';
                            $.post({
                                type: 'POST',
                                url: '/admin/items/get',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(r) {
                                    $('.files').show(500);
                                    $.each(r, function(i, value) {
                                        console.log(value);
                                        suggestions += '<option value="' + value.id + '">' + value.cat_name + ' > ' + value.name + '</option>';
                                    });
                                    $('select#item_id').html(suggestions);
                                }
                            });
                        });

                        if(window.File && window.FileReader && window.FileList) {

                            var $_attachments = [],
                                $_total,
                                $_item,
                                $_errors = 0,
                                $_type,
                                $_container = $(".files");
                            $_container.find("#dropZone").show();
                            $_container.find("#dropZone").on('dragover', function (e){
                                $(this).css('border', '1px solid #8cbf32');
                            });
                            $_container.on('dragenter', function (e){
                                $_container.find("#dropZone").css('border', '1px dotted #8cbf32').css('background-color', '#c5ff8d');
                            });


                            $("a#upload_file").on('click', function (event) {
                                event.stopPropagation(); // Остановка происходящего
                                event.preventDefault(); // Полная остановка происходящего
                                $_attachments = $("input[name*=attachments]")[0].files;
                                $_total = $_attachments.length;
                                $_item = $('select[name*=item_id]').val();
                                $_type = $('select[name*=type_files]').val();
                                if ($_total > 0 && $_item > 0) {
                                    $_container.find("#dropZone").hide(500);
                                    $(".progress").show(500);
                                    $(".files_log").show(500);
                                    $_container.find($(this)).hide();
                                    $_container.find('#upload_file').hide();
                                    $_container.find('.progress .progress-bar').css('width', '5%');
                                    do_file($_item, $_type);
                                }
                            });

                            do_file = function(item_id, type, id) {
                                console.log(item_id);
                                console.log(type);
                                console.log(id);
                                id = typeof(id) !== 'undefined' ? id : 0;

                                var $_formdata = new FormData();
                                $_formdata.append('id', id);
                                $_formdata.append('file', $_attachments[id]);
                                $_formdata.append('type', type);
                                $_formdata.append('item_id', parseInt(item_id));
                                $_formdata.append('total', $_total);

                                $.ajax({
                                    type: 'POST',
                                    url: '/admin/lib/store',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: $_formdata,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    dataType: 'json',
                                    success: function (r) {
                                        console.log(r);
                                        if (r.result === '200')
                                            $(".files_log").append('Файл '+r.file+' успешно загружен в папку /storage/public/lib<br/>');
                                        else if (r.result === '400') {
                                            $(".files_log").append('Файл '+r.file+' в папке /storage/public/lib существует.<br/>');
                                            $_errors++;
                                        }
                                        if(!r.end) {
                                            $_container.find('.progress .progress-bar').css('width', Math.round(100*r.id/r.total)+'%');
                                            do_file(r.item_id, r.type, r.id*1+1);
                                        } else {
                                            $_container.find('.progress .progress-bar').css('width', '100%');
                                            if ($_errors === 0) setTimeout(function(){location.reload()}, 1500);
                                        }
                                    },
                                    error: function(xhr, status, errorThrown) {
                                        console.log(errorThrown+'\n'+xhr.responseText);
                                    }
                                });
                            }

                        }
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
