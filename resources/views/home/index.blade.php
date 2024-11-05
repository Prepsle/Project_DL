@extends('home.master')

@section('content')
<!-- BANNER SECTION -->
<section class="float-left w-100 banner-con position-relative main-box pt-0">
    <img alt="vector" class="vector1 img-fluid position-absolute" src="/template/home/images/vector1.png">
    <div class="container">
        <!-- Carousel -->
        <div class="owl-carousel">
            <div class="item">
                <div class="row align-items-center">
                    <div class="col-lg-6  order-xl-0 order-lg-0 order-1">
                        <div class="banner-inner-content">
                            <h4>Khám phá Thế Giới! <i class="fa-solid fa-earth-americas"></i></h4>
                            <!-- <h4>Thực hiện chuyến đi tốt nhất của bạn!</h4> -->
                            <p class="font-size-20">Bắt tay vào cuộc hành trình khám phá những kỳ quan tuyệt đẹp.</p>
                            <!-- <div class="green-btn d-inline-block">
                                <a href="#" class="d-inline-block">Khám phá ngay</a>
                            </div> -->
                            <!-- banner inner content -->
                        </div>
                        <!--  -->
                    </div>
                    <div class="col-lg-6">
                        <figure class="banner-image-con">
                            <img src="/template/home/images/home-banner-image.png" alt="image" class="">
                        </figure>
                        <!--  -->
                    </div>
                    <!-- row -->
                </div>
                <!-- item -->
            </div>
        </div>
        <!-- container -->
    </div>
    <!-- banner con -->
</section>

<section class="blog-posts blogpage-section three-column-con w-100 float-left" style="padding-top: 60px; padding-bottom: 60px">
    <div class="container">
        <div class="row wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <div id="blog" class="col-xl-12">
                <!-- threecolumn-blog  -->
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-group pt-4 mt-5">
                            <li class="list-group-item">QUẬN / HUYỆN</li>
                            @foreach($quanHuyenList as $item)
                            <li class="list-group-item"><a href="/bai-viet?quan_huyen={{ $item->ma_quan_huyen }}">{{ $item->ten_quan_huyen }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 mb-5 d-flex justify-content-end">
                                <form action="/bai-viet" style="width: 50%" method="GET" class="input-group">
                                    <input type="text" class="form-control" name="query">
                                    <button class="btn btn-outline-primary">Tìm</button>
                                </form>
                            </div>
                            @foreach($baiVietList as $item)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-aos="fade-up" data-aos-duration="700">
                                <div class="blog-box blog-box1">
                                    <figure class="blog-image mb-0">
                                        <img src="{{ $item->hinh_anh_bai_viet }}" alt="{{ $item->ten_bai_viet }}" class="img-fluid" loading="lazy">
                                    </figure>
                                    <div class="lower-portion">
                                        <div class="span-i-con d-flex justify-content-between">
                                            <div>
                                                <i class="tag-mb fa-solid fa-users"></i>
                                                <span class="text-size-14">{{ $item->nguoiDangBaiViet->ten_tai_khoan }}</span>
                                            </div>
                                            <div>
                                                <i class="tag-mb fa-solid fa-eye"></i>
                                                <span class="text-size-14">{{ $item->luot_xem_bai_viet }}</span>
                                            </div>
                                        </div>
                                        <a href="/chi-tiet-bai-viet/{{ $item->ma_bai_viet }}">
                                            <h5 class="two-line">{{ $item->ten_bai_viet }}</h5>
                                        </a>
                                    </div>
                                    <div class="button-portion ">
                                        <div class="date">
                                            <i class="mb-0 calendar-ml fa-solid fa-calendar-days"></i>
                                            <span class="mb-0 text-size-14">{{ App\Helpers\Helper::DateTime($item->ngay_dang_bai_viet, 'date') }}</span>
                                        </div>
                                        <div class="button">
                                            <a class="mb-0 read_more text-decoration-none" href="/chi-tiet-bai-viet/{{ $item->ma_bai_viet }}">
                                                Xem thêm
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="row d-flex align-items-center justify-content-between">
                            {!! $baiVietList->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection