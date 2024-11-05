<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\BinhLuan;
use App\Models\DiaDiem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BaiVietController extends Controller
{
    public function index(Request $req)
    {
        $baiVietList = [];
        if (Auth::user()->ma_loai_tai_khoan == '1') {
            $baiVietList = BaiViet::where('ten_bai_viet', 'like', '%' . $req['q'] . '%')
                ->when(isset($req['q']), function ($query) use ($req) {
                    return $query->where('ten_bai_viet', 'like', '%' . $req['q'] . '%');
                })
                ->when(isset($req['start_date']) && isset($req['end_date']), function ($query) use ($req) {
                    $startDate = Carbon::parse($req['start_date'])->format('Y-m-d');
                    $endDate = Carbon::parse($req['end_date'])->format('Y-m-d');
                    return $query->whereBetween(DB::raw('DATE(ngay_dang_bai_viet)'), [$startDate, $endDate]);
                })
                ->paginate(10);
        } else if (Auth::user()->ma_loai_tai_khoan == '2') {
            $baiVietList = BaiViet::where('nguoi_dang_bai_viet', Auth::user()->ma_tai_khoan)
                ->when(isset($req['q']), function ($query) use ($req) {
                    return $query->where('ten_bai_viet', 'like', '%' . $req['q'] . '%');
                })
                ->when(isset($req['start_date']) && isset($req['end_date']), function ($query) use ($req) {
                    $startDate = Carbon::parse($req['start_date'])->format('Y-m-d');
                    $endDate = Carbon::parse($req['end_date'])->format('Y-m-d');
                    return $query->whereBetween(DB::raw('DATE(ngay_dang_bai_viet)'), [$startDate, $endDate]);
                })
                ->paginate(10);
        }

        return view('admin.bai-viet.index', [
            'title'       => 'Danh sách bài viết',
            'baiVietList' => $baiVietList,
            'keyword'     => $req['q'],
            'start_date'  => $req['start_date'],
            'end_date'    => $req['end_date'],
        ]);
    }

    public function add()
    {
        $diaDiemList = DiaDiem::get();

        return view('admin.bai-viet.add', [
            'title'       => 'Thêm bài viết',
            'diaDiemList' => $diaDiemList,
        ]);
    }

    public function store(Request $req)
    {
        

        // Add thumbnail
        if ($req->hasFile('hinh_anh_bai_viet')) {
            $file = $req->file('hinh_anh_bai_viet');
            $newImageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/bai-viet/' . date('Y') . '/' . date('m'), $newImageName);
            $req['hinh_anh_bai_viet'] = str_replace('public/', '/storage/', $path);
        }
        //else {
        //     Alert::error('Vui lòng thêm hình ảnh bài viết');
        //     return redirect()->back();
        // }
        // // DiaDiem::create($req->input());
        // Alert::success('Thêm bài viết thành công');
        // return redirect('/admin/bai-viet');
    

        $req['ngay_dang_bai_viet'] = Carbon::now();
        $req['nguoi_dang_bai_viet'] = Auth::user()->ma_tai_khoan;
        $baiViet = BaiViet::create($req->input());

        $baiViet->diaDiemList()->sync($req['ma_dia_diem']);

        Alert::success('Thêm bài viết thành công');
        return redirect('/admin/bai-viet');
    }

    public function edit(BaiViet $baiViet)
    {
        $diaDiemList = DiaDiem::get();

        return view('admin.bai-viet.edit', [
            'title'       => 'Chỉnh sửa bài viết',
            'baiViet'     => $baiViet,
            'diaDiemList' => $diaDiemList,
        ]);
    }

    public function update(Request $req, BaiViet $baiViet)
    {
        // Add thumbnail
        if ($req->hasFile('hinh_anh_bai_viet')) {
            // Delete old images
            Storage::disk('public')->delete(str_replace('/storage/', '', $baiViet->hinh_anh_bai_viet));

            // Add new images
            $file = $req->file('hinh_anh_bai_viet');
            $newImageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/bai-viet/' . date('Y') . '/' . date('m'), $newImageName);
            $req['hinh_anh_bai_viet'] = str_replace('public/', '/storage/', $path);
        }
        $baiViet->update($req->input());
        $baiViet->diaDiemList()->sync($req['ma_dia_diem']);
        Alert::success('Chỉnh sửa bài viết thành công');
        return redirect('/admin/bai-viet');
    }

    public function destroy(Request $req)
    {
        $baiViet = BaiViet::where('ma_bai_viet', $req['id'])->first();

        // Delete old images
        Storage::disk('public')->delete(str_replace('/storage/', '', $baiViet->hinh_anh_bai_viet));

        $baiViet->delete();
        Alert::success('Xóa bài viết thành công');
        return redirect()->back();
    }

    public function viewComment(BaiViet $baiViet, Request $req)
    {
        if ($req['action'] === 'update') {
            $binhLuan = BinhLuan::where('ma_binh_luan', $req['ma_binh_luan'])
                ->first();
            $binhLuan->trang_thai_binh_luan = $req['trang_thai_binh_luan'];
            $binhLuan->save();

            return redirect()->back();
        }

        return view('admin.bai-viet.view-comment', [
            'title'                => 'Bình luận bài viết',
            'baiViet'              => $baiViet,
            'trang_thai_binh_luan' => $req['trang_thai_binh_luan'],
        ]);
    }
}
