@extends('home.master')

@section('content')
<!-- BANNER SECTION -->
<section class="float-left w-100 banner-con sub-banner-con position-relative main-box" style="padding-top: 60px; padding-bottom: 60px">
    <img alt="vector" class="vector1 img-fluid position-absolute" src="/template/home/images/vector1.png">
    <img alt="vector" class="vector2 img-fluid position-absolute" src="/template/home/images/vector2.png">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="sub-banner-inner-con">
                    <h4>Địa điểm</h4>
                    <p class="font-size-20">{{ $diaDiem->ten_dia_diem }}</p>

                </div>
                <!-- col-lg-6 -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>

    <!-- banner con -->
</section>
<!-- bg outer wrapper -->

<!-- Single Blog -->
<section class="singleblog-section blogpage-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="main-box">
                    <figure class="image1 mb-3" data-aos="fade-up" data-aos-duration="700">
                        <img src="{{ $diaDiem->hinh_anh_dia_diem }}" alt="image" class="img-fluid" loading="lazy">
                    </figure>

                    <div class="content1" data-aos="fade-up" data-aos-duration="700">
                        <h4 class="mt-3">{{ $diaDiem->ten_dia_diem }}</h4>
                        <div class="span-fa-outer-con">
                            <i class="mb-0 calendar fa-solid fa-calendar-days"></i>
                            <span class="mb-0 text-size-14">{{ $diaDiem->loaiDiaDiem->ten_loai_dia_diem }}</span>
                        </div>
                    </div>

                    <div data-aos="fade-up" data-aos-duration="700">
                        <hr>
                        <div class="text-justify">{!! $diaDiem->mo_ta_dia_diem !!}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 column">
                <div class="box1 box5" data-aos="fade-up" data-aos-duration="700">
                    <h5>Bài viết liên quan</h5>
                    @foreach($diaDiem->baiVietList as $item)
                    <div class="feed">
                        <figure class="feed-image mb-0" data-aos="fade-up">
                            <img src="{{ $item->hinh_anh_bai_viet }}" alt="image" class="img-fluid" loading="lazy">
                        </figure>
                        <a href="/chi-tiet-bai-viet/{{ $item->ma_bai_viet }}" class="mb-0">
                            <div>{{ $item->ten_bai_viet }}</div>
                            @if($item->ma_bai_viet == false)
                            <div class="badge badge-primary">Đang xem</div>
                            @endif
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="box1 box3" data-aos="fade-up" data-aos-duration="700">
                    <h5>Liên hệ chúng tôi</h5>
                    <ul class="list-unstyled mb-0">
                        <!-- <li class="text-size-16 text"><span class="d-inline-block">Email:</span> <a href="mailto:info@traveltrek.com" class="mb-0 text text-decoration-nonetext-size-16">info@traveltrek.com</a></li>
                        <li class="text-size-16 text"><span class="d-inline-block">Phone:</span> <a href="tel:+12345678900" class="mb-0 text text-decoration-nonetext-size-16">+1 234 567 89 0 0</a></li>
                        <li class="text-size-16 text1"><span class="d-inline-block">Facebook:</span> <a href="tel:+1(987)65432199" class="mb-0 text text-decoration-nonetext-size-16">+1 ( 987 ) 654 321 9 9</a></li> -->
                        <li class="text-size-16 text"><span class="d-inline-block">Email:</span> <a href="mailto:info@traveltrek.com" class="mb-0 text text-decoration-nonetext-size-16">info@TraVinh.com</a></li>
                        <li class="text-size-16 text"><span class="d-inline-block">Phone:</span> <a href="tel:+12345678900" class="mb-0 text text-decoration-nonetext-size-16">099 9284 284</a></li>
                        <li class="text-size-16 text1"><span class="d-inline-block">Facebook:</span> <a href="tel:+1(987)65432199" class="mb-0 text text-decoration-nonetext-size-16">Du lịch Trà Vinh</a></li>
                    </ul>
                </div>
                <div class="box1 box5" data-aos="fade-up" data-aos-duration="700">
                    <h5>Địa chỉ</h5>
                    <span>{{ $diaDiem->dia_chi }}, </span>
                    <span>{{ $diaDiem->xaPhuong->ten_xa_phuong }}, </span>
                    <span>{{ $diaDiem->xaPhuong->quanHuyen->ten_quan_huyen }} </span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection