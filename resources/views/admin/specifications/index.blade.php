@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                Спецификации
            </li>
        </ul>
    </div>
@endsection

@section('content')
        <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title">
        Спецификации: список всех элементов
        <a href="{{action('Admin\SpecificationsController@add', ['id' => 0])}}" class="btn btn-outline btn-circle btn green pull-right">
            <i class="fa fa-plus"></i>
            Новая группа
        </a>
    </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->

    <!-- BEGIN CONTENT BODY -->
    <div class="blog-page">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet-body">
                    <div class="panel-group accordion" id="specifications-panel">

                        @foreach($specification_groups as $spec_group)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed"  data-toggle="collapse" data-parent="#specifications-panel"
                                           href="#spec_group_id{{ $spec_group['id'] }}">
                                            {{ $spec_group['name'] }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="spec_group_id{{ $spec_group['id'] }}" class="panel-collapse collapse">
                                    <!-- BEGIN BORDERED TABLE PORTLET-->
                                    <div class="portlet light portlet-fit bordered">
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th> Имя </th>
                                                        <th> Порядковый номер </th>
                                                        <th>
                                                            <a href="{{action('Admin\SpecificationsController@add', ['id' => $spec_group['id']])}}" class="btn btn-outline btn-circle btn-sm green">
                                                                <i class="fa fa-plus"></i>
                                                                Добавить
                                                            </a>
                                                            <a href="{{action('Admin\SpecificationsController@specification', ['id' => $spec_group['id']])}}" class="btn btn-outline btn-circle btn-sm purple">
                                                                <i class="fa fa-edit"></i>
                                                                Редактировать группу
                                                            </a>
                                                            <a class="btn btn-outline btn-circle btn-sm red modal-del-confirm"
                                                               data-toggle="modal"
                                                               del-obj="Вы действительно хотите удалить группу '{{ $spec_group['name'] }}' со ВСЕМИ ее спецификациями?"
                                                               del-url="{{action('Admin\SpecificationsController@delete', ['id' => $spec_group['id']])}}" >
                                                                <i class="fa fa-remove"></i>
                                                                Удалить группу
                                                            </a>
                                                        </th>
                                                    </tr>
                                                    </thead>

                                                    @if(count($specifications))
                                                        <tbody>

                                                        @foreach($specifications as $value)
                                                            @if($value['parent_id'] == $spec_group['id'])
                                                                <tr>
                                                                    <td> {{$value['name']}} </td>
                                                                    <td> {{$value['ord']}} </td>
                                                                    <td>
                                                                        <a href="{{action('Admin\SpecificationsController@specification', ['id' => $value['id']])}}" class="btn btn-outline btn-circle btn-sm purple">
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
                                                            @endif
                                                        @endforeach

                                                        </tbody>
                                                    @endif

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END BORDERED TABLE PORTLET-->



                                    {{--<div class="panel-body">--}}
                                    {{--<p> Duis autem vel eum iriure dolor in hendrerit in vulputate. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut. </p>--}}
                                    {{--<p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.--}}
                                    {{--</p>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                {{--</div>--}}
                <!-- END ACCORDION PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
@endsection