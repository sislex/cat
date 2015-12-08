@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
               Настройки меню
                <i class="fa fa-circle"></i>
                <a href="{{action('Admin\SettingsController@phones')}}" class="nav-link ">
                    Телефоны
                </a>
            </li>
        </ul>
    </div>
    @endsection
    @section('content')
            <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">
        <small>Список телефонов</small>
    </h3>
    <!-- END PAGE TITLE-->

    <!-- BEGIN CONTENT BODY -->
    <div class="portlet-body col-xs-12 col-md-6">
        <div class="table-scrollable">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> Тип </th>
                        <th> Номер </th>
                        <th>
                            <a href="{{action('Admin\SettingsController@addPhone')}}" class="btn btn-outline btn-circle btn-sm green">
                                <i class="fa fa-plus"></i>
                                Добавить
                            </a>
                        </th>
                    </tr>
                    </thead>

                    @if(isset($phones) && count($phones))
                        <tbody>
                        @foreach($phones as $phones)
                            <tr>
                                <td>{{$phones['id']}}</td>
                                <td>{{$phones['type']}}</td>
                                <td>{{$phones['phone']}}</td>
                                <td>
                                    <a class="btn btn-outline btn-circle btn-sm red modal-del-confirm"
                                       data-toggle="modal"
                                       del-obj="Вы действительно хотите удалить телефон '{{ $phones['type'] }}' ?"
                                       del-url="{{action('Admin\SettingsController@deletePhone', ['id' => $phones['id']])}}" >
                                        <i class="fa fa-remove"></i>
                                        Удалить
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    @endif

                </table>
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