@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\ItemsController@index')}}">Авто Каталог</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
    @endsection

    @section('content')
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> Авто Каталог
        <small>Список авто</small>
    </h3>
    <!-- END PAGE TITLE-->

    <div ng-app="myApp"
            ng-controller="myCtrl">
        <div class="note note-info">
            <!-- BEGIN FORM-->
            <div class="form-body">

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Тип</label>
                            <select
                                    class="form-control input-circle"
                                    ng-model="obj.help.type_auto[0]"
                                    ng-options="item.text for item in filter.type_auto"
                                    ng-change="obj.helpers.makeObj('type_auto')"
                                    >
                            </select>
                        </div>
                        <div class="col-md-4" ng-show="obj.help.type_auto[0].children">
                            <label class="control-label">Марка</label>
                            <select
                                    class="form-control input-circle"
                                    ng-model="obj.help.type_auto[1]"
                                    ng-options="item.text for item in obj.help.type_auto[0].children"
                                    ng-change="obj.helpers.makeObj('type_auto')"
                                    >
                            </select>
                        </div>
                        <div class="col-md-4" ng-show="obj.help.type_auto[1].children">
                            <label class="control-label">Модель</label>
                            <select
                                    class="form-control input-circle"
                                    ng-model="obj.help.type_auto[2]"
                                    ng-options="item.text for item in obj.help.type_auto[1].children"
                                    ng-change="obj.helpers.makeObj('type_auto')"
                                    >
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <!-- END FORM-->
        </div>
@{{ obj.obj }}
        <!-- BEGIN CONTENT BODY -->
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>  </th>
                        <th> # </th>
                        <th> Name </th>
                        <th> Created </th>
                        <th> Updated </th>
                        <th>
                            <a href="{{action('Admin\ItemsController@add')}}" class="btn btn-outline btn-circle btn-sm green">
                                <i class="fa fa-plus"></i>
                                Add
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody ng-show="cloneItems">
                        <tr ng-repeat="item in cloneItems | orderBy:'name'">
                            <td> @{{ item.item['id'] }} </td>
                            <td><img ng-src="/images/items/@{{ item.item['id'] }}/thumbnail/@{{ item.images[0] }}" alt=""> </td>
                            <td> @{{ item.item['name'] }} </td>
                            <td> @{{ item.item['created_at'] }} </td>
                            <td> @{{ item.item['updated_at'] }} </td>
                            <td>
                                <a href="{{action('Admin\ItemsController@show')}}/@{{ item.item['id'] }}" class="btn btn-outline btn-circle btn-sm purple">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                                <a href="{{action('Admin\ItemsController@delete')}}/@{{ item.item['id'] }}" class="btn btn-outline btn-circle btn-sm red">
                                    <i class="fa fa-remove"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- END CONTENT BODY -->
    </div>
@endsection

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\ItemsController@index')}}">Авто Каталог</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@endsection

@section('PAGE-LEVEL-PLUGINS')
    <script src="/admin/assets/global/plugins/angularjs/angular.min.js"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/admin/js/items/index.js" type="text/javascript"></script>
@endsection

@section('PAGE-LEVEL-STYLES')
    <style>
        tbody img {
            width: 100%;
            max-width: 100px;
        }
    </style>
@endsection