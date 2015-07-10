<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{route('admin')}}">Quản trị</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu message-dropdown">
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                            <span class="pull-left">
                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong><?php echo auth()->user()->name; ?></strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                            <span class="pull-left">
                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                            <span class="pull-left">
                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-footer">
                    <a href="#">Read All New Messages</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu alert-dropdown">
                <li>
                    <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">View All</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo auth()->user()->name; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-gear"></i> Cài đặt</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{route('logout')}}"><i class="fa fa-fw fa-power-off"></i> Đăng xuất</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active"><a href="{{route('admin')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
            
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#account-menu"><i class="fa fa-user"></i> Quản lý Tài khoản <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="account-menu" class="collapse">
                    <li><a href="{{route('admin.user')}}">Tất cả Tài khoản</a></li>
                    <li><a href="{{route('admin.user.create')}}">Thêm Tài khoản</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#post-menu"><i class="fa fa-fw fa-edit"></i> Quản lý bài viết <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="post-menu" class="collapse">
                    <li>
                        <a href="{{route('admin.post')}}">Tất cả bài viết</a>
                    </li>
                    <li>
                        <a href="{{route('admin.post.create')}}">Thêm bài viết mới</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#page-menu"><i class="fa fa-fw fa-edit"></i> Quản lý Trang <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="page-menu" class="collapse">
                    <li>
                        <a href="{{route('admin.page')}}">Tất cả Trang</a>
                    </li>
                    <li>
                        <a href="{{route('admin.page.create')}}">Thêm Trang mới</a>
                    </li>
                </ul>
            </li>
             <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#cat-menu"><i class="fa fa-fw fa-folder-o"></i> Quản lý Danh mục <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="cat-menu" class="collapse">
                    <li>
                        <a href="{{route('admin.cat')}}">Tất cả Danh mục</a>
                    </li>
                    <li>
                        <a href="{{route('admin.tag')}}">Quản lý Thẻ</a>
                    </li>
                </ul>
            </li>
            <li><a href="{{route('admin.media')}}"><i class="fa fa-fw fa-bar-chart-o"></i> Thư viện</a></li>
            <li><a href="{{route('slider')}}"><i class="fa fa-fw fa-film"></i> Slider</a></li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#menu-menu"><i class="fa fa-fw fa-navicon"></i> Quản lý Menu <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="menu-menu" class="collapse">
                    <li>
                        <a href="{{route('admin.menu')}}"> Nhóm Menu</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#menu-setting"><i class="fa fa-fw fa-gear"></i> Cài đặt <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="menu-setting" class="collapse">
                    <li><a href="{{route('setting')}}"> Tổng quan</a></li>
                    <li><a href="{{route('info')}}"> Thông tin</a></li>
                    <li><a href="{{route('contact')}}"> Thông tin Fotter</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>