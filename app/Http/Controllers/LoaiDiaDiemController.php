<?php

namespace App\Http\Controllers;

use App\Models\LoaiDiaDiem;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LoaiDiaDiemController extends Controller
{
    public function index(Request $req)
    {
        $loaiDiaDiemList = LoaiDiaDiem::where('ten_loai_dia_diem', 'like', '%' . $req['q'] . '%')
            ->paginate(10);

        return view('admin.loai-dia-diem.index', [
            'title'           => 'Loại địa điểm',
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'keyword'         => $req['q'],
        ]);
    }

    public function add()
    {
        return view('admin.loai-dia-diem.add', [
            'title' => 'Thêm loại địa điểm',
        ]);
    }

    public function store(Request $req)
    {
        LoaiDiaDiem::create($req->input());
        Alert::success('Thông báo', 'Thêm loại địa điểm thành công');
        return redirect('/admin/loai-dia-diem/');
    }

    public function edit(LoaiDiaDiem $loaiDiaDiem)
    {
        return view('admin.loai-dia-diem.edit', [
            'title'       => 'Chỉnh sửa loại địa điểm',
            'loaiDiaDiem' => $loaiDiaDiem,
        ]);
    }

    public function update(LoaiDiaDiem $loaiDiaDiem, Request $req)
    {
        $loaiDiaDiem->update($req->input());
        Alert::success('Thông báo', 'Chỉnh sửa loại địa điểm thành công');
        return redirect('/admin/loai-dia-diem/');
    }

    public function destroy(Request $req)
    {
        LoaiDiaDiem::where('ma_loai_dia_diem', $req['id'])->delete();
        Alert::success('Thông báo', 'Xoá loại địa điểm thành công');
        return redirect()->back();
    }
}
