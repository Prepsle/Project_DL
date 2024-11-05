<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\DiaDiem;
use App\Models\LoaiDiaDiem;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $req)
    {
        return view('admin.bang-dieu-khien.index', [
            'title'   => 'Tổng quan',
            'counter' => [
                'diaDiem'     => DiaDiem::count(),
                'loaiDiaDiem' => LoaiDiaDiem::count(),
                'khachHang'   => TaiKhoan::where('ma_loai_tai_khoan', '3')->count(),
                'baiViet'     => BaiViet::count(),
            ],
        ]);
    }
}
