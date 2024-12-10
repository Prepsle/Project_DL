<?php

namespace App\Http\Controllers;

use App\Mail\ActiveTravelCompany;
use App\Mail\PaymentTravelCompany;
use App\Models\BaiViet;
use App\Models\BinhLuan;
use App\Models\DanhMucDuLich;
use App\Models\DiaDiem;
use App\Models\gio_hangs;
use App\Models\LoaiDiaDiem;
use App\Models\QuanHuyen;
use App\Models\TaiKhoan;
use App\Models\XaPhuong;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index(Request $req)
    {
        if (Auth::check() && Auth::user()->da_duyet == 1 && Auth::user()->da_thanh_toan == 0) {
            alert()->html('Bạn vui lòng thanh toán?', "
                Phí đăng ký dịch vụ cho công ty du lịch là 299k ( <a href='http://localhost:8000/payment'>tại đây</a>),
                hoặc <a href='http://localhost:8000/auth/logout'>đăng xuất</a>
            ", 'success');
        }

        $baiVietList = BaiViet::orderBy('luot_xem_bai_viet', 'desc')->paginate(6);
        $diaDiemList = DiaDiem::orderBy('updated_at', 'desc')->get();
        $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();
        $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();
        $quanHuyenList = QuanHuyen::get();

        return view('home.index', [
            'title'           => 'Trang chủ',
            'diaDiemList'     => $diaDiemList,
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'dmDuLichList'    => $dmDuLichList,
            'baiVietList'     => $baiVietList,
            'quanHuyenList'   => $quanHuyenList,
        ]);
    }

    public function gioiThieu()
    {
        $diaDiemList = DiaDiem::orderBy('updated_at', 'desc')->get();
        $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();
        $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();

        return view('home.gioi-thieu', [
            'title'           => 'Giới thiệu',
            'diaDiemList'     => $diaDiemList,
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'dmDuLichList'    => $dmDuLichList,
        ]);
    }

    public function locDiaDiem(Request $req)
    {
        $diaDiemList = DiaDiem::where('ten_dia_diem', 'like', '%' . $req['query'] . '%')
            ->when($req['loai_dia_diem'] !== null, function ($query) use ($req) {
                return $query->where('ma_loai_dia_diem', $req['loai_dia_diem']);
            })
            ->when($req['danh_muc'] !== null, function ($query) use ($req) {
                return $query->where('ma_danh_muc', $req['danh_muc']);
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(6);

        if ($req->input('quan_huyen') !== null) {
            $perPage = 10;

            $xaPhuongList = XaPhuong::where('ma_quan_huyen', $req->input('quan_huyen'))
                ->paginate($perPage);

            $diaDiemList = $xaPhuongList->map(function ($xaPhuong) {
                return $xaPhuong->diaDiemList;
            })->flatten();

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $diaDiemList = new LengthAwarePaginator(
                $diaDiemList->forPage($currentPage, $perPage),
                $diaDiemList->count(),
                $perPage,
                $currentPage,
                ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );
        }

        $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();
        $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();
        $quanHuyenList = QuanHuyen::get();

        return view('home.dia-diem', [
            'title'           => 'Địa điểm',
            'diaDiemList'     => $diaDiemList,
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'dmDuLichList'    => $dmDuLichList,
            'quanHuyenList'   => $quanHuyenList,
        ]);
    }

    public function chiTietDiaDiem(DiaDiem $diaDiem)
    {
        $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();
        $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();

        return view('home.chi-tiet-dia-diem', [
            'title'           => $diaDiem->ten_dia_diem,
            'diaDiem'         => $diaDiem,
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'dmDuLichList'    => $dmDuLichList,
        ]);
    }

    public function baiViet(Request $req)
    {
        if ($req['quan_huyen'] !== null) {
            $xaPhuongList = XaPhuong::where('ma_quan_huyen', $req['quan_huyen'])->get();

            $diaDiemLists = $xaPhuongList->map(function ($xaPhuong) {
                return $xaPhuong->diaDiemList;
            });

            $baiVietList = $diaDiemLists->flatten()->map(function ($diaDiem) {
                return $diaDiem->baiVietList;
            });

            $baiVietList = $baiVietList->flatten();
            $baiVietList = $baiVietList->unique('ma_bai_viet');

            $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();
            $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();
            $quanHuyenList = QuanHuyen::get();

            return view('home.bai-viet', [
                'title'           => 'Bài viết',
                'baiVietList'     => $baiVietList,
                'loaiDiaDiemList' => $loaiDiaDiemList,
                'dmDuLichList'    => $dmDuLichList,
                'quanHuyenList'   => $quanHuyenList,
            ]);
        } else {
            $baiVietList = BaiViet::where('ten_bai_viet', 'like', '%' . $req['query'] . '%')->get();
            $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();
            $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();
            $quanHuyenList = QuanHuyen::get();

            return view('home.bai-viet', [
                'title'           => 'Bài viết',
                'baiVietList'     => $baiVietList,
                'loaiDiaDiemList' => $loaiDiaDiemList,
                'dmDuLichList'    => $dmDuLichList,
                'quanHuyenList'   => $quanHuyenList,
            ]);
        }
    }

    public function baiVietCacChuyenDi(Request $req)
    {
        $taiKhoanList = TaiKhoan::where('ma_loai_tai_khoan', 1)->get();

        $baiVietList = $taiKhoanList->flatMap(function ($taiKhoan) {
            return $taiKhoan->baiVietList;
        });

        $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();
        $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();
        $quanHuyenList = QuanHuyen::get();

        return view('home.bai-viet-cty-du-lich', [
            'title'           => 'Bài viết của công ty du lịch',
            'baiVietList'     => $baiVietList,
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'dmDuLichList'    => $dmDuLichList,
            'quanHuyenList'   => $quanHuyenList,
        ]);
    }

    public function baiVietCtyDuLich(Request $req)
    {
        $taiKhoanList = TaiKhoan::where('ma_loai_tai_khoan', 2)->get();

        $baiVietList = $taiKhoanList->flatMap(function ($taiKhoan) {
            return $taiKhoan->baiVietList;
        });

        $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();
        $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();
        $quanHuyenList = QuanHuyen::get();

        return view('home.bai-viet-cty-du-lich', [
            'title'           => 'Bài viết của công ty du lịch',
            'baiVietList'     => $baiVietList,
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'dmDuLichList'    => $dmDuLichList,
            'quanHuyenList'   => $quanHuyenList,
        ]);
    }

    public function danhSachCtyDuLich(Request $req)
    {
        $ctyDuLichList = TaiKhoan::where('ten_tai_khoan', 'like', '%' . $req['query'] . '%')
            ->where('ma_loai_tai_khoan', 2)->where('da_duyet', 1)->paginate(6);
        $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();
        $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();

        return view('home.danh-sach-cty-du-lich', [
            'title'           => 'Danh sách công ty du lịch',
            'ctyDuLichList'   => $ctyDuLichList,
            'dmDuLichList'    => $dmDuLichList,
            'loaiDiaDiemList' => $loaiDiaDiemList,
        ]);
    }

    public function chiTietBaiViet(BaiViet $baiViet)
    {
        if ($baiViet) {
            $baiViet->luot_xem_bai_viet++;
            $baiViet->save();

            $baiVietList = collect($baiViet->diaDiemList)->flatMap->baiVietList->unique('ma_bai_viet');
            $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();
            $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();

            return view('home.chi-tiet-bai-viet', [
                'title'           => $baiViet->ten_bai_viet,
                'baiViet'         => $baiViet,
                'baiVietList'     => $baiVietList,
                'loaiDiaDiemList' => $loaiDiaDiemList,
                'dmDuLichList'    => $dmDuLichList,
            ]);
        }
        abort(404);
    }

    public function lienHe()
    {
        $loaiDiaDiemList = LoaiDiaDiem::orderBy('updated_at', 'desc')->get();
        $dmDuLichList = DanhMucDuLich::orderBy('updated_at', 'desc')->get();

        return view('home.lien-he', [
            'title'           => 'Liên hệ',
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'dmDuLichList'    => $dmDuLichList,
        ]);
    }

    public function saveComment(Request $req)
    {
        $req['thoi_gian_binh_luan'] = Carbon::now();
        BinhLuan::create($req->input());
        Alert::success('Bình luận thành công');
        return redirect()->back();
    }

    public function login()
    {
        return view('admin.auth.login', [
            'title' => 'Đăng nhập',
        ]);
    }

    public function loginStore(Request $req)
    {
        $taiKhoan = TaiKhoan::where('sdt', $req['sdt'])->first();

        if ($taiKhoan && $req['mat_khau'] === $taiKhoan->mat_khau) {
            Auth::login($taiKhoan);
            Alert::success('Đăng nhập thành công');
            return redirect('/');
        }
        Alert::error('Tên đăng nhập hoặc mật khẩu không hợp lệ');
        return redirect()->back();
    }

    public function registry()
    {
        return view('admin.auth.registry', [
            'title' => 'Đăng ký',
        ]);
    }

    public function registryStore(Request $req)
    {
        if ($req['mat_khau'] !== $req['nhap_lai_mat_khau']) {
            Alert::error('Mật khẩu không khớp');
            return redirect()->back();
        } else if (TaiKhoan::where('sdt', $req['sdt'])->first()) {
            Alert::error('Số điện thoại đã dùng rồi');
            return redirect()->back();
        } else if (TaiKhoan::where('email', $req['email'])->first()) {
            Alert::error('Email đã dùng rồi');
            return redirect()->back();
        } else {
            if ($req->hasFile('hinh_dai_dien')) {
                $file = $req->file('hinh_dai_dien');
                $newImageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/cty-du-lich/hinh-dai-dien/' . date('Y') . '/' . date('m'), $newImageName);
                $req['hinh_dai_dien'] = str_replace('public/', '/storage/', $path);
            }

            if ($req->hasFile('giay_phep_kd')) {
                $file = $req->file('giay_phep_kd');
                $newImageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/cty-du-lich/giay-phep-kd/' . date('Y') . '/' . date('m'), $newImageName);
                $req['giay_phep_kd'] = str_replace('public/', '/storage/', $path);
            }

            if ($req['ma_loai_tai_khoan'] == 2) {
                $req['da_duyet'] = 0;
                $req['da_thanh_toan'] = 0;
            }
            TaiKhoan::create($req->input());
            if ($req['ma_loai_tai_khoan'] == 2) {
                Mail::to($req['email'])->send(new ActiveTravelCompany());
                Alert::success('Chào mừng bạn đã đến với website của chúng tôi, chúng tôi sẽ xem xét và xử lý nhanh chóng tài khoản của bạn!');
            } else {
                Alert::success('Đăng ký tài khoản thành công');
            }
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        Alert::success('Đăng xuất thành công');
        return redirect('/');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $google = Socialite::driver('google')->user();
        $user = TaiKhoan::where('email', $google->email)->first();

        if ($user) {
            Auth::login($user);
            Alert::success('Đăng nhập thành công');
        } else {
            Alert::success('Email này chưa đăng ký');
        }
        return redirect('/');
    }

    public function facebook()
    {
        Session::put('facebook_url', url()->current());
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback(Request $req)
    {
        $facebook = Socialite::driver('facebook')->user();

        if (Session::get('facebook_url') == 'http://localhost:8000/auth/link-facebook') {
            $user = TaiKhoan::where('ma_tai_khoan', Auth::user()->ma_tai_khoan)->first();
            $user->facebook_id = $facebook->id;
            $user->save();
            Alert::success('Liên kết tài khoản Facebook thành công');
            return redirect()->back();
        } else {
            $user = TaiKhoan::where('facebook_id', $facebook->id)->first();
            if ($user) {
                Auth::login($user);
                Alert::success('Đăng nhập thành công');
                return redirect('/');
            } else {
                Alert::error('Tài khoản Facebook này chưa đăng ký');
                return redirect()->back();
            }
        }
    }

    public function payment()
    {
        $vnp_TmnCode = 'NRV50IUJ'; // Mã website tại VNPAY
        $vnp_HashSecret = 'AHM71S5BXN3SDTWCROER5VP5X8LB693S'; // Chuỗi bí mật
        $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
        $vnp_Returnurl = 'http://localhost:8000/payment/callback';
        $vnp_TxnRef = time(); // Mã giao dịch
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 299000 * 100; // Số tiền thanh toán
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = [
            'vnp_Version'    => '2.1.0',
            'vnp_TmnCode'    => $vnp_TmnCode,
            'vnp_Amount'     => $vnp_Amount,
            'vnp_Command'    => 'pay',
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_CurrCode'   => 'VND',
            'vnp_IpAddr'     => $vnp_IpAddr,
            'vnp_Locale'     => $vnp_Locale,
            'vnp_OrderInfo'  => $vnp_OrderInfo,
            'vnp_OrderType'  => $vnp_OrderType,
            'vnp_ReturnUrl'  => $vnp_Returnurl,
            'vnp_TxnRef'     => $vnp_TxnRef,
        ];

        if (isset($vnp_BankCode) && $vnp_BankCode != '') {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = '';
        $i = 0;
        $hashdata = '';
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . '=' . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . '=' . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . '=' . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . '?' . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

    public function paymentCallback(Request $request)
    {
        $vnp_HashSecret = 'AHM71S5BXN3SDTWCROER5VP5X8LB693S';
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = [];
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == 'vnp_') {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = '';
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = trim($hashData, '&');
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00' && Auth::check()) {
                $user = TaiKhoan::where('ma_tai_khoan', Auth::user()->ma_tai_khoan)->first();
                $user->da_thanh_toan = 1;
                $user->save();
                Alert::success('Thanh toán thành công');
                Mail::to($user->email)->send(new PaymentTravelCompany());
            }
        } else {
            Alert::error('Thanh toán thất bại');
        }
        return redirect('/');
    }

    public function shoppingcart(Request $request){
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
                $item['price'] = $product->gia_thanh;  // Cập nhật giá nếu cần
            }
        }
        $productCount = count($cart);

        return view('shopping.shoppingcart',compact('cart','productCount'),[
            'title'           => 'Giỏ hàng',
            'diaDiemList'     => $diaDiemList,
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'dmDuLichList'    => $dmDuLichList,
            'quanHuyenList'   => $quanHuyenList,
        ]);
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request)
    {
        $userId = auth()->user()->ma_tai_khoan ?? null; // Lấy ID người dùng nếu đã đăng nhập

        // Lấy thông tin sản phẩm từ request
        $product = [
            'ma_tai_khoan' => $userId,
            'ma_bai_viet' => $request->ma_bai_viet,
            'quantity' => $request->quantity ?? 1,
            'price' => $request->price,
        ];
        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
        $existingItem = gio_hangs::where('ma_tai_khoan', $userId)
                                ->where('ma_bai_viet', $product['ma_bai_viet'])
                                ->first();

        if ($existingItem) {
            $existingItem->quantity += $product['quantity'];
            $existingItem->save();
        } else {
            gio_hangs::create($product);
        }

        $cart = gio_hangs::where('ma_tai_khoan', $userId)->get();

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }


    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function update(Request $request)
    {
        // Xác thực input
        $request->validate([
            'id' => 'required|integer|exists:gio_hangs,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Kiểm tra sản phẩm có tồn tại không
        $cartItem = gio_hangs::findOrFail($request->id);
        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng.'], 404);
        }

        // Cập nhật số lượng sản phẩm
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        // Lấy lại toàn bộ giỏ hàng từ DB
        $userId = auth()->user()->ma_tai_khoan ?? null; // Lấy ID người dùng
        $cart = gio_hangs::where('ma_tai_khoan', $userId)->get();

        // Cập nhật session giỏ hàng
        session()->put('cart', $cart);

        // Lấy tổng số lượng và tổng giá của giỏ hàng
        $cart = gio_hangs::all();
        $totalQuantity = $cart->sum('quantity');
        $newPrice = (float)$cartItem->price * $cartItem->quantity;

        // Trả về phản hồi JSON
        return response()->json([
            'success' => true,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => number_format($newPrice, 0, ',', '.'),
        ]);
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        }

        return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
    }

    // Xóa toàn bộ giỏ hàng
    public function clear()
    {
        DB::table('order_details')->delete();
        // Xóa toàn bộ giỏ hàng của người dùng trong cơ sở dữ liệu (dùng delete thay vì truncate)
        gio_hangs::query()->delete();  // Cách này sẽ xóa tất cả các bản ghi trong bảng gio_hangs.

        // Xóa giỏ hàng khỏi session (nếu đang sử dụng session)
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được xóa.');
    }
}
