@extends('catalog.layout')

@section('title', $content['title'])
@section('keywords', $content['keywords'])
@section('description', $content['description'])

@section('content')

<!-- Start Body Content -->
<div id="content" class="content full">
    <div class="container">
        <div class="row">
            <div class="col-md-9 posts-archive">

                @if(isset($blog_pages))
                    @foreach($blog_pages as $page)
                        @if($page['published'])

                            <article class="post format-standard">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        @if(isset($page['previewImageURL']))
                                            <a href="{{ action('Catalog\CatalogController@blog', ['pseudo_url' => $page['pseudo_url']]) }}" class="img-thumbnail">
                                                <img src="{{ $page['previewImageURL'] }}" alt="preview-image">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="post-actions">
                                            <div class="post-date">
                                                {{--November 27, 2014--}}
                                                {{ date('d-m-Y', strtotime($page['created_at'])) }}
                                            </div>
                                        </div>
                                        <h3 class="post-title">
                                            <a href="{{ action('Catalog\CatalogController@blog', ['pseudo_url' => $page['pseudo_url']]) }}">
                                                {{ $page['name'] }}
                                            </a>
                                        </h3>
                                        <p>
                                            {{ $page['short_text'] }}
                                            <a href="{{ action('Catalog\CatalogController@blog', ['pseudo_url' => $page['pseudo_url']]) }}" class="continue-reading">
                                                Продолжить
                                                <i class="fa fa-long-arrow-right"></i>
                                            </a>
                                        </p>
                                        {{--<div class="post-meta">Раздел: <a href="#">Financial</a></div>--}}
                                    </div>
                                </div>
                            </article>

                        @endif
                    @endforeach
                @endif

                    <div class="row">
                        <div class="col-md-12 single-post">

                            <article class="post-content">

                                {!! $content['text'] !!}

                            </article>

                        </div>
                    </div>
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