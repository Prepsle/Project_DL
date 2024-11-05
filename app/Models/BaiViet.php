<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    use HasFactory;

    protected $primaryKey = 'ma_bai_viet';

    protected $fillable = [
        'ma_bai_viet',
        'ten_bai_viet',
        'mo_ta_ngan',
        'noi_dung_bai_viet',
        'hinh_anh_bai_viet',
        'ngay_dang_bai_viet',
        'luot_xem_bai_viet',
        'nguoi_dang_bai_viet',
    ];

    public function nguoiDangBaiViet()
    {
        return $this->hasOne('App\Models\TaiKhoan', 'ma_tai_khoan', 'nguoi_dang_bai_viet');
    }

    public function binhLuanList($trang_thai_binh_luan = '')
    {
        if ($trang_thai_binh_luan == '') {
            return $this->hasMany('App\Models\BinhLuan', 'ma_bai_viet', 'ma_bai_viet');
        } else {
            return $this->hasMany('App\Models\BinhLuan', 'ma_bai_viet', 'ma_bai_viet')->where('trang_thai_binh_luan', $trang_thai_binh_luan)->get();
        }
    }

    public function diaDiemList()
    {
        return $this->belongsToMany('App\Models\DiaDiem', 'dia_diem_bai_viets', 'ma_bai_viet', 'ma_dia_diem');
    }
}
