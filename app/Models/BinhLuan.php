<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;

    protected $primaryKey = 'ma_binh_luan';

    protected $fillable = [
        'ma_binh_luan',
        'chi_tiet_binh_luan',
        'thoi_gian_binh_luan',
        'trang_thai_binh_luan',
        'ma_tai_khoan',
        'ma_bai_viet',
    ];

    public function taiKhoan()
    {
        return $this->hasOne('App\Models\TaiKhoan', 'ma_tai_khoan', 'ma_tai_khoan');
    }

    public function baiViet()
    {
        return $this->hasOne('App\Models\BaiViet', 'ma_bai_viet', 'ma_bai_viet');
    }
}
