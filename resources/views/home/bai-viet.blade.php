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
                    <h1>{{ $title }}</h1>
                    <p class="font-size-20">Nơi chia sẻ kinh nghiệm về những chiến đi, và các ưu đãi mới nhất</p>
                    
                </div>
                <!-- col-lg-6 -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- banner con -->
</section>

<!-- MAIN SECTION -->
<section class="blog-posts blogpage-section three-column-con w-100 float-left">
    <div class="container">
        <div class="row wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <div id="blog" class="col-xl-12">
                <!-- threecolumn-blog  -->
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-group">
                            <li class="list-group-item">QUẬN / HUYỆN</li>
                            @foreach($quanHuyenList as $item)
                            <li class="list-group-item {{ isset($_REQUEST['quan_huyen']) && $_REQUEST['quan_huyen'] == $item->ma_quan_huyen ? "active" : "" }}"><a href="?quan_huyen={{ $item->ma_quan_huyen }}">{{ $item->ten_quan_huyen }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 mb-5 d-flex justify-content-end">
                                <form style="width: 50%" method="GET" class="input-group">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection