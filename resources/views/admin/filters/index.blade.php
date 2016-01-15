@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Фильтры
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">
        Фильтры: список всех фильтров
    </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->

    <!-- BEGIN CONTENT BODY -->
    <div class="blog-page">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN BORDERED TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            @if(count($filters))
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Название </th>
                                        <th> Тип </th>
                                        <th> Количество элементов </th>
                                        <th>
                                            <a href="{{action('Admin\FiltersController@add')}}" class="btn btn-outline btn-circle btn-sm green">
                                                <i class="fa fa-plus"></i>
                                                Добавить
                                            </a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($filters as $value)
                                        <tr>
                                            <td> {{$value['id']}} </td>
                                            <td> {{$value['name']}} </td>
                                            <td> {{$value['type']}} </td>
                                            <td>
                                                <?php
                                                $value['arr'] = json_decode($value['obj'], true);
                                                ?>
                                                @if(is_array($value['arr']))
                                                    {{count($value['arr'])}}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{action('Admin\FiltersController@filter', ['id' => $value['id']])}}" class="btn btn-outline btn-circle btn-sm purple">
                                                    <i class="fa fa-edit"></i>
                                                    Редактировать
                                                </a>
                                                <a class="btn btn-outline btn-circle btn-sm red modal-del-confirm"
                                                   data-toggle="modal"
                                                   del-obj="Вы действительно хотите удалить фильтр '{{ $value['name'] }}' ?"
                                                   del-url="{{action('Admin\FiltersController@delete', ['id' => $value['id']])}}" >
                                                    <i class="fa fa-remove"></i>
                                                    Удалить
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
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