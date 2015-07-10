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
      
        @include('parts.tablenav', ['filter'=>['name-az' => 'Tên A-Z', 'name-za' => 'Tên Z-A', 'post_status' => 'Trạng thái', 'created_ad' => 'Mới nhất'], 'order'=>$order])
        
        <form class="" method="POST" action="{{route('admin.post.massdel')}}">
            {!! csrf_field() !!}

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <td><input type="checkbox" name="massdel" class="checkall" /></td>
                            <th>ID</th>
                            <th>Thumbnail</th>
                            <th>Tên Bài viết</th>
                            <th>Trạng thái</th>
                            <th>Tác giả</th>
                            <th>Bình luận</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($posts)
                        @foreach($posts as $post)
                        <tr>
                            <td><input type="checkbox" name="massdel[{{$post->id}}]" class="checkitem" /></td>
                            <td>{{$post->id}}</td>
                            <td><img width="70" src="{{ asset($post->image_url) }}" alt="thumbnail" /></td>
                            <td>{{$post->post_title}}</td>
                            <td>{{$post->post_status}}</td>
                            <td>{{$post->author_id}}</td>
                            <td>{{$post->comment_count}}</td>
                            <td>
                                <a href="{{route('admin.post.edit', $post->id)}}" class="btn btn-info btn-sm item-edit" title="Chỉnh sửa"><span class="fa fa-pencil"></span></a>  
                                <a href="{{route('admin.post.delete', $post->id)}}" class="btn btn-danger btn-sm item-delete" title="Xóa"><span class="fa fa-close"></span></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                {!! $posts->render() !!}
            </div>
            <a href="{{route('admin.post.create')}}" class="btn btn-success"><span class="fa fa-plus"></span> Thêm mới</a>
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa</button>
        </form>
        
    </div>
</div>
<!-- /.row -->

@endsection