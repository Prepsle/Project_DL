<?php

namespace App\Http\Controllers;

use App\Mail\NofiTravelCompany;
use App\Mail\PaymentTravelCompany;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaiKhoanController extends Controller
{
    public function indexTourCompany(Request $req)
    {
        if (isset($req['ma_tai_khoan']) && isset($req['active'])) {
            $user = TaiKhoan::where('ma_tai_khoan', $req['ma_tai_khoan'])->first();
            if ($user) {
                if ($req['active'] == '1') {
                    $user['da_duyet'] = 1;
                    $user->save();
                    Mail::to($user->email)->send(new NofiTravelCompany('Tài khoản của bạn đã được xác nhận. Vui lòng đăng nhập vào website để tiến hành thanh toán'));
                } else {
                    $user->delete();
                    Mail::to($user->email)->send(new NofiTravelCompany('Có thể bạn chưa cung cấp đủ thông tin cho thấy bạn là một công ty du lịch nên chúng tôi chưa thể xác nhận tài khoản của bạn.Đồng thời chúng tôi cũng tiến hành xoá bỏ thông tin tài khoản của bạn,bạn vui lòng đăng ký lại với đầy đủ thông tin'));
                }
            }

            return redirect('/admin/cong-ty-du-lich');
        }

        $congTyDuLichList = TaiKhoan::where('ma_loai_tai_khoan', 2)
            ->where('ten_tai_khoan', 'like', '%' . $req['q'] . '%')
            ->paginate(10);

        return view('admin.cong-ty-du-lich.index', [
            'title'            => 'Công ty du lịch',
            'congTyDuLichList' => $congTyDuLichList,
            'keyword'          => $req['q'],
        ]);
    }

    public function indexCustomer(Request $req)
    {
        $khachHangList = TaiKhoan::where('ma_loai_tai_khoan', 3)
            ->where('ten_tai_khoan', 'like', '%' . $req['q'] . '%')
            ->paginate(10);

        return view('admin.khach-hang.index', [
            'title'         => 'Khách hàng',
            'khachHangList' => $khachHangList,
            'keyword'       => $req['q'],
        ]);
    }
}
