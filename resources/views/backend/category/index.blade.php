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
        
        
        @include('parts.tablenav', ['filter' => ['name' => 'Tên', 'order' => 'Thứ tự', 'count' => 'Số bài']])
        @if($type=='cat')
        <form class="" method="POST" action="{{route('admin.cat.massdel')}}">
                {!! csrf_field() !!}

                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-left"><input type="checkbox" name="massdel" class="checkall" /></th>
    
                                <th>Tên Danh mục</th>
                                <th>Dường dẫn tĩnh</th>
                                <th>Danh mục cha</th>
                                <th>Thứ tự</th>
                                <th>Số bài</th>
                                <th>ID</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
<!--                            @if($cats)
                            @foreach($cats as $cat)
                            <tr>
                                <td><input type="checkbox" name="massdel[{{$cat->id}}]" class="checkitem" /></td>
                                <td>{{$cat->id}}</td>
                                <td>{{$cat->name}}</td>
                                <td>{{$cat->slug}}</td>
                                <td>{{$cat->parent}}</td>
                                <td>{{$cat->order}}</td>
                                <td>{{$cat->count}}</td>
                                <td style="min-width: 93px;">
                                    <a href="{{route('admin.cat.edit', $cat->id)}}" class="btn btn-info btn-sm item-edit" title="Chỉnh sửa"><span class="fa fa-pencil"></span></a>  
                                    <a href="{{route('admin.cat.delete', $cat->id)}}" class="btn btn-danger btn-sm item-delete" title="Xóa"><span class="fa fa-close"></span></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif-->
                            {!! $listcats !!}
                        </tbody>
                    </table>
                    {!! $cats->render() !!}
                </div>
                <a href="{{route('admin.cat.create')}}" class="btn btn-success"><span class="fa fa-plus"></span> Thêm mới</a>
                
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa</button>
            </form>
        @else
        <form class="" method="POST" action="{{route('admin.tag.massdel')}}">
                {!! csrf_field() !!}

                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-left"><input type="checkbox" name="massdel" class="checkall" /></th>
                                <th>ID</th>
                                <th>Tên Thẻ</th>
                                <th>Dường dẫn tĩnh</th>
                                <th>Thứ tự</th>
                                <th>Số bài</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($cats)
                            @foreach($cats as $cat)
                            <tr>
                                <td><input type="checkbox" name="massdel[{{$cat->id}}]" class="checkitem" /></td>
                                <td>{{$cat->id}}</td>
                                <td>{{$cat->name}}</td>
                                <td>{{$cat->slug}}</td>
                                <td>{{$cat->order}}</td>
                                <td>{{$cat->count}}</td>
                                <td style="min-width: 93px;">
                                    <a href="{{route('admin.tag.edit', $cat->id)}}" class="btn btn-info btn-sm item-edit" title="Chỉnh sửa"><span class="fa fa-pencil"></span></a>  
                                    <a href="{{route('admin.tag.delete', $cat->id)}}" class="btn btn-danger btn-sm item-delete" title="Xóa"><span class="fa fa-close"></span></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {!! $cats->render() !!}
                </div>
                <a href="{{route('admin.tag.create')}}" class="btn btn-success"><span class="fa fa-plus"></span> Thêm mới</a>               
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa</button>
            </form>
        @endif

    </div>
</div>
<!-- /.row -->

@endsection