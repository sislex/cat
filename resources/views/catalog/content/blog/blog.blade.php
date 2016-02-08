@extends('catalog.layout')

@section('content')
    <!-- Start Body Content -->
    <div id="content" class="content full">
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
                        <h2 class="post-title">
                            {{ $content['name'] }}
                        </h2>
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
                                            <a href="{{ action('Catalog\CatalogController@blog_category', ['id' => $category['id']]) }}">{{ $category['menu'] }}</a> &nbsp;
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- End Body Content -->
@endsection

@section('PAGE-LEVEL-PLUGINS')
    <script src="/admin/assets/global/plugins/angularjs/angular.min.js"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/catalog/js/catalog/index.js" type="text/javascript"></script>
@endsection