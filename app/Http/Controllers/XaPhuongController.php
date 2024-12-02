<?php

namespace App\Http\Controllers;

use App\Models\QuanHuyen;
use App\Models\XaPhuong;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class XaPhuongController extends Controller
{
    public function index(Request $req)
    {
        $xaPhuongList = XaPhuong::where('ten_xa_phuong', 'like', '%' . $req['q'] . '%')
            ->paginate(10);

        return view('admin.xa-phuong.index', [
            'title'        => 'Xã phường',
            'xaPhuongList' => $xaPhuongList,
            'keyword'      => $req['q'],
        ]);
    }

    public function add()
    {
        $quanHuyenList = QuanHuyen::get();

        return view('admin.xa-phuong.add', [
            'title'         => 'Thêm xã phường',
            'quanHuyenList' => $quanHuyenList,
        ]);
    }

    public function store(Request $req)
    {
        XaPhuong::create($req->input());
        Alert::success('Thông báo', 'Thêm xã phường thành công');
        return redirect('/admin/xa-phuong/');
    }

    public function edit(XaPhuong $xaPhuong)
    {
        $quanHuyenList = QuanHuyen::get();

        return view('admin.xa-phuong.edit', [
            'title'         => 'Chỉnh sửa xã phường',
            'xaPhuong'      => $xaPhuong,
            'quanHuyenList' => $quanHuyenList,
        ]);
    }

    public function update(XaPhuong $xaPhuong, Request $req)
    {
        $xaPhuong->update($req->input());
        Alert::success('Thông báo', 'Chỉnh sửa xã phường thành công');
        return redirect('/admin/xa-phuong/');
    }

    public function destroy(Request $req)
    {
        XaPhuong::where('ma_xa_phuong', $req['id'])->delete();
        Alert::success('Thông báo', 'Xoá xã phường thành công');
        return redirect()->back();
    }
}
