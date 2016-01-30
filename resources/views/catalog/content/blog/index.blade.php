@extends('catalog.layout')

@section('content')
    <!-- Start Body Content -->
    <div id="content" class="content full">
        <div class="container">
            <div class="row">
                <div class="col-md-9 posts-archive">
                    <article class="post format-standard">
                        <div class="row">
                            <div class="col-md-4 col-sm-4"> <a href="single-post.html"><img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt="" class="img-thumbnail"></a> </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="post-actions">
                                    <div class="post-date">November 27, 2014</div>
                                    <div class="comment-count"><a href="single-post.html"><i class="icon-dialogue-text"></i> 20</a></div>
                                </div>
                                <h3 class="post-title"><a href="single-post.html">Suspendisse eget ligula in nulla iaculis interdum nec</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam... <a href="single-post.html" class="continue-reading">Continue reading <i class="fa fa-long-arrow-right"></i></a></p>
                                <div class="post-meta">Posted in: <a href="#">Financial</a></div>
                            </div>
                        </div>
                    </article>
                    <article class="post format-standard">
                        <div class="row">
                            <div class="col-md-4 col-sm-4"> <a href="single-post.html"><img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt="" class="img-thumbnail"></a> </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="post-actions">
                                    <div class="post-date">November 25, 2014</div>
                                    <div class="comment-count"><a href="single-post.html"><i class="icon-dialogue-text"></i> 54</a></div>
                                </div>
                                <h3 class="post-title"><a href="single-post.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam... <a href="single-post.html" class="continue-reading">Continue reading <i class="fa fa-long-arrow-right"></i></a></p>
                                <div class="post-meta">Posted in: <a href="#">New Launch</a></div>
                            </div>
                        </div>
                    </article>
                    <article class="post format-standard">
                        <div class="row">
                            <div class="col-md-4 col-sm-4"> <a href="single-post.html"><img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt="" class="img-thumbnail"></a> </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="post-actions">
                                    <div class="post-date">October 30, 2014</div>
                                    <div class="comment-count"><a href="single-post.html"><i class="icon-dialogue-text"></i> 32</a></div>
                                </div>
                                <h3 class="post-title"><a href="single-post.html">2015 Proin enim quam, vulputate</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam... <a href="single-post.html" class="continue-reading">Continue reading <i class="fa fa-long-arrow-right"></i></a></p>
                                <div class="post-meta">Posted in: <a href="#">Trial run</a></div>
                            </div>
                        </div>
                    </article>
                    <ul class="pagination">
                        <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
                <!-- Start Sidebar -->
                <div class="col-md-3 sidebar">
                    <div class="widget sidebar-widget search-form-widget">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" placeholder="Search Posts...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-search fa-lg"></i></button>
                                </span>
                        </div>
                    </div>
                    <div class="widget sidebar-widget widget_categories">
                        <h3 class="widgettitle">Post Categories</h3>
                        <ul>
                            <li><a href="#">Financial</a> (10)</li>
                            <li><a href="#">Trial run</a> (12)</li>
                            <li><a href="#">New Launch</a> (34)</li>
                            <li><a href="#">Advice</a> (14)</li>
                            <li><a href="#">Uncategorized</a> (114)</li>
                        </ul>
                    </div>
                    <div class="widget sidebar-widget widget_recent_reviews">
                        <h3 class="widgettitle">Latest Reviews</h3>
                        <div class="post-block post-review-block">
                            <div class="review-status">
                                <strong>3.6</strong>
                                <span>Out of 5</span>
                            </div>
                            <h3 class="post-title"><a href="single-review-post.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h3>
                        </div>
                        <div class="post-block post-review-block">
                            <div class="review-status">
                                <strong>4.1</strong>
                                <span>Out of 5</span>
                            </div>
                            <h3 class="post-title"><a href="single-review-post.html">Curabitur nec nulla lectus, non hendrerit lorem porttitor eget</a></h3>
                        </div>
                        <div class="post-block post-review-block">
                            <div class="review-status">
                                <strong>5.0</strong>
                                <span>Out of 5</span>
                            </div>
                            <h3 class="post-title"><a href="single-review-post.html">2014 Proin enim quam, vulputate at lobortis quis, condimentum at justo</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Body Content -->
@endsection

@section('PAGE-LEVEL-PLUGINS')
    <script src="/admin/assets/global/plugins/angularjs/angular.min.js"></script>
@endsection

@section('PAGE-LEVEL-SCRIPTS')
    <script src="/catalog/js/catalog/index.js" type="text/javascript"></script>
@endsection