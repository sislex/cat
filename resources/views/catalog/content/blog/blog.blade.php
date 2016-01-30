@extends('catalog.layout')

@section('content')
    <!-- Start Body Content -->
    <div id="content" class="content full">
        <div class="container">
            <div class="row">
                <div class="col-md-9 single-post">
                    <header class="single-post-header clearfix">
                        <div class="post-actions">
                            <div class="post-date">November 27, 2014</div>
                            {{--<div class="comment-count"><a href="single-post.html"><i class="icon-dialogue-text"></i> 20</a></div>--}}
                        </div>
                        <h2 class="post-title">
                            {{ $content['name'] }}
                        </h2>
                    </header>

                    <article class="post-content">

                        {!! $content['text'] !!}

                        <!-- Pagination -->
                        <ul class="pager">
                            <li class="pull-left"><a href="#">&larr; Prev Post</a></li>
                            <li class="pull-right"><a href="#">Next Post &rarr;</a></li>
                        </ul>

                        <!-- About Author -->
                        <section class="about-author">
                            <div class="img-thumbnail"> <img src="http://placehold.it/100x100&amp;text=IMAGE+PLACEHOLDER" alt="avatar"> </div>
                            <div class="post-author-content">
                                <h3>John Doe <span class="label label-success">Author</span></h3>
                                <p>Curabitur nec nulla lectus, non hendrerit lorem. Quisque lorem risus, porttitor eget fringilla non, vehicula sed tortor. Proin enim quam, vulputate at lobortis quis, condimentum at justo. Phasellus nec nisi justo. Ut luctus sagittis nulla at dapibus. Aliquam ullamcorper commodo elit, quis ornare eros consectetur a. Phasellus nec nisi justo. Ut luctus sagittis nulla at dapibus. Aliquam ullamcorper commodo elit, quis ornare eros consectetur a.</p>
                            </div>
                        </section>

                    </article>
                    <section class="post-comments" id="comments">
                        <h3><i class="fa fa-comment"></i> Comments (4)</h3>
                        <ol class="comments">
                            <li>
                                <div class="post-comment-block">
                                    <div class="img-thumbnail"> <img src="http://placehold.it/100x100&amp;text=IMAGE+PLACEHOLDER" alt="avatar"> </div>
                                    <div class="post-comment-content">
                                        <a href="#" class="btn btn-default btn-xs pull-right">Reply</a>
                                        <h5>John Doe says</h5>
                                        <span class="meta-data">Nov 23, 2013 at 7:58 pm</span>
                                        <p>Curabitur nec nulla lectus, condimentum at justo. Phasellus nec nisi justo. Ut luctus sagittis nulla at dapibus. Aliquam ullamcorper commodo elit, quis ornare eros consectetur a.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post-comment-block">
                                    <div class="img-thumbnail"> <img src="http://placehold.it/100x100&amp;text=IMAGE+PLACEHOLDER" alt="avatar"> </div>
                                    <div class="post-comment-content">
                                        <a href="#" class="btn btn-default btn-xs pull-right">Reply</a>
                                        <h5>John Doe says</h5>
                                        <span class="meta-data">Nov 23, 2013 at 7:58 pm</span>
                                        <p>Curabitur nec nulla lectus.</p>
                                    </div>
                                </div>
                                <ul>
                                    <li>
                                        <div class="post-comment-block">
                                            <div class="img-thumbnail"> <img src="http://placehold.it/100x100&amp;text=IMAGE+PLACEHOLDER" alt="avatar"> </div>
                                            <div class="post-comment-content">
                                                <a href="#" class="btn btn-default btn-xs pull-right">Reply</a>
                                                <h5>John Doe says</h5>
                                                <span class="meta-data">Nov 23, 2013 at 7:58 pm</span>
                                                <p>Curabitur nec nulla lectus, non hendrerit lorem. Quisque lorem risus, porttitor eget fringilla non, vehicula sed tortor. Proin enim quam, vulputate at lobortis quis, condimentum at justo. Phasellus nec nisi justo. Ut luctus sagittis nulla at dapibus. Aliquam ullamcorper commodo elit, quis ornare eros consectetur a. Phasellus nec nisi justo. Ut luctus sagittis nulla at dapibus. Aliquam ullamcorper commodo elit, quis ornare eros consectetur a.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post-comment-block">
                                            <div class="img-thumbnail"> <img src="http://placehold.it/100x100&amp;text=IMAGE+PLACEHOLDER" alt="avatar"> </div>
                                            <div class="post-comment-content">
                                                <a href="#" class="btn btn-default btn-xs pull-right">Reply</a>
                                                <h5>John Doe says</h5>
                                                <span class="meta-data">Nov 23, 2013 at 7:58 pm</span>
                                                <p>Curabitur nec nulla lectus, non hendrerit lorem.</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="post-comment-block">
                                    <div class="img-thumbnail"> <img src="http://placehold.it/100x100&amp;text=IMAGE+PLACEHOLDER" alt="avatar"> </div>
                                    <div class="post-comment-content">
                                        <a href="#" class="btn btn-default btn-xs pull-right">Reply</a>
                                        <h5>John Doe says</h5>
                                        <span class="meta-data">Nov 23, 2013 at 7:58 pm</span>
                                        <p>Curabitur nec nulla lectus, non hendrerit lorem. Quisque lorem risus, porttitor eget fringilla non, vehicula sed tortor. Proin enim quam, vulputate at lobortis quis, condimentum at justo.</p>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </section>
                    <section class="post-comment-form">
                        <h3><i class="fa fa-share"></i> Post a comment</h3>
                        <form>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" class="form-control input-lg" placeholder="Your name">
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="email" class="form-control input-lg" placeholder="Your email">
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="url" class="form-control input-lg" placeholder="Website (optional)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea cols="8" rows="4" class="form-control input-lg" placeholder="Your comment"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-lg">Submit your comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <!-- Start Sidebar -->
                <div class="col-md-3 sidebar">
                    <div class="widget sidebar-widget widget_recent_posts">
                        <h3 class="widgettitle">Recent Posts</h3>
                        <ul>
                            <li>
                                <a href="single-post.html"><img src="http://placehold.it/200x200&amp;text=IMAGE+PLACEHOLDER" alt="" class="img-thumbnail"></a>
                                <h5><a href="single-post.html">2015 Proin enim quam, vulputate</a></h5>
                                <div class="post-actions"><div class="post-date">October 30, 2014</div></div>
                            </li>
                            <li>
                                <a href="single-post.html"><img src="http://placehold.it/200x200&amp;text=IMAGE+PLACEHOLDER" alt="" class="img-thumbnail"></a>
                                <h5><a href="single-post.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h5>
                                <div class="post-actions"><div class="post-date">October 30, 2014</div></div>
                            </li>
                        </ul>
                    </div>
                    <div class="widget sidebar-widget widget_recent_reviews">
                        <h3 class="widgettitle">Latest Reviews</h3>
                        <div class="post-block post-review-block">
                            <div class="review-status">
                                <strong>3.6</strong>
                                <span>Out of 5</span>
                            </div>
                            <h3 class="post-title"><a href="single-post-review.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h3>
                        </div>
                        <div class="post-block post-review-block">
                            <div class="review-status">
                                <strong>4.1</strong>
                                <span>Out of 5</span>
                            </div>
                            <h3 class="post-title"><a href="single-post-review.html">Curabitur nec nulla lectus, non hendrerit lorem porttitor eget</a></h3>
                        </div>
                        <div class="post-block post-review-block">
                            <div class="review-status">
                                <strong>5.0</strong>
                                <span>Out of 5</span>
                            </div>
                            <h3 class="post-title"><a href="single-post-review.html">2014 Proin enim quam, vulputate at lobortis quis, condimentum at justo</a></h3>
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