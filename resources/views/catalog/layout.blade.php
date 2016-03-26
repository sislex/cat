<!DOCTYPE HTML>
<html class="no-js">
<head>
    <!-- Basic Page Needs
      ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <!-- Favicon
    ================================================== -->
    @if(\App\UIComponents::getFavicon() != '')
        <link rel="icon" href="/images/ui-components/favicon/{{ \App\UIComponents::getFavicon() }}" type="image/ico">
    @endif

    <!-- Mobile Specific Metas
      ================================================== -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <!-- CSS
      ================================================== -->
    <link href="/catalog/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/catalog/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
    <link href="/catalog/css/style.css" rel="stylesheet" type="text/css">
    <link href="/catalog/vendor/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css">
    <link href="/catalog/vendor/owl-carousel/css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="/catalog/vendor/owl-carousel/css/owl.theme.css" rel="stylesheet" type="text/css">
    <!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="/catalog/css/ie.css" media="screen" /><![endif]-->
    <link href="/catalog/css/custom.css" rel="stylesheet" type="text/css"><!-- CUSTOM STYLESHEET FOR STYLING -->
    <!-- Color Style -->
    <link href="/catalog/colors/color1.css" rel="stylesheet" type="text/css">
    <!-- SCRIPTS
      ================================================== -->
    <script src="/catalog/js/modernizr.js"></script><!-- Modernizr -->
</head>
<body class="home">
<!--[if lt IE 7]>
<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<div class="body">
    <!-- Start Site Header -->
    <div class="site-header-wrapper">
        <header class="site-header">
            <div class="container sp-cont">
                <div class="site-logo">

                    @if(\App\UIComponents::getLogo() != '')
                        <a href="/">
                            <img src="/images/ui-components/logo/{{ \App\UIComponents::getLogo() }}" alt="Logo">
                        </a>
                    @else
                        <a href="/">
                            <img src="/catalog/images/logo.png" alt="Logo">
                        </a>
                    @endif

                    {{--<span class="site-tagline">--}}
                        {{--Продавай и покупай,<br>на GOLDENMOTORS.BY!--}}
                    {{--</span>--}}

                    <span class="site-tagline">
                        Надежное авто на вес золота!
                    </span>
                </div>
                <div class="header-right" style="font-size: 20px">
                    {{--<div class="user-login-panel logged-in-user">--}}
                        {{--<img class="user-login-btn" src="http://placehold.it/100x100&amp;text=IMAGE+PLACEHOLDER" alt="">--}}
                    {{--</div>--}}
                    {{--<i class="fa fa-phone"></i>--}}
                    {{--<div class="badge badge-success ng-binding">+375-(44)-783-28-32</div>--}}
                    <div class="copyrights-right">
                        <div class="phone"><a href="tel://+375447832832"><i class="fa fa-phone"></i> +375-(44)-783-28-32 </a></div>

                        <ul class="social-icons social-icons-colored pull-right">
                            <li class="skype"><a href="skype:goldenmotors.by?add"><i class="fa fa-skype"></i></a></li>
                            <li class="envelope"><a href="mailto:goldenmotors.by@gmail.com"><i class="fa fa-envelope-o"></i></a></li>
                            <li class="facebook"><a href="https://www.facebook.com/goldenmotors.by/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li class="vk"><a href="https://vk.com/club37638314" target="_blank"><i class="fa fa-vk"></i></a></li>
                            <li class="twitter"><a href="https://twitter.com/goldenmotors_by" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li class="google-plus"><a href="https://plus.google.com/+GoldenmotorsBy" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                            <li class="youtube"><a href="http://www.youtube.com/user/goldenmotorsby" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Site Header -->
        <div class="navbar">
            <div class="container sp-cont">
                {{--<div class="search-function">--}}
                    {{--<a href="#" class="search-trigger"><i class="fa fa-search"></i></a>--}}
                    {{--@if(\App\Phones::where('type','=','мобильный телефон')->first())--}}
                        {{--<div>--}}
                            {{--<i class="fa fa-phone"></i>--}}
                            {{--Позвони нам <strong>+ 375 (29) 5761520</strong>--}}
                            {{--Позвони нам--}}
                            {{--<strong>--}}
                                {{--<a href="tel://{{ \App\Phones::where('type','=','мобильный телефон')->first()->value('phone') }}">--}}
                                    {{--{{ \App\Phones::where('type','=','мобильный телефон')->first()->value('phone') }}--}}
                                {{--</a>--}}
                            {{--</strong>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--</div>--}}
                <a href="#" class="visible-sm visible-xs" id="menu-toggle"><i class="fa fa-bars"></i></a>
                <!-- Main Navigation -->
                <nav class="main-navigation dd-menu toggle-menu" role="navigation">
                    <ul class="sf-menu">

                        <!-- BEGIN MENU -->
                            @include('catalog.top-menu')
                        <!-- END MENU -->

                    </ul>
                </nav>
            </div>
        </div>
    </div>

    @yield('content')

    <!-- Start site footer -->
    <footer class="site-footer">

        <div class="site-footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 copyrights-left" style="font-size: small">
                        <p>
                            2016 &copy; ООО "Голден Моторс"
                            <br>
                            <noindex>
                                УНП 191570638 выдано Минским Горисполкомом 19.12.2011г.
                                <br>220006, г.Минск, ул.Маяковского 2, оф.11, тел. +375-(44)-7-832-832
                            </noindex>
                            <div style="font-size: smaller">
                                <a href="http://goldenmotors.by" style="color: darkorange">Купить авто в Минске.</a> Продажа любых автомобилей в Беларуси.
                            </div>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 copyrights-right">
                        <ul class="social-icons social-icons-colored pull-right">
                            <li class="facebook"><a href="https://www.facebook.com/goldenmotors.by/" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a></li>
                            <li class="vk"><a href="https://vk.com/club37638314" target="_blank" rel="nofollow"><i class="fa fa-vk"></i></a></li>
                            <li class="twitter"><a href="https://twitter.com/goldenmotors_by" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a></li>
                            <li class="google-plus"><a href="https://plus.google.com/+GoldenmotorsBy" target="_blank" rel="nofollow"><i class="fa fa-google-plus"></i></a></li>
                            <li class="youtube"><a href="http://www.youtube.com/user/goldenmotorsby" target="_blank" rel="nofollow"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
				<!-- Yandex.Metrika counter -->
					<script type="text/javascript">
					(function (d, w, c) {
						(w[c] = w[c] || []).push(function() {
							try {
								w.yaCounter21527971 = new Ya.Metrika({id:21527971,
										webvisor:true,
										clickmap:true,
										trackLinks:true,
										accurateTrackBounce:true});
							} catch(e) { }
						});

						var n = d.getElementsByTagName("script")[0],
							s = d.createElement("script"),
							f = function () { n.parentNode.insertBefore(s, n); };
						s.type = "text/javascript";
						s.async = true;
						s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

						if (w.opera == "[object Opera]") {
							d.addEventListener("DOMContentLoaded", f, false);
						} else { f(); }
					})(document, window, "yandex_metrika_callbacks");
					</script>
					<noscript><div><img src="//mc.yandex.ru/watch/21527971" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
			   <!-- /Yandex.Metrika counter -->
				
            </div>
        </div>
    </footer>
    <!-- End site footer -->
    <a id="back-to-top"><i class="fa fa-angle-double-up"></i></a>
