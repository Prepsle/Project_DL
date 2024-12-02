<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TaiKhoan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'ma_tai_khoan';

    protected $fillable = [
        'ma_tai_khoan',
        'ten_tai_khoan',
        'sdt',
        'email',
        'mat_khau',
        'ma_loai_tai_khoan',
        'da_thanh_toan',
        'da_duyet',
        'facebook_id',
        'hinh_dai_dien',
        'giay_phep_kd',
    ];

    protected $hidden = [
        'mat_khau',
    ];

    public function baiVietList()
    {
        return $this->hasMany('App\Models\BaiViet', 'nguoi_dang_bai_viet', 'ma_tai_khoan');
    }


    public function gioHangs()
    {
        return $this->hasMany(gio_hangs::class);
    }
}
