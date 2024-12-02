@extends('home.master')

@section('content')

<style>
    .text-ellipsis {
        white-space: nowrap; 
        width: 320px; 
        overflow: hidden;
        text-overflow: ellipsis; 
    }
</style>
<!-- BANNER SECTION -->
<section class="float-left w-100 banner-con sub-banner-con position-relative main-box" style="padding-top: 60px; padding-bottom: 60px">
    <img alt="vector" class="vector1 img-fluid position-absolute" src="/template/home/images/vector1.png">
    <img alt="vector" class="vector2 img-fluid position-absolute" src="/template/home/images/vector2.png">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="sub-banner-inner-con">
                    <h4>Bài viết</h4>
                    <p class="font-size-20">{{ $baiViet->ten_bai_viet }}</p>
                    
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
                    <div class="content1" data-aos="fade-up" data-aos-duration="700">
                        <h4 class="mt-3">{{ $baiViet->ten_bai_viet }}</h4>
                        <div class="span-fa-outer-con">
                            <i class="fa-solid fa-user"></i>
                            <span class="text-size-14 text-mr">Người viết: {{ $baiViet->nguoiDangBaiViet->ten_tai_khoan }}</span>
                            <i class="mb-0 calendar fa-solid fa-calendar-days"></i>
                            <span class="mb-0 text-size-14">Ngày tạo: {{ App\Helpers\Helper::DateTime($baiViet->ngay_dang_bai_viet, 'date') }}</span>
                        </div>
                    </div>
                    <div class="text-justify">{!! $baiViet->noi_dung_bai_viet !!}</div>
                    <div class="content4" data-aos="fade-up" data-aos-duration="700">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <!-- <div class="icon">
                                    <h5>Chia sẻ ngay</h5>
                                    <div class="social-icons position-absolute">
                                        <ul class="mb-0 list-unstyled ">
                                            <li><a href="https://www.linkedin.com/login" class="text-decoration-none"><i class="fa-brands fa-linkedin-in social-networks"></i></a>
                                            </li>
                                            <li><a href="https://www.instagram.com/accounts/login/?next=https%3A%2F%2Fwww.instagram.com%2Faccounts%2Fonetap%2F%3Fnext%3D%252F%26__coig_login%3D1" class="text-decoration-none"><i
                                                        class="fa-brands fa-instagram social-networks"></i></a></li>
                                            <li><a href="https://www.facebook.com/login/" class="text-decoration-none"><i class="fa-brands fa-facebook-f social-networks"></i></a>
                                            </li>
                                            <li><a href="https://twitter.com/i/flow/login?input_flow_data=%7B%22requested_variant%22%3A%22eyJsYW5nIjoiZW4ifQ%3D%3D%22%7D" class="text-decoration-none"><i
                                                        class="fa-brands fa-x-twitter social-networks"></i></a></li>
                                        </ul>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <h3 class="my-3">Bình luận: </h3>
                    @foreach($baiViet->binhLuanList('da_xac_nhan') as $binhLuan)
                    <div class="my-3">
                        <div class="d-flex">
                            <img width="50" src="/template/admin/img/profile.png" alt="">
                            <div class="ml-2">
                                <b>{{ $binhLuan->taiKhoan->ten_tai_khoan }}</b>
                                <div>{{ App\Helpers\Helper::DateTime($binhLuan->thoi_gian_binh_luan) }}</div>
                            </div>
                        </div>
                        <div>{{ $binhLuan->chi_tiet_binh_luan }}</div>
                    </div>
                    @endforeach
                </div>

                <form action="/save/comment" class="main-box mt-4" method="POST">
                    <div class="form-group">
                        <label>Nội dung bình luận</label>
                        <textarea name="chi_tiet_binh_luan" class="form-control" rows="3"></textarea>
                    </div>
                    @if(Auth::check())
                    <input hidden type="text" name="ma_tai_khoan" value="{{ Auth::user()->ma_tai_khoan }}">
                    <input hidden type="text" name="ma_bai_viet" value="{{ $baiViet->ma_bai_viet }}">
                    <button class="btn btn-primary">Bình luận</button>
                    @else
                    <span><i>Vui lòng đăng nhập trước khi bình luận</i></span>
                    @endif
                    @csrf
                </form>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 column">
                <div class="box1 box5" data-aos="fade-up" data-aos-duration="700">
                    <div class="text-ellipsis" style="font-size: 0.85rem; color: #007bff;">
                        {!! $baiViet->map_link !!}
                    </div>
                </div>                

                <div class="box1 box5" data-aos="fade-up" data-aos-duration="700">
                    <h5>Thông tin chi tiết:</h5>
                    <div class="text-ellipsis" href="">Tên chuyến đi: {{$baiViet->ten_bai_viet}}</div>
                    <div class="text-ellipsis" href="">Giá thành: {{ number_format($baiViet->gia_thanh, 0, ',', '.') }} VNĐ</div>
                    <div class="text-ellipsis" href="">lịch trình: </div>
                    <br>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ma_bai_viet" value="{{ $baiViet->ma_bai_viet }}">
                        <input type="hidden" name="name" value="{{ $baiViet->ten_bai_viet }}">
                        <input type="hidden" name="price" value="{{ $baiViet->gia_thanh }}">
                        <button type="submit" class="btn btn-primary">Đặt tour ngay</button>
                    </form>
                </div>

                <div class="box1 box5" data-aos="fade-up" data-aos-duration="700">
                    <h5>Bài viết liên quan</h5>
                    @foreach($baiVietList as $item)
                    <div class="feed">
                        <figure class="feed-image mb-0" data-aos="fade-up">
                            <img src="{{ $item->hinh_anh_bai_viet }}" alt="image" class="img-fluid" loading="lazy">
                        </figure>
                        <a href="/chi-tiet-bai-viet/{{ $item->ma_bai_viet }}" class="mb-0">
                            <div>{{ $item->ten_bai_viet }}</div>
                            @if($item->ma_bai_viet == $baiViet->ma_bai_viet)
                            <div class="badge badge-primary">Đang xem</div>
                            @endif
                        </a>
                    </div>
                    @endforeach
                </div>
                <!-- <div class="box1 box3 mt-5" data-aos="fade-up" data-aos-duration="700"> -->
                    <!-- <h5>Liên hệ chúng tôi</h5>
                    <div class="social-icons">
                        <ul class="mb-0 list-unstyled ">
                            <li><a href="https://www.linkedin.com/login" class="text-decoration-none"><i class="fa-brands fa-linkedin-in social-networks"></i></a>
                            </li>
                            <li><a href="https://www.instagram.com/accounts/login/?next=https%3A%2F%2Fwww.instagram.com%2Faccounts%2Fonetap%2F%3Fnext%3D%252F%26__coig_login%3D1" class="text-decoration-none"><i
                                        class="fa-brands fa-instagram social-networks"></i></a></li>
                            <li><a href="https://www.facebook.com/login/" class="text-decoration-none"><i class="fa-brands fa-facebook-f social-networks"></i></a>
                            </li>
                            <li><a href="https://twitter.com/i/flow/login?input_flow_data=%7B%22requested_variant%22%3A%22eyJsYW5nIjoiZW4ifQ%3D%3D%22%7D" class="text-decoration-none"><i class="fa-brands fa-x-twitter social-networks"></i></a></li>
                        </ul>
                    </div> -->
                    <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-sm-block"> -->
                        <!-- <div class="icon">
                            <h4 class="heading">Liên hệ</h4>
                            <hr class="line">
                            <ul class="list-unstyled mb-0">
                                <li class="text-size-16 text"><span class="d-inline-block" style="color: black;"><strong>Email:</strong></span><a class="mb-0 text text-decoration-nonetext-size-16"> info@TraVinh.com</a></li>
                                <li class="text-size-16 text"><span class="d-inline-block" style="color: black;"><strong>Phone:</strong></span> <a class="mb-0 text text-decoration-nonetext-size-16">099 9284 284</a></li>
                                <li class="text-size-16 text1"><span class="d-inline-block" style="color: black;"><strong>Facebook:</strong></span><a class="mb-0 text text-decoration-nonetext-size-16"> Du lịch Trà Vinh</a></li>
                                <li class="social-icons">
                                    <div class="circle"><a href="https://www.facebook.com/login/"><i class="fa-brands fa-square-facebook"></i></a></div>
                                    <div class="circle"><a href="https://twitter.com/i/flow/login"><i class="fa-brands fa-square-x-twitter"></i></a></div>
                                    <div class="circle"><a href="https://www.linkedin.com/login"><i class="fa-brands fa-linkedin"></i></a>
                                    </div>
                                    <div class="circle"><a href="https://www.pinterest.com/"><i class="fa-brands fa-square-pinterest"></i></a></div>
                                </li> -->
                            <!-- </ul>
                        </div>  -->
                    <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
</section>
@endsection
