@extends('layouts.backend')

@section('title')
{{$title}}
@endsection

@section('content')

<div class="row">

    <div class="col-lg-12">

        <h2>{{$title}}</h2>
        <div class="vf_form">

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(Session::has('uploadMess'))
            <div class="alert alert-danger">
                <p>{{Session::get('uploadMess')}}</p>
            </div>
            @endif
            @if(Session::has('successMess'))
            <div class="alert alert-success">
                <p>{{Session::get('successMess')}}</p>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-12"

                     <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a class="tab-upload" href="#upload" aria-controls="upload" role="tab" data-toggle="tab">Tải File lên</a></li>
                            <li role="presentation"><a class="tab-select" href="#select" aria-controls="profile" role="tab" data-toggle="tab">Chọn File trong thư viện</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="upload">
                                
                                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{route('admin.media.store')}}">
                                    {!! csrf_field() !!}
                                    <div class="form-group upload-file">
                                        <label class="text-left control-label col-sm-2">Chọn tệp tin (*)</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="file" id="file-select" class="" placeholder="Chọn tệp" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-left control-label col-sm-2">Tên File (*)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" id="file-name" class="form-control" placeholder="Tên" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-left control-label col-sm-2">Tiêu đề</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title" class="form-control" placeholder="title" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <input type="submit" name="create_media" class="btn btn-success" value="Upload" />
                                            <a href="{{route('admin.media')}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="select">
                                <ul class="list-unstyled list-inline list-media">
                                    @foreach ($dirs as $item)
                                    @if(!in_array($item, ['.', '..']))
                                    @if(is_dir($rpath.'/'.$item))
                                    <li>
                                        <form method="post" action="{{route('explorer')}}">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="path" value="{{$rpath.'\\'.$item}}" />
                                            <input type="hidden" name="url" value="{{$url.'/'.$item}}" />
                                            <button type="submit" class="btn btn-info"><i class="fa fa-folder"></i> {{$item}}</button>
                                        </form>
                                    </li>
                                    @else
                                    <li><a href="{{parse_url($url.'/'.$item)['path']}}" data-name="{{$item}}"><img width="80" src="{{$url.'/'.$item}}" alt="image" /></a></li>
                                    @endif
                                    @endif
                                    @endforeach
                                </ul>

                                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{route('admin.media.store')}}">
                                    {!! csrf_field() !!}
                                    
                                    <div class="form-group">
                                        <label class="text-left control-label col-sm-2">URL</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="src" id="url" class="form-control" placeholder="url" />
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label class="text-left control-label col-sm-2">Tên File (*)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" id="file-name" class="form-control" placeholder="Tên" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-left control-label col-sm-2">Tiêu đề</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title" class="form-control" placeholder="title" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <input type="submit" name="create_media" class="btn btn-success" value="Upload" />
                                            <a href="{{route('admin.media')}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>


                </div>
            </div>


        </div>
    </div>
</div>
<!-- /.row -->

@endsection

