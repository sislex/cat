@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Настройки
                <i class="fa fa-circle"></i>
                <a href="{{action('Admin\SettingsController@email')}}" class="nav-link ">
                    Email
                </a>
                <i class="fa fa-circle"></i>
                Добавить Email
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
    <form id="email_form" action="{{action('Admin\SettingsController@updateEmail')}}" method="post" class="form-horizontal">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <input type="hidden" name="id" id="id" value="{{ $email['id'] or '' }}" />

        <div class="tab-content">
            <div class="tab-pane active" id="tab_0">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa"></i> Описание email
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">

                           <div class="form-group">
                                <label class="col-md-3 control-label"> Email - адрес </label>
                                <div class="col-md-7">
                                    <input required class="form-control input-circle" name="email" type="email" value="{{ $email['email'] or ''}}" placeholder="Введите email - адрес">
                                </div>
                            </div>

                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-circle green">Сохранить</button>
                                    <a href="{{action('Admin\SettingsController@showEmail', ['id' => $email['id']])}}" class="btn btn-circle red btn-outline">Отменить</a>
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
@endsection
