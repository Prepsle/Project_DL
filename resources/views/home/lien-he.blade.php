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
                    <h1>Liên hệ</h1>
                    <p class="font-size-20">
                        Hãy liên hệ với chúng tôi mọi lúc, mọi nơi
                    </p>
                    
                </div>
                <!-- col-lg-6 -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>

    <!-- banner con -->
</section>

<!-- ABOUT US SECTION -->
<section class="float-left w-100 about-travel-con position-relative main-box padding-top padding-bottom">
    <img alt="vector" class="vector5 wow bounceInUp img-fluid position-absolute" data-wow-duration="2s" src="/template/home/images/vector5.png">
    <img alt="vector" class="vector6 img-fluid position-absolute" src="/template/home/images/vector6.png">
    <div class="container wow bounceInUp" data-wow-duration="2s">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-travel-img-con position-relative">
                    <figure class="about-img"><img class="img-fluid" alt="image" src="/template/home/images/about-travel-img1.jpg">
                    </figure>
                    <figure class="about-img2"><img class="img-fluid" alt="image" src="/template/home/images/about-travel-img2.jpg">
                    </figure>
                </div>
                <!-- col -->
            </div>
            <div class="col-lg-6">
                <div class="about-travel-content">
                    <h4 class="text-uppercase">Về TrevelTrek</h4>
                    <h2>Công ty đại lý du lịch tốt nhất thế giới kể từ năm 2011.</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliquaquis</p>
                    <ul class="list-unstyled p-0 listing">
                        <li class="position-relative"><i class="fa-solid fa-check mr-3"></i>Forem commodo dolor sit amet
                            consectetur adipis.</li>
                        <li class="position-relative"><i class="fa-solid fa-check mr-3"></i>Sed do eiusmod tempor incididunt ut
                            labore et dolore magna. </li>
                        <li class="position-relative mb-0"><i class="fa-solid fa-check mr-3"></i>Ipsum suspen disse ultrices
                            gravida
                            risus commodo viverra. </li>
                        <!-- list unstyled -->
                    </ul>
                    <ul class="list-unstyled p-0 m-0 d-flex align-items-center about-count">
                        <li><span class="d-inline-block counter">13 </span><span class="mb-0 plus1 d-inline-block">+</span> <br>
                            Năm
                        </li>
                        <li><span class="d-inline-block counter">355 </span><span class="mb-0 plus1 d-inline-block">+</span> <br>
                            Đối tác
                        </li>
                        <li><span class="d-inline-block counter">17</span><span class="mb-0 plus1 d-inline-block">k+</span>
                            Khách hàng
                        </li>
                    </ul>
                    <div class="green-btn d-inline-block">
                        <a href="/tours/all" class="d-inline-block">Tìm tour ngay</a>
                    </div>
                    <!-- about travel content -->
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- about travel con -->
</section>

<!-- PLAN YOUR TRIP SECTION -->
<section class="float-left w-100 plan-trip-con position-relative main-box padding-top padding-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-8 order-xl-0 order-lg-0 order-md-0 order-1">
                <div class="plan-trip-sub-con">
                    <div class="heading-content text-left position-relative">
                        <h4 class="text-uppercase">KẾ HOẠCH CHUYẾN ĐI CỦA BẠN VỚI CHÚNG TÔI</h4>
                        <h2 class="text-uppercase">Bạn đã sẫn sàng chưa?</h2>
                        <div class="green-btn d-inline-block">
                            <a href="/tours/all" class="d-inline-block">Đi ngay</a>
                        </div>
                    </div>
                </div>
                <!-- col -->
            </div>
            <div class="col-lg-4 col-md-4">
                <figure><img class="img-fluid" src="/template/home/images/plan-trip-img.png" alt="image"></figure>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- plan your trip con -->
</section>
@endsection