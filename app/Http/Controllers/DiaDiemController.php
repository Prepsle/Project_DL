<?php

namespace App\Http\Controllers;

use App\Models\DanhMucDuLich;
use App\Models\DiaDiem;
use App\Models\LoaiDiaDiem;
use App\Models\XaPhuong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DiaDiemController extends Controller
{
    public function index(Request $req)
    {
        $diaDiemList = DiaDiem::where('ten_dia_diem', 'like', '%' . $req['q'] . '%')
            ->paginate(10);

        return view('admin.dia-diem.index', [
            'title'       => 'Danh sách địa điểm',
            'diaDiemList' => $diaDiemList,
            'keyword'     => $req['q'],
        ]);
    }

    public function add()
    {
        $loaiDiaDiemList = LoaiDiaDiem::get();
        $dmDuLichList = DanhMucDuLich::get();
        $xaPhuongList = XaPhuong::get();

        return view('admin.dia-diem.add', [
            'title'           => 'Thêm địa điểm',
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'dmDuLichList'    => $dmDuLichList,
            'xaPhuongList'    => $xaPhuongList,
        ]);
    }

    public function store(Request $req)
    {
        if ($req['mo_ta_dia_diem'] == '') {
            Alert::error('Vui lòng thêm mô tả đia điểm');
            return redirect()->back();
        }

        // Add thumbnail
        if ($req->hasFile('hinh_anh_dia_diem')) {
            $file = $req->file('hinh_anh_dia_diem');
            $newImageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/dia-diem/' . date('Y') . '/' . date('m'), $newImageName);
            $req['hinh_anh_dia_diem'] = str_replace('public/', '/storage/', $path);
        } else {
            Alert::error('Vui lòng thêm hình ảnh địa điểm');
            return redirect()->back();
        }
        DiaDiem::create($req->input());
        Alert::success('Thêm địa điểm thành công');
        return redirect('/admin/dia-diem');
    }

    public function edit(DiaDiem $diaDiem)
    {
        $loaiDiaDiemList = LoaiDiaDiem::get();
        $dmDuLichList = DanhMucDuLich::get();
        $xaPhuongList = XaPhuong::get();

        return view('admin.dia-diem.edit', [
            'title'           => 'Chỉnh sửa địa điểm',
            'diaDiem'         => $diaDiem,
            'loaiDiaDiemList' => $loaiDiaDiemList,
            'dmDuLichList'    => $dmDuLichList,
            'xaPhuongList'    => $xaPhuongList,
        ]);
    }

    public function update(Request $req, DiaDiem $diaDiem)
    {
        // Add thumbnail
        if ($req->hasFile('hinh_anh_dia_diem')) {
            // Delete old images
            Storage::disk('public')->delete(str_replace('/storage/', '', $diaDiem->hinh_anh_dia_diem));

            // Add new images
            $file = $req->file('hinh_anh_dia_diem');
            $newImageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/dia-diem/' . date('Y') . '/' . date('m'), $newImageName);
            $req['hinh_anh_dia_diem'] = str_replace('public/', '/storage/', $path);
        }
        $diaDiem->update($req->input());
        Alert::success('Chỉnh sửa địa điểm thành công');
        return redirect('/admin/dia-diem');
    }

    public function destroy(Request $req)
    {
        $diaDiem = DiaDiem::where('ma_dia_diem', $req['id'])->first();

        // Delete old images
        Storage::disk('public')->delete(str_replace('/storage/', '', $diaDiem->hinh_anh_dia_diem));

        $diaDiem->delete();
        Alert::success('Xóa địa điểm thành công');
        return redirect()->back();
    }
}