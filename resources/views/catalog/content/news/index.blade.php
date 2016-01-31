@extends('catalog.layout')

@section('content')

<!-- Start Body Content -->
<div id="content" class="content full">
    <div class="container">
        <ul class="grid-holder col-3 posts-grid">

            @if(isset($news_pages))
                @foreach($news_pages as $page)

                <li class="grid-item post format-standard">
                    <div class="grid-item-inner">
                        @if(isset($page['previewImageURL']))
                            <a href="{{ action('Catalog\CatalogController@news', ['pseudo_url' => $page['pseudo_url']]) }}" class="media-box">
                                <img src="{{ $page['previewImageURL'] }}" alt="preview-image">
                            </a>
                        @endif
                        <div class="grid-content">
                            <div class="post-actions">
                                <div class="post-date">December 27, 2014</div>
                                {{--<div class="comment-count"><a href="single-post.html"><i class="icon-dialogue-text"></i> 20</a></div>--}}
                            </div>
                            <h3 class="post-title">
                                <a href="{{ action('Catalog\CatalogController@news', ['pseudo_url' => $page['pseudo_url']]) }}">
                                    {{ $page['name'] }}
                                </a>
                            </h3>
                            <p>
                                {{ $page['short_text'] }}
                                <a href="{{ action('Catalog\CatalogController@news', ['pseudo_url' => $page['pseudo_url']]) }}" class="continue-reading">
                                    Продолжить
                                    <i class="fa fa-long-arrow-right"></i>
                                </a>
                            </p>
                            <div class="post-meta">Раздел: <a href="#">Financial</a></div>
                        </div>
                    </div>
                </li>

                @endforeach
            @endif

        </ul>
        <ul class="pagination">
            <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
        </ul>
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