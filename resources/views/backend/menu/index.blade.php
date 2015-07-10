@extends('layouts.backend')

@section('title')
{{$title}}
@endsection

@section('content')


<div id="user-manage" class="row">

    <div class="col-lg-12">
        <h2>{{$title}}</h2>

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

        
 
        <form class="" method="POST" action="{{route('admin.menu.massdel')}}">
                {!! csrf_field() !!}

                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-left"><input type="checkbox" name="massdel" class="checkall" /></th>
                                <th>ID</th>
                                <th>Tên Nhóm Menu</th>
                                <th>Đường dẫn tĩnh</th>
                                <th>Quản lý Item</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($menus)
                            @foreach($menus as $menu)
                            <tr>
                                <td><input type="checkbox" name="massdel[{{$menu->id}}]" class="checkitem" /></td>
                                <td>{{$menu->id}}</td>
                                <td>{{$menu->name}}</td>
                                <td>{{$menu->slug}}</td>
                                <td><a href="{{route('menu-item', $menu->id)}}">Xem mục con</a></td>
                                <td style="min-width: 93px;">
                                    <a href="{{route('admin.menu.edit', $menu->id)}}" class="btn btn-info btn-sm item-edit" title="Chỉnh sửa"><span class="fa fa-pencil"></span></a>  
                                    <a href="{{route('admin.menu.delete', $menu->id)}}" class="btn btn-danger btn-sm item-delete" title="Xóa"><span class="fa fa-close"></span></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {!! $menus->render() !!}
                </div>
                <a href="{{route('admin.menu.create')}}" class="btn btn-success"><span class="fa fa-plus"></span> Thêm mới</a>
                
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa</button>
            </form>
        
    </div>
</div>
<!-- /.row -->

@endsection