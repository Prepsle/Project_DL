<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="icon" href="/template/home/images/favicon.png">

    <!-- Custom fonts for this template-->
    <link href="/template/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- InternalFileupload css-->
    <link rel="stylesheet" href="/template/admin/vendor/fileuploads/css/fileupload.css" />
    <!-- summernote -->
    <link rel="stylesheet" href="/template/admin/vendor/summernote/summernote-bs4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/template/admin/vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="/template/admin/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Custom styles for this template-->
    <link href="/template/admin/css/sb-admin-2.min.css?id=1" rel="stylesheet">
    <style>
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
    </style>
    <style>
        .note-editable {
            font-family: 'Times New Roman';
            font-size: 13px;
            text-align: justify;
        }
    </style>
    @yield('header')
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon">
                    <img width="40" src="/template/home/images/favicon.png" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">Du lịch</div>
            </a>
            @if(Auth::user()->ma_loai_tai_khoan == '1')
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/bang-dieu-khien/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tổng quan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/quan-huyen/">
                    <i class="fas fa-fw fa-map-marked-alt"></i>
                    <span>Quận / Huyện</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/xa-phuong/">
                    <i class="fas fa-fw fa-map-marked-alt"></i>
                    <span>Xã / Phường</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">Du lịch</div>
            <!-- Divider -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/danh-muc-du-lich/">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Danh mục du lịch</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/loai-dia-diem/">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Loại địa điểm</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/dia-diem/">
                    <i class="fas fa-fw fa-torii-gate"></i>
                    <span>Địa điểm</span>
                </a>
            </li>

            <!-- Heading -->
            <div class="sidebar-heading">Tài khoản</div>
            <!-- Divider -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/khach-hang/">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Thành viên</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/cong-ty-du-lich/">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Công ty du lịch</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->ma_loai_tai_khoan == '1' || Auth::user()->ma_loai_tai_khoan == '2')
            <!-- Heading -->
            <div class="sidebar-heading">Bài viết</div>
            <!-- Divider -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/bai-viet/">
                    <i class="fas fa-fw fa-sticky-note"></i>
                    <span>Bài viết</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/binh-luan/">
                    <i class="fas fa-fw fa-comment"></i>
                    <span>Bình luận</span>
                </a>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->ten_tai_khoan }}</span>
                                <img class="img-profile rounded-circle" src="/template/admin/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                @if(Auth::user()->ma_loai_tai_khoan == '1')
                                <a class="dropdown-item" href="/admin/bang-dieu-khien">Quản trị viên</a>
                                @endif

                                @if(Auth::user()->ma_loai_tai_khoan == '2' && Auth::user()->da_thanh_toan == '1')
                                <a class="dropdown-item" href="/admin/bai-viet">Bài viết</a>
                                @endif

                                @if(Auth::user()->da_thanh_toan == '0')
                                <a class="dropdown-item" href="/payment">Thanh toán ngay (100K)</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/auth/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->

                @yield('content')
            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <!-- <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> -->

    @include('sweetalert::alert')
    <!-- Bootstrap core JavaScript-->
    <script src="/template/admin/vendor/jquery/jquery.min.js"></script>
    <script src="/template/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="/template/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Internal Fileuploads js-->
    <script src="/template/admin/vendor/fileuploads/js/fileupload.js"></script>
    <script src="/template/admin/vendor/fileuploads/js/file-upload.js"></script>
    <!-- Select2 -->
    <script src="/template/admin/vendor/select2/js/select2.full.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="/template/admin/js/sb-admin-2.min.js"></script>
    <!-- Summernote -->
    <script src="/template/admin/vendor/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            $(document).ready(function() {
                $('#summernote').summernote({
                    fontSizes: ['8', '9', '10', '11', '12', '14', '18'],
                    height: 300,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontsize', ['8', '9', '10', '11', '12', '14', '18']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'hr']],
                        ['view', ['fullscreen', 'codeview']],
                        ['help', ['help']]
                    ],
                    callbacks: {
                        onInit: function() {
                            $('.note-editable').css('font-family', 'Times New Roman');
                            $('.note-editable').css('font-size', '13px');
                            $('.note-editable').css('text-align', 'justify');
                        }
                    }
                });
            });

            $('.select2').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
    <!-- Script -->
    <script src="/myscript.js"></script>
    @yield('footer')
</body>

</html>