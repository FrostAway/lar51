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


            
                {!! Form::open([
                'route' => 'slide.store',
                'method' => 'POST',
                'class' => 'form-horizontal'
                ]) !!}
                
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Nhóm Slider</label>
                    <div class="col-sm-10">
                        {!! Form::hidden('slider_id', $currslider->id) !!}
                        {!! Form::text('group_name', $currslider->name, ['class' => 'form-control', 'disabled']) !!}
                    </div>
                </div>
                <div class="form-group">
                        {!! Form::label('', 'Ảnh đại diện', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::hidden('', csrf_token(), ['id' => 'post_token']) !!}
                            <div class="media-choose">
                                {!! Form::hidden('image', old('image_url'), ['id' => 'media-url']) !!}
                                <img src="{{old('image_url')}}" class="media-image img-responsive" alt="Hình ảnh" />
                                <a type="button" href="javascript:void()" class="media-select" data-toggle="modal" data-target="#popupModal">Thêm ảnh đại diện</a>
                            </div>
                        </div>
                    </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Tên Slide (*)</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Xem thêm (title)</label>
                    <div class="col-sm-10">
                        <input type="text" name="desc" value="{{old('desc')}}" class="form-control" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Thứ tự</label>
                    <div class="col-sm-10">
                        {!! Form::text('order', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Liên kết</label>
                    <div class="col-sm-10 box-select">
                        <div class="link_select">
                            {!! Form::text('link', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Mở liên kết</label>
                    <div class="col-sm-10">
                        {!! Form::select('open_type', ['current' => 'Tab hiện tại', 'newtab'=>'Tab mới'], null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="submit" name="create_slide" class="btn btn-success" value="Tạo Slide" />
                        <a href="{{route('slider.view', $currslider->id)}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>                        
                    </div>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
<!-- /.row -->

@include('parts.popup')

@endsection

