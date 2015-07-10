
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
              
        <div class="form-group">
            <label class="col-sm-2">Tiêu đề trang</label>
            <div class="col-sm-10">
                {!! Form::text('st[st_title]', Option::get_setting('st_title'), ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">Mô tả</label>
            <div class="col-sm-10">
                {!! Form::text('st[st_desc]', Option::get_setting('st_desc'), ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">Email</label>
            <div class="col-sm-10">
                {!! Form::text('st[st_email]', Option::get_setting('st_email'), ['class'=>'form-control']) !!}
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2">Yahoo</label>
            <div class="col-sm-10">
                {!! Form::text('st[st_yahoo]', Option::get_setting('st_yahoo'), ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">Skype</label>
            <div class="col-sm-10">
                {!! Form::text('st[st_skype]', Option::get_setting('st_skype'), ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">Điện thoại</label>
            <div class="col-sm-10">
                {!! Form::text('st[st_phone]', Option::get_setting('st_phone'), ['class'=>'form-control']) !!}
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                {!! Form::submit('Cập nhật', ['class'=>'btn btn-success']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
<!-- /.row -->
@include('parts.popup')

@endsection
