@extends('layouts.backend')

@section('title')
{{$title}}
@endsection

@section('content')

<div id="cat-manage" class="row">

    <div class="col-lg-12 media-container">
        <input type="hidden" id="media_src" value="{{$media_src}}" />
    </div>
</div>
<!-- /.row -->

@endsection