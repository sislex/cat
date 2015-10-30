@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\FiltersController@index')}}">Фильтры</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@endsection

@section('content')
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> Фильтры
    <small>Список фильтров</small>
</h3>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="blog-page">
    <div class="row">
        <div class="col-md-6">
            <div class="portlet yellow-lemon box">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Contextual Menu with Drag & Drop
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="tree_3" class="tree-demo"> </div>
                    {{--<div class="alert alert-success no-margin margin-top-10"> Note! Opened and selected nodes will be saved in the user's browser, so when returning to the same tree the previous state will be restored. </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- END CONTENT BODY -->
@endsection

@section('PAGE-LEVEL-PLUGINS')
    <script src="/admin/assets/global/plugins/jstree/dist/jstree.js" type="text/javascript"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/admin/assets/pages/scripts/ui-tree.js" type="text/javascript"></script>
@endsection

@section('PAGE-LEVEL-STYLES')
    <link href="/admin/assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
@endsection