@extends('admin.layout')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

@section('content')
    <script type="text/javascript">
        // $(document).ready( function () {
        var adminBlog = angular.module('adminBlog', []);
        var blog = <?php echo json_encode($blog); ?>;
        blog = $.parseJSON(blog);

        adminBlog.controller('UsersList', function ($scope){
            $scope.posts = blog['posts'];
            $scope.sortType = 'name';
            $scope.sortReverse  = true;
//          console.log($scope.users);
        });


        // });
    </script>

    <table class="table table-striped">
        <tr>
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
            <td>Created <a href="javascript:" data-ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
                    <i data-ng-show="(sortType == 'created_at' && sortReverse) || sortType != 'created_at'" class="fa fa-arrow-down" aria-hidden="true"></i>
                    <i data-ng-show="sortType == 'created_at' && !sortReverse" class="fa fa-arrow-up" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
        <tr data-ng-repeat="post in posts | orderBy:sortType:!sortReverse">
            <td>@{{ post.id }}</td>
            <td>@{{ post.name }}</td>
            <td>@{{ post.created_at }}</td>
        </tr>
    </table>
@endsection