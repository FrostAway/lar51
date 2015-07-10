@extends('layouts.backend')

@section('title')
{{$title}}
@endsection

@section('content')

<div id="cat-manage" class="row">

    <div class="col-lg-12">
        <h2>{{$title}}</h2>

        @if(isset($userMess))
        <div class="alert alert-danger">
            <ul>
                <li>{{$userMess}}</li>
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

        @include('parts.tablenav', ['filter'=>['name' => 'Tên', 'email' => 'Email']])

        <form class="" method="POST" action="{{route('admin.user.massdel')}}">
            {!! csrf_field() !!}

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <td><input type="checkbox" name="massdel" class="checkall" /></td>
                            <th>ID</th>
                            <th>Tên tài khoản</th>
                            <th>Vai trò</th>
                            <th>Địa chỉ Email</th>
                            <th>Giới tính</th>
                            <th>Ngày sinh</th>
                            <th>Địa chỉ</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users)
                        @foreach($users as $user)
                        <tr>
                            <td><input type="checkbox" name="massdel[{{$user->id}}]" class="checkitem" /></td>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->role}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->sex}}</td>
                            <td>{{$user->bird}}</td>
                            <td>{{$user->address}}</td>
                            <td style="min-width: 93px;">
                                <a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-info btn-sm item-edit" title="Chỉnh sửa"><span class="fa fa-pencil"></span></a>  
                                <a href="{{route('admin.user.delete', $user->id)}}" class="btn btn-danger btn-sm item-delete" title="Xóa"><span class="fa fa-close"></span></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                {!! $users->render() !!}
            </div>
            <a href="{{route('admin.user.create')}}" class="btn btn-success"><span class="fa fa-plus"></span> Thêm mới</a>
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa</button>
        </form>

    </div>
</div>
<!-- /.row -->

@endsection