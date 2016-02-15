@extends('catalog.layout')

@section('content')
    <div ng-app="myApp">
        <div class="hero-area">
            <!-- Start Hero Slider -->
            <div class="hero-slider heroflex flexslider clearfix" data-autoplay="yes" data-pagination="no" data-arrows="yes" data-style="fade" data-speed="7000" data-pause="yes">
                <ul class="slides">
                    @if(isset($main_slider) && is_array($main_slider) && isset($main_slider['images']) && count($main_slider['images']))
                        @foreach($main_slider['images'] as $image)
                            <li class="parallax" style="background-image:url('/images/ui-components/main-slider/{{ $image }}');"></li>
                        @endforeach
                    @else
                        <li class="parallax" style="background-image:url(http://placehold.it/1400x500&amp;text=IMAGE+PLACEHOLDER);"></li>
                        <li class="parallax" style="background-image:url(http://placehold.it/1400x500&amp;text=IMAGE+PLACEHOLDER);"></li>
                    @endif
                </ul>
            </div>
            <!-- End Hero Slider -->
        </div>
        <!-- Utiity Bar -->
        {{--<div class="utility-bar">--}}
            {{--<div class="container">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-4 col-sm-6 col-xs-8">--}}
                        {{--<div class="toggle-make">--}}
                            {{--<a href="#"><i class="fa fa-navicon"></i></a>--}}
                            {{--<span>Browse by body style</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8 col-sm-6 col-xs-4">--}}
                        {{--<ul class="utility-icons social-icons social-icons-colored">--}}
                            {{--<li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>--}}
                            {{--<li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>--}}
                            {{--<li class="googleplus"><a href="#"><i class="fa fa-google-plus"></i></a></li>--}}
                            {{--<li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="by-type-options">--}}
                {{--<div class="container">--}}
                    {{--<div class="row">--}}
                        {{--<ul class="owl-carousel carousel-alt" data-columns="6" data-autoplay="" data-pagination="no" data-arrows="yes" data-single-item="no" data-items-desktop="6" data-items-desktop-small="4" data-items-mobile="3" data-items-tablet="4">--}}
                            {{--<li class="item"> <a href="results-list.html"><img src="/catalog/images/body-types/wagon.png" alt=""> <span>Wagon</span></a></li>--}}
                            {{--<li class="item"> <a href="results-list.html"><img src="/catalog/images/body-types/minivan.png" alt=""> <span>Minivan</span></a></li>--}}
                            {{--<li class="item"> <a href="results-list.html"><img src="/catalog/images/body-types/coupe.png" alt=""> <span>Coupe</span></a></li>--}}
                            {{--<li class="item"> <a href="results-list.html"><img src="/catalog/images/body-types/convertible.png" alt=""> <span>Convertible</span></a></li>--}}
                            {{--<li class="item"> <a href="results-list.html"><img src="/catalog/images/body-types/crossover.png" alt=""> <span>Crossover</span></a></li>--}}
                            {{--<li class="item"> <a href="results-list.html"><img src="/catalog/images/body-types/suv.png" alt=""> <span>SUV</span></a></li>--}}
                            {{--<li class="item"> <a href="results-list.html#"><img src="/catalog/images/body-types/minicar.png" alt=""> <span>Minicar</span></a></li>--}}
                            {{--<li class="item"> <a href="results-list.html"><img src="/catalog/images/body-types/sedan.png" alt=""> <span>Sedan</span></a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
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
                                <section class="listing-block latest-news">
                                    <div class="listing-header">
                                        <a href="blog.html" class="btn btn-sm btn-default pull-right">All news</a>
                                        <h3>Последние авто новости</h3>
                                    </div>
                                    <div class="listing-container">
                                        <div class="carousel-wrapper">
                                            <div class="row">
                                                <ul class="owl-carousel" id="news-slider" data-columns="3" data-autoplay="" data-pagination="yes" data-arrows="yes" data-single-item="no" data-items-desktop="2" data-items-desktop-small="1" data-items-tablet="2" data-items-mobile="1">
                                                    <li class="item">
                                                        <div class="post-block format-standard">
                                                            <a href="single-post.html" class="media-box post-image"><img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt=""></a>
                                                            <div class="post-actions">
                                                                <div class="post-date">December 05, 2014</div>
                                                                <div class="comment-count"><a href="single-post.html"><i class="icon-dialogue-text"></i> 12</a></div>
                                                            </div>
                                                            <h3 class="post-title"><a href="single-post.html">Suspendisse eget ligula in nulla iaculis interdum nec</a></h3>
                                                            <div class="post-content">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus...</p>
                                                            </div>
                                                            <div class="post-meta">
                                                                Posted in: <a href="blog-masonry.html">Financial</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="item">
                                                        <div class="post-block format-standard">
                                                            <a href="single-post.html" class="media-box post-image"><img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt=""></a>
                                                            <div class="post-actions">
                                                                <div class="post-date">November 29, 2014</div>
                                                                <div class="comment-count"><a href="#"><i class="icon-dialogue-text"></i> 0</a></div>
                                                            </div>
                                                            <h3 class="post-title"><a href="single-post.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h3>
                                                            <div class="post-content">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus...</p>
                                                            </div>
                                                            <div class="post-meta">
                                                                Posted in: <a href="blog-masonry.html">New Launch</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="item">
                                                        <div class="post-block format-standard">
                                                            <a href="single-post.html" class="media-box post-image"><img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt=""></a>
                                                            <div class="post-actions">
                                                                <div class="post-date">November 27, 2014</div>
                                                                <div class="comment-count"><a href="#"><i class="icon-dialogue-text"></i> 0</a></div>
                                                            </div>
                                                            <h3 class="post-title"><a href="single-post.html">2015 Proin enim quam, vulputate</a></h3>
                                                            <div class="post-content">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus...</p>
                                                            </div>
                                                            <div class="post-meta">
                                                                Posted in: <a href="blog-masonry.html">Trial run</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="spacer-40"></div>
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