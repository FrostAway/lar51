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
                'method' => 'POST',
                'route' => 'slider.store',
                'class' => 'form-horizontal'
            ]) !!}
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Tên Nhóm Slider (*)</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Dường dẫn tĩnh</label>
                    <div class="col-sm-10">
                        <input type="text" name="slug" value="{{old('slug')}}" class="form-control" placeholder="" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="submit" name="create_slider" class="btn btn-success" value="Tạo Nhóm Slider" />
                        <a href="{{route('slider')}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>                        
                    </div>
                </div>
            {!! Form::close() !!}
            
        </div>
    </div>
</div>
<!-- /.row -->

@endsection

