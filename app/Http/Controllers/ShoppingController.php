<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\DanhMucDuLich;
use App\Models\DiaDiem;
use App\Models\gio_hangs;
use App\Models\LoaiDiaDiem;
use App\Models\OrderDetail;
use App\Models\QuanHuyen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingController extends Controller
{
    public function index(){
        $baiVietList = BaiViet::orderBy('luot_xem_bai_viet', 'desc')->paginate(6);
        $diaDiemList = DiaDiem::orderBy('updated_at', 'desc')->get();
        $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();
        $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();
        $quanHuyenList = QuanHuyen::get();

        $cart = session()->get('cart', []);
        foreach ($cart as &$item) {
            // Lấy thông tin bài viết từ bảng BaiViet bằng ma_bai_viet
            $product = BaiViet::find($item['ma_bai_viet']);
            if ($product) {
                $item['product_name'] = $product->ten_bai_viet;  // Lấy tên sản phẩm
                $item['image'] = $product->hinh_anh_bai_viet;  // Lấy ảnh sản phẩm nếu cần
                $item['price'] = $product->gia_thanh;
                $item['quantity'] = $item['quantity'];
            }
        }

        return view('shopping.ordersshow',compact('cart'),[
            'title'       => 'Chi tiết đơn hàng',
            'diaDiemList'     => $diaDiemList,
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'dmDuLichList'    => $dmDuLichList,
            'quanHuyenList'   => $quanHuyenList,
        ]);
    }

    public function submit_form(Request $request) {
        $cart = session()->get('cart', []);
        $user = auth()->user();
        $gioHangs = gio_hangs::where('ma_tai_khoan', $user->ma_tai_khoan)->get();
        foreach ($gioHangs as $gioHang) {
            $orderId = $gioHang->id;
        }  
        foreach ($cart as $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $orderId;
            $orderDetail->ma_bai_viet = $item['ma_bai_viet'];
            $orderDetail->quantity = $item['quantity'];
            $orderDetail->unit_price = $item['price'];
            $orderDetail->total_price = $item['quantity'] * $item['price'];
            $orderDetail->save();
        }

        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Chi tiết đơn hàng đã được lưu thành công.');
    }

    public function adminShow(){
        $baiVietList = BaiViet::orderBy('luot_xem_bai_viet', 'desc')->paginate(6);
        $diaDiemList = DiaDiem::orderBy('updated_at', 'desc')->get();
        $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();
        $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();
        $quanHuyenList = QuanHuyen::get();

        $orderDetails = DB::table('order_details')
        ->join('gio_hangs', 'order_details.order_id', '=', 'gio_hangs.id')
        ->join('bai_viets', 'order_details.ma_bai_viet', '=', 'bai_viets.ma_bai_viet')
        ->join('tai_khoans', 'gio_hangs.ma_tai_khoan', '=', 'tai_khoans.ma_tai_khoan') 
        ->select('order_details.*', 'bai_viets.ten_bai_viet', 'tai_khoans.ten_tai_khoan', 'tai_khoans.sdt', 'tai_khoans.email')
        ->get();

        return view('admin.don_hang.index',compact('orderDetails'),[
            'title'       => 'Đơn hàng',
            'diaDiemList'     => $diaDiemList,
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'dmDuLichList'    => $dmDuLichList,
            'quanHuyenList'   => $quanHuyenList,
        ]);
    }
}
