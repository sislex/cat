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
            </li>
        </ul>
    </div>
    @endsection

    @section('content')
            <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">
        <small>Список счетчиков</small>
    </h3>
    <!-- END PAGE TITLE-->

    <!-- BEGIN CONTENT BODY -->
    <div class="portlet-body col-xs-12 col-md-6">
        <div class="table-scrollable">
            @if(count($counters))
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> Название </th>
                        <th> Текст счетчика </th>
                        <th>
                            <a href="{{action('Admin\SettingsController@addCounter')}}" class="btn btn-outline btn-circle btn-sm green">
                                <i class="fa fa-plus"></i>
                                Добавить
                            </a>
                        </th>
                    </tr>
                    </thead>

                    @if(isset($counters) && count($counters))
                        <tbody>
                            @foreach($counters as $counter)
                                <tr>
                                    <td>{{$counter['id']}}</td>
                                    <td>{{$counter['name']}}</td>
                                    <td>{{$counter['text']}}</td>
                                    <td>
                                        <a class="btn btn-outline btn-circle btn-sm red modal-del-confirm"
                                           data-toggle="modal"
                                           del-obj="Вы действительно хотите удалить счетчик '{{ $counter['name'] }}' ?"
                                           del-url="{{action('Admin\SettingsController@deleteCounter', ['id' => $counter['id']])}}" >
                                            <i class="fa fa-remove"></i>
                                            Удалить
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif

                </table>
            @endif
        </div>
    </div>
    <!-- END CONTENT BODY -->
@endsection

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\ContentController@index')}}">Верхнее меню</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@endsection