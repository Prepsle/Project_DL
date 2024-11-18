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
                    <h4>Các công ty du lịch</h4>
                    <p class="font-size-20">Nhiều đơn vị du lịch uy tín mà bạn có thể tin tưởng lựa chọn. </p>
                    
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
                    <div class="col-md-12 mb-5 d-flex justify-content-end">
                        <form style="width: 50%" method="GET" class="input-group">
                            <input type="text" class="form-control" name="query">
                            <button class="btn btn-outline-primary">Tìm</button>
                        </form>
                    </div>
                    @foreach($ctyDuLichList as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-aos="fade-up" data-aos-duration="700">
                        <div class="blog-box blog-box1">
                            <figure class="blog-image mb-0">
                                <img src="{{ $item->hinh_dai_dien }}" alt="{{ $item->ten_tai_khoan }}" class="img-fluid" loading="lazy">
                            </figure>
                            <div class="lower-portion">
                                <a>
                                    <h5 class="two-line">{{ $item->ten_tai_khoan }}</h5>
                                </a>
                                <div>
                                    <div class="date">
                                        <i class="fas fa-phone-volume"></i>
                                        <span class="mb-0 text-size-14">{{ $item->sdt }}</span>
                                    </div>
                                    <div class="date">
                                        <i class="fas fa-envelope"></i>
                                        <span class="mb-0 text-size-14">{{ $item->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="button-portion ">
                                <div class="date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Tham gia vào:</span>
                                </div>
                                <div class="date">
                                    <span class="mb-0 text-size-14">{{ App\Helpers\Helper::DateTime($item->created_at, 'date') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row d-flex align-items-center justify-content-between">
                    {!! $ctyDuLichList->links() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection