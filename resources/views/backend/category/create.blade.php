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

            @if($type=='cat')
            <form class="form-horizontal" method="POST" action="{{route('admin.cat.store')}}">             
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Tên Danh mục (*)</label>
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
                    <label class="text-left control-label col-sm-2">Danh mục cha</label>
                    <div class="col-sm-10">
                        <select name="parent" class="form-control">
                            <option value="0">Chọn danh mục</option>
                            @foreach($cats as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Order</label>
                    <div class="col-sm-10">
                        <input type="text" name="order" value="{{old('order')}}" class="form-control" placeholder="" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="submit" name="create_user" class="btn btn-success" value="Tạo Danh mục" />
                        <a href="{{route('admin.cat')}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>                        
                    </div>
                </div>
            </form>
            @else
            <form class="form-horizontal" method="POST" action="{{route('admin.tag.store')}}">             
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Tên Thẻ (*)</label>
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
                    <label class="text-left control-label col-sm-2">Order</label>
                    <div class="col-sm-10">
                        <input type="text" name="order" value="{{old('order')}}" class="form-control" placeholder="" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="submit" name="create_user" class="btn btn-success" value="Tạo Thẻ" />
                        <a href="{{route('admin.tag')}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>                        
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
<!-- /.row -->

@endsection

