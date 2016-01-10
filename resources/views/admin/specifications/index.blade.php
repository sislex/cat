@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\SpecificationsController@index')}}">
                    Спецификации
                </a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
    @endsection

    @section('content')
            <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> Спецификации
        <small>Список спецификаций</small>
    </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="blog-page">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN BORDERED TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-body">
                        <div class="table-scrollable">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Имя </th>
                                        <th> Порядковый номер </th>
                                        <th> Является группой? </th>
                                        <th> ID родительской группы </th>
                                        <th>
                                            <a href="{{action('Admin\SpecificationsController@add')}}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-plus"></i>
                                                Добавить
                                            </a>
                                        </th>
                                    </tr>
                                    </thead>

                                    @if(count($specifications))
                                        <tbody>

                                    @foreach($specifications as $value)
                                            <tr>
                                                <td> {{$value['id']}} </td>
                                                <td> {{$value['name']}} </td>
                                                <td> {{$value['ord']}} </td>
                                                <td>
                                                    @if ($value['parent_id'] == 0)
                                                        да
                                                    @else
                                                        нет
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($value['parent_id'] == 0)
                                                        ---
                                                    @else
                                                        {{$value['parent_id']}}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{action('Admin\SpecificationsController@specification', ['id' => $value['name']])}}" class="btn btn-outline btn-circle btn-sm purple">
                                                        <i class="fa fa-edit"></i>
                                                        Редактировать
                                                    </a>
                                                    <a class="btn btn-outline btn-circle btn-sm red modal-del-confirm"
                                                       data-toggle="modal"
                                                       del-obj="Вы действительно хотите удалить спецификацию '{{ $value['name'] }}' ?"
                                                       del-url="{{action('Admin\SpecificationsController@delete', ['id' => $value['id']])}}" >
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
                </div>
                <!-- END BORDERED TABLE PORTLET-->
            </div>
        </div>
    </div>
    </div>
    <!-- END CONTENT BODY -->
@endsection