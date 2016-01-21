@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Фильтры
                <i class="fa fa-circle"></i>
            </li>
            <li>
                {{ $filter['name'] or 'Добавление' }}
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">
        Фильтр: {{ $filter['name'] or '' }}
    </h3>
    <!-- END PAGE TITLE-->

    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN NAV TAB -->
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_0" data-toggle="tab">
                Описание
            </a>
        </li>

        @if (isset($filter['name']) && $filter['name'] != '' && $filter['type'] != 'value')
            <li>
                <a href="#tab_1" data-toggle="tab">
                    Структура
                </a>
            </li>
        @endif
    </ul>
    <!-- END NAV TAB -->

    <div class="tab-content">
        <div class="tab-pane active" id="tab_0">
            <!-- BEGIN FORM-->
            <form id="filter-form" action="{{action('Admin\FiltersController@update')}}" method="post" class="form-horizontal">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                @if(isset($filter['id']))
                    <input type="hidden" name="id" id="id" value="{{ $filter['id'] or '' }}" />
                @endif
                {{--<input type="hidden" name="name" id="name" value="{{ $filter['name'] or '' }}" />--}}
                <input type="hidden" name="tab" id="tab" value="#tab_0" />
                {{--<input type="hidden" name="tab" value="#tab_1" />--}}

                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa"></i>
                            Описание фильтра
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Name </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-circle" name="name" value="{{ $filter['name'] or '' }}" placeholder="Enter text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Type </label>
                                <div class="col-md-4">
                                    <select name="type" id="" required class="form-control input-circle">
                                        <option value="list" @if (isset($filter) && $filter['type'] == 'list') selected @endif>
                                            list
                                        </option>
                                        <option value="sublist" @if (isset($filter) && $filter['type'] == 'sublist') selected @endif>
                                            sublist
                                        </option>
                                        <option value="value" @if (isset($filter) && $filter['type'] == 'value') selected @endif>
                                            value
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">

                            <button type="submit" id="save-btn" class="btn btn-circle green">
                                Сохранить
                            </button>

                            @if (isset($filter) && $filter['name'] != '')
                                <a href="{{action('Admin\FiltersController@filter', ['id' => $filter['id']])}}" class="btn btn-circle red btn-outline">
                                    Отменить
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </form>
            <!-- END FORM-->
        </div>

        @if(isset($filter['name']) && $filter['name'] != '' && $filter['type'] != 'value')
            <div class="tab-pane" id="tab_1">
                <div class="portlet-body form">
                    <div class="portlet green box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>
                                {{ $filter['name'] }}
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="tree_3" class="tree-demo"> </div>
                            <button style="margin-top: 20px" class="btn blue btn-block" id="saveFilter" token="{{ Session::token() }}">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
{{--{{dd($filter)}}--}}
    <!-- END CONTENT BODY -->
@endsection

@section('PAGE-LEVEL-PLUGINS')
    <script src="/admin/assets/global/plugins/jstree/dist/jstree.js" type="text/javascript"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/admin/assets/pages/scripts/ui-tree.js" type="text/javascript"></script>
    <script type="text/javascript">
        if (App.isAngularJsApp() === false) {

            var data = {!! $filter['obj'] or '""' !!};
            jQuery(document).ready(function() {
                UITree.init(data);
            });
        }
    </script>

    <script type="text/javascript">
//        $('#show-alert').bind('click', function(){

        (function(){
            var form_not_submitted_flag = true;

            $('#filter-form').submit(function(event){
                if (form_not_submitted_flag) {
                    event.preventDefault();

                    var filterAlreadyExists = false;
                    var inputFilterName = $('[name=name]').val();
                    $.get('{{action('Admin\FiltersController@getJSONNames')}}', {}, function(data){
                        $.each(data, function(key, value){
                            if(inputFilterName.toLowerCase() == value.name.toLowerCase()) {
                                filterAlreadyExists = true;
                                return;
                            }
                        });

                        if (!filterAlreadyExists) {
                            form_not_submitted_flag = false;
                            $('#filter-form').submit();
                        } else {
                            alert_type = 'danger';
                            alert_message = 'Ошибка! Фильтр с таким именем уже существует!';
                            alert_icon = 'fa fa-remove';

//                            if (!filterAlreadyExists) {
//                            var alert_type = 'success';
//                            var alert_message = 'Фильтр добавлен успешно.';
//                            var alert_icon = 'fa fa-check';
//                            }

                            App.alert({ container: $('#alert_container').val(),         // alerts parent container
                                place: 'append',        // append or prepent in container
                                //                    type: 'success',        // alert's type ('success', 'danger', 'warning' or 'info')
                                type: alert_type,        // alert's type ('success', 'danger', 'warning' or 'info')
                                //                message: 'Test alert 111',      // alert's message
                                message: alert_message,      // alert's message
                                close: true,        // make alert closable
                                reset: false,       // close all previouse alerts first
                                focus: true,        // auto scroll to the alert after shown
                                closeInSeconds: 3,      // auto close after defined seconds
                                icon: alert_icon         // put icon class before the message
                            });
                        }
                    }, 'json');
                }
            })
        })();
    </script>

@endsection

@section('PAGE-LEVEL-STYLES')
    <link href="/admin/assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
@endsection