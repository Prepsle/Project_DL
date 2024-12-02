<?php

namespace App\Http\Controllers;

use App\Models\QuanHuyen;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class QuanHuyenController extends Controller
{
    public function index(Request $req)
    {
        $quanHuyenList = QuanHuyen::where('ten_quan_huyen', 'like', '%' . $req['q'] . '%')
            ->paginate(10);

        return view('admin.quan-huyen.index', [
            'title'         => 'Quận huyện',
            'quanHuyenList' => $quanHuyenList,
            'keyword'       => $req['q'],
        ]);
    }

    public function add()
    {
        return view('admin.quan-huyen.add', [
            'title' => 'Thêm quận huyện',
        ]);
    }

    public function store(Request $req)
    {
        QuanHuyen::create($req->input());
        Alert::success('Thông báo', 'Thêm quận huyện thành công');
        return redirect('/admin/quan-huyen/');
    }

    public function edit(QuanHuyen $quanHuyen)
    {
        return view('admin.quan-huyen.edit', [
            'title'     => 'Chỉnh sửa quận huyện',
            'quanHuyen' => $quanHuyen,
        ]);
    }

    public function update(QuanHuyen $quanHuyen, Request $req)
    {
        $quanHuyen->update($req->input());
        Alert::success('Thông báo', 'Chỉnh sửa quận huyện thành công');
        return redirect('/admin/quan-huyen/');
    }

    public function destroy(Request $req)
    {
        QuanHuyen::where('ma_quan_huyen', $req['id'])->delete();
        Alert::success('Thông báo', 'Xoá quận huyện thành công');
        return redirect()->back();
    }
}
