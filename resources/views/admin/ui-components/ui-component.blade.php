@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Баннеры и слайдеры
                <i class="fa fa-circle"></i>
            </li>
            <li>
                {{ $uicomponent['name'] == 'main-slider' ? 'Основной слайдер' :
                    ($uicomponent['name'] == 'logo' ? 'Логотип' :
                        ($uicomponent['name'] == 'favicon' ? 'Иконка сайта' : '')) }}
            </li>
        </ul>
    </div>
    @endsection

    @section('content')
            <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">
        {{ $uicomponent['name'] == 'main-slider' ? 'Основной слайдер: редактирование' :
                    ($uicomponent['name'] == 'logo' ? 'Логотип: редактирование' :
                        ($uicomponent['name'] == 'favicon' ? 'Иконка сайта: редактирование' : '')) }}
    </h3>
    <!-- END PAGE TITLE-->

    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN NAV TAB -->
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_0" data-toggle="tab"> Картинки </a>
        </li>
        <li>
            <a href="#tab_1" data-toggle="tab"> HTML </a>
        </li>
        <li>
            <a href="#tab_2" data-toggle="tab"> Настройка </a>
        </li>
    </ul>
    <!-- END NAV TAB -->
    <div class="tab-content">
        <div class="tab-pane active" id="tab_0">
            <div class="row">
                <div class="col-md-12">
                    <form id="fileupload" data-type="ui-component" data-name="{{ $uicomponent['name'] or 'fileupload-form__data-name_is-empty__error' }}" sort="{{ $uicomponent['images'] or ''}}" action="/admin/assets/global/plugins/jquery-file-upload/server/php/index.php?name={{ $uicomponent['name'] or 'form-action__name-parameter_is-empty__error' }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                        <div class="row fileupload-buttonbar">
                            <div class="col-lg-7">
                                <!-- The fileinput-button span is used to style the file input field as button -->
                                <span class="btn green btn-circle fileinput-button">
                                    <i class="fa fa-plus"></i>
                                    <span> Добавить... </span>
                                    <input type="file" name="files[]" multiple="">
                                </span>
                                <span class="fileupload-process"> </span>
                            </div>
                            <!-- The global progress information -->
                            <div class="col-lg-5 fileupload-progress fade">
                                <!-- The global progress bar -->
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                                </div>
                                <!-- The extended global progress information -->
                                <div class="progress-extended"> &nbsp; </div>
                            </div>
                        </div>
                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table table-striped clearfix">
                            <tbody class="files sortable"> </tbody>
                        </table>
                    </form>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Demo Notes</h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li> The maximum file size for uploads in this demo is
                                    <strong>5 MB</strong> (default file size is unlimited). </li>
                                <li> Only image files (
                                    <strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction). </li>
                                <li> Uploaded files will be deleted automatically after
                                    <strong>5 minutes</strong> (demo setting). </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_1">
            <div class="row">
                <div class="col-md-12">
                    <form id="html" enctype="application/x-www-form-urlencoded" action="{{ action('Admin\UIComponentsController@update') }}" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="name" value="{{ $uicomponent['name'] or '' }}" />
                            <textarea rows="10" class="form-control" name="html" placeholder="Введите HTML код">{!! $uicomponent['html'] or '' !!}</textarea>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-circle green"> Сохранить </button>
                                    <a href="{{ action('Admin\UIComponentsController@show',['name' => $uicomponent['name']]) }}" class="btn btn-circle red btn-outline"> Отменить </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_2">
            {{--<div class="form-group">--}}
            <div class="row">
                <label class="col-md-2 control-label"> Использовать </label>
                <form class="col-md-10" id="configuration" enctype="application/x-www-form-urlencoded" action="{{ action('Admin\UIComponentsController@update') }}" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <input type="hidden" name="name" value="{{ $uicomponent['name'] or '' }}" />
                        <select form="configuration" name="configuration" class="form-control input-circle">
                            <option value="images" {{ isset($uicomponent['configuration']) && $uicomponent['configuration'] == 'images' ? 'selected' : '' }}> Картинки </option>
                            <option value="html" {{ isset($uicomponent['configuration']) && $uicomponent['configuration'] == 'html' ? 'selected' : '' }}> HTML </option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-circle green"> Сохранить </button>
                                <a href="{{ action('Admin\UIComponentsController@show',['name' => $uicomponent['name']]) }}" class="btn btn-circle red btn-outline"> Отменить </a>
                            </div>
                        </div>
                    </div>
                </form>
                {{--<div class="col-md-7"></div>--}}
            </div>
        </div>
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <tr class="template-upload fade">
                            <td>
                                <span class="preview"></span>
                            </td>
                            <td>
                                <p class="name">{%=file.name%}</p>
                                <strong class="error text-danger label label-danger"></strong>
                            </td>
                            <td>
                                <p class="size">Обработка...</p>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                </div>
                            </td>
                            <td> {% if (!i && !o.options.autoUpload) { %}
                                <button class="btn blue btn-circle start" disabled>
                                    <i class="fa fa-upload"></i>
                                    <span>Запустить</span>
                                </button> {% } %} {% if (!i) { %}
                                <button class="btn red btn-circle cancel">
                                    <i class="fa fa-ban"></i>
                                    <span>Отменить</span>
                                </button> {% } %} </td>
                        </tr> {% } %}
        </script>
        <!-- The template to display files available for download -->
        <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <tr class="template-download fade">
                            <td>
                                <span class="preview"> {% if (file.thumbnailUrl) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
                                        <img src="{%=file.thumbnailUrl%}">
                                    </a> {% } %} </span>
                            </td>
                            <td>
                                <p class="name"> {% if (file.url) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
                                    <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
                                <div>
                                    <span class="label label-danger">Ошибка</span> {%=file.error%}</div> {% } %} </td>
                            <td>
                                <span class="size">{%=o.formatFileSize(file.size)%}</span>
                            </td>
                            <td> {% if (file.deleteUrl) { %}
                                <button class="btn red delete btn-sm btn-circle" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                                    <i class="fa fa-trash-o"></i>
                                    <span>Удалить</span>
                                </button>
                                {% } %}</td>
                        </tr> {% } %}
        </script>
    </div>
    <!-- END CONTENT BODY -->
@endsection

@section('PAGE-LEVEL-PLUGINS')
    {{--<script src="/admin/assets/global/plugins/angularjs/angular.min.js"></script>--}}

    <script src="/admin/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/admin/assets/pages/scripts/form-fileupload.js" type="text/javascript"></script>

    <script id="files-order" type="text/javascript">
        $(".sortable").sortable({
            items: "> tr",
            axis: "y",
            update: function( event, ui ) {
                var sortedIDs = $(this).sortable("toArray");
                var arr = [];
                $(sortedIDs).find('.name a').each(function(){
                    arr.push($(this).html());
                });
//                console.log(arr);
                $.post('/admin/ui-components/update', {_token: '{{ Session::token() }}', name: '{{$uicomponent['name'] or 'images-sorting__name-param-is-empty__error'}}', images: arr}, function(callback){
                    console.log(callback);
                });
            }
        });
    </script>
@endsection

@section('PAGE-LEVEL-STYLES')
    <link href="/admin/assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />

    <link href="/admin/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" />
    <style>
        .preview img {
            width: 100%;
            max-width: 80px;
        }
    </style>
@endsection