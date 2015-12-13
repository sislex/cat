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
    <div class="portlet-body col-xs-12 col-md-9">

        <!-- BEGIN FORM-->
        <form id="default_currency_form" action="{{action('Admin\SettingsController@updateDefaultCurrency')}}" method="post" class="form-horizontal">
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

            <div class="table-scrollable">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th> Валюта по-умолчанию </th>
                            <th>  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="default-currency" id="" class="form-control input-circle">
                                    @foreach($currencies as $currency)
                                        <option value="{{ $currency['name'] }}" {{ $currency['default'] == true ? 'selected' : '' }}>
                                            {{ $currency['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-circle green"> Применить </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>

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
                                <a href="{{action('Admin\SettingsController@showCurrency', ['id' => $currency['id']])}}" class="btn btn-outline btn-circle btn-sm purple">
                                    <i class="fa fa-edit"></i>
                                    Редактировать
                                </a>
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