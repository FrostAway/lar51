<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>{{$title}}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,700,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/dist/css/bootstrap.min.css') }}" />
        <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
        <link rel="stylesheet" href="{{ asset('public/css/btdatepicker.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/css/main.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/css/fl_screen.css') }}" />
        
    </head>
    <body>

        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3&appId=1395390994084918";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <script type='text/javascript'>window._sbzq || function (e) {
                e._sbzq = [];
                var t = e._sbzq;
                t.push(["_setAccount", 21863]);
                var n = e.location.protocol == "https:" ? "https:" : "http:";
                var r = document.createElement("script");
                r.type = "text/javascript";
                r.async = true;
                r.src = n + "//static.subiz.com/public/js/loader.js";
                var i = document.getElementsByTagName("script")[0];
                i.parentNode.insertBefore(r, i)
            }(window);</script> 

        <header id="header">
            <div class="row top-head">
                <div class="container">
                    <div class="col-sm-2 logo">
                        <a href="#"><img class="img-responsive" src="{{ get_setting('st_logo') }}" alt="LOGO" title="" /></a>
                    </div>
                    
                    <div class="col-sm-10  main-menu">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand hidden-md hidden-lg" href="#">Menu</a>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav navbar-right">
                                        {!! get_menus(20) !!}
<!--                                        <li class="active"><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                                        <li><a href="#"><i class="fa fa-user"></i> Giới thiệu</a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i> Sản phẩm - Dịch vụ</a></li>
                                        <li><a href="#"><i class="fa fa-money"></i> Bảng giá</a></li>
                                        <li><a href="#"><i class="fa fa-newspaper-o"></i> Tin tức</a></li>
                                        <li><a href="#"><i class="fa fa-image"></i> Thư viện Ảnh</a></li>
                                        <li><a href="#"><i class="fa fa-video-camera"></i> Video</a></li>
                                        <li><a href="#"><i class="fa fa-users"></i> Tuyển dụng</a></li>
                                        <li><a href="#"><i class="fa fa-phone"></i> Liên hệ</a></li>-->
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        
        <section id="box-slide">
            @yield('box-slide')
        </section>

        <section id="main-body">
            @yield('main-body')
        </section>

        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3 ftcol">
                        <h3 class="title">Thông tin liên hệ</h3>
                        <ul class="list-unstyled">
                            <li><strong>Trụ sở: </strong> <i>Tầng 3, Số 34 Đường Hoàng Cầu Mới, Đống Đa, Hà Nội</i></li>
                            <li><strong>Điện thoại: </strong> <i>(+84) 43 8572 999 / (+84) 43 8574 666</i></li>
                            <li><strong>Fax: </strong> <i>(+84) 43 5378 333</i></li>
                            <li><strong>Email: </strong> <a href="mailto:info@vatc.vn"><i>info@vatc.vn</i></a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3 ftcol">
                        <h3 class="title">Sleeppod tại sân bay</h3>
                        <ul class="list-unstyled">
                            <li><strong>Địa chỉ: </strong> <i>Tầng 2 và Tầng 3 nhà ga 71 Sân bay Quốc tế Nội Bài</i></li>
                            <li><strong>Điện thoại: </strong> <i>(+84) 43 584 3636</i></li>
                            <li><strong>Fax: </strong> <i>(+84) 43 5378 333</i></li>
                            <li><strong>Email: </strong> <a href="mailto:eservation@vatc.vn"><i>eservation@vatc.vn</i></a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3 ftcol">
                        <h3 class="title">Đăng ký Email</h3>
                        <p>Đăng ký Email của bạn để nhận thông tin hữu ích cho chuyến bay</p>
                        <form class="text-right">
                            <input type="email" name="email" class="text" placeholder="Email của bạn" required="" />
                            <input type="submit" name="" class="submit" value="ĐĂNG KÝ" />
                        </form>
                    </div>
                    <div class="col-sm-6 col-md-3 ftcol">
                        <div class="facebook-page">
                            <div class="fb-page" data-href="https://www.facebook.com/vifonic" data-width="100%" data-height="320" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/vifonic"><a href="https://www.facebook.com/vifonic">Vifonic - Thiết kế web theo yêu cầu</a></blockquote></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <section id="end_ft">
            <div class="container">
                <p class="pull-left copyright">
                    &copy; 2013-2015 AVTC.vn. All right reserved
                </p>
                <p class="pull-right">
                    <span>Designed by <a target="_blank" href="http://vifonic.com">Vifonic</a></span>
                    <span class="social-icons">
                        <a href="#" target="_blank"><i class="fa fa-2x fa-facebook-square"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-2x fa-twitter-square"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-2x fa-google-plus-square"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-2x fa-youtube-square"></i></a>
                    </span>
                </p>
            </div>
        </section>

        <script type="text/javascript" src="{{ asset('public/js/html5.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/moment.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/dist/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/bootstrap_datepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/vf_scripts.js') }}"></script>
    </body>
</html>