</div>

@yield('MODAL-PAGES')

<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Request more info</h4>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.</p>
                <form>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="Full Name">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control" placeholder="Phone">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" value="Request Info">
                    <label class="btn-block">Preferred Contact</label>
                    <label class="checkbox-inline"><input type="checkbox"> Email</label>
                    <label class="checkbox-inline"><input type="checkbox"> Phone</label>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/catalog/js/utils.js"></script> <!-- Jquery Library Call -->
<script src="/catalog/js/jquery-2.0.0.min.js"></script> <!-- Jquery Library Call -->
<script src="/catalog/vendor/prettyphoto/js/prettyphoto.js"></script> <!-- PrettyPhoto Plugin -->
<script src="/catalog/js/ui-plugins.js"></script> <!-- UI Plugins -->
<script src="/catalog/js/helper-plugins.js"></script> <!-- Helper Plugins -->
<script src="/catalog/vendor/owl-carousel/js/owl.carousel.min.js"></script> <!-- Owl Carousel -->
<script src="/catalog/vendor/password-checker.js"></script> <!-- Password Checker -->
<script src="/catalog/js/bootstrap.js"></script> <!-- UI -->
<script src="/catalog/js/init.js"></script> <!-- All Scripts -->
<script src="/catalog/vendor/flexslider/js/jquery.flexslider.js"></script> <!-- FlexSlider -->
<!--<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>-->

@yield('PAGE-LEVEL-PLUGINS')

@yield('PAGE-LEVEL-SCRIPTS')

</body>
</html>