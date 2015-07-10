
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Đăng ký</title>

        <link href="{{ asset('public/backend/css/bootstrap.min.css') }}" rel="stylesheet" />


        <link href="{{ asset('public/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <!--<link href="{{ asset('public/css/jquery-ui.css') }}" rel="stylesheet" />-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">



        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper" class="container">
            <br />
            <br />
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            <h1 class="panel-heading text-center">Đăng ký Tài khoản</h1>
                        </div>
                        <div class="panel-body">

                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form class="form-horizontal" method="POST" action="{{route('auth.create')}}">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="text-left control-label col-sm-3">Tên tài khoản (*)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Tên tài khoản" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-left control-label col-sm-3">Email (*)</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="example@mail.com" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-left control-label col-sm-3">Mật khẩu (*)</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-left control-label col-sm-3">Nhập lại mật khẩu (*)</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-left control-label col-sm-3">Giới tính</label>
                                    <div class="col-sm-9">
                                        <select name="sex" class="form-control">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-left control-label col-sm-3">Ngày sinh</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bird" value="{{old('bird')}}" class="form-control bird field-date" placeholder="dd/mm/yyyy" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-left control-label col-sm-3">Địa chỉ</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Địa chỉ" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <input type="submit" name="create_user" class="btn btn-success" value="Tạo tài khoản" />
                                        <span>Đã có tài khoản? </span><a href="{{route('login')}}"> Đăng nhập</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->

        <script src="{{ asset('public/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/js/jquery-ui.min.js') }}"></script>

        <script src="{{ asset('public/backend/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/js/vf_scripts.js') }}"></script>

        @yield('footer')

    </body>

</html>