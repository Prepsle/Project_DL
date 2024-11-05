<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use Illuminate\Http\Request;

class BinhLuanController extends Controller
{
    public function index(Request $req)
    {
        if ($req['action'] === 'update') {
            $binhLuan = BinhLuan::where('ma_binh_luan', $req['ma_binh_luan'])
                ->first();
            $binhLuan->trang_thai_binh_luan = $req['trang_thai_binh_luan'];
            $binhLuan->save();

            return redirect()->back();
        }

        return view('admin.binh-luan.index', [
            'title'                => 'Bình luận',
            'binhLuanList'         => BinhLuan::where('trang_thai_binh_luan', 'cho_xac_nhan')->get(),
            'trang_thai_binh_luan' => $req['trang_thai_binh_luan'],
        ]);
    }
}
