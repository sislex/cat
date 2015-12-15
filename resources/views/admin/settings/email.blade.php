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
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">
        Email
        <small> Список email-адресов </small>
    </h3>
    <!-- END PAGE TITLE-->

    <!-- BEGIN CONTENT BODY -->
    <div class="portlet-body col-xs-12 col-md-9">

        <!-- BEGIN FORM-->
          <div class="table-scrollable">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th> # </th>
                    <th>email - адрес </th>
                    <th>
                        <a href="{{action('Admin\SettingsController@addEmail')}}" class="btn btn-outline btn-circle btn-sm green">
                            <i class="fa fa-plus"></i>
                            Добавить
                        </a>
                    </th>
                </tr>
                </thead>

                @if(isset($emails) && count($emails))
                    <tbody>
                    @foreach($emails as $email)
                        <tr>
                            <td>{{$email['id']}}</td>
                            <td>{{$email['email']}}</td>
                            <td>
                                <a href="{{action('Admin\SettingsController@showEmail', ['id' => $email['id']])}}" class="btn btn-outline btn-circle btn-sm purple">
                                    <i class="fa fa-edit"></i>
                                    Редактировать
                                </a>
                                <a class="btn btn-outline btn-circle btn-sm red modal-del-confirm"
                                   data-toggle="modal"
                                   del-obj="Вы действительно хотите удалить валюту '{{ $email['email'] }}' ?"
                                   del-url="{{action('Admin\SettingsController@deleteEmail', ['id' => $email['id']])}}" >
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