@extends('catalog.layout')

@section('content')
<div ng-app="myApp" ng-controller="myCtrl">
    <!-- Start Page header -->
    <div class="page-header parallax" style="background-image:url(http://placehold.it/1200x300&amp;text=IMAGE+PLACEHOLDER);">
        <div class="container">
            <h1 class="page-title">Listing results</h1>
        </div>
    </div>
    <!-- Utiity Bar -->
    <div class="utility-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-8">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Search results</li>
                    </ol>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-4">
                </div>
            </div>
        </div>
    </div>
    <!-- Actions bar -->
    <div class="actions-bar tsticky">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 search-actions">
                    <ul class="utility-icons tools-bar">
                        <li><a href="#"><i class="fa fa-star-o"></i></a>
                            <div class="tool-box">
                                <div class="tool-box-head">
                                    <a href="user-dashboard-saved-cars.html" class="basic-link pull-right">View all</a>
                                    <h5>Saved cars</h5>
                                </div>
                                <div class="tool-box-in">
                                    <ul class="listing tool-car-listing">
                                        <li>
                                            <div class="checkb"><input type="checkbox"></div>
                                            <div class="imageb"><a href="vehicle-details.html"><img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt=""></a></div>
                                            <div class="textb">
                                                <a href="vehicle-details.html">Nissan Terrano first hand</a>
                                                <span class="price">$28000</span>
                                            </div>
                                            <div class="delete"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li>
                                        <li>
                                            <div class="checkb"><input type="checkbox"></div>
                                            <div class="imageb"><a href="vehicle-details.html"><img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt=""></a></div>
                                            <div class="textb">
                                                <a href="vehicle-details.html">Mercedes Benz E class</a>
                                                <span class="price">$76000</span>
                                            </div>
                                            <div class="delete"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tool-box-foot">
                                    <a href="#" class="btn btn-xs btn-primary pull-right">Join</a>
                                    <a href="#" class="pull-right tool-signin" data-toggle="modal" data-target="#loginModal">Sign in</a>
                                    <a href="#" class="btn btn-xs btn-info">Compare(2)</a>
                                </div>
                            </div>
                        </li>
                        <li><a href="#"><i class="fa fa-folder-o"></i></a>
                            <div class="tool-box">
                                <div class="tool-box-head">
                                    <a href="user-dashboard-saved-searches.html" class="basic-link pull-right">View all</a>
                                    <h5>Saved searches</h5>
                                </div>
                                <div class="tool-box-in">
                                    <ul class="listing tool-search-listing">
                                        <li>
                                            <div class="link"><a href="#">Search name</a></div>
                                            <div class="delete"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li>
                                        <li>
                                            <div class="link"><a href="#">Search name</a></div>
                                            <div class="delete"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li>
                                        <li>
                                            <div class="link"><a href="#">Search name</a></div>
                                            <div class="delete"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tool-box-foot">
                                    <a href="#" class="btn btn-xs btn-primary pull-right">Join</a>
                                    <a href="#" class="pull-right tool-signin" data-toggle="modal" data-target="#loginModal">Sign in</a>
                                </div>
                            </div>
                        </li>
                        <li><a href="#"><i class="fa fa-clock-o"></i></a>
                            <div class="tool-box">
                                <div class="tool-box-head">
                                    <h5>Recently viewed cars</h5>
                                </div>
                                <div class="tool-box-in">
                                    <ul class="listing tool-view-listing">
                                        <li>
                                            <div class="imageb"><a href="vehicle-details.html"><img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt=""></a></div>
                                            <div class="textb">
                                                <a href="vehicle-details.html">Nissan Terrano first hand</a>
                                                <span class="price">$28000</span>
                                            </div>
                                            <div class="save"><a href="vehicle-details.html"><i class="fa fa-star-o"></i></a></div>
                                        </li>
                                        <li>
                                            <div class="imageb"><a href="vehicle-details.html"><img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt=""></a></div>
                                            <div class="textb">
                                                <a href="vehicle-details.html">Mercedes Benz E class</a>
                                                <span class="price">$76000</span>
                                            </div>
                                            <div class="save"><a href="#"><i class="fa fa-star-o"></i></a></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tool-box-foot">
                                    <a href="#" class="btn btn-xs btn-primary pull-right">Join</a>
                                    <a href="#" class="pull-right tool-signin" data-toggle="modal" data-target="#loginModal">Sign in</a>
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
                            <li><a href="#">Price (High to Low)</a></li>
                            <li><a href="#">Price (Low to High)</a></li>
                            <li><a href="#">Mileage (Low to High)</a></li>
                            <li><a href="#">Mileage (High to Low)</a></li>
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
                                        <option value="">Тип: неважно</option>
                                    </select>
                                </div>

                                <div ng-show="obj.help.type_auto[0].children">
                                    <select
                                            class="form-control input-circle"
                                            ng-model="obj.help.type_auto[1]"
                                            ng-options="item.text for item in obj.help['type_auto'][0].children | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('type_auto', 'sublist')"
                                            >
                                        <option value="">Марка: неважно</option>
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

                                <div class="accordion-group panel">
                                    <select
                                            class="form-control input-circle"
                                            ng-model="obj.help['Тип кузова'][0]"
                                            ng-options="item.text for item in filter['Тип кузова'] | orderBy:'text':false"
                                            ng-change="obj.helpers.makeObj('Тип кузова')"
                                            >
                                        <option value="">Тип кузова: неважно</option>
                                    </select>
                                </div>

                                <div class="accordion-group panel">
                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseTwo">Аудиооборудование<i class="fa fa-angle-down"></i> </a> </div>
                                    <div id="collapseTwo" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <ul class="filter-options-list list-group">
                                                <li ng-repeat="role in filter['Аудиооборудование'] | orderBy:'-text'">
                                                    <label>
                                                        <input type="checkbox" checklist-model="obj.help['Аудиооборудование']" checklist-value="role" checklist-change="obj.helpers.makeObj('Аудиооборудование')">
                                                        @{{role.text}}
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                            <div id="results-holder" class="results-list-view" ng-show="cloneItems">
                                <!-- Result Item -->
                                <div class="result-item format-standard" ng-repeat="item in cloneItems | orderBy:'name'">
                                    <div class="result-item-image">
                                        <a href="{{action('Catalog\CatalogController@item')}}/@{{ item.item['id'] }}" class="media-box"><img ng-src="/images/items/@{{ item.item['id'] }}/thumbnail/@{{ item.images[0] }}" alt=""></a>
                                        <span class="label label-default vehicle-age">2014</span>
                                        <span class="label label-success premium-listing">Premium Listing</span>
                                        <div class="result-item-view-buttons">
                                            <a href="https://www.youtube.com/watch?v=P5mvnA4BV7Y" data-rel="prettyPhoto"><i class="fa fa-play"></i> View video</a>
                                            <a href="{{action('Catalog\CatalogController@item')}}/@{{ item.item['id'] }}"><i class="fa fa-plus"></i> View details</a>
                                        </div>
                                    </div>
                                    <div class="result-item-in">
                                        <h4 class="result-item-title"><a href="{{action('Catalog\CatalogController@item')}}/@{{ item.item['id'] }}">@{{ item.type_auto[0].children[0].text }} @{{ item.type_auto[0].children[0].children[0].text }}</a></h4>
                                        <div class="result-item-cont">
                                            <div class="result-item-block col1">
                                                <p>@{{ item.item.short_text }}</p>
                                            </div>
                                            <div class="result-item-block col2">
                                                <div class="result-item-pricing">
                                                    <div class="price">$@{{ item.item.price || 23423 }}</div>
                                                </div>
                                                <div class="result-item-action-buttons">
                                                    <a href="#" class="btn btn-default btn-sm"><i class="fa fa-star-o"></i> Save</a>
                                                    <a href="{{action('Catalog\CatalogController@item')}}/@{{ item.item['id'] }}" class="btn btn-default btn-sm">Enquire</a><br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="result-item-features">
                                            <ul class="inline">
                                                <li ng-if="item['Трансмиссия']">@{{ item['Трансмиссия'][0].text}}</li>
                                                <li ng-if="item['Тип кузова']">@{{ item['Тип кузова'][0].text}}</li>
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
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/catalog/js/catalog/index.js" type="text/javascript"></script>
@endsection