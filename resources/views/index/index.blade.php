@extends('layouts.fontend')

@section('box-slide')
    @include('layouts.slide', ['slides' => $slides])
@endsection

@section('main-body')
<div class="container box">
    <div class="row box-content">
        <div class="col-sm-12 col-md-8">
            <div class="row posts posts-list">
                <div class="first post col-sm-6">
                    <h3 class="box-title">Tin Tức</h3>
                    <?php $first = $news->first(); ?>
                    <a href="{{route('post.view', [$first->slug, $first->id])}}">
                        <div class="image">
                            <img class="img-responsive" src="{{ asset($first->image_url) }}" alt="Thumb" />
                        </div>
                        <h4 class="title">{!! $first->post_title !!}</h4>
                        <span class="time">{{ $first->created_at->format('d/m/Y') }}</span>
                    </a>
                </div>
                <div class="col-sm-6 second">
                    <div class="arrow pull-right">
                        <a class="prev" href="#"><i class="fa fa-2x fa-arrow-circle-o-left"></i></a>
                        <a class="next" href="#"><i class="fa fa-2x fa-arrow-circle-o-right"></i></a>
                    </div>
                    <div class="clearfix"></div>
                    <?php $i=0; foreach ($news as $new) { $i++;
                    if($i>1){?>
                        <div class="post">
                            <a href="{{route('post.view', [$new->slug, $new->id])}}">
                                <h4 class="title">{{$new->post_title}} <span class="time"> {{$new->created_at->format('d/m/Y')}}</span></h4>
                            </a>
                        </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 banner-sb">
            <h3 class="box-title">Hỗ trợ trực tuyến</h3>
            <p class="desc">
                Liên hệ với chúng tôi để được hỗ trợ một cách nhanh nhất và chính xác nhất về các dịch vụ mà VATC cung cấp.
            </p>
            <div class="contact">
                <h4 class="text-center">Lễ tân hộp ngủ</h4>
                <ul class="list-unstyled list-contacts">
                    <li><a href="ymsgr:sendIM?{{get_setting('st_yahoo')}}"><img border="0" src="http://opi.yahoo.com/online?u={{get_setting('st_yahoo')}}&m=g&t=9&l=vi"> {{get_setting('st_yahoo')}}</a></li>
                    <li><a href="skype:{{get_setting('st_skype')}}?chat"><img src="http://mystatus.skype.com/mediumicon/{{get_setting('st_skype')}}" alt="Skype" /> {{get_setting('st_skype')}}</a></li>
                    <li><a href="telto:{{get_setting('st_phone')}}"><i class="fa fa-2x fa-phone-square"></i> {{get_setting('st_phone')}}</a></li>
                    <li><a href="mailto:{{get_setting('st_email')}}"><i class="fa fa-2x fa-envelope-o"> </i> {{get_setting('st_email')}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row slider slide-content-1">
    <div class="container">
        <div class="col-md-6 slides">
            @if(isset($ctslides) && !empty($ctslides))
            @foreach($ctslides as $slide)
            <div class="slide">
                <a target="<?php if($slide->open_type=='newtab') echo '_blank' ?>" href="{{$slide->link}}"><img class="img-responsive" src="{{ asset($slide->image) }}" alt="Slide" /></a>
            </div>
            @endforeach
            <a href="#" class="prev"><i class="fa fa-3x fa-angle-left"></i></a>
            <a href="#" class="next"><i class="fa fa-3x fa-angle-right"></i></a>
            @endif
        </div>
        <div class="col-md-6 adtext">
            <div class="rooms">
                <h3 class="title">Loại phòng</h3>
                <div class="content">
                    @if(!empty($rooms))
                    @foreach($rooms as $room)
                    <div class="row room">
                        <div class="col-sm-3">
                            <h4>{!! $room->post_title !!}</h4>
                        </div>
                        <div class="col-sm-9">
                            <div class="desc">
                                {!! $room->post_content !!}
                            </div>
                            <div class="row">
                                <div class="col-xs-6 price">
                                    <span>Giá: </span><ins>150.000 đ/Giờ</ins>
                                </div>
                                <div class="col-xs-6 read-more">
                                    <a href="{{route('post.view', [$room->slug, $room->id])}}" class="btn btn-warning">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="row adprice">
                <div class="col-sm-6">
                    <h3 class="title">Bảng giá</h3>
                    <p>
                        Công Ty Cổ Phần Du Lịch Hàng Không Việt Nam (VATC) là một doanh nghiệp mới, được thành lập vào đầu tháng 11 năm 2013.  VA
                    </p>
                </div>
                <div class="col-sm-6">
                    <div class="viewprice">
                        <div class="adbox">
                            <h4>Rẻ bất ngờ</h4>
                        </div>
                        <div class="read-more">
                            <a href="#">Xem bảng giá</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
    <div class="bg-img"><img class="img-responsive" src="{{ asset('public/images/bg/banner-bg-1.jpg') }}" alt="Banner" /></div>
</div>

<div class="box container">
    <h3 class="box-title">Sự kiện - Cẩm nang du lịch</h3>
    <div class="row posts posts-grid">
        @if($travels)
        @foreach($travels as $post)
        <div class="col-sm-6 col-md-3 post">
            <a href="{{route('post.view', [$post->slug, $post->id])}}">
                <div class="image">
                    <img class="img-responsive" src="{{ asset($post->image_url) }}" alt="thumbnail" />
                </div>
                <h4>{{$post->post_title}}</h4>
                <div class="time">{{ $post->created_at->format('d/m/Y') }}</div>
            </a>
        </div>
        @endforeach
        @endif
    </div>
</div>

<div class="slider slide-content-2 ">
    <div class="comments slides container">
        @if(!empty($reviews))
        @foreach($reviews as $review)
        <div class="row comment">
            <div class="col-sm-3 avatar">
                <img class="img-responsive" src="{{ asset($review->image_url) }}" alt="Face" />
            </div>
            <div class="col-sm-9 text-center">
                <div class="content">
                    <span class="icon">&OpenCurlyDoubleQuote;</span>
                    {!! $review->post_content !!}
                </div>
                <div class="meta">
                    <div class="author pull-left">
                        <img class="point" src="{{ asset('public/images/icon/arrow.png') }}" alt="arrow" />
                        <h4 class="text-left">{!! $review->post_title !!}</h4>
                        <i>{!! $review->post_excerpt !!}</i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
        <div class="arrow prev_next">
            <a href="#" class="prev"><i class="fa fa-3x fa-arrow-circle-o-left"></i></a>
            <a href="#" class="next"><i class="fa fa-3x fa-arrow-circle-o-right"></i></a>      
        </div>
    </div>
    <div class="overlay"></div>
    <div class="bg-img"><img class="img-responsive" src="{{ asset('public/images/bg-1.jpg') }}" alt="background" /></div>
</div>
@endsection