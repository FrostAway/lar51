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
            @if(Session::has('Mess'))
            <div class="alert alert-success">
                <p>{{Session::get('Mess')}}</p>
            </div>
            @endif
            @if(Session::has('errorMess'))
            <div class="alert alert-danger">
                <p>{{Session::get('errorMess')}}</p>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" method="POST" action="{{route('admin.video.store')}}">
                        {!! csrf_field() !!}
                        

                        <div class="form-group upload-file">
                            <label class="text-left control-label col-sm-2">Youtube Link (*)</label>
                            <div class="col-sm-10">
                                <textarea name="src" id="" rows="4" class="form-control" placeholder="https://youtube.com/"></textarea>
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
                                <input type="submit" name="create_media" class="btn btn-success" value="Thêm mới" />
                                <a href="{{route('admin.video')}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

@endsection

