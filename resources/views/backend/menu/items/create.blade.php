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


            
                {!! Form::open([
                'route' => 'menuitem.store',
                'method' => 'POST',
                'class' => 'form-horizontal'
                ]) !!}
                
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Nhóm Menu</label>
                    <div class="col-sm-10">
                        {!! Form::hidden('group_id', $currgroup->id) !!}
                        {!! Form::text('group_name', $currgroup->name, ['class' => 'form-control', 'disabled']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Tên Menu (*)</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Link</label>
                    <div class="col-sm-10 box-select">
                        {!! Form::hidden('ajax_token', csrf_token(), ['class' => 'ajax_token']) !!}
                        <div class="link_type">
                            <label>{!! Form::radio('link_type', 'cat', true) !!} Danh mục tin tức</label>
                            <label>{!! Form::radio('link_type', 'page') !!} Trang</label>
                            <label>{!! Form::radio('link_type', 'post') !!} Bài viết</label>
                            <label>{!! Form::radio('link_type', 'custom') !!} tùy chọn</label>
                        </div>
                        <div class="link_select">
                            {!! Form::select('link', ($cats), null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Menu cha</label>
                    <div class="col-sm-10">
                        {!! Form::select('parent', array('0' => 'Chọn Menu cha')+$parents, null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Thứ tự</label>
                    <div class="col-sm-10">
                        {!! Form::text('order', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Trạng thái</label>
                    <div class="col-sm-10">
                        {!! Form::select('status', ['enable' => 'Enable', 'disable'=>'Disable'], null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Mở menu</label>
                    <div class="col-sm-10">
                        {!! Form::select('open_type', ['current' => 'Tab hiện tại', 'newtab'=>'Tab mới'], null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-left control-label col-sm-2">Icon</label>
                    <div class="col-sm-10">
                        {!! Form::text('icon', null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="submit" name="create_menu" class="btn btn-success" value="Tạo Menu" />
                        <a href="{{route('menu-item')}}" class="btn btn-danger"><span class="fa fa-mail-reply"> Quay lại</span></a>                        
                    </div>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
<!-- /.row -->

@endsection

