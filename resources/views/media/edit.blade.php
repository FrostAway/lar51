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

            <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{route('admin.media.update')}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Hiển thị</label>
                    <div class="col-sm-10">
                        <img width="400" src="{{ asset($media->src) }}" title="{{$media->title}}" alt="Hình ảnh" />
                    </div>
                </div>
                <input type="hidden" name="id" value="{{$media->id}}" />
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Chọn file (*)</label>
                    <div class="col-sm-10">
                        <input type="file" name="file" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Xóa file cũ?</label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="delold" class="" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Tên File (*)</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{$media->name}}" class="form-control"  placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">URL</label>
                    <div class="col-sm-10">
                        <input type="text" name="src" value="{{$media->src}}" class="form-control"  placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Tiêu đề</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" value="{{$media->title}}" class="form-control"  placeholder="" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="submit" name="" class="btn btn-success" value="Cập nhật" />
                        <a href="{{route('admin.media')}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.row -->

@endsection

