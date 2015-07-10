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

            <form class="form-horizontal" method="POST" action="{{route('admin.user.store')}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Tên tài khoản (*)</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Tên tài khoản" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Email (*)</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="example@mail.com" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Mật khẩu (*)</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Nhập lại mật khẩu (*)</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Giới tính</label>
                    <div class="col-sm-10">
                        <select name="sex" class="form-control">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Ngày sinh</label>
                    <div class="col-sm-10">
                        <input type="text" name="bird" value="{{old('bird')}}" class="form-control bird field-date" placeholder="dd/mm/yyyy" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Địa chỉ</label>
                    <div class="col-sm-10">
                        <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Địa chỉ" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="submit" name="create_user" class="btn btn-success" value="Tạo tài khoản" />
                        <a href="{{route('admin.user')}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.row -->

@endsection

