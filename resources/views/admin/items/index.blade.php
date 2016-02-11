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
                            <select
                                    class="form-control input-circle"
                                    ng-model="obj.help.type_auto[0]"
                                    ng-options="item.text for item in filter['type_auto'] | orderBy:'text':false"
                                    ng-change="obj.helpers.makeObj('type_auto', 'sublist')"
                                    >
                                <option value="">Тип: любой</option>
                            </select>
                        </div>
                        <div class="col-md-4" ng-show="obj.help.type_auto[0].children">
                            <select
                                    class="form-control input-circle"
                                    ng-model="obj.help.type_auto[1]"
                                    ng-options="item.text for item in obj.help['type_auto'][0].children | orderBy:'text':false"
                                    ng-change="obj.helpers.makeObj('type_auto', 'sublist')"
                                    >
                                <option value="">Марка: любая</option>
                            </select>
                        </div>
                        <div class="col-md-4" ng-show="obj.help.type_auto[1].children">
                            <select
                                    class="form-control input-circle"
                                    ng-model="obj.help.type_auto[2]"
                                    ng-options="item.text for item in obj.help['type_auto'][1].children | orderBy:'text':false"
                                    ng-change="obj.helpers.makeObj('type_auto', 'sublist')"
                                    >
                                <option value="">Модель: любая</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <select
                                    class="form-control input-circle"
                                    ng-model="obj.help['Тип кузова'][0]"
                                    ng-options="item.text for item in filter['Тип кузова'] | orderBy:'text':false"
                                    ng-change="obj.helpers.makeObj('Тип кузова')"
                                    >
                                <option value="">Тип кузова: любой</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select
                                    class="form-control input-circle"
                                    ng-model="obj.help['Трансмиссия'][0]"
                                    ng-options="item.text for item in filter['Трансмиссия'] | orderBy:'text':false"
                                    ng-change="obj.helpers.makeObj('Трансмиссия')"
                                    >
                                <option value="">Трансмиссия: любая</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select
                                    class="form-control input-circle"
                                    ng-model="obj.help['Тип двигателя'][0]"
                                    ng-options="item.text for item in filter['Тип двигателя'] | orderBy:'text':false"
                                    ng-change="obj.helpers.makeObj('Тип двигателя')"
                                    >
                                <option value="">Тип двигателя: любой</option>
                            </select>
                        </div>
                    </div>
                    {{--<div class="row">--}}
                        {{--<label class="col-md-3 control-label"> Опции </label>--}}
                        {{--<div class="col-md-9">--}}
                            {{--<select multiple--}}
                                    {{--ng-model="obj.help['Опции']"--}}
                                    {{--ng-options="item.text for item in filter['Опции'] | orderBy:'text':false"--}}
                                    {{--ng-change="obj.helpers.makeObj('Опции')"--}}
                                    {{-->--}}
                            {{--</select>--}}
                            {{--<br>--}}
                            {{--<label ng-repeat="role in filter['Опции'] | orderBy:'-text'" class="col-md-4">--}}
                                {{--<input type="checkbox" checklist-model="obj.help['Опции']" checklist-value="role" checklist-change="obj.helpers.makeObj('Опции')"> @{{role.text}}--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--@{{obj.help['Опции']}}--}}
                    {{--</div>--}}
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
                        <th> # </th>
                        <th> Фото </th>
                        <th> Тип </th>
                        <th> Марка </th>
                        <th> Модель </th>
                        <th> Кузов </th>
                        <th> Цена </th>
                        <th>
                            <a href="{{action('Admin\ItemsController@add')}}" class="btn btn-outline btn-circle btn-sm green">
                                <i class="fa fa-plus"></i>
                                Добавить
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody ng-show="cloneItems">
                        <tr ng-repeat="item in cloneItems | orderBy: '-item.id'">
                            <td> @{{ item.item['id'] }} </td>
                            <td><img class="img-rounded" ng-src="/images/items/@{{ item.item['id'] }}/thumbnail/@{{ item.images[0] }}" alt=""> </td>
                            <td> @{{ item.type_auto[0].text }} </td>
                            <td> @{{ item.type_auto[0].children[0].text }} </td>
                            <td> @{{ item.type_auto[0].children[0].children[0].text }} </td>
                            <td> @{{ item['Тип кузова'][0].text }} </td>
                            <td> @{{ item.item['price'] }} </td>
                            <td class="itemActions">
                                <a href="{{action('Admin\ItemsController@show')}}/@{{ item.item['id'] }}" class="btn btn-outline btn-circle btn-sm purple">
                                    <i class="fa fa-edit"></i>
                                    Редактировать
                                </a>
                                <a class="btn btn-outline btn-circle btn-sm red modal-del-confirm"
                                   data-toggle="modal"
                                   del-obj="Вы действительно хотите удалить запись '@{{ item.type_auto[0].children[0].text }} @{{ item.type_auto[0].children[0].children[0].text }}' ?"
                                   del-url="{{action('Admin\ItemsController@delete')}}/@{{ item.item['id'] }}">
                                    <i class="fa fa-remove"></i>
                                    Удалить
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
    <script src="/admin/js/checklist-model.js" type="text/javascript"></script>
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
            .itemActions{
            width: 150px;
        }
    </style>
@endsection