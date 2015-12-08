@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Настройки меню
                <i class="fa fa-circle"></i>
                <a href="{{action('Admin\SettingsController@counters')}}" class="nav-link ">
                    Телефоны
                </a>
                <i class="fa fa-circle"></i>

                Добавить телефон
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
    <form id="content_form" action="{{action('Admin\SettingsController@insertPhone')}}" method="post" class="form-horizontal">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

        <div class="tab-content">
            <div class="tab-pane active" id="tab_0">
                <div class="portlet box green">
                    <div class="portlet-body form">
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Тип контактных данных </label>
                                <div class="col-md-4">
                                    <select class="form-control input-circle" name="type">
                                        <option value="" disabled selected>Выберите тип контактных данных</option>
                                        <option value="факс">факс</option>
                                        <option value="телефон">телефон</option>
                                        <option value="мобильный телефон">мобильный телефон</option>
                                        <option value="телефон/факс">телефон/факс</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Номер </label>
                                    <div class="col-md-7">
                                        <input required class="form-control input-circle masked" name="phone" placeholder="номер">
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
    <script src="/admin/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/admin/assets/pages/scripts/components-editors.js" type="text/javascript"></script>
    <script>$('.masked').inputmask("+375-(99)-999-99-99");</script>
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
