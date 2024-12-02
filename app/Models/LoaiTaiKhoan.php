<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiTaiKhoan extends Model
{
    use HasFactory;

    protected $primaryKey = 'ma_loai_tai_khoan';

    protected $fillable = [
        'ma_loai_tai_khoan',
        'ten_loai_tai_khoan',
    ];
}
