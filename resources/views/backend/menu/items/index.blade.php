@extends('layouts.backend')

@section('title')
{{$title}}
@endsection

@section('content')

<div id="cat-manage" class="row">

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

        <div class="group_menu form-group">
            <label class="control-label col-sm-3">Thuộc nhóm Menu</label>
            <div class="col-sm-9">
                <input type="text" disabled="" class="form-control" value="{{$group->name}}" />
            </div>
            <div class="clearfix"></div>
        </div>

        @include('parts.tablenav', ['filter'=>['name' => 'Tên', 'post_status' => 'Trạng thái', 'created_ad' => 'Mới nhất']])

        <form class="" method="POST" action="{{route('menuitem.massdel')}}">
            {!! csrf_field() !!}

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <td><input type="checkbox" name="massdel" class="checkall" /></td>
                        
                            <th>Tên mục</th>
                            <th>Mục cha</th>
                            <th>Loại</th>
                            <th>Link</th>
                            <th>Hiển thị</th>
                            <th>Thứ tự</th>
                            <th>Icon/Image</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
<!--                        @if($menus)
                        @foreach($menus as $menu)
                        <tr>
                            <td><input type="checkbox" name="massdel[{{$menu->id}}]" class="checkitem" /></td>
                            <td>{{$menu->id}}</td>
                            <td>{{$menu->name}}</td>
                            <td>{{$menu->parent}}</td>
                            <td>{{$menu->type}}</td>
                            <td>{{$menu->link}}</td>
                            <td>{{$menu->status}}</td>
                            <td>{{$menu->order}}</td>
                            <td>
                                <a href="{{route('menuitem.edit', $menu->id)}}" class="btn btn-info btn-sm item-edit" title="Chỉnh sửa"><span class="fa fa-pencil"></span></a>  
                                <a href="{{route('menuitem.delete', [$menu->id, $group->id])}}" class="btn btn-danger btn-sm item-delete" title="Xóa"><span class="fa fa-close"></span></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif-->
                        <?php // echo list_tree_tr($menus, 0, 0, $group->id); ?>
                        {!! $menus_tr !!}
                    </tbody>
                </table>
            </div>
            <a href="{{route('menuitem.create', $group->id)}}" class="btn btn-success"><span class="fa fa-plus"></span> Thêm mới</a>
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa</button>
        </form>
    </div>
</div>
<!-- /.row -->

@endsection