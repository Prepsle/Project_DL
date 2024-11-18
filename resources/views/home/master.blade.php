<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="icon" sizes="96x96" href="/template/home/images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- StyleSheet link CSS -->
    <link rel="stylesheet" href="/template/home/css/animate.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/template/home/bootstrap/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/template/home/css/superclasses.css" type="text/css">
    <link rel="stylesheet" href="/template/home/css/custom.css" type="text/css">
    <link rel="stylesheet" href="/template/home/css/blog.css" type="text/css">
    <link rel="stylesheet" href="/template/home/css/responsive.css" type="text/css">
    <link rel="stylesheet" href="/template/home/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/template/home/css/owl.theme.default.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        img {
            max-width: 100%;
        }

        .single-line {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
            line-height: 1.5;
        }

        .two-line {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            line-height: 1.5;
        }

        .list-group-item:hover {
            background-color: #007bff;
        }

        .list-group-item:hover a {
            color: white !important;
        }

        .list-group-item.active {
            background-color: #007bff;
        }

        .list-group-item.active a {
            color: white !important;
        }

        .btn-primary {
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
        }

        .badge {
            font-size: 0.75rem;
        }

    </style>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '994882865175556',
                cookie: true,
                xfbml: true,
                version: '{api-version}'
            });

            FB.AppEvents.logPageView();

        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</head>

