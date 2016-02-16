@extends('catalog.layout')

@section('content')
    <div ng-app="myApp">
        <div class="hero-area">
            <!-- Start Hero Slider -->
            <div class="hero-slider heroflex flexslider clearfix" data-autoplay="yes" data-pagination="no" data-arrows="yes" data-style="fade" data-speed="7000" data-pause="yes">
                <ul class="slides">
                    @if(isset($main_slider) && is_array($main_slider) && isset($main_slider['images']) && count($main_slider['images']))
                        @foreach($main_slider['images'] as $main_slider_image)
                            <li class="parallax" style="background-image:url('/images/ui-components/main-slider/{{ $main_slider_image }}');"></li>
                        @endforeach
                    @else
                        <li class="parallax" style="background-image:url(http://placehold.it/1400x500&amp;text=IMAGE+PLACEHOLDER);"></li>
                        <li class="parallax" style="background-image:url(http://placehold.it/1400x500&amp;text=IMAGE+PLACEHOLDER);"></li>
                    @endif
                </ul>
            </div>
            <!-- End Hero Slider -->
        </div>

        <!-- Start Body Content -->
        <div class="main" role="main">
            <div id="content" class="content full padding-b0">
                <div class="container">

                    <!-- Welcome Content and Services overview -->
                    @if(isset($main_page_text))
                        <div class="row">

                            {!! $main_page_text !!}

                        </div>
                        <div class="spacer-75"></div>
                    @else

                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="uppercase strong">Welcome to AutoStars<br>Listing portal</h1>
                                <p class="lead">AutoStars is the world's leading portal for<br>easy and quick <span class="accent-color">car buying and selling</span></p>
                            </div>
                            <div class="col-md-6">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, <span class="accent-color">consectetur adipiscing</span> elit. Nulla convallis egestas rhoncus.</p>
                            </div>
                        </div>
                        <div class="spacer-75"></div>

                    @endif

                            <!-- Recently Listed Vehicles -->
                    <section class="listing-block recent-vehicles" ng-controller="lastCarsWidget" >
                        <div ng-if="(items.length>0)">
                            <div class="listing-header" >
                                <h3>Новые поступления</h3>
                            </div>
                            <div class="listing-container">
                                <div class="carousel-wrapper">
                                    <div class="row">
                                        <ul class="owl-carousel carousel-fw" id="vehicle-slider" data-columns="4" data-autoplay="" data-pagination="yes" data-arrows="no" data-single-item="no" data-items-desktop="4" data-items-desktop-small="3" data-items-tablet="2" data-items-mobile="1">
                                            <li class="item" ng-repeat="item in items">
                                                <div class="vehicle-block format-standard">
                                                    <a href="{{action('Catalog\CatalogController@item')}}/@{{ item.item['id'] }}" class="media-box">
                                                        <img ng-src="/images/items/@{{ item.item['id'] }}/thumbnail/@{{ item.images[0] }}" alt="">
                                                    </a>
                                                    <span class="label label-default vehicle-age">@{{ item['God_vypuska'][0]['text'] }}</span>
                                                    <span class="label label-success premium-listing">Premium </span>
                                                    <h5 class="vehicle-title"><a href="{{action('Catalog\CatalogController@item')}}/@{{ item.item['id'] }}">@{{ item.type_auto[0].children[0].text }} @{{ item.type_auto[0].children[0].children[0].text }} @{{ item.God_vypuska[0].text }}</a></h5>
                                                <span class="vehicle-meta">
                                                    @{{ item.type_auto[0].children[0].text }}, @{{ item['Цвет'][0]['text'] }}
                                                </span>
                                                    <span class="vehicle-cost">$@{{ item.item.price || 0 }}</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="spacer-60"></div>
                    <div class="row">
                        <!-- Latest News -->
                        <div class="col-md-12 col-sm-12">
                            {{--<div class="spacer-40"></div>--}}
                            <!-- Latest Testimonials -->
                            <section class="listing-block latest-testimonials">
                                <div class="listing-header">
                                    <h3>Отзывы</h3>
                                </div>
                                <div class="listing-container">
                                    <div class="carousel-wrapper">
                                        <div class="row">
                                            <ul class="owl-carousel carousel-fw" id="testimonials-slider" data-columns="2" data-autoplay="5000" data-pagination="no" data-arrows="no" data-single-item="no" data-items-desktop="2" data-items-desktop-small="1" data-items-tablet="1" data-items-mobile="1">
                                                <li class="item">
                                                    <div class="testimonial-block">
                                                        <blockquote>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.</p>
                                                        </blockquote>
                                                        <div class="testimonial-avatar"><img src="http://placehold.it/100x100&amp;text=IMAGE+PLACEHOLDER" alt="" width="60" height="60"></div>
                                                        <div class="testimonial-info">
                                                            <div class="testimonial-info-in">
                                                                <strong>Arthur Henry</strong><span>Carsales Inc</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="item">
                                                    <div class="testimonial-block">
                                                        <blockquote>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.</p>
                                                        </blockquote>
                                                        <div class="testimonial-avatar"><img src="http://placehold.it/100x100&amp;text=IMAGE+PLACEHOLDER" alt="" width="60" height="60"></div>
                                                        <div class="testimonial-info">
                                                            <div class="testimonial-info-in">
                                                                <strong>Lori Bailey</strong><span>My car Experts</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="item">
                                                    <div class="testimonial-block">
                                                        <blockquote>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.</p>
                                                        </blockquote>
                                                        <div class="testimonial-avatar"><img src="http://placehold.it/100x100&amp;text=IMAGE+PLACEHOLDER" alt="" width="60" height="60"></div>
                                                        <div class="testimonial-info">
                                                            <div class="testimonial-info-in">
                                                                <strong>Willie &amp; Heather Obrien</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!-- Latest Reviews -->

                    </div>
                </div>
                <div class="spacer-50"></div>
                <div class="lgray-bg make-slider">
                    <div class="container">

                        <!-- Partners slider -->
                        @if(isset($partners_slider) && is_array($partners_slider) && isset($partners_slider['images']) && count($partners_slider['images']))
                            <div class="row">
                                <div class="col-md-3 col-sm-4">
                                    <h3>Наши партнеры </h3>
                                    {{--<a href="#" class="btn btn-default btn-lg">All make &amp; models</a>--}}
                                </div>
                                <div class="col-md-9 col-sm-8">
                                    <div class="row">
                                        <ul class="owl-carousel" id="make-carousel" data-columns="5" data-autoplay="6000" data-pagination="no" data-arrows="no" data-single-item="no" data-items-desktop="5" data-items-desktop-small="4" data-items-tablet="3" data-items-mobile="3">

                                            @foreach($partners_slider['images'] as $partners_slider_image)
                                                <li class="item">
                                                    {{--<a href="">--}}
                                                        <img src="/images/ui-components/partners-slider/{{ $partners_slider_image }}" alt="Partner Image">
                                                    {{--</a>--}}
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

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
    <script src="/admin/js/items/item.js" type="text/javascript"></script>
    <script src="/catalog/js/index/widgets.js" type="text/javascript"></script>
@endsection