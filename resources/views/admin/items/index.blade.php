@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{action('Admin\ItemsController@index')}}">Авто Каталог</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
    @endsection

    @section('content')
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> Авто Каталог
        <small>Список авто</small>
    </h3>
    <!-- END PAGE TITLE-->

    <!-- BEGIN CONTENT BODY -->
    <div class="portlet-body">
        <div class="table-scrollable">
            @if(count($items))
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> Name </th>
                        <th> Created </th>
                        <th> Updated </th>
                        <th>  </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $value)
                        <tr>
                            <td> {{$value['id']}} </td>
                            <td> {{$value['name']}} </td>
                            <td> {{$value['created_at']}} </td>
                            <td> {{$value['updated_at']}} </td>
                            <td>
                                <a href="{{action('Admin\ItemsController@show', ['id' => $value['id']])}}" class="btn btn-outline btn-circle btn-sm purple">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
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
                <a href="{{action('Admin\ItemsController@index')}}">Авто Каталог</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
@endsection