<body>
    <!-- OUTER BG WRAPPER -->
    <div class="bg-outer-wrapper float-left w-100">
        @if(Auth::check() && Auth::user()->da_duyet == 1 && Auth::user()->da_thanh_toan == "0")
        <div class="w-100 float-left top-bar-con main-box">
            <div class="container">
                <div class="top-bar-inner-con d-flex align-items-center justify-content-between">
                    <div class="left-con">
                        Để sử dụng chức năng của công ty du lịch (phí 299K)
                    </div>
                    <div class="right-con">
                        <a href="/payment">
                            Thanh toán ngay
                        </a>
                        <!-- right con -->
                    </div>
                    <!-- top bar inner con -->
                </div>
                <!-- container -->
            </div>
            <!-- top bar con -->
        </div>
        @endif

        <div class="clearfix"></div>
        <!-- HEADER SECTION -->
        <header class="w-100 flaot-left header-con main-box position-relative">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="/">
                        <figure class="mb-0">
                            <img src="/template/home/images/logo-icon.png" alt="logo-icon">
                        </figure>
                    </a>
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link p-0" href="/">Trang chủ</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link p-0" href="/gioi-thieu">Giới thiệu</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link p-0 dropdown-toggle" href="#" data-toggle="dropdown">Các địa điểm</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/dia-diem">Tất cả địa điểm</a>
                                    @foreach($loaiDiaDiemList as $item)
                                    <a class="dropdown-item" href="/dia-diem?loai_dia_diem={{ $item->ma_loai_dia_diem }}">{{ $item->ten_loai_dia_diem }}</a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link p-0 dropdown-toggle" href="#" data-toggle="dropdown">Tour</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/bai-viet-cty-du-lich">Các chuyến đi</a>
                                    <a class="dropdown-item" href="/danh-sach-cty-du-lich">Công ty du lịch</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link p-0 dropdown-toggle" href="#" data-toggle="dropdown">Danh mục</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/dia-diem">Tất cả danh mục</a>
                                    @foreach($dmDuLichList as $item)
                                    <a class="dropdown-item" href="/dia-diem?danh_muc={{ $item->ma_danh_muc }}">{{ $item->ten_danh_muc }}</a>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                        <div class="header-contact">
                            <ul class="list-unstyled d-flex align-items-center gap-2 mb-0">
                                @if(Auth::check())
                                <li class="me-2">
                                    <a href="/gio-hang" class="btn btn-primary position-relative">
                                        <i class="bi bi-cart"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ $productCount ?? 0 }}
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <div class="nav-item dropdown">
                                        <a class="nav-link p-0 dropdown-toggle" href="#" data-toggle="dropdown">{{ Auth::user()->ten_tai_khoan }}</a>
                                        <div class="dropdown-menu">
                                            @if(Auth::user()->ma_loai_tai_khoan == '1')
                                            <a class="dropdown-item" href="/admin/bang-dieu-khien">Quản trị viên</a>
                                            @endif

                                            @if(Auth::user()->ma_loai_tai_khoan == '2' && Auth::user()->da_thanh_toan == '1')
                                            <a class="dropdown-item" href="/admin/bai-viet">Bài viết</a>
                                            @endif

                                            <!-- @if(Auth::user()->da_thanh_toan == '0')
                                            <a class="dropdown-item" href="/payment">Thanh toán ngay (100K)</a>
                                            @endif -->

                                            <a class="dropdown-item" href="/auth/logout">Đăng xuất</a>
                                        </div>

                                    </div>
                                </li>
                                @else
                                <li>
                                    <a href="/auth/login" class="live-chat-btn d-inline-block">
                                        <i class="fa-solid fa-comment-dots"></i>
                                        <span>Đăng nhập</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <!--  -->
                    </div>
                </nav>
                <!-- container -->
            </div>
            <!-- header-con -->
        </header>

        @yield('content')
    </div>

    <!-- FOOTER SECTION -->
    <section class="float-left w-100 position-relative main-box footer-con" style="padding: 16px">
        <img alt="vector" class="vector8 img-fluid position-absolute" src="/template/home/images/vector8.png">
        <div class="container">
            <!-- <div class="partner-con">
                <ul class="mb-0 list-unstyled d-flex align-items-center justify-content-between">
                    <li>
                        <figure class="mb-0">
                            <img class="img-fluid" src="/template/home/images/partner-logo-1.png" alt="icon">
                        </figure>
                    </li>
                    <li>
                        <figure class="mb-0">
                            <img class="img-fluid" src="/template/home/images/partner-logo-2.png" alt="icon">
                        </figure>
                    </li>
                    <li class="img-mb">
                        <figure class="mb-0">
                            <img class="img-fluid" src="/template/home/images/partner-logo-3.png" alt="icon">
                        </figure>
                    </li>
                    <li>
                        <figure class="mb-0">
                            <img class="img-fluid" src="/template/home/images/partner-logo-4.png" alt="icon">
                        </figure>
                    </li>
                    <li>
                        <figure class="mb-0">
                            <img class="img-fluid" src="/template/home/images/partner-logo-5.png" alt="icon">
                        </figure>
                    </li>
                    <li>
                        <figure class="mb-0">
                            <img class="img-fluid" src="/template/home/images/partner-logo-6.png" alt="icon">
                        </figure>
                    </li>
                </ul>
                <!- partner con -->
            <!-- </div> -->
            <div class="middle-portion">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 d-sm-block">
                        <div class="icon">
                            <h4 class="heading">Liên hệ</h4>
                            <hr class="line">
                            <ul class="list-unstyled mb-0">
                                <li class="text-size-16 text"><span class="d-inline-block">Email:</span> <a href="mailto:info@traveltrek.com" class="mb-0 text text-decoration-nonetext-size-16">info@TraVinh.com</a></li>
                                <li class="text-size-16 text"><span class="d-inline-block">Phone:</span> <a href="tel:+12345678900" class="mb-0 text text-decoration-nonetext-size-16">099 9284 284</a></li>
                                <li class="text-size-16 text1"><span class="d-inline-block">Facebook:</span> <a href="tel:+1(987)65432199" class="mb-0 text text-decoration-nonetext-size-16">Du lịch Trà Vinh</a></li>
                                <!-- <li class="social-icons">
                                    <div class="circle"><a href="https://www.facebook.com/login/"><i class="fa-brands fa-square-facebook"></i></a></div>
                                    <div class="circle"><a href="https://twitter.com/i/flow/login"><i class="fa-brands fa-square-x-twitter"></i></a></div>
                                    <div class="circle"><a href="https://www.linkedin.com/login"><i class="fa-brands fa-linkedin"></i></a>
                                    </div>
                                    <div class="circle"><a href="https://www.pinterest.com/"><i class="fa-brands fa-square-pinterest"></i></a></div>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer con -->
    </section>

    @include('sweetalert::alert')
    <!-- BACK TO TOP BUTTON -->
    <button id="back-to-top-btn" title="Back to Top"></button>
    <script src="/template/home/js/jquery.min.js"></script>
    <script src="/template/home/js/popper.min.js"></script>
    <script src="/template/home/js/bootstrap.min.js"></script>
    <script src="/template/home/js/owl.carousel.js"></script>
    <script src="/template/home/js/contact-form.js"></script>
    <script src="/template/home/js/video-popup.js"></script>
    <script src="/template/home/js/video-section.js"></script>
    <script src="/template/home/js/jquery.validate.js"></script>
    <script src="/template/home/js/wow.js"></script>
    <script src="/template/home/js/counter.js"></script>
    <script src="/template/home/js/custom.js"></script>
    <script src="/template/home/js/search.js"></script>
</body>

</html>