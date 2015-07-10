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

        @include('parts.tablenav', ['filter'=>['name' => 'Tên', 'created_ad' => 'Thời gian']])
        
        <form class="" method="POST" action="{{route('admin.media.massdel')}}">
            {!! csrf_field() !!}

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <td><input type="checkbox" name="massdel" class="checkall" /></td>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Tiêu đề</th>
                            <th>Author</th>
                            <th>Link</th>
                            <th>Kiểu</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($medias)
                        @foreach($medias as $media)
                        <tr>
                            <td><input type="checkbox" name="massdel[{{$media->id}}]" class="checkitem" /></td>
                            <td>{{$media->id}}</td>
                            <td><img width="100" src="{{ asset($media->src) }}" alt="Thumbnail" /></td>
                            
                            <td>{{$media->title}}</td>
                            <td>{{$media->author_id}}</td>
                            <td>{{$media->src}}</td>
                            <td>{{$media->mime_type}}</td>
                            <td style="min-width: 93px;">
                                <a href="{{route('admin.media.edit', $media->id)}}" class="btn btn-info btn-sm item-edit" title="Chỉnh sửa"><span class="fa fa-pencil"></span></a>  
                                <a href="{{route('admin.media.delete', $media->id)}}" class="btn btn-danger btn-sm item-delete" title="Xóa"><span class="fa fa-close"></span></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            {!! $medias->render() !!}
            </div>
            <a href="{{route('admin.media.create')}}" class="btn btn-success"><span class="fa fa-plus"></span> Thêm mới</a>
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa</button>
        </form>
    </div>
</div>
<!-- /.row -->

@endsection