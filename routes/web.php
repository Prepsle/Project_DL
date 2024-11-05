<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\DanhMucDuLichController;
use App\Http\Controllers\DiaDiemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoaiDiaDiemController;
use App\Http\Controllers\QuanHuyenController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\XaPhuongController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/dia-diem', 'locDiaDiem');
    Route::get('/chi-tiet-dia-diem/{diaDiem}', 'chiTietDiaDiem');
    Route::get('/bai-viet', 'baiViet');
    Route::get('/bai-viet-cty-du-lich', 'baiVietCtyDuLich');
    Route::get('/danh-sach-cty-du-lich', 'danhSachCtyDuLich');
    Route::get('/bai-viet-cac-chuyen-di', 'baiVietCacChuyenDi');
    Route::get('/chi-tiet-bai-viet/{baiViet}', 'chiTietBaiViet');
    Route::get('/lien-he', 'lienHe');
    Route::get('/gioi-thieu', 'gioiThieu');
    Route::post('/save/comment', 'saveComment');

    Route::get('/auth/login', 'login')->name('login');
    Route::post('/auth/login', 'loginStore');
    Route::get('/auth/registry', 'registry');
    Route::post('/auth/registry', 'registryStore');
    Route::get('/auth/logout', 'logout');

    Route::get('/auth/google', 'google');
    Route::get('/auth/google/callback', 'googleCallback');

    Route::get('/auth/facebook', 'facebook');
    Route::get('/auth/link-facebook', 'facebook');
    Route::get('/auth/facebook/callback', 'facebookCallback');

    Route::get('/payment', 'payment')->middleware('auth');
    Route::get('/payment/callback', 'paymentCallback');
});

# Admin routes
Route::prefix('admin')->controller(AdminController::class)->group(function () {
    Route::get('/bang-dieu-khien', 'dashboard');


    # Admin > Tài khoản routes
    Route::prefix('cong-ty-du-lich')->controller(TaiKhoanController::class)->group(function () {
        Route::get('/', 'indexTourCompany');
    });

    # Admin > Tài khoản routes
    Route::prefix('khach-hang')->controller(TaiKhoanController::class)->group(function () {
        Route::get('/', 'indexCustomer');
    });
});
