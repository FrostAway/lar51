
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Đăng nhập</title>

        <link href="{{ asset('public/backend/css/bootstrap.min.css') }}" rel="stylesheet" />


        <link href="{{ asset('public/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <!--<link href="{{ asset('public/css/jquery-ui.css') }}" rel="stylesheet" />-->
        <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->

 

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
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            <h1 class="panel-heading text-center">Đăng nhập tài khoản</h1>
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
                            
                            @if(Session::has('errorMess'))
                            <div class="alert alert-danger">
                                <p>{{Session::get('errorMess')}}</p>
                            </div>
                            @endif
                            
                            <form method="POST" action="{{route('auth.login')}}" class="form-group">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label class="control-label">Tài khoản</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label><input type="checkbox" name="remember"> Remember Me</label>
                                </div>

                                <div>
                                    <button class="btn btn-success" type="submit">Đăng nhập</button>
                                    <span>Chưa có tài khoản? </span><a href="{{route('auth.register')}}">Đăng ký</a>
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