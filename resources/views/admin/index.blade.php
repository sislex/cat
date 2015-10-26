@extends('admin.layout')

@section('page_bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>General</span>
            </li>
        </ul>

    </div>
@show

@section('content')
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> Больое название
    <small>описание</small>
</h3>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="blog-page">
    <div class="row">
        Content
    </div>
</div>
</div>
<!-- END CONTENT BODY -->
@endsection