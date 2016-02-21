@extends('catalog.layout')

@section('title', $content['title'])
@section('keywords', $content['keywords'])
@section('description', $content['description'])

@section('content')

<!-- Start Body Content -->
<div id="content" class="content full" ng-app="myApp">
    <div class="container">
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
    <script src="/admin/assets/global/plugins/angularjs/angular.min.js" type="text/javascript"></script>
    <script src="/admin/js/checklist-model.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/angularjs/angular-cookies.min.js" type="text/javascript"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/catalog/js/catalog/index.js" type="text/javascript"></script>
    <script src="/catalog/js/index/widgets.js" type="text/javascript"></script>
@endsection