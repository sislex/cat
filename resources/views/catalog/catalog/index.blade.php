@extends('catalog.layout')

@section('title', 'Каталог Goldenmotors.by')
@section('keywords', 'Каталог Goldenmotors.by')
@section('description', 'Каталог Goldenmotors.by')

@section('content')
<div ng-app="myApp" ng-controller="myCtrl">
    <!-- Start Page header -->

    @if(isset($catalog_banner['images'][0]))
        <div class="page-header parallax" style="background-image:url('/images/ui-components/catalog-banner/{{ $catalog_banner['images'][0] }}');">
            {{--<div class="container">--}}
                {{--<h1 class="page-title">Listing results</h1>--}}
            {{--</div>--}}
        </div>
    @endif

    <!-- Actions bar -->
    <div class="actions-bar tsticky">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 search-actions">
                    <ul class="utility-icons tools-bar">
                        <li ng-if="(wishList && wishList.length)">
                            <a href="#"><i class="fa fa-star-o"></i></a>
                            <div class="tool-box">
                                <div class="tool-box-head">
                                    <h5>Избранное</h5>
                                </div>
                                <div class="tool-box-in">
                                    <ul class="listing tool-car-listing">
                                        <li ng-repeat="item in wishList">
                                            <div class="imageb">
                                                <a href="/catalog/auto/@{{ item.id }}">
                                                    <img ng-src="/images/items/@{{ item.id }}/thumbnail/@{{ item.image }}" alt="">
                                                </a>
                                            </div>
                                            <div class="textb">
                                                <a href="/catalog/auto/@{{ item.id }}">@{{item.name}}</a>
                                                <span class="price">$ @{{item.price}}</span>
                                            </div>
                                            <div class="delete"><a ng-click="obj.helpers.deleteFromWishList(item.id)"><i class="icon-delete"></i></a></div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </li>
                        <li ng-if="(viewedList && viewedList.length)">
                            <a href="#"><i class="fa fa-clock-o"></i></a>
                            <div class="tool-box">
                                <div class="tool-box-head">
                                    <h5>Просмотренное</h5>
                                </div>
                                <div class="tool-box-in">
                                    <ul class="listing tool-view-listing">
                                        <li ng-repeat="item in viewedList">
                                            <div class="imageb">
                                                <a href="/catalog/auto/@{{ item.id }}">
                                                    <img ng-src="/images/items/@{{ item.id }}/thumbnail/@{{ item.image }}" alt="">
                                                </a>
                                            </div>
                                            <div class="textb">
                                                <a href="/catalog/auto/@{{ item.id }}">@{{item.name}}</a>
                                                <span class="price">$ @{{item.price}}</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 col-sm-9">
                    <div class="btn-group pull-right results-sorter">
                        <button type="button" class="btn btn-default listing-sort-btn">Сортировать по</button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a ng-click="obj.helpers.changeOrderValue('price')">Цене (от Дешевых к Дорогим)</a></li>
                            <li><a ng-click="obj.helpers.changeOrderValue('-price')">Цене (от Дорогих к Дешевым)</a></li>
                            <li><a ng-click="obj.helpers.changeOrderValue('Probeg')">Пробегу (от Меньшего к Большему)</a></li>
                            <li><a ng-click="obj.helpers.changeOrderValue('-Probeg')">Пробегу (от Большего к Меньшему)</a></li>
                        </ul>
                    </div>

                    <div class="toggle-view view-format-choice pull-right">
                        <label>Вид списка</label>
                        <div class="btn-group">
                            <a href="#" class="btn btn-default active" id="results-list-view"><i class="fa fa-th-list"></i></a>
                            <a href="#" class="btn btn-default" id="results-grid-view"><i class="fa fa-th"></i></a>
                        </div>
                    </div>
                    <!-- Small Screens Filters Toggle Button -->
                    <button class="btn btn-default visible-xs" id="Show-Filters">Search Filters</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Body Content -->
    <div class="main" role="main">
        <div id="content" class="content full">
            <div class="container">
                <div class="row">
                    <!-- Search Filters -->
                    <div class="col-md-3 search-filters" id="Search-Filters">
                        <div class="tbsticky filters-sidebar">
                            <h3>Фильтр</h3>
                            <div class="accordion" id="toggleArea">
                                <div>
                                    <select
                                            class="form-control input-circle"
                                            ng-model="obj.help.type_auto[0]"
                                            ng-options="item.text for item in filter['type_auto'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('type_auto', 'sublist')"
                                            >
                                        <option value="">Тип: любой</option>
                                    </select>
                                </div>

                                <div ng-show="obj.help.type_auto[0].children">
                                    <select
                                            class="form-control input-circle"
                                            ng-model="obj.help.type_auto[1]"
                                            ng-options="item.text for item in obj.help['type_auto'][0].children | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('type_auto', 'sublist')"
                                            >
                                        <option value="">Марка: любая</option>
                                    </select>
                                </div>

                                <div ng-show="obj.help.type_auto[1].children">
                                    <select
                                            class="form-control input-circle"
                                            ng-model="obj.help.type_auto[2]"
                                            ng-options="item.text for item in obj.help['type_auto'][1].children | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('type_auto', 'sublist')"
                                            >
                                        <option value="">Модель</option>
                                    </select>
                                </div>
                                <div>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <select
                                                    class="form-control input-circle"
                                                    ng-model="obj.help['God_vypuska']['min']"
                                                    ng-options="item.text for item in filter['God_vypuska'] | orderBy:'text':true"
                                                    ng-change="obj.helpers.makeObj('God_vypuska', 'value')"
                                                    placeholder="Цена от"
                                                    >
                                                <option value="">Год от:</option>
                                            </select>
                                        </div>
                                        <div class="form-group last-child">
                                            <select
                                                    class="form-control input-circle"
                                                    ng-model="obj.help['God_vypuska']['max']"
                                                    ng-options="item.text for item in filter['God_vypuska'] | orderBy:'text':true"
                                                    ng-change="obj.helpers.makeObj('God_vypuska', 'value')"
                                                    placeholder="Цена до"
                                                    >
                                                <option value="">Год до</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <select
                                                    class="form-control input-circle"
                                                    ng-model="obj.help['price']['min']"
                                                    ng-options="item for item in [1000,2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 12000, 14000, 16000, 18000, 20000, 25000, 30000, 45000, 50000, 100000]"
                                                    ng-change="obj.helpers.makeObj('price', 'value')"
                                                    placeholder="Цена от"
                                                    >
                                                <option value="">Цена от:</option>
                                            </select>
                                        </div>
                                        <div class="form-group last-child">
                                            <select
                                                    class="form-control input-circle"
                                                    ng-model="obj.help['price']['max']"
                                                    ng-options="item for item in [1000,2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 12000, 14000, 16000, 18000, 20000, 25000, 30000, 45000, 50000, 100000]"
                                                    ng-change="obj.helpers.makeObj('price', 'value')"
                                                    placeholder="Цена до"
                                                    >
                                                <option value="">До: 200000</option>
                                            </select>
                                            {{--<input ng-model="obj.help['price']['max']"--}}
                                            {{--ng-change="obj.helpers.makeObj('price', 'value')"--}}
                                            {{--type="text" placeholder="Цена до" class="form-control max" style="width: 100%">--}}
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-group panel">
                                    <select
                                            class="form-control input-circle"
                                            ng-model="obj.help['Тип двигателя'][0]"
                                            ng-options="item.text for item in filter['Тип двигателя'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Тип двигателя')"
                                            >
                                        <option value="">Тип двигателя: любой</option>
                                    </select>
                                </div>

                                <div class="accordion-group panel">
                                    <select
                                            class="form-control input-circle"
                                            ng-model="obj.help['Тип кузова'][0]"
                                            ng-options="item.text for item in filter['Тип кузова'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Тип кузова')"
                                            >
                                        <option value="">Тип кузова: любой</option>
                                    </select>
                                </div>

                                <div class="accordion-group panel">
                                    <select
                                            class="form-control input-circle"
                                            ng-model="obj.help['Трансмиссия'][0]"
                                            ng-options="item.text for item in filter['Трансмиссия'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Трансмиссия')"
                                            >
                                        <option value="">Трансмиссия: любой</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Listing Results -->
                    <div class="col-md-9 results-container">
                        <div class="results-container-in">
                            <div class="waiting" style="display:none;">
                                <div class="spinner">
                                    <div class="rect1"></div>
                                    <div class="rect2"></div>
                                    <div class="rect3"></div>
                                    <div class="rect4"></div>
                                    <div class="rect5"></div>
                                </div>
                            </div>
                            <div id="results-holder" class="results-list-view" ng-show="cloneItems" ng-init="order='-price'">
                                <!-- Result Item -->
                                <div class="result-item format-standard" ng-repeat="item in cloneItems | orderBy:order">
                                    <div class="result-item-image">
                                        <a  href="{{action('Catalog\CatalogController@item')}}/@{{ item.item['id'] }}" class="media-box" ng-show="item.images[0]">
                                            <img ng-src="/images/items/@{{ item.item['id'] }}/thumbnail/@{{ item.images[0] }}" alt="">
                                        </a>
                                        <span class="label label-default vehicle-age">@{{ item['God_vypuska'][0]['text'] }}</span>
                                        {{--<span class="label label-success premium-listing">Premium Listing</span>--}}
                                        <div class="result-item-view-buttons">
                                            <a ng-if="item['video']" href="https://www.youtube.com/watch?v=@{{ item['video'] }}" data-rel="prettyPhoto"><i class="fa fa-play"></i> Открыть видео</a>
                                            <a href="{{action('Catalog\CatalogController@item')}}/@{{ item.item['id'] }}"  ><i class="fa fa-plus"></i> Подробнее</a>
                                        </div>
                                    </div>
                                    <div class="result-item-in">
                                        <h4 class="result-item-title"><a  href="{{action('Catalog\CatalogController@item')}}/@{{ item.item['id'] }}">
                                                @{{ item.type_auto[0].children[0].text }} @{{ item.type_auto[0].children[0].children[0].text }} @{{ item.type_auto[0].children[0].children[0].children[0].text }} @{{ item.God_vypuska[0].text }}</a></h4>
                                        <div class="result-item-cont">
                                            <div class="result-item-block col1">
                                                <p>@{{ (item.item.text).substr(0, 180) }}<span ng-if="(item.item.text).length>180">...</span></p>
                                            </div>
                                            <div class="result-item-block col2">
                                                <div class="result-item-pricing">
                                                    <div class="badge badge-success" >@{{ item.item.price * currencies.BYR | ceil }} <span style="font-size: 10px">руб</span>.</div>
                                                    <div class="price">$@{{ item.item.price | ceil }}</div>
                                                </div>
                                                <div class="result-item-action-buttons">
                                                    <a ng-click="obj.helpers.addToWishList(item)" class="btn btn-default btn-sm">
                                                        <i class="fa fa-star-o" ng-if="!obj.helpers.checkId(wishList, item.item['id'])"></i>
                                                        <i class="fa fa-star"  ng-if="obj.helpers.checkId(wishList, item.item['id'])" style="color: #F5CF44"></i>
                                                        Избранное
                                                    </a>
{{--                                                    <a href="{{action('Catalog\CatalogController@item')}}/@{{ item.item['id'] }}" class="btn btn-default btn-sm">Enquire</a><br>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="result-item-features">
                                            <ul class="inline">
                                                <li ng-if="item['Объем куб. см.']">@{{ item['Объем куб. см.']}} см<sup style="font-size: 8px">3</sup></li>
                                                <li ng-if="item['Probeg']">@{{ item['Probeg']}} km</li>
                                                <li ng-if="item['Тип двигателя']">@{{ item['Тип двигателя'][0].text}}</li>
                                                <li ng-if="item['Трансмиссия']">@{{ item['Трансмиссия'][0].text}}</li>
                                                <li ng-if="item['Тип кузова']">@{{ item['Тип кузова'][0].text}}</li>
                                                <li ng-if="item['Цвет']">@{{ item['Цвет'][0].text}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Body Content -->
</div>
@endsection

@section('PAGE-LEVEL-PLUGINS')
    <script src="/admin/assets/global/plugins/angularjs/angular.min.js"></script>
    <script src="/admin/js/checklist-model.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/angularjs/angular-cookies.min.js"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/catalog/js/catalog/index.js" type="text/javascript"></script>
@endsection