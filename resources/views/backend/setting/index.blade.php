@extends('layouts.backend')

@section('title')
{{$title}}
@endsection

@section('content')


<div id="setting-manage" class="row">

    <div class="col-lg-12">

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
        'route' => 'setting.update',
        'class' => 'form-horizontal',
        'method' => 'POST'
        ]) !!}

        <div class="form-group media-choose">
            <label class="col-sm-2">Logo</label>
            <div class="image col-sm-2">
                <img class="media-image img-responsive" id="logo_url" src="{{ Option::get_setting('st_logo') }}" alt="Logo" />
            </div>
            <div class="col-sm-6">
                {!! Form::text('st[st_logo]', Option::get_setting('st_logo'), ['id' => 'media-url', 'class'=>'form-control']) !!}
            </div>
            <div class="col-sm-2">
                <a type="button" href="javascript:void()" class="media-select" data-toggle="modal" data-target="#popupModal">Chọn hình ảnh</a>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                {!! Form::submit('Cập nhật', ['class' => 'btn btn-success']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
<!-- /.row -->
@include('parts.popup')

@endsection