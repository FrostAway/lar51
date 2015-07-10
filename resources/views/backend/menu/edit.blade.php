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
            
            
            <form class="form-horizontal" method="POST" action="{{route('admin.menu.update', $cat->id)}}">
                {!! csrf_field() !!}
                
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Tên Nhóm Menu (*)</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{$cat->name}}" class="form-control" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Dường dẫn tĩnh</label>
                    <div class="col-sm-10">
                        <input type="text" name="slug" value="{{$cat->slug}}" class="form-control" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="submit" name="" class="btn btn-success" value="Cập nhật" />
                        <a href="{{route('admin.menu')}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
<!-- /.row -->

@endsection

