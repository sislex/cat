@extends('catalog.layout')

@section('title', $content['title'])
@section('keywords', $content['keywords'])
@section('description', $content['description'])

@section('content')

<!-- Start Body Content -->
<div id="content" class="content full">
    <div class="container">

        @if(isset($categories))
            <div class="gallery-filter">
                <ul class="nav nav-pills sort-source">
                    <li class="{{ isset($active_category_id) ? '' : 'active' }}">
                            <a href="{{ action('Catalog\CatalogController@news_index') }}">
                                <i class="fa fa-th"></i> <span>Показать все</span></a>
                    </li>

                    @foreach($categories as $category)
                        @if($category['published'])
                            <li class="{{ (isset($active_category_id) && $active_category_id == $category['id']) ? 'active' : '' }}">
                                <a href="{{ action('Catalog\CatalogController@news_category', ['pseudo_url' => $category['pseudo_url']]) }}">{{ $category['menu'] }}</a>
                            </li>
                        @endif
                    @endforeach

                </ul>
            </div>
        @endif

        @if(isset($news_pages))
            <ul class="grid-holder col-3 posts-grid">
                @foreach($news_pages as $page)
                    @if($page['published'])

                        <li class="grid-item post format-standard">
                            <div class="grid-item-inner">
                                @if(isset($page['previewImageURL']))
                                    <a href="{{ action('Catalog\CatalogController@news', ['pseudo_url' => $page['pseudo_url']]) }}" class="media-box">
                                        <img src="{{ $page['previewImageURL'] }}" alt="preview-image">
                                    </a>
                                @endif
                                <div class="grid-content">
                                    <div class="post-actions">
                                        <div class="post-date">
                                            {{--December 27, 2014--}}
                                            {{ date('d-m-Y', strtotime($page['created_at'])) }}
                                        </div>
                                    </div>
                                    <h3 class="post-title">
                                        <a href="{{ action('Catalog\CatalogController@news', ['pseudo_url' => $page['pseudo_url']]) }}">
                                            {{ $page['name'] }}
                                        </a>
                                    </h3>
                                    <p>
                                        {{ $page['short_text'] }}
                                        <a href="{{ action('Catalog\CatalogController@news', ['pseudo_url' => $page['pseudo_url']]) }}" class="continue-reading">
                                            Далее
                                            <i class="fa fa-long-arrow-right"></i>
                                        </a>
                                    </p>
                                    {{--<div class="post-meta">Раздел: <a href="#">Financial</a></div>--}}
                                </div>
                            </div>
                        </li>

                    @endif
                @endforeach
            </ul>
        @endif

        <div class="row">
            <div class="col-md-12 single-post">

                <article class="post-content">

                    {!! $content['text'] !!}

                </article>

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