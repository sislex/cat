@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Настройки
                <i class="fa fa-circle"></i>
                <a href="{{action('Admin\SettingsController@currencies')}}" class="nav-link ">
                    Валюта
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">
        Валюта
        <small> Список валют </small>
    </h3>
    <!-- END PAGE TITLE-->

    <!-- BEGIN CONTENT BODY -->
    <div class="portlet-body col-xs-12 col-md-6">
        <div class="table-scrollable">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th> # </th>
                    <th> Наименование (буквенный код) </th>
                    <th> Курс к у.е. </th>
                    <th> Знак или краткое наименование </th>
                    <th>
                        <a href="{{action('Admin\SettingsController@addCurrency')}}" class="btn btn-outline btn-circle btn-sm green">
                            <i class="fa fa-plus"></i>
                            Добавить
                        </a>
                    </th>
                </tr>
                </thead>

                @if(isset($currencies) && count($currencies))
                    <tbody>
                    @foreach($currencies as $currency)
                        <tr>
                            <td>{{$currency['id']}}</td>
                            <td>{{$currency['name']}}</td>
                            <td>{{$currency['rate']}}</td>
                            <td>{{$currency['icon']}}</td>
                            <td>
                                <a class="btn btn-outline btn-circle btn-sm red modal-del-confirm"
                                   data-toggle="modal"
                                   del-obj="Вы действительно хотите удалить валюту '{{ $currency['name'] }}' ?"
                                   del-url="{{action('Admin\SettingsController@deleteCurrency', ['id' => $currency['id']])}}" >
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