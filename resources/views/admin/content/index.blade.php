@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                {{--<a href="{{action('Admin\ContentController@index')}}">Верхнее меню</a>--}}
                {{--<i class="fa fa-circle"></i>--}}
                <a href="{{action('Admin\ContentController@index', ['type' => $type])}}" class="nav-link ">
                    Контентные страницы - {{ $type == 'menu' ? 'Меню' :
                                                ($type == 'news' ? 'Новости' :
                                                    ($type == 'blog' ? 'Блог' : '')) }}
                </a>
            </li>
        </ul>
    </div>
    @endsection

    @section('content')
            <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">
        {{ $type == 'menu' ? 'Меню' :
            ($type == 'news' ? 'Новости' :
                ($type == 'blog' ? 'Блог' : '')) }}
        <small>список страниц</small>
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
                        <th> Created </th>
                        <th> Updated </th>
                        <th>
                            {{--Add--}}
                            <a href="{{action('Admin\ContentController@add', ['type' => $type])}}" class="btn btn-outline btn-circle btn-sm green">
{{--                            <a href="{{action('Admin\ContentController@show', ['id' => ''])}}" class="btn btn-outline btn-circle btn-sm green">--}}
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
                                    <td> {{$value['created_at']}} </td>
                                    <td> {{$value['updated_at']}} </td>
                                    <td>
                                        <a href="{{action('Admin\ContentController@show', ['id' => $value['id']])}}" class="btn btn-outline btn-circle btn-sm purple">
                                            <i class="fa fa-edit"></i>
                                            Редактировать
                                        </a>
                                        <a href="{{action('Admin\ContentController@delete', ['id' => $value['id']])}}" class="btn btn-outline btn-circle btn-sm red">
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