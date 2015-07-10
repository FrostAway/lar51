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
            'class' => 'form-horizontal',
            'method' => 'post',
            'route' => 'admin.page.store',
            'enctype' => 'multipart/form-data'
            ]) !!}
            <div class="row">
                <div class="col-sm-9">

                    <div class="form-group">
                        {!! Form::label('title', 'Tiêu đề (*)', ['class' => 'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('post_title', old('post_title'), ['class'=>'form-control', 'placeholder' => 'Tiêu đề']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug', 'URL', ['class' => 'control-label col-sm-2 text-left']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('slug', old('slug'), ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('post_content', 'Nội dung', ['class' => 'control-label col-sm-12']) !!}
                        <div class="col-sm-12">
                            {!! Form::textarea('post_content', old('post_content'), ['class'=>'form-control editor', 'rows'=>20]) !!} 
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('post_excerpt', 'Tóm tắt', ['class' => 'control-label col-sm-12']) !!}
                        <div class="col-sm-12">
                            {!! Form::textarea('post_excerpt', old('post_excerpt'), ['class'=>'form-control', 'rows'=>4]) !!} 
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        {!! Form::label('thumbnail_id', 'Ảnh đại diện', ['class' => 'control-label col-sm-12']) !!}
                        <div class="col-sm-12">
                            {!! Form::hidden('', csrf_token(), ['id' => 'post_token']) !!}
                            <div class="media-choose">
                                {!! Form::hidden('image_url', old('image_url'), ['id' => 'media-url']) !!}
                                <img src="{{old('image_url')}}" class="media-image img-responsive" alt="Hình ảnh" />
                                <a type="button" href="javascript:void()" class="media-select" data-toggle="modal" data-target="#popupModal">Thêm ảnh đại diện</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('post_status', 'Trạng thái', ['class' => 'control-label col-sm-12']) !!}
                        <div class="col-sm-12">
                            {!! Form::select('post_status', ['draft' => 'Bản nháp', 'pending' => 'Chờ xét duyệt', 'publish' => 'Publish'], 'publish', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! Form::submit('Tạo Trang', ['class' => 'btn btn-success']) !!}
                            <a href="{{route('admin.post')}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- /.row -->
@include('parts.popup')
<script>
    
</script>

@endsection

