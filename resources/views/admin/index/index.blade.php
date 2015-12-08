@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ action('Admin\IndexController@index') }}">Home</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> Название
    <small>Описание</small>
</h3>
<!-- END PAGE TITLE-->

<div class="blog-page">
    <div class="row">
        Тест..
    </div>
</div>
@endsection