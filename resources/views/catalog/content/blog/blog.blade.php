@extends('catalog.layout')

@section('title', $content['title'])
@section('keywords', $content['keywords'])
@section('description', $content['description'])

@section('content')
    <!-- Start Body Content -->
    <div id="content" class="content full" ng-app="myApp">
        <div class="container">
            <div class="row">
                <div class="col-md-9 single-post">
                    <header class="single-post-header clearfix">
                        <div class="post-actions">
                            <div class="post-date">
                                {{--November 27, 2014--}}
                                {{ date('d-m-Y', strtotime($content['created_at'])) }}
                            </div>
                        </div>
                        <h1 class="post-title">
                            {{ $content['name'] }}
                        </h1>
                    </header>

                    <article class="post-content">

                        {!! $content['text'] !!}

                    </article>

                </div>

                <!-- Start Sidebar -->
                <div class="col-md-3 sidebar">

                    @if(isset($categories))
                        <div class="widget sidebar-widget widget_categories">
                            <h3 class="widgettitle">
                                Категории
                            </h3>
                            <ul>
                                @foreach($categories as $category)
                                    @if($category['published'])
                                        <li>
                                            <a href="{{ action('Catalog\CatalogController@blog_category', ['pseudo_url' => $category['pseudo_url']]) }}">{{ $category['menu'] }}</a> &nbsp;
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="widget sidebar-widget widget_recent_posts" ng-controller="lastBlogPostsWidget">

                        <div ng-if="blog.length > 0">
                            <h3 class="widgettitle">
                                Последние посты
                            </h3>
                            <ul>
                                <li class="" ng-repeat="blog_post in blog | orderBy: id">
                                    <a href="{{ action('Catalog\CatalogController@blog')}}/@{{ blog_post['pseudo_url'] }}">
                                        <img src="@{{ blog_post['previewImageURL'] }}" alt="" class="img-thumbnail">
                                    </a>
                                    <h5>
                                        <a href="{{ action('Catalog\CatalogController@blog')}}/@{{ blog_post['pseudo_url'] }}">
                                            @{{ blog_post['name'] }}
                                        </a>
                                    </h5>
                                    <div class="post-actions">
                                        <div class="post-date">
                                            @{{ blog_post['date'] }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Body Content -->
@endsection

@section('PAGE-LEVEL-PLUGINS')
    <script src="/admin/assets/global/plugins/angularjs/angular.min.js" type="text/javascript"></script>
    <script src="/admin/js/checklist-model.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/angularjs/angular-cookies.min.js" type="text/javascript"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/catalog/js/catalog/index.js" type="text/javascript"></script>
    <script src="/catalog/js/index/widgets.js" type="text/javascript"></script>
@endsection