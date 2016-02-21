@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Контентные страницы
                <i class="fa fa-circle"></i>
            </li>
            <li>
                {{ $page['type'] == 'mainpage' ? 'Главная страница' :
                    ($page['type'] == 'menu' ? 'Меню' :
                        ($page['type'] == 'news' ? 'Новости' :
                            ($page['type'] == 'blog' ? 'Блог' :
                                ($page['type'] == 'feedback' ? 'Отзывы' : '')))) }}
            </li>
            <li>
                @if($page['type'] != 'mainpage')
                    <i class="fa fa-circle"></i>
                    {{ $page['name'] or 'Добавление' }}
                @endif
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">
        @if($page['type'] == 'mainpage')
            Главная страница: редактирование
        @elseif($page['type'] == 'feedback')
            @if(isset($page['name']))
                Отзывы: редактирование отзыва от '{{ $page['name'] }}'
            @else
                Отзывы: добавление нового отзыва
            @endif
        @elseif($page['type'] == 'menu')
            @if(isset($page['name']))
                Меню: редактирование '{{ $page['name'] }}'
            @else
                Меню: добавление нового элемента
            @endif
        @elseif($page['type'] == 'news')
            @if(isset($page['name']))
                Новости: редактирование '{{ $page['name'] }}'
            @else
                Новости: добавление новой новости
            @endif
        @elseif($page['type'] == 'blog')
            @if(isset($page['name']))
                Блог: редактирование '{{ $page['name'] }}'
            @else
                Блог: добавление новой записи
            @endif
        @endif
    </h3>
    <!-- END PAGE TITLE-->

    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN NAV TAB -->
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_0" data-toggle="tab"> Содержимое </a>
        </li>

        @if($page['id'] != '')
            <li>
                <a href="#tab_1" data-toggle="tab"> СЕО данные </a>
            </li>
        @endif
    </ul>
    <!-- END NAV TAB -->

    <!-- BEGIN FORM-->
    <form id="content_form" action="{{action('Admin\ContentController@update')}}" method="post" files="true" enctype="multipart/form-data" class="form-horizontal">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <input type="hidden" name="id" id="id" value="{{ $page['id'] or '' }}" />
        <input type="hidden" name="tab" id="tab" value="#tab_0" />

        @if($page['type'] == 'feedback')
            <input type="hidden" name="type" value="feedback" />
        @elseif($page['type'] == 'mainpage')
            <input type="hidden" name="type" value="mainpage" />
        @endif

        <div class="tab-content">
            <div class="tab-pane active" id="tab_0">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa"></i> Описание страницы
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">


                            @if($page['type'] != 'mainpage' && $page['type'] != 'feedback')

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Parent_ID </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-circle" name="parent_id" value="{{ $page['parent_id'] or '' }}" placeholder="Enter text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Type </label>
                                    <div class="col-md-4">
                                        {{--<input type="text" class="form-control input-circle" name="type" value="{{ $page['type'] or '' }}" placeholder="Enter text">--}}
                                        <select name="type" id="" form="content_form" required class="form-control input-circle">
                                            <option value="menu" {{ $page['type'] == 'menu' ? 'selected' : '' }}> меню </option>
                                            <option value="news" {{ $page['type'] == 'news' ? 'selected' : '' }}> новости </option>
                                            <option value="blog" {{ $page['type'] == 'blog' ? 'selected' : '' }}> блог </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Menu </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-circle" name="menu" value="{{ $page['menu'] or '' }}" placeholder="Enter text">
                                    </div>
                                </div>

                            @endif

                            @if($page['type'] != 'menu' && $page['type'] != 'mainpage')

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Name </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-circle" name="name" value="{{ $page['name'] or '' }}" placeholder="Enter text">
                                    </div>
                                </div>

                            @endif


                            @if($page['type'] != 'mainpage')

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Order </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-circle" name="order" value="{{ $page['order'] or '' }}" placeholder="Enter text">
                                    </div>
                                </div>

                            @endif

                            @if($page['type'] != 'mainpage' && $page['type'] != 'menu')

                                    <div class="form-group">
                                    <label class="col-md-3 control-label"> Preview Image </label>
                                    <div class="col-md-4">
                                        <input type="file" accept="image/jpeg" class="form-control input-circle" name="image" value="" placeholder="">
                                    </div>
                                </div>

                            @endif


                            @if($page['type'] != 'menu' && $page['type'] != 'mainpage')

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Short_text </label>
                                    <div class="col-md-4">
                                        <textarea rows="4" class="form-control input-circle" name="short_text" placeholder="Enter text">{{ $page['short_text'] or '' }}</textarea>
                                    </div>
                                </div>

                            @endif

                            @if($page['id'] != '' && $page['type'] != 'feedback')
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Text </label>
                                    <div class="col-md-7">
                                        {{--<progress></progress>--}}
                                        <textarea rows="6" id="summernote_1" class="form-control input-circle" name="text" placeholder="Enter text">{{ $page['text'] or '' }}</textarea>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-circle green">Сохранить</button>
                                    <a href="{{action('Admin\ContentController@index', ['type' => $page['type']])}}" class="btn btn-circle red btn-outline">Отменить</a>
{{--                                    <a href="{{action('Admin\ContentController@show', ['id' => $page['id']])}}" class="btn btn-circle red btn-outline">Отменить</a>--}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            @if($page['id'] != '')

                <div class="tab-pane" id="tab_1">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa"></i> СЕО данные
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Title </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-circle" name="title" value="{{ $page['title'] or '' }}" placeholder="Enter text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Description </label>
                                    <div class="col-md-4">
                                        <textarea rows="4" class="form-control input-circle" name="description" placeholder="Enter text">{{ $page['description'] or '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Keywords </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-circle" name="keywords" value="{{ $page['keywords'] or '' }}" placeholder="Enter text">
                                    </div>
                                </div>

                                @if($page['type'] != 'mainpage' && $page['type'] != 'feedback')

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> Pseudo_URL </label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control input-circle" name="pseudo_url" value="{{ $page['pseudo_url'] or '' }}" placeholder="Enter text">
                                        </div>
                                    </div>

                                @endif

                                @if($page['type'] != 'mainpage')

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> Published </label>
                                        <div class="col-md-4">
                                            {{--<input type="text" class="form-control input-circle" name="pseudo_url" value="{{ $page['published'] or 0 }}" placeholder="Enter text">--}}
                                            <select form="content_form" name="published" class="form-control input-circle">
                                                <option value="0" {{ $page['published'] == false ? 'selected' : '' }}>нет</option>
                                                <option value="1" {{ $page['published'] == true ? 'selected' : '' }}>да</option>
                                            </select>
                                        </div>
                                    </div>

                                @endif

                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-circle green">Сохранить</button>
{{--                                        <a href="{{action('Admin\ContentController@show', ['id' => $page['id']])}}" class="btn btn-circle red btn-outline">Отменить</a>--}}
                                        <a href="{{action('Admin\ContentController@index', ['type' => $page['type']])}}" class="btn btn-circle red btn-outline">Отменить</a>
                                        {{--<button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>--}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            @endif
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
