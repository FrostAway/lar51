
    <div class="row">
        <div class="col-sm-12 header-slide">
            
            <div class="slides">
                @if(isset($slides) && !empty($slides))
                @foreach($slides as $slide)
                <div class="slide text-center">
                    <h1 class="sl-title"><span>{!! $slide->name !!}</span></h1>
                    <h2 class="sub-title">{!! $slide->desc !!} <a target="<?php if($slide->open_type == 'newtab') echo '_blank'; ?>" href="{{ $slide->link }}"><i class="fa fa-long-arrow-right"></i></a></h2>
                    <div class="bg-img"><img class="img-responsive" src="{{ asset('public/images/slide/header-slide1.jpg') }}" alt="image" /></div>
                </div>
                @endforeach
                @endif
            </div>
            
            <div class="overlay"></div>
        </div>
    </div>

    <div class="container place-room">
        <h3 class="title"><img src="{{ asset('public/images/icon-key.png') }}" alt="Icon" /> Đặt phòng ngay hôm nay</h3>
        <div class="place-content">
            <div class="row">
                <form>
                    <div class="col-sm-10 content">
                        <div class="place-field">
                            <input type="text" name="dfrom" class="form-control date dfrom" placeholder="Ngày đến" />
                            <i class="fa fa-calendar"></i><div class="line"></div>
                        </div>
                        <div class="place-field">
                            <input type="text" name="tfrom" class="form-control picktime tfrom" placeholder="Giờ đến" />
                            <i class="fa fa-angle-down"></i><div class="line"></div>
                        </div>
                        <div class="place-field">
                            <input type="text" name="dto" class="form-control date dto" placeholder="Ngày đi" />
                            <i class="fa fa-calendar"></i><div class="line"></div>
                        </div>
                        <div class="place-field">
                            <input type="text" name="tto" class="form-control picktime" placeholder="Giờ đi" />
                            <i class="fa fa-angle-down"></i><div class="line"></div>
                            <select name="tto" class="hidden">
                                <option value="0"></option>
                            </select>
                        </div>
                        <div class="place-field">
                            <input type="text" list="station" name="adult" class="form-control" placeholder="Nhà ga" />
                            <i class="fa fa-angle-down"></i><div class="line"></div>
                            <datalist id="station">
                                <option value="nhaga1">Nhà ga 1</option>
                                <option value="nhaga2">Nhà ga 2</option>
                                <option value="nhaga3">Nhà ga 3</option>
                                <option value="nhaga4">Nhà ga 4</option>
                            </datalist>
                        </div>
                        <div class="place-field">
                            <input type="text" list="adult" name="adult" class="form-control" placeholder="Người lớn" />
                            <i class="fa fa-angle-down"></i><div class="line"></div>
                            <datalist id="adult">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </datalist>
                        </div>
                        <div class="place-field">
                            <input type="text" list="child" name="child" class="form-control" placeholder="Trẻ em" />
                            <i class="fa fa-angle-down"></i><div class="line"></div>
                            <datalist id="child">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </datalist>
                        </div>
                        <div class="place-field">
                            <input type="text" list="single_room" name="single_room" class="form-control" placeholder="Phòng đơn" />
                            <i class="fa fa-angle-down"></i><div class="line"></div>
                            <datalist id="single_room">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </datalist>
                        </div>
                        <div class="place-field">
                            <input type="text" list="pair_room" class="form-control" placeholder="Phòng đôi" />
                            <i class="fa fa-angle-down"></i><div class="line"></div>
                            <datalist id="pair_room">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </datalist>
                        </div>
                        <div class="place-field">
                            <input type="text" class="form-control" placeholder="" />
                            <i class="fa fa-angle-down"></i><div class="line"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-sm-2 submit">
                        <button type="submit" class="text-center">
                            <i class="fa fa-check-circle-o"></i>
                            <div class="text">ĐẶT PHÒNG</div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
