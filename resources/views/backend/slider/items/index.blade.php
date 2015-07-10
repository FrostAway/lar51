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

        <div class="group_slide form-group">
            <label class="control-label col-sm-3">Thuộc nhóm Menu</label>
            <div class="col-sm-9">
                <input type="text" disabled="" class="form-control" value="{{$slider->name}}" />
            </div>
            <div class="clearfix"></div>
        </div>

        @include('parts.tablenav', ['filter'=>['name' => 'Tên', 'post_status' => 'Trạng thái', 'created_ad' => 'Mới nhất']])

        <form class="" method="POST" action="{{route('slide.massdel')}}">
            {!! csrf_field() !!}

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <td><input type="checkbox" name="massdel" class="checkall" /></td>      
                            <th>ID</th>
                            <td>Hình ảnh</td>
                            <th>Tên</th>
                            <th>Link</th>
                            <th>Mở link</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($slides)
                        @foreach($slides as $slide)
                        <tr>
                            <td><input type="checkbox" name="massdel[{{$slide->id}}]" class="checkitem" /></td>
                            <td>{{$slide->id}}</td>
                            <td><img width="120" src="{{ asset($slide->image) }}" alt="Image" /></td>
                            <td>{{$slide->name}}</td>
                            <td>{{$slide->link}}</td>
                            <td>{{$slide->open_type}}</td>
                            <td>
                                <a href="{{route('slide.edit', [$slide->id, $slider->id])}}" class="btn btn-info btn-sm item-edit" title="Chỉnh sửa"><span class="fa fa-pencil"></span></a>  
                                <a href="{{route('slide.delete', [$slide->id, $slider->id])}}" class="btn btn-danger btn-sm item-delete" title="Xóa"><span class="fa fa-close"></span></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        
                    </tbody>
                </table>
            </div>
            <a href="{{route('slide.create', $slider->id)}}" class="btn btn-success"><span class="fa fa-plus"></span> Thêm mới</a>
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa</button>
        </form>
    </div>
</div>
<!-- /.row -->

@endsection