@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Настройки меню
                <i class="fa fa-circle"></i>
                <a href="{{action('Admin\SettingsController@counters')}}" class="nav-link ">
                    Счетчики
                </a>
                <i class="fa fa-circle"></i>

                Добавить счетчик
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <!-- BEGIN CONTENT BODY -->

    <!-- BEGIN NAV TAB -->
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_0" data-toggle="tab"> Содержимое </a>
        </li>

    </ul>
    <!-- END NAV TAB -->

    <!-- BEGIN FORM-->
    <form id="content_form" action="{{action('Admin\SettingsController@insertCounter')}}" method="post" class="form-horizontal">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

        <div class="tab-content">
            <div class="tab-pane active" id="tab_0">
                <div class="portlet box green">
                    <div class="portlet-body form">
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Название счетчика </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-circle" name="name" value="" placeholder="название счетчика">
                                </div>
                            </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Текст счетчика </label>
                                    <div class="col-md-7">
                                        <textarea rows="6" class="form-control input-circle" name="text" placeholder="Текст счетчика"></textarea>
                                    </div>
                                </div>

                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-circle green">Сохранить</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- END FORM-->

    <!-- END CONTENT BODY -->
@endsection

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\ContentController@index')}}">Контентные страницы</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@endsection

@section('PAGE-LEVEL-PLUGINS')
    <script src="/admin/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-summernote/summernote.js" type="text/javascript"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/admin/assets/pages/scripts/components-editors.js" type="text/javascript"></script>
@endsection

@section('PAGE-LEVEL-STYLES')
    <link href="/admin/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />

    <style>
        .preview img {
            width: 100%;
            max-width: 80px;
        }
    </style>
@endsection
