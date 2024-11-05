<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaDiem extends Model
{
    use HasFactory;

    protected $primaryKey = 'ma_dia_diem';

    protected $fillable = [
        'ma_dia_diem',
        'ten_dia_diem',
        'dia_chi',
        'mo_ta_dia_diem',
        'hinh_anh_dia_diem',
        'ma_loai_dia_diem',
        'ma_danh_muc',
        'ma_xa_phuong',
    ];

    public function loaiDiaDiem()
    {
        return $this->hasOne('App\Models\LoaiDiaDiem', 'ma_loai_dia_diem', 'ma_loai_dia_diem');
    }

    public function dmDuLich()
    {
        return $this->hasOne('App\Models\DanhMucDuLich', 'ma_danh_muc', 'ma_danh_muc');
    }

    public function xaPhuong()
    {
        return $this->hasOne('App\Models\XaPhuong', 'ma_xa_phuong', 'ma_xa_phuong');
    }

    public function baiVietList()
    {
        return $this->belongsToMany('App\Models\BaiViet', 'dia_diem_bai_viets', 'ma_dia_diem', 'ma_bai_viet');
    }
}
