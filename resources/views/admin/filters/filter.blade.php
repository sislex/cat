@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\FiltersController@index')}}">
                    Фильтры
                </a>
                <i class="fa fa-circle"></i>
                {{ $filter['name'] or '' }}
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

        @if (isset($filter['name']) and $filter['name'] != '' and $filter['type'] != 'value')
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
            <form action="{{action('Admin\FiltersController@update')}}" method="post" class="form-horizontal">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                @if(isset($filter['id']))
                    <input type="hidden" name="id" id="id" value="{{ $filter['id'] or '' }}" />
                @endif
                <input type="hidden" name="name" id="name" value="{{ $filter['name'] or '' }}" />
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
                            <button type="submit" class="btn btn-circle green">
                                Сохранить
                            </button>

                            @if (isset($filter) and $filter['name'] != '')
                                <a href="{{action('Admin\FiltersController@filter', ['name' => $filter['name']])}}" class="btn btn-circle red btn-outline">
                                    Отменить
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </form>
            <!-- END FORM-->
        </div>

        @if(isset($filter['name']) and $filter['name'] != '' and $filter['type'] != 'value')
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

    <!-- END CONTENT BODY -->
@endsection

@section('PAGE-LEVEL-PLUGINS')
    <script src="/admin/assets/global/plugins/jstree/dist/jstree.js" type="text/javascript"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/admin/assets/pages/scripts/ui-tree.js" type="text/javascript"></script>
    <script type="text/javascript">
        if (App.isAngularJsApp() === false) {
            var data = {!! $filter['obj'] or '' !!};
            jQuery(document).ready(function() {
                UITree.init(data);
            });
        }
    </script>
@endsection

@section('PAGE-LEVEL-STYLES')
    <link href="/admin/assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
@endsection