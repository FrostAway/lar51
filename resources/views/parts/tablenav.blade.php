<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-lg hidden-md" href="#">Tùy chọn</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">


            {!! Form::open([
            'route' => ['post.order'],
            'method' => 'get',
            'class' => 'navbar-form navbar-left'
            ]) !!}
            <div class="form-group">
                {!! Form::select('order_action', ['0' => 'Sắp xếp theo'] + $filter, (isset($order)) ? $order : null, ['class' => 'form-control']) !!}
            </div>
            <button type="submit" class="btn btn-default">Áp dụng</button>
            {!! Form::close() !!}
            
           {!! Form::open([
            'route' => ['post.search'],
            'method' => 'get',
            'class' => 'navbar-form navbar-right'
            ]) !!}
                <div class="form-group">
                    <input type="text" name="key" class="form-control" placeholder="Tìm kiếm">
                </div>
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            {!! Form::close() !!}
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
