@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\ItemsController@index')}}"> Каталог Авто </a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
    @endsection

    @section('content')

    <!-- BEGIN CONTENT BODY -->

    <!-- BEGIN NAV TAB -->
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_0" data-toggle="tab"> Данные по авто </a>
        </li>
        <li>
            <a href="#tab_1" data-toggle="tab"> СЕО данные </a>
        </li>
        <li>
            <a href="#tab_2" data-toggle="tab"> Фото </a>
        </li>
        <li>
            <a href="#tab_3" data-toggle="tab"> Видео </a>
        </li>
    </ul>
    <!-- END NAV TAB -->
    <div class="tab-content">
        <div class="tab-pane active" id="tab_0">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i> Описание товара
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="{{action('Admin\ItemsController@update')}}" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <input type="hidden" name="id" value="{{ $item{'id'} }}" />
                        <input type="hidden" name="tab" value="#tab_0" />

                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Name </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-circle" name="name" value="{{ $item{'name'} }}" placeholder="Enter text">
                                    <!-- <span class="help-block"> Title </span> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Short_text </label>
                                <div class="col-md-4">
                                    {{--<input type="text" class="form-control input-circle" value="{{ $item{'short_text'} }}" placeholder="Enter text">--}}
                                    <textarea rows="4" class="form-control input-circle" name="short_text" placeholder="Enter text">{{ $item{'short_text'} }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Text </label>
                                <div class="col-md-4">
                                    {{--<input type="text" class="form-control input-circle" value="{{ $item{'text'} }}" placeholder="Enter text">--}}
                                    <textarea rows="6" class="form-control input-circle" name="text" placeholder="Enter text">{{ $item{'text'} }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-circle green">Сохранить</button>
                                    {{--<button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>--}}
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_1">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i> СЕО данные
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="{{action('Admin\ItemsController@update')}}" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <input type="hidden" name="id" value="{{ $item{'id'} }}" />
                        <input type="hidden" name="tab" value="#tab_1" />

                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Title </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-circle" name="title" value="{{ $item{'title'} }}" placeholder="Enter text">
                                    <!-- <span class="help-block"> Title </span> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Keywords </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-circle" name="keywords" value="{{ $item{'keywords'} }}" placeholder="Enter text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Description </label>
                                <div class="col-md-4">
                                    {{--<input type="text" class="form-control input-circle" value="{{ $item{'description'} }}" placeholder="Enter text">--}}
                                    <textarea rows="4" class="form-control input-circle" name="description" placeholder="Enter text">{{ $item{'description'} }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-circle green">Сохранить</button>
                                    {{--<button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>--}}
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
@endsection

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\ItemsController@index')}}">Каталог Авто</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@endsection