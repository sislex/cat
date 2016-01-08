@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\SpecificationsController@index')}}">
                    Спецификации
                </a>
                <i class="fa fa-circle"></i>
                {{ $specification['name'] or '' }}
            </li>
        </ul>
    </div>
@endsection


@section('content')
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">
        Спецификация: {{ $specification['name'] or '' }}
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
    </ul>
    <!-- END NAV TAB -->

    <div class="tab-content">
        <div class="tab-pane active" id="tab_0">
            <!-- BEGIN FORM -->
            <form id="specification-form" action="{{action('Admin\SpecificationsController@update')}}" method="post" class="form-horizontal">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                @if(isset($specification['id']))
                    <input type="hidden" name="id" id="id" value="{{ $specification['id'] or '' }}" />
                @endif
                {{--<input type="hidden" name="tab" id="tab" value="#tab_0" />--}}

                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa"></i>
                            Описание спецификации
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Имя </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-circle" name="name" value="{{ $specification['name'] or '' }}" placeholder="Enter text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> Группа </label>
                                <div class="col-md-4">
                                    <select name="parent_id" required class="form-control input-circle">
                                        <option value="0"> --- </option>

                                        @if(isset($specification_groups))
                                            @foreach($specification_groups as $spec_group)
                                                <option value="{{ $spec_group['id'] }}" @if (isset($specification) && $spec_group['id'] == $specification['parent_id']) selected @endif>
                                                    {{ $spec_group['name'] }}
                                                </option>
                                            @endforeach
                                        @endif
                                        {{--<option value="list" @if (isset($specification) && $specification['parent_id'] == 'list') selected @endif>--}}
                                            {{--list--}}
                                        {{--</option>--}}
                                        {{--<option value="sublist" @if (isset($specification) && $specification['parent_id'] == 'sublist') selected @endif>--}}
                                            {{--sublist--}}
                                        {{--</option>--}}
                                        {{--<option value="value" @if (isset($specification) && $specification['parent_id'] == 'value') selected @endif>--}}
                                            {{--value--}}
                                        {{--</option>--}}
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

                            @if (isset($specification) && $specification['name'] != '')
                                <a href="{{action('Admin\SpecificationsController@specification', ['name' => $specification['name']])}}" class="btn btn-circle red btn-outline">
                                    Отменить
                                </a>
                            @endif

                        </div>
                    </div>
                </div>

            </form>
            <!-- END FORM-->
        </div>
    </div>

    <!-- END CONTENT BODY -->
@endsection

@section('PAGE-LEVEL-PLUGINS')
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script type="text/javascript">
        (function(){
            var form_not_submitted_flag = true;

            $('#specification-form').submit(function(event) {
                if (form_not_submitted_flag) {
                    event.preventDefault();

                    var specificationAlreadyExists = false;
                    var inputSpecificationName = $('[name=name]').val();
                    $.get('{{action('Admin\SpecificationsController@getJSONNames')}}', {}, function(data){
                        $.each(data, function(key, value){
                            console.log(inputSpecificationName +' == ' +value.name);
                            if(inputSpecificationName.toLowerCase() == value.name.toLowerCase()) {
                                specificationAlreadyExists = true;
                                return;
                            }
                        });

                        if (!specificationAlreadyExists) {
                            form_not_submitted_flag = false;
                            $('#specification-form').submit();
                        } else {
                            alert_type = 'danger';
                            alert_message = 'Ошибка! Спецификация с таким именем уже существует!';
                            alert_icon = 'fa fa-remove';

//                            if (!specificationAlreadyExists) {
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