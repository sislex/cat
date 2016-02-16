@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Контентные страницы
                <i class="fa fa-circle"></i>
            </li>

            <li>
                {{ $type == 'menu' ? 'Меню' :
                    ($type == 'news' ? 'Новости' :
                        ($type == 'blog' ? 'Блог' :
                            ($type == 'feedback' ? 'Отзывы' : ''))) }}
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">
        {{ $type == 'menu' ? 'Меню: список всех элементов' :
            ($type == 'news' ? 'Новости: список всех новостей' :
                ($type == 'blog' ? 'Блог: список всех записей' : '')) }}
    </h3>
    <!-- END PAGE TITLE-->

    <!-- BEGIN CONTENT BODY -->
    <div class="portlet-body">
        <div class="table-scrollable">
            {{--@if(count($content))--}}
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> Name </th>
                        <th> Parent_ID </th>
                        <th> Order </th>
                        <th> Created </th>
                        <th> Updated </th>
                        <th>
                            <a href="{{action('Admin\ContentController@add', ['type' => $type])}}" class="btn btn-outline btn-circle btn-sm green">
                                <i class="fa fa-plus"></i>
                                Добавить
                            </a>
                        </th>
                    </tr>
                    </thead>

                    @if(count($content))
                        <tbody>
                            @foreach($content as $value)
                                <tr>
                                    <td> {{$value['id']}} </td>
                                    <td> {{$value['name']}} </td>
                                    <td> {{$value['parent_id']}} </td>
                                    <td> {{$value['order']}} </td>
                                    <td> {{$value['created_at']}} </td>
                                    <td> {{$value['updated_at']}} </td>
                                    <td>
                                        <a href="{{action('Admin\ContentController@show', ['id' => $value['id']])}}" class="btn btn-outline btn-circle btn-sm purple">
                                            <i class="fa fa-edit"></i>
                                            Редактировать
                                        </a>
                                        <a class="btn btn-outline btn-circle btn-sm red modal-del-confirm"
                                           data-toggle="modal"
                                           del-obj="Вы действительно хотите удалить запись '{{ $value['name'] }}' и все связанные с ней записи ?"
                                           del-url="{{action('Admin\ContentController@delete', ['id' => $value['id']])}}" >
                                            <i class="fa fa-remove"></i>
                                            Удалить
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif

                </table>
            {{--@endif--}}
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