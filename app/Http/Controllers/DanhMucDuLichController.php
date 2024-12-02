<?php

namespace App\Http\Controllers;

use App\Models\DanhMucDuLich;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DanhMucDuLichController extends Controller
{
    public function index(Request $req)
    {
        $danhMucDuLichList = DanhMucDuLich::where('ten_danh_muc', 'like', '%' . $req['q'] . '%')
            ->paginate(10);

        return view('admin.danh-muc-du-lich.index', [
            'title'             => 'Danh mục du lịch',
            'danhMucDuLichList' => $danhMucDuLichList,
            'keyword'           => $req['q'],
        ]);
    }

    public function add()
    {
        return view('admin.danh-muc-du-lich.add', [
            'title' => 'Thêm danh mục du lịch',
        ]);
    }

    public function store(Request $req)
    {
        DanhMucDuLich::create($req->input());
        Alert::success('Thông báo', 'Thêm danh mục du lịch thành công');
        return redirect('/admin/danh-muc-du-lich/');
    }

    public function edit(DanhMucDuLich $dmDuLich)
    {
        return view('admin.danh-muc-du-lich.edit', [
            'title'    => 'Chỉnh sửa danh mục du lịch',
            'dmDuLich' => $dmDuLich,
        ]);
    }

    public function update(DanhMucDuLich $dmDuLich, Request $req)
    {
        $dmDuLich->update($req->input());
        Alert::success('Thông báo', 'Chỉnh sửa danh mục du lịch thành công');
        return redirect('/admin/danh-muc-du-lich/');
    }

    public function destroy(Request $req)
    {
        DanhMucDuLich::where('ma_danh_muc', $req['id'])->delete();
        Alert::success('Thông báo', 'Xoá danh mục du lịch thành công');
        return redirect()->back();
    }
}
