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

            <form class="form-horizontal" method="POST" action="{{route('admin.user.update', $user->id)}}">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{$user->id}}" />
                <input type="hidden" name="_method" value="PUT" />
                
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Tên tài khoản</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Tên tài khoản" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="example@mail.com" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Mật khẩu</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" value="{{$user->password}}" class="form-control" placeholder="Mật khẩu" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Nhập lại mật khẩu</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" value="{{$user->password}}" class="form-control" placeholder="Nhập lại mật khẩu" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Vai trò</label>
                    <div class="col-sm-10">
                        <select name="role" class="form-control">
                            <option value="administrator" <?php selected('administrator', $user->role) ?>>Quản lý</option>
                            <option value="author" <?php selected('author', $user->role) ?>>Tác giả</option>
                            <option value="subscriber" <?php selected('subscriber', $user->role) ?>>Thành viên đăng ký</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Giới tính</label>
                    <div class="col-sm-10">
                        <select name="sex" class="form-control">
                            <option value="male" <?php selected('male', $user->sex); ?>>Male</option>
                            <option value="female" <?php selected('female', $user->sex); ?>>Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Ngày sinh</label>
                    <div class="col-sm-10">
                        <input type="text" name="bird" value="{{$user->bird}}" class="form-control bird field-date" placeholder="dd/mm/yyyy" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Địa chỉ</label>
                    <div class="col-sm-10">
                        <input type="text" name="address" value="{{$user->address}}" class="form-control" placeholder="Địa chỉ" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="submit" name="create_user" class="btn btn-success" value="Cập nhật" />
                        <a href="{{route('admin.user')}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.row -->

@endsection

