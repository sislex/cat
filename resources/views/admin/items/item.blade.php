@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\ItemsController@index')}}"> Каталог Авто </a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
    @endsection

    @section('content')

    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN NAV TAB -->
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_0" data-toggle="tab"> Основные поля </a>
        </li>
        @if(isset($item['id']))
            <li>
                <a href="#tab_4" data-toggle="tab"> Опции </a>
            </li>
            <li>
                <a href="#tab_5" data-toggle="tab"> Спецификации </a>
            </li>
            <li>
                <a href="#tab_1" data-toggle="tab"> СЕО данные </a>
            </li>
            <li>
                <a href="#tab_2" data-toggle="tab"> Фото </a>
            </li>
            <li>
                <a href="#tab_3" data-toggle="tab"> Видео </a>
            </li>
        @endif
    </ul>
    <!-- END NAV TAB -->
    <div class="tab-content"
         ng-app="myApp"
         ng-controller="myCtrl"
            >
        <div class="tab-pane active" id="tab_0">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i> Описание товара
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="main" action="{{action('Admin\ItemsController@update')}}" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <input type="hidden" name="id" value="{{ $item['id'] or '' }}" />
                        <input type="hidden" name="tab" value="#tab_0" />
                        <input ng-init="obj.objJson='{{ $item['obj'] or '' }}'" type="text" name="obj" ng-model="obj.objJson" class="col-md-12 "/>

                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Тип * </label>
                                <div class="col-md-2">
                                    <select
                                            ng-model="obj.help.type_auto[0]"
                                            ng-options="item.text for item in filter.type_auto | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('type_auto', 'sublist')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любой </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" ng-show="obj.help.type_auto[0].children">
                                <label class="col-md-3 control-label"> Марка * </label>
                                <div class="col-md-4">
                                    <select
                                            ng-model="obj.help.type_auto[1]"
                                            ng-options="item.text for item in obj.help.type_auto[0].children | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('type_auto', 'sublist')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любая </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" ng-show="obj.help.type_auto[1].children">
                                <label class="col-md-3 control-label"> Модель * </label>
                                <div class="col-md-4">
                                    <select
                                            ng-model="obj.help.type_auto[2]"
                                            ng-options="item.text for item in obj.help.type_auto[1].children | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('type_auto', 'sublist')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любая </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Версия/Модификация </label>
                                <div class="col-md-4">
                                    <input
                                        type="text"
                                        ng-model="obj.help['Версия/Модификация']"
                                        ng-change="obj.helpers.makeObj('Версия/Модификация')"
                                        class="form-control input-circle"
                                        placeholder="Введите текст"
                                        >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> VIN </label>
                                <div class="col-md-2">
                                    <input
                                        type="text"
                                        ng-model="obj.help['VIN']"
                                        ng-change="obj.helpers.makeObj('VIN')"
                                        class="form-control input-circle"
                                        placeholder="Введите VIN"
                                        >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Год выпуска * </label>
                                <div class="col-md-2">
                                    <select
                                            ng-model="obj.help['God_vypuska'][0]"
                                            ng-options="item.text for item in filter['God_vypuska'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('God_vypuska')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любой </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Состояние * </label>
                                <div class="col-md-2">
                                    <select
                                            ng-model="obj.help['Состояние'][0]"
                                            ng-options="item.text for item in filter['Состояние'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Состояние')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любое </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Цвет * </label>
                                <div class="col-md-2">
                                    <select
                                            ng-model="obj.help['Цвет'][0]"
                                            ng-options="item.text for item in filter['Цвет'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Цвет')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любой </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Тип двигателя * </label>
                                <div class="col-md-2">
                                    <select
                                            ng-model="obj.help['Тип двигателя'][0]"
                                            ng-options="item.text for item in filter['Тип двигателя'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Тип двигателя')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любой </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Объем куб. см. * </label>
                                <div class="col-md-2">
                                    <input
                                        type="text"
                                        ng-model="obj.help['Объем куб. см.']"
                                        ng-change="obj.helpers.makeObj('Объем куб. см.')"
                                        class="form-control input-circle"
                                        placeholder="Введите объем"
                                        >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Количество цилиндров * </label>
                                <div class="col-md-2">
                                    <input
                                        type="text"
                                        ng-model="obj.help['Цилиндров']"
                                        ng-change="obj.helpers.makeObj('Цилиндров')"
                                        class="form-control input-circle"
                                        placeholder="Введите количество"
                                        >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Тип кузова * </label>
                                <div class="col-md-2">
                                    <select
                                            ng-model="obj.help['Тип кузова'][0]"
                                            ng-options="item.text for item in filter['Тип кузова'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Тип кузова')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любой </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Количество дверей </label>
                                <div class="col-md-2">
                                    <select
                                            ng-model="obj.help['Количество дверей'][0]"
                                            ng-options="item.text for item in filter['Количество дверей'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Количество дверей')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любое </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Пробег * </label>
                                <div class="col-md-2">
                                    <input
                                            type="text"
                                            ng-if="probegType=='км'"
                                            ng-model="obj.help['Probeg']"
                                            ng-change="obj.help['Probeg'] = obj.help['Probeg'] * 1;obj.helpers.makeObj('Probeg'); obj.help['Miles'] = obj.help['Probeg']/1.61"
                                            class="form-control input-circle"
                                            placeholder="Введите пробег"
                                            >

                                    <input
                                            type="text"
                                            ng-if="probegType=='мили'"
                                            ng-model="obj.help['Miles']"
                                            ng-change="obj.help['Probeg'] = obj.help['Miles'] * 1.61; obj.helpers.makeObj('Probeg');"
                                            class="form-control input-circle"
                                            placeholder="Введите пробег"
                                            >

                                </div>
                                <div class="col-md-2">
                                    <select name="km-or-miles" class="form-control input-circle"
                                            ng-init="probegType = 'км'"
                                            ng-model="probegType"
                                            ng-options="item for item in ['км', 'мили']"
                                            >
                                    </select>

                                </div>
                                <div class="col-md-1" ng-if="probegType=='мили'">
                                    @{{ obj.help['Probeg'] | number }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Трансмиссия * </label>
                                <div class="col-md-2">
                                    <select
                                            ng-model="obj.help['Трансмиссия'][0]"
                                            ng-options="item.text for item in filter['Трансмиссия'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Трансмиссия')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любая </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Привод * </label>
                                <div class="col-md-2">
                                    <select
                                            ng-model="obj.help['Привод'][0]"
                                            ng-options="item.text for item in filter['Привод'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Привод')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любой </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Класс транспорта * </label>
                                <div class="col-md-2">
                                    <select
                                            ng-model="obj.help['Класс транспорта'][0]"
                                            ng-options="item.text for item in filter['Класс транспорта'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Класс транспорта')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любой </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Цена * </label>
                                <div class="col-md-2">
                                    <input type="text" class="form-control input-circle" name="price" value="{{ $item['price'] or '' }}" placeholder="Введите цену">
                                </div>
                                <div class="col-md-1">
                                    <h4>$</h4>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Обмен * </label>
                                <div class="col-md-2">
                                    <select
                                            ng-model="obj.help['Обмен'][0]"
                                            ng-options="item.text for item in filter['Обмен'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Обмен')"
                                            class="form-control input-circle"
                                    >
                                        <option value=""> любой </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Старая цена </label>
                                <div class="col-md-2">
                                    <input
                                            type="text"
                                            ng-model="obj.help['Старая цена']"
                                            ng-change="obj.helpers.makeObj('Старая цена')"
                                            class="form-control input-circle"
                                            placeholder="Введите старую цену"
                                    >
                                </div>
                                <div class="col-md-1">
                                    <h4>$</h4>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label"> Страна * </label>
                                <div class="col-md-2">
                                    <select
                                            ng-model="obj.help['Страна'][0]"
                                            ng-options="item.text for item in filter['Страна'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Страна', 'sublist')"
                                            class="form-control input-circle"
                                    >
                                        <option value=""> любая </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" ng-show="obj.help['Страна'][0].children">
                                <label class="col-md-3 control-label"> Город * </label>
                                <div class="col-md-4">
                                    <select
                                            ng-model="obj.help['Страна'][1]"
                                            ng-options="item.text for item in obj.help['Страна'][0].children | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Страна', 'sublist')"
                                            class="form-control input-circle"
                                            >
                                        <option value=""> любая </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Доп. информация </label>
                                <div class="col-md-4">
                                    {{--<input type="text" class="form-control input-circle" value="{{ $item{'text'} }}" placeholder="Enter text">--}}
                                    <textarea rows="6" class="form-control input-circle" name="text" placeholder="Введите доп. информацию о товаре">{{ $item['text'] or '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        {{--                        @{{obj.help['Опции']}}--}}
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-circle green"> Сохранить </button>
                                    {{--<button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>--}}
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_5">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i> Спецификации
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="options" action="{{action('Admin\ItemsController@update')}}" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <input type="hidden" name="id" value="{{ $item['id'] or '' }}" />
                        <input type="hidden" name="tab" value="#tab_5" />
                        <input ng-init="obj.specificationsJson='{{ $item['specifications'] or '' }}'" type="text" name="specifications" ng-model="obj.specificationsJson" class="col-md-12 "/>

                        <div class="form-body">

                            <div class="form-group" ng-repeat="specificationGroup in specifications">
                                <div class="col-sm-3 control-label bold"> @{{ specificationGroup.name }} </div>
                                <div class="col-sm-6">
                                    <div ng-repeat="child in specificationGroup.children" class="row">
                                        <label class="col-sm-6 control-label"> @{{ child }} </label>
                                        <input type="text" class="col-sm-6 input-circle" name="keywords" placeholder="Enter text"
                                               ng-model="obj.specifications[specificationGroup.name][child]"
                                               ng-change="obj.helpers.makeSpecificationsObj()"
                                                >
                                    </div>
                                </div>
                            </div>


                        </div>
                        {{--                        @{{obj.help['Опции']}}--}}
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-circle green"> Сохранить </button>
                                    {{--<button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>--}}
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_4">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i> Опции
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="options" action="{{action('Admin\ItemsController@update')}}" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <input type="hidden" name="id" value="{{ $item['id'] or '' }}" />
                        <input type="hidden" name="tab" value="#tab_4" />
                        <input ng-init="obj.objJson='{{ $item['obj'] or '' }}'" type="text" name="obj" ng-model="obj.objJson" class="col-md-12 "/>

                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label bold"> Аудиооборудование </label>
                                <div class="col-md-9">
                                    <label ng-repeat="role in filter['Аудиооборудование'] | orderBy:'-text'" class="col-md-4">
                                        <input type="checkbox" checklist-model="obj.help['Аудиооборудование']" checklist-value="role" checklist-change="obj.helpers.makeObj('Аудиооборудование')"> @{{role.text}}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label bold"> Интерьер и экстерьер </label>
                                <div class="col-md-9">
                                    <label ng-repeat="role in filter['Интерьер и экстерьер'] | orderBy:'-text'" class="col-md-4">
                                        <input type="checkbox" checklist-model="obj.help['Интерьер и экстерьер']" checklist-value="role" checklist-change="obj.helpers.makeObj('Интерьер и экстерьер')"> @{{role.text}}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label bold"> Оснащение </label>
                                <div class="col-md-9">
                                    <label ng-repeat="role in filter['Оснащение'] | orderBy:'-text'" class="col-md-4">
                                        <input type="checkbox" checklist-model="obj.help['Оснащение']" checklist-value="role" checklist-change="obj.helpers.makeObj('Оснащение')"> @{{role.text}}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label bold"> Противоугонная система </label>
                                <div class="col-md-9">
                                    <label ng-repeat="role in filter['Противоугонная система'] | orderBy:'-text'" class="col-md-4">
                                        <input type="checkbox" checklist-model="obj.help['Противоугонная система']" checklist-value="role" checklist-change="obj.helpers.makeObj('Противоугонная система')"> @{{role.text}}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label bold"> Системы безопасности </label>
                                <div class="col-md-9">
                                    <label ng-repeat="role in filter['Системы безопасности'] | orderBy:'-text'" class="col-md-4">
                                        <input type="checkbox" checklist-model="obj.help['Системы безопасности']" checklist-value="role" checklist-change="obj.helpers.makeObj('Системы безопасности')"> @{{role.text}}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label bold"> Электропакет </label>
                                <div class="col-md-9">
                                    <label ng-repeat="role in filter['Электропакет'] | orderBy:'-text'" class="col-md-4">
                                        <input type="checkbox" checklist-model="obj.help['Электропакет']" checklist-value="role" checklist-change="obj.helpers.makeObj('Электропакет')"> @{{role.text}}
                                    </label>
                                </div>
                            </div>

                        </div>
                        {{--                        @{{obj.help['Опции']}}--}}
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-circle green"> Сохранить </button>
                                    {{--<button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>--}}
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
        @if(isset($item['id']))
{{--        @if($item['id'] != '')--}}
            {{--<div class="tab-pane" id="tab_1">--}}
                {{--<div class="portlet box green">--}}
                    {{--<div class="portlet-title">--}}
                        {{--<div class="caption">--}}
                            {{--<i class="fa fa-gift"></i> Описание товара--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="portlet-body form">--}}
                        {{--<!-- BEGIN FORM-->--}}
                        {{--<form id="description" action="{{action('Admin\ItemsController@update')}}" method="post" class="form-horizontal">--}}
                            {{--<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />--}}
                            {{--<input type="hidden" name="id" value="{{ $item['id'] or '' }}" />--}}
                            {{--<input type="hidden" name="tab" value="#tab_1" />--}}

                            {{--<div class="form-body">--}}

                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label"> Name </label>--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<input type="text" class="form-control input-circle" name="name" value="{{ $item['name'] or '' }}" placeholder="Enter text">--}}
                                        {{--<!-- <span class="help-block"> Title </span> -->--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label"> Short_text </label>--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<input type="text" class="form-control input-circle" value="{{ $item{'short_text'} }}" placeholder="Enter text">--}}
                                        {{--<textarea rows="4" class="form-control input-circle" name="short_text" placeholder="Enter text">{{ $item['short_text'] or '' }}</textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-md-3 control-label"> Text </label>--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<input type="text" class="form-control input-circle" value="{{ $item{'text'} }}" placeholder="Enter text">--}}
                                        {{--<textarea rows="6" class="form-control input-circle" name="text" placeholder="Enter text">{{ $item['text'] or '' }}</textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-actions">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-offset-3 col-md-9">--}}
                                        {{--<button type="submit" class="btn btn-circle green">Сохранить</button>--}}
                                        {{--<button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                        {{--<!-- END FORM-->--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="tab-pane" id="tab_1">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i> СЕО данные
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form id="seo" action="{{action('Admin\ItemsController@update')}}" method="post" class="form-horizontal">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="id" value="{{ $item['id'] or '' }}" />
                            <input ng-init="obj.objJson='{{ $item['obj'] or '' }}'" type="text" name="obj" ng-model="obj.objJson" class="col-md-12 hidden"/>
                            <input type="text" name="price" value="{{ $item['price'] or '' }}" class="col-md-12 hidden">
                            <input type="text" name="short_text" value="{{ $item['short_text'] or '' }}" class="col-md-12 hidden">
                            <input type="hidden" name="tab" value="#tab_1" />

                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Title </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-circle" name="title" value="{{ $item['title'] or '' }}" placeholder="Enter text">
                                        <!-- <span class="help-block"> Title </span> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Description </label>
                                    <div class="col-md-4">
                                        {{--<input type="text" class="form-control input-circle" value="{{ $item{'description'} }}" placeholder="Enter text">--}}
                                        <textarea rows="4" class="form-control input-circle" name="description" placeholder="Enter text">{{ $item['description'] or '' }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Keywords </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-circle" name="keywords" value="{{ $item['keywords'] or '' }}" placeholder="Enter text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Published </label>
                                    <div class="col-md-4">
                                        {{--<input type="text" class="form-control input-circle" value="{{ $item{'description'} }}" placeholder="Enter text">--}}
                                        {{--<textarea rows="4" class="form-control input-circle" name="description" placeholder="Enter text">{{ $item['description'] or '' }}</textarea>--}}
                                        <select form="seo" name="published" class="form-control input-circle">
                                            <option value="0" {{ $item['published'] == false ? 'selected' : '' }}>нет</option>
                                            <option value="1" {{ $item['published'] == true ? 'selected' : '' }}>да</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-circle green"> Сохранить </button>
                                        {{--<button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>--}}
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_2">
                <div class="row">
                    <div class="col-md-12">
                        <form id="fileupload" data-type="item" sort="{{ $item->images or ''}}" action="/admin/assets/global/plugins/jquery-file-upload/server/php/index.php?id={{ $item['id'] or '' }}" method="POST" enctype="multipart/form-data">
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            <div class="row fileupload-buttonbar">
                                <div class="col-lg-7">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                <span class="btn green btn-circle fileinput-button">
                                    <i class="fa fa-plus"></i>
                                    <span> Добавить... </span>
                                    <input type="file" name="files[]" multiple="">
                                </span>
                                    {{--<button type="submit" class="btn btn-circle blue start">--}}
                                    {{--<i class="fa fa-upload"></i>--}}
                                    {{--<span> Start upload </span>--}}
                                    {{--</button>--}}
                                    {{--<button type="reset" class="btn btn-circle warning cancel">--}}
                                    {{--<i class="fa fa-ban-circle"></i>--}}
                                    {{--<span> Cancel upload </span>--}}
                                    {{--</button>--}}
                                    {{--<button type="button" class="btn btn-circle red delete">--}}
                                    {{--<i class="fa fa-trash"></i>--}}
                                    {{--<span> Delete </span>--}}
                                    {{--</button>--}}
                                    {{--<input type="checkbox" class="toggle">--}}
                                    <!-- The global file processing state -->
                                    <span class="fileupload-process"> </span>
                                </div>
                                <!-- The global progress information -->
                                <div class="col-lg-5 fileupload-progress fade">
                                    <!-- The global progress bar -->
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                                    </div>
                                    <!-- The extended global progress information -->
                                    <div class="progress-extended"> &nbsp; </div>
                                </div>
                            </div>
                            <!-- The table listing the files available for upload/download -->
                            <table role="presentation" class="table table-striped clearfix">
                                <tbody class="files sortable"> </tbody>
                            </table>
                        </form>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Demo Notes</h3>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li> The maximum file size for uploads in this demo is
                                        <strong>5 MB</strong> (default file size is unlimited). </li>
                                    <li> Only image files (
                                        <strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction). </li>
                                    <li> Uploaded files will be deleted automatically after
                                        <strong>5 minutes</strong> (demo setting). </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_3">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i> Ссылка на видео
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form id="seo" action="{{action('Admin\ItemsController@update')}}" method="post" class="form-horizontal">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="id" value="{{ $item['id'] or '' }}" />
                            <input type="hidden" name="tab" value="#tab_3" />
                            <input ng-init="obj.objJson='{{ $item['obj'] or '' }}'" type="text" name="obj" ng-model="obj.objJson" class="col-md-12 "/>


                            <div class="form-group">
                                <label class="col-md-3 control-label"> Видео </label>
                                <div class="col-md-2">
                                    <input
                                            type="text"
                                            ng-model="obj.help['video']"
                                            ng-change="obj.helpers.makeObj('video')"
                                            class="form-control input-circle"
                                            placeholder="Введите id видеоролика"
                                            >
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-circle green"> Сохранить </button>
                                        {{--<button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>--}}
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        <!-- The blueimp Gallery widget -->
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
            <div class="slides"> </div>
            <h3 class="title"></h3>
            <a class="prev"> ‹ </a>
            <a class="next"> › </a>
            <a class="close white"> </a>
            <a class="play-pause"> </a>
            <ol class="indicator"> </ol>
        </div>
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <tr class="template-upload fade">
                            <td>
                                <span class="preview"></span>
                            </td>
                            <td>
                                <p class="name">{%=file.name%}</p>
                                <strong class="error text-danger label label-danger"></strong>
                            </td>
                            <td>
                                <p class="size">Обработка...</p>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                </div>
                            </td>
                            <td> {% if (!i && !o.options.autoUpload) { %}
                                <button class="btn blue btn-circle start" disabled>
                                    <i class="fa fa-upload"></i>
                                    <span>Запустить</span>
                                </button> {% } %} {% if (!i) { %}
                                <button class="btn red btn-circle cancel">
                                    <i class="fa fa-ban"></i>
                                    <span>Отменить</span>
                                </button> {% } %} </td>
                        </tr> {% } %}
        </script>
        <!-- The template to display files available for download -->
        <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <tr class="template-download fade">
                            <td>
                                <span class="preview"> {% if (file.thumbnailUrl) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
                                        <img src="{%=file.thumbnailUrl%}">
                                    </a> {% } %} </span>
                            </td>
                            <td>
                                <p class="name"> {% if (file.url) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
                                    <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
                                <div>
                                    <span class="label label-danger">Ошибка</span> {%=file.error%}</div> {% } %} </td>
                            <td>
                                <span class="size">{%=o.formatFileSize(file.size)%}</span>
                            </td>
                            <td> {% if (file.deleteUrl) { %}
                                <button class="btn red delete btn-sm btn-circle" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                                    <i class="fa fa-trash-o"></i>
                                    <span>Удалить</span>
                                </button>
                                {{--<input type="checkbox" name="delete" value="1" class="toggle"> {% } else { %}--}}
                                {{--<button class="btn yellow cancel btn-sm btn-circle">--}}
                                    {{--<i class="fa fa-ban"></i>--}}
                                    {{--<span>Cancel</span>--}}
                                {{--</button>--}}
                                {% } %}</td>
                        </tr> {% } %}
        </script>
        @endif
    </div>
    <!-- END CONTENT BODY -->
@endsection

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\ItemsController@index')}}">Каталог Авто</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@endsection

@section('PAGE-LEVEL-PLUGINS')
    <script src="/admin/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>

    <script src="/admin/assets/global/plugins/angularjs/angular.min.js"></script>
    <script src="/admin/js/checklist-model.js" type="text/javascript"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/admin/assets/pages/scripts/form-fileupload.js" type="text/javascript"></script>
    <script src="/admin/js/items/item.js" type="text/javascript"></script>

    <script id="files-order" type="text/javascript">
        $(".sortable").sortable({
            items: "> tr",
            axis: "y",
            update: function( event, ui ) {
                var sortedIDs = $(this).sortable("toArray");
                var arr = [];
                $(sortedIDs).find('.name a').each(function(){
                    arr.push($(this).html());
                });
//                console.log(arr);
                $.post('/admin/items/update/images', {_token: '{{ Session::token() }}', id: '{{$item['id'] or ''}}', images: arr}, function(callback){
                    console.log(callback);
                });
            }
        });
    </script>
@endsection

@section('PAGE-LEVEL-STYLES')
    <link href="/admin/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" />
    <style>
        .preview img {
            width: 100%;
            max-width: 80px;
        }
    </style>
@endsection
