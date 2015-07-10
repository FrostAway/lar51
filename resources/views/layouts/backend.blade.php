<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title')</title>

        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
        
        <!--<link href="{{ asset('public/plugin/filemanager/css/style.css') }}" rel="stylesheet"  />-->
        <link href="{{ asset('public/backend/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/backend/css/sb-admin.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/backend/css/plugins/morris.css') }}" rel="stylesheet" />
        <link href="{{ asset('public/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        
        <link href="{{ asset('public/backend/css/styles.css') }}" rel="stylesheet" type="text/css" />

        @yield('header')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <script>
            var base_path = '<?php echo base_path(); ?>';
            var url = '<?php echo url(); ?>';
            var ajax_url = '<?php echo route('admin.ajax') ?>';
        </script>
        
    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            @include('parts/navbar')

            <div id="page-wrapper">

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">{{$title}}</h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="{{route('admin')}}">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-table"></i> {{$title}}
                                </li>
                            </ol>
                        </div>
                    </div>

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->

        <script src="{{ asset('public/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/js/jquery-ui.min.js') }}"></script>
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
  
        <script src="{{ asset('public/backend/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/plugin/tinymce/tinymce.min.js') }}"></script>
        
        <script src="{{ asset('public/backend/js/vf_ajax.js') }}"></script>
        <script src="{{ asset('public/backend/js/vf_scripts.js') }}"></script>

        @yield('footer')

    </body>

</html>